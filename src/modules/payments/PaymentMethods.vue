<template>
  <div>
    <h5>Payment Method</h5>
    <div class="col-sm-12 p-0 mt-4">
      <div class="payment-method" v-if="paymentMethod !== null">
        <label>
          <i class="fab fa-cc-visa" v-if="paymentMethod.details.source.card.brand === 'Visa'"></i>
          <i class="fab fa-cc-discover" v-if="paymentMethod.details.source.card.brand === 'Discover'"></i>
          <i class="fab fa-cc-mastercard" v-if="paymentMethod.details.source.card.brand === 'Mastercard'"></i>
          {{paymentMethod.details.source.card.brand}}
           (****{{paymentMethod.details.source.card.last4}})
        </label>
        <p>Expire on {{paymentMethod.details.source.card.exp_month + '/' + paymentMethod.details.source.card.exp_year}}</p>
        <p>
          Added on {{paymentMethod.created_at}}
        </p>
        <roundedBtn
          :onClick="addNewPaymentMethod"
          :text="'Change payment method'"
          :styles="{
            backgroundColor: '#01004E',
            color: 'white'
          }"
          v-if="newPaymentFlag === false"
        />
      </div>

      <roundedBtn
        :onClick="addNewPaymentMethod"
        :text="'Add new payment method'"
        :styles="{
          backgroundColor: '#01004E',
          color: 'white'
        }"
        v-if="newPaymentFlag === false && data === null"
      />
      <div class="new-payment-method-holder" v-if="newPaymentFlag === true">
        <div class="card-holder">
          <div class="fontawesome-icons">
            <i class="fa fa-cc-visa"></i>
            <i class="fa fa-cc-discover"></i>
            <i class="fa fa-cc-mastercard"></i>
            <i class="fa fa-cc-amex"></i>
            <i class="fa fa-cc-jcb"></i>
          </div>
          <stripe-cc ref="stripe" />
          <roundedBtn 
            :onClick="() => {
              this.newPaymentFlag = false
            }"
            :text="'Cancel'" 
            :styles="{
              marginBottom: '25px',
              marginRight: '10px'
            }"
          />
          <roundedBtn
            :onClick="() => {
              authorize()
            }"
            :text="'Authorize'"
            :styles="{
              backgroundColor: '#01004E',
              color: 'white',
              marginBottom: '25px'
            }"
          />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import roundedBtn from 'src/modules/generic/roundedBtn'
import COLORS from 'src/assets/style/colors.js'
import AUTH from 'src/services/auth'
export default {
  mounted(){
    if(this.data){
      this.paymentMethod = {
        ...this.data,
        details: JSON.parse(this.data.details)
      }
    }
  },
  data() {
    return {
      user: AUTH.user,
      newPaymentFlag: false,
      paymentMethod: null
    }
  },
  props: ['data'],
  components: {
    roundedBtn,
    'stripe-cc': require('modules/payments/Stripe.vue')
  },
  methods: {
    addNewPaymentMethod(){
      this.newPaymentFlag = true
    },
    retrieve(){
      this.newPaymentFlag = false
      this.$parent.retrieveRoot()
    },
    authorize(){
      this.$refs.stripe.createCustomer()
    }
  }
}
</script>

<style lang="scss" scoped>
@import "~assets/style/colors.scss";
.new-payment-method-holder{
  width: 100%;
  float: left;
}

.card-holder{
  width: 50%;
  float: left;
}
.fab{
  font-size: 14px !important;
}

.payment-method{
  padding: 15px;
  border: solid 1px #eee;
  border-radius: 5px;
  width: 24%;
  margin-right: 76%;
  float: left;
  margin-bottom: 25px;
}

.fontawesome-icons{
  margin-bottom: 10px;
  margin-left: -5px;
  font-size: 32px;
  color: $primary;
}
</style>
