<template>
  <div>
    <h5> Current payment methods </h5>
    <div class="col-sm-12 p-0 mt-4">
      <roudedBtn
        :onClick="addNewPaymentMethod"
        :text="'Add new payment method'"
        :styles="{
          backgroundColor: '#01004E',
          color: 'white'
        }"
        v-if="newPaymentFlag === false"
      />
      <div class="payment-method" v-if="newPaymentFlag === true">
        <div class="card-holder">
          <stripe-cc ref="stripe" />
          <roudedBtn
            :onClick="authorize"
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
import roudedBtn from 'src/modules/generic/roundedBtn'
import COLORS from 'src/assets/style/colors.js'
import AUTH from 'src/services/auth'
export default {
  data() {
    return {
      user: AUTH.user,
      newPaymentFlag: false
    }
  },
  components: {
    roudedBtn,
    'stripe-cc': require('modules/payments/Stripe.vue')
  },
  methods: {
    addNewPaymentMethod(){
      this.newPaymentFlag = true
    },
    authorize(){
      this.$refs.stripe.addNewPaymentMethod()
    }
  }
}
</script>

<style lang="scss" scoped>
@import "~assets/style/colors.scss";
.payment-method{
  width: 100%;
  float: left;
}

.card-holder{
  width: 50%;
  float: left;
}
</style>
