<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StripeWebhooks as Stripe;
use Increment\Imarket\Merchant\Models\Merchant;
use Carbon\Carbon;
class StripeController extends APIController
{
  protected $pk;
  protected $sk;
  protected $stripe = null;
  protected $customer = null;

  public $planController = 'App\Http\Controllers\PlanController';
  public $paymentMethodController = 'App\Http\Controllers\PaymentMethodController';
  public $billingController = 'App\Http\Controllers\BillingController';

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
      $plan = app($this->planController)->createByParams(array(
        'account_id' => $data['account_id'],
        'plan'       => $data['plan']['category'],
        'amount'     => intval($data['plan']['payload_value']),
        'currency'   => 'USD'
      ));

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

        $billing = app($this->billingController)->addToBilling(array(
          'account_id' => $data['account_id'],
          'currency'   => 'USD',
          'details'    => json_encode(array(
            'payment_method_id' => $paymentMethod,
            'plan_id'           => $plan
          )),
          'amount'     => intval($data['plan']['total']),
          'start_date' => Carbon::now(),
          'end_date'   => Carbon::now()->addMonths($data['plan']['months']),
          'status'     => 'paid'
        ));

        $merchant = Merchant::where('account_id', '=', $data['account_id'])->get();

        if($merchant && sizeof($merchant) > 0){
          //
        }else{
          Merchant::insert(array(
            'account_id' => $data['account_id'],
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