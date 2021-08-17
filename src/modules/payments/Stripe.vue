<template>
    <div class="payment-accounts">
      <div class="text-danger" v-if="errorMessage !== null" style="padding-top: 10px; padding-bottom: 10px;">Opps! {{errorMessage}}</div>
      <div :class="{complete}">
        <div class="row">
          <div class="form-group login-spacer col-lg-12 col-md-12 col-sm-12">
            <label for="address">Card Number</label>
            <card-number class="stripe-element card-number"
              ref="cardNumber"
              :stripe="stripeSK"
              @change="number = $event.complete"
              :options="options"
            />
          </div>
        </div>

        <div class="row">
          <div class="form-group login-spacer col-lg-6 col-md-6 col-sm-12">
            <label for="address">Expiration</label>
            <card-expiry class="stripe-element card-expiry"
              ref="cardExpiry" 
              :stripe="stripeSK" 
              @change="expiry = $event.complete"
              :options="options"
            />
          </div>

          <div class="form-group login-spacer col-lg-6 col-md-6 col-sm-12">
            <label for="address">CVC</label>
            <div id="signup-card-number">
              <card-cvc class='stripe-element card-cvc'
                ref='cardCvc'
                :stripe="stripeSK" 
                @change="expiry = $event.complete" 
                :options="options"
              />
            </div>
          </div>
        </div>
      </div>
  </div>
  </div>
</template>
<style>
.btn-block{
  height: 50px !important;
}
.payment-accounts, .billing-summary{
  width: 100%;
  float: left;
}

.payment-accounts .accounts-item{
  width: 100%;
  float: left;
  min-height: 10px;
  overflow-y: hidden;
  display: table;
}

.new-payment-method{
  width: 50%;
  float: left;
}

.accounts-item .details{
  margin-right: 10px;
  margin-top: 10px;
  width: 100%;
  float: left;
}

.accounts-item i{
  font-size: 32px;
  display:inline-block;
  vertical-align: -6px;
  margin-right: 10px;
}

.accounts-item i:hover{
  cursor: pointer;
}

.stripe-element{
  height: 45px;
  display: block;
  width: 100%;
  padding: .5rem .75rem;
  font-size: 12px;
  background-color: #fff;
  background-image: none;
  background-clip: padding-box;
  border: 1px solid rgba(0,0,0,.15);
  border-radius: .25rem;
  transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
}

.stripe-element.card-number, .stripe-element.card-expiry, .stripe-element.card-cvc{
  padding: 0px;
}

.StripeElement{
  padding: .90rem .75rem;
  color: #495057;
  line-height: 1.25;
}

@media (max-width: 992px){
  .new-payment-method{
    width: 100%;
    float: left;
  }
}
.payment-methods{
  float: left;
  width: 100%;
}
.payment-label{
  line-height: 100px;
  border-bottom: solid 1px #eee;
}
</style>
<script>
import ROUTER from 'src/router'
import AUTH from 'src/services/auth'
import CONFIG from 'src/config.js'
import CardExpiry from 'src/components/stripe/CardExpiry'
import CardCvc from 'src/components/stripe/CardCvc'
import CardNumber from 'src/components/stripe/CardNumber'
import { Stripe } from 'src/components/stripe/stripeElements'
export default {
  data(){
    return{
      user: AUTH.user,
      config: CONFIG,
      errorMessage: null,
      complete: false,
      number: false,
      expiry: false,
      cvc: false,
      stripeSK: (CONFIG.IS_DEV === true) ? CONFIG.stripe.dev_pk : CONFIG.stripe.live_pk,
      options: {
        style: {base: {
          fontSize: '16px'
        }}
      }
    }
  },
  props: ['creditCard', 'paypal', 'paymentMethod', 'data'],
  components: {
    CardNumber,
    CardCvc,
    CardExpiry
  },
  methods: {
    redirect(route){
      ROUTER.push(route)
    },
    selectPaymentAccount(index){
      this.accountsItem[index].flag = !this.accountsItem[index].flag
    },
    addNewPaymentMethod(){
      if(this.user.userID <= 0 && this.data === null){
        return
      }
      if(this.user.merchant && this.user.merchant.addition_informations === null){
        return
      }
      console.log({
        data: this.data
      })
      $('#loading').css({'display': 'block'})
      this.errorMessage = null
      Stripe.createSource().then(data => {
        if(data.error !== undefined){
          // console.log(data.error)
          $('#loading').css({'display': 'none'})
          this.errorMessage = data.error.message
        }else{
          if(this.user.information.first_name !== undefined){
            let parameter = {
              source: data.source,
              account_id: this.user.userID,
              plan: this.data,
              email: this.user.email,
              name: this.user.information.first_name + ' ' + this.user.information.last_name
            }
            this.APIRequest('stripe_webhooks/charge_customer', parameter).then(response => {
              $('#loading').css({'display': 'none'})
              if(response.data){
                this.redirect('/thankyou')
              }
            })
          }else{
            $('#loading').css({'display': 'none'})
            this.redirect('/settings')
          }
        }
      })
    },
    createCustomer(){
      if(this.user.userID <= 0 && this.data === null){
        return
      }
      if(this.user.merchant && this.user.merchant.addition_informations === null){
        return
      }
      console.log({
        data: this.data
      })
      $('#loading').css({'display': 'block'})
      this.errorMessage = null
      Stripe.createSource().then(data => {
        if(data.error !== undefined){
          // console.log(data.error)
          $('#loading').css({'display': 'none'})
          this.errorMessage = data.error.message
        }else{
          let parameter = {
            source: data.source,
            account_id: this.user.userID,
            email: this.user.email,
            name: this.user.information.first_name + ' ' + this.user.information.last_name
          }
          this.APIRequest('stripe_webhooks/create_customer', parameter).then(response => {
            $('#loading').css({'display': 'none'})
            if(response.data){
              this.$parent.retrieve()
            }
          })
        }
      })
    }
  }
}
</script>
