<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StripeWebhooks as Stripe;
use Increment\Imarket\Merchant\Models\Merchant;
use Carbon\Carbon;
use App\Billing;
class StripeController extends APIController
{
  protected $pk;
  protected $sk;
  protected $stripe = null;
  protected $customer = null;

  public $planController = 'App\Http\Controllers\PlanController';
  public $paymentMethodController = 'App\Http\Controllers\PaymentMethodController';
  public $billingController = 'App\Http\Controllers\BillingController';
  public $emailController = 'App\Http\Controllers\EmailController';

  function __construct(){
    $this->pk = env('STRIPE_PK');
    $this->sk = env('STRIPE_SK');

    $this->stripe = new Stripe($this->pk, $this->sk);
  }

  public function createCustomer(Request $request){
    $data = $request->all();

    if($this->stripe == null){
      $this->response['data'] = null;
      $this->response['error'] = 'Invalid Stripe Credentials';
      return $this->response();
    }

    $this->customer = $this->stripe->createCustomer($data['email'], $data['source']['id'], $data['name']);

    if($this->customer){
      $paymentMethod = app($this->paymentMethodController)->createByParams(
        array(
          'account_id'  => $data['account_id'],
          'method'      => 'stripe',
          'details'     => json_encode(array(
            'customer' => $this->customer,
            'source'   => $data['source']
          )),
          'status'      => 'active'
        )
      );
      $this->response['data'] = $paymentMethod;
    }
    return $this->response();
  }

  public function chargeCustomerByBilling($billing){
    // get plan
    // get payment method
    // get account
    $plan = app($this->planController)->getByParams('account_id', $billing['account_id']);
    $paymentMethod = app($this->paymentMethodController)->getByParams('account_id', $billing['account_id']);
    if($plan && $paymentMethod && $billing){
      // USD 299 Constructions Monthy Plan
      $title = 'USD '.$plan['amount'].' '.$plan['plan'].' Monthy Plan';
      $paymentMethodDetails = json_decode($paymentMethod['details'], true);
      $charge = $this->stripe->chargeCustomer($paymentMethodDetails['customer']['email'], $paymentMethodDetails['source']['id'], $paymentMethodDetails['customer']['id'], $billing['amount'] * 100, $title);
      if($charge && $charge->id){
        return true;
      }else{
        return false;
      }
    }else{
      return false;
    }
  }

  public function chargeCustomer(Request $request){
    $data = $request->all();

    if($this->stripe == null){
      $this->response['data'] = null;
      $this->response['error'] = 'Invalid Stripe Credentials';
      return $this->response();
    }

    $this->customer = $this->stripe->createCustomer($data['email'], $data['source']['id'], $data['name']);

    if($this->customer){
      $title = ' '.$data['plan']['title'];
      $charge = $this->stripe->chargeCustomer($data['email'], $data['source']['id'], $this->customer->id, $data['plan']['total'] * 100, $title);

      // save to plan with start and end date
      $plan = app($this->planController)->getByParams('account_id', $data['account_id']);
      $lastDate = null;
      if($plan == null){
        $plan = app($this->planController)->createByParams(array(
          'account_id' => $data['account_id'],
          'plan'       => $data['plan']['category'],
          'amount'     => intval($data['plan']['payload_value']),
          'currency'   => 'USD'
        ));        
      }else{
        $lastDate = $plan['end_date'] ? Carbon::createFromFormat('Y-m-d H:i:s', $plan['end_date']) : null;
        app($this->planController)->updateByParams($plan['id'],
          array(
            'end_date' => null,
            'updated_at' => Carbon::now()
          )
        );
      }


      $paymentMethod = app($this->paymentMethodController)->createByParams(
        array(
          'account_id'  => $data['account_id'],
          'method'      => 'stripe',
          'details'     => json_encode(array(
            'customer' => $this->customer,
            'source'   => $data['source']
          )),
          'status'      => 'active'
        )
      );

      if($plan && $charge && $paymentMethod){
        // create billing
        $startDate = $lastDate ? $lastDate->copy() : Carbon::now();
        $billingEndDate = $lastDate ? $lastDate->addMonths($data['plan']['months']) : Carbon::now()->addMonths($data['plan']['months']);

        $billing = Billing::where('account_id', '=', $data['account_id'])->orderBy('end_date', 'desc')->limit(1)->get();

        if($billing && sizeof($billing) > 0 && $billing[0]['status'] == 'not paid'){
          // create new end date based from start date
          $endDate = Carbon::createFromFormat('Y-m-d H:i:s', $billing[0]['start_date']);
          $newBillingEndDate = $endDate->addMonths($data['plan']['months']);
          Billing::where('id', '=', $billing[0]['id'])->update(array(
            'end_date' => $newBillingEndDate,
            'status'   => 'paid'
          ));
        }else{
          $billingData = array(
            'account_id' => $data['account_id'],
            'currency'   => 'USD',
            'details'    => json_encode(array(
              'payment_method_id' => $paymentMethod,
              'plan_id'           => $plan
            )),
            'amount'     => intval($data['plan']['total']),
            'start_date' => $startDate,
            'end_date'   => $billingEndDate,
            'status'     => 'paid'
          );
          $billing = app($this->billingController)->addToBilling($billingData);
          $billingData['plan'] = $data['plan']['category'];
          if(env('SES_KEY')){
            app($this->emailController)->receipt($data['account_id'], $billingData);
          }
        }


        $merchant = Merchant::where('account_id', '=', $data['account_id'])->get();

        if($merchant && sizeof($merchant) > 0){
          //
        }else{
          Merchant::insert(array(
            'account_id' => $data['account_id'],
            'status'     => 'verified',
            'addition_informations' => json_encode(array(
              'industry' => $data['plan']['category']
            ))
          ));
        }
      }


      // save charge to the database

      $this->response['data'] = array(
        'charge' => json_encode($charge),
        'customer' => json_encode($this->customer)
      );

      return $this->response();
    }else{
      return $this->response();
    }
  }


}