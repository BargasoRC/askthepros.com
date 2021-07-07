<template>
  <div class="container-fluid mb-5">
		<h2 class="mt-5">Checkout Summary</h2>
		<hr />
		<div>
			<p><b>Terms:</b> Month 1 - $299 (includes one-time set up fee $199) then $99/mo. auto-billed. Cancel anytime. </p>
		</div>
		<div class="col-sm-7 p-0 mt-3">
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th scope="col">DESCRIPTION</th>
						<th scope="col">AMMOUNT</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Managed Social Media Posting - Initial Payment</td>
						<td>$299.00</td>
					</tr>
					<tr>
						<td><b>Total</b></td>
						<td>$299.00</td>
					</tr>
				</tbody>
			</table>
		</div>
    <div class="mt-1 choose_payment">
		  <b>Choose Payment:</b>
    </div>
    <div class="d-flex stripe_btn_container mt-3">
      <i id="stripe" class="far fa-dot-circle" v-if="payment" @click="choose"></i>
      <i id="stripe" class="far fa-circle"  v-if="!payment" @click="choose"></i>
      <label for="stripe" class="stripe_label">Stripe</label>
    </div>
    <div class="mt-3">
      <img class="payment" :src="require('src/assets/img/pay_methods.png')" alt="Payment Methods">
    </div>
    <div class="col-sm-6 p-0 mt-5">
      <div>
        <p class="mb-2"><i :style="{
          color: 'red'
        }">*</i>Name on the card:</p>
        <input 
          :class="!isValid && cardName == '' ? 'form-control mb-0' : 'form-control'"
          :style="{
            ...!isValid && cardName == '' ? {border: '1px solid red !important'} : '',
            ...{
              height: '45px'
            }
          }"
          v-model="cardName"
        >
        <p
          class="mb-0 pb-0 requiredFieldError ml-0 mt-1"
          v-if="!isValid && cardName == ''"
        >Required Field</p>
      </div>
      <div class="mt-3">
        <p class="mb-2"><i :style="{
          color: 'red'
        }">*</i>Credit Number:</p>
        <input 
          :class="!isValid && cardNumber == '' ? 'form-control mb-0' : 'form-control'"
          placeholder="Card number"
          :style="{
            ...!isValid && cardNumber == '' ? {border: '1px solid red !important'} : '',
            ...{
              height: '45px'
            }
          }"
          v-model="cardNumber"
        >
        <p
          class="mb-0 pb-0 requiredFieldError ml-0 mt-1"
          v-if="!isValid && cardNumber == ''"
        >Required Field</p>
      </div>
      <div class="mt-3">
        <p class="mb-2"><i :style="{
          color: 'red'
        }">*</i>Expiration</p>
        <input 
          :class="!isValid && cardExpiration == '' ? 'form-control mb-0' : 'form-control'"
          placeholder="MM / YY"
          :type="'date'"
          :style="{
            ...!isValid && cardExpiration == '' ? {border: '1px solid red !important'} : '',
            ...{
              height: '45px'
            }
          }"
          v-model="cardExpiration"
        >
        <p
          class="mb-0 pb-0 requiredFieldError ml-0 mt-1"
          v-if="!isValid && cardNumber == ''"
        >Required Field</p>
      </div>
      <div class="mt-3">
        <p class="mb-2"><i :style="{
          color: 'red'
        }">*</i>CVC</p>
        <input 
          :class="!isValid && cardCVC == '' ? 'form-control mb-0' : 'form-control'"
          placeholder="MM / YY"
          :style="{
            ...!isValid && cardCVC == '' ? {border: '1px solid red !important'} : '',
            ...{
              height: '45px'
            }
          }"
          v-model="cardCVC"
        >
        <p
          class="mb-0 pb-0 requiredFieldError ml-0 mt-1"
          v-if="!isValid && cardNumber == ''"
        >Required Field</p>
      </div>
      <div class="mt-3 d-flex justify-content-start">
        <div>
          <i class="far fa-square" :style="{
            cursor: 'pointer'
          }" v-if="!isAgree" @click="agree"></i>
          <i class="far fa-check-square" :style="{
            cursor: 'pointer'
          }" v-if="isAgree" @click="agree"></i>
        </div>
        <div class="ml-2">
          <p class="mb-2"><i :style="{
            color: 'red'
          }">*</i>I agree my card will be automatically billed monthly until cancellation.</p>
        </div>
      </div>
      <div class="mt-5">
        <roudedBtn
          :onClick="checkout"
          :text="'Checkout'"
          :styles="{
            backgroundColor: '#01004E',
            color: 'white'
          }"
        />
      </div>
    </div>
	</div>
</template>

<script>
import roudedBtn from 'src/modules/generic/roundedBtn'
export default {
  data() {
    return {
      payment: true,
      isValid: true,
      cardName: '',
      cardNumber: '',
      cardExpiration: '',
      cardCVC: '',
      isAgree: false
    }
  },
  components: {
    roudedBtn
  },
  methods: {
    choose() {
      this.payment = !this.payment
    },
    agree() {
      this.isAgree = !this.isAgree
    },
    checkout() {
      console.log('')
    }
  }
}
</script>

<style lang="scss" scoped>
@import "~assets/style/colors.scss";
.choose_payment {
  margin-top: 30px !important;
}
#stripe {
  color: $darkPrimary !important;
  cursor: pointer;
}
.stripe_btn_container {
  align-items: center;
}
.stripe_label {
  display: inline;
  margin-bottom: 0;
  margin-left: 15px;
  font-weight: 500;
}
</style>
