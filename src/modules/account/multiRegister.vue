<template>
  <div id="rooms" style="width: 100% !important; top: 100px">
    <div class="row" style="justify-content:center;display:flex;background-color:white" v-if="page!==4">
      <div class="col-md-4 text-center">
          <h6>
            <span :class="page===1 ? 'circle' : 'circle-outline'">1</span>
            Personal
          </h6>
      </div>
      <div class="col-md-4 text-center">
          <h6>
            <span  :class="page===2 ? 'circle' : 'circle-outline'">2</span>
            Business
          </h6>
      </div>
      <div class="col-md-4 text-center">
        <h6>
          <span :class="page===3 ? 'circle' : 'circle-outline'">3</span>
          Branding
        </h6>
      </div>
    </div>
    <div v-if="page===1">
      <div class="row">
        <div class="col-md-6">
          <p class="mt-2"><b>First Name</b></p>
            <roundedInput
              :type="'text'"
              :placeholder="'First Name'"
              :class="!this.isValid && (first_name == '' || !isFirstNameValid) ? 'mb-0 ' : ' registrationField'"
              :styles="{
                border: !this.isValid && (first_name == '' || !isFirstNameValid) ? '1px solid red !important' : 'none',
              }"
              v-model="first_name"
            />
            <p
              class="mb-0 pb-0 requiredFieldError"
              v-if="!this.isValid && (first_name == '' || !isFirstNameValid)"
            >{{
              !isFirstNameValid ?
                'Invalid First Name'
              :
                'Required Field'
            }}</p>
        </div>
        <!-- ///////////// -->
        <div class="col-md-6">
          <p class="mt-2"><b>Last Name</b></p>
            <roundedInput
              :type="'text'"
              :placeholder="'Last Name'"
              :class="!this.isValid && (last_name == '' || !isLastNameValid) ? 'mb-0 ' : ' registrationField'"
              :styles="{
                border: !this.isValid && (last_name == '' || !isLastNameValid) ? '1px solid red !important' : 'none',
              }"
              v-model="last_name"
            />
            <p
              class="mb-0 pb-0 requiredFieldError"
              v-if="!this.isValid && (last_name == '' || !isLastNameValid)"
            >{{
              !isLastNameValid ?
                'Invalid Last Name'
              :
                'Required Field'
            }}</p>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <p class="mt-2"><b>Phone Number</b></p>
            <roundedInput
              :type="'text'"
              :placeholder="'Phone Number'"
              :class="!this.isValid && (phone_number == '' || !isPhoneNumberValid) ? 'mb-0 ' : ' registrationField'"
              :styles="{
                border: !this.isValid && (phone_number == '' || !isPhoneNumberValid) ? '1px solid red !important' : 'none',
              }"
              v-model="phone_number"
            />
            <p
              class="mb-0 pb-0 requiredFieldError"
              v-if="!this.isValid && (phone_number == '' || !isPhoneNumberValid)"
            >{{
              !isPhoneNumberValid ?
                'Invalid Phone Number'
              :
                'Required Field'
            }}</p>
        </div>
        <!-- ///////////// -->
        <div class="col-md-6">
          <p class="mt-2"><b>Industry</b></p>
            <roundedInput
              :type="'text'"
              :placeholder="'Industry'"
              :class="!this.isValid && (selectedIndustry == '' || !isIndustryValid) ? 'mb-0 ' : ' registrationField'"
              :styles="{
                border: !this.isValid && (selectedIndustry == '' || !isIndustryValid) ? '1px solid red !important' : 'none',
              }"
              disabled
              v-model="selectedIndustry"
            />
            <p
              class="mb-0 pb-0 requiredFieldError"
              v-if="!this.isValid && (selectedIndustry == '' || !isIndustryValid)"
            >{{
              !isIndustryValid ?
                'Invalid Industry'
              :
                'Required Field'
            }}</p>
        </div>
      </div>
      <div>
        <p class="mt-2"><b>Email</b></p>
          <roundedInput
            :type="'text'"
            :placeholder="'Email'"
            :class="!this.isValid && (email == '' || !isEmailValid) ? 'mb-0 ' : ' registrationField'"
            :styles="{
              border: !this.isValid && (email == '' || !isEmailValid) ? '1px solid red !important' : 'none',
            }"
            v-model="email"
          />
          <p
            class="mb-0 pb-0 requiredFieldError"
            v-if="!this.isValid && (email == '' || !isEmailValid)"
          >{{
            !isEmailValid ?
              'Invalid Email'
            :
              'Required Field'
          }}</p>
      </div>
      <div class="row">
        <div class="col-md-6">
          <p class="mt-2"><b>Password</b></p>
            <roundedInput 
              :type="'password'"
              :placeholder="'Your password here...'"
              :class="!this.isValid && (password == '' || password != cpassword || passwordRequirements != '') ? 'mb-0 ' : ' registrationField'"
              :styles="{
                border: !this.isValid && (password == '' || password != cpassword || passwordRequirements != '') ? '1px solid red !important' : 'none',
              }"
              v-model="password"
            />
            <p
            class="mb-0 pb-0 requiredFieldError"
            v-if="!this.isValid && (password == '' || password != cpassword || passwordRequirements != '')"
          >{{
            password != cpassword ?
              passwordRequirements != '' ?
                passwordRequirements
              :
                'Password Did Not Match'
            :
              passwordRequirements != '' ?
                passwordRequirements
              :
              'Required Field'
          }}</p>
        </div>
        <!-- ///////////// -->
        <div class="col-md-6">
          <p class="mt-2"><b>Confirm Password</b></p>
          <roundedInput 
            :type="'password'"
            :placeholder="'Retype Password'"
            :class="!this.isValid && (password == '' || password != cpassword || passwordRequirements != '') ? 'mb-0 ' : ' registrationField'"
            :styles="{
              border: !this.isValid && (password == '' || password != cpassword || passwordRequirements != '') ? '1px solid red !important' : 'none',
              marginBottom: '5%'
            }"
            v-model="cpassword"
          />
          <p
            class="mb-0 pb-0 requiredFieldError"
            v-if="!this.isValid && (password == '' || password != cpassword || passwordRequirements != '')"
          >{{
            password != cpassword ?
              passwordRequirements != '' ?
                passwordRequirements
              :
                'Password Did Not Match'
            :
              passwordRequirements != '' ?
                passwordRequirements
              :
              'Required Field'
          }}</p>
        </div>
      </div>
      <p style="float: right; margin-top: 3%; cursor: pointer" @click="next(2)"><b>Next</b></p>
    </div>
    <div  v-if="page===2">
      <div>
        <p class="mt-2"><b>Business Name</b></p>
          <roundedInput
            :type="'text'"
            :placeholder="'Business Name'"
            :class="!this.isValid && (business_name == '' || !isBusinessNameValid) ? 'mb-0 ' : ' registrationField'"
            :styles="{
              border: !this.isValid && (business_name == '' || !isBusinessNameValid) ? '1px solid red !important' : 'none',
            }"
            v-model="email"
          />
          <p
            class="mb-0 pb-0 requiredFieldError"
            v-if="!this.isValid && (business_name == '' || !isBusinessNameValid)"
          >{{
            !isBusinessNameValid ?
              'Invalid Business Name'
            :
              'Required Field'
          }}</p>
      </div>
      <div>
        <p class="mt-2"><b>Location</b></p>
          <GooglePlacesAutoComplete
            :property="property"
            @onFinish="getAddressData($event)"
            >
          </GooglePlacesAutoComplete>
          <!-- <p
            class="mb-0 pb-0 requiredFieldError"
            v-if="!this.isValid && (email == '' || !isEmailValid)"
          >{{
            !isEmailValid ?
              'Invalid Email'
            :
              'Required Field'
          }}</p> -->
      </div>
      <span>
        <p style="margin-top: 5%; float: left; cursor:pointer" @click="page = 1"><b>Back</b></p>
        <p style="margin-top: 5%; float: right; cursor:pointer" @click="page = 3"><b>Next</b></p>
      </span>
    </div>
    <div v-if="page===3" style="margin-left: 10px">
      <p><b>Which option best describes your situation ?</b></p>
      <label class="container">I want to promote my Company Name Only.
        <input type="radio" name="radio" checked="checked" value="Company" v-model="brand">
        <span class="checkmark"></span>
      </label>
      <label class="container">I want to promote both myself and my Company Name.
        <input type="radio" name="radio" value="Myself and Company" v-model="brand">
        <span class="checkmark"></span>
      </label>
      <label class="container">I want to promote myself only without referencing a Company Name.
        <input type="radio" name="radio" value="Myself" v-model="brand">
        <span class="checkmark"></span>
      </label>
      <!-- <label class="container">Generated Question
        <input type="radio" name="radio">
        <span class="checkmark"></span>
      </label> -->
      <span>
        <p style="margin-top: 5%; float: left; cursor:pointer" @click="page = 1"><b>Back</b></p>
        <p style="margin-top: 5%; float: right; font-size: 15px; cursor:pointer; color: blue;" @click="generateBrand()"><b>Submit</b></p>
        <!-- <p style="margin-top: 5%; float: right; cursor:pointer" @click="page = 3"><b>Submit</b></p> -->
      </span>
      <!-- <Checkout :addOns="selectedAddOn"/> -->
    </div>
  </div>
</template>
<style scoped lang="scss">
@import "~assets/style/colors.scss";
/* The container */
.container {
  display: block;
  position: relative;
  padding-left: 35px;
  margin-bottom: 15px;
  cursor: pointer;
  font-size: 14px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* Hide the browser's default radio button */
.container input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
}

/* Create a custom radio button */
.checkmark {
  position: absolute;
  top: 0;
  left: 0;
  height: 25px;
  width: 25px;
  background-color: #eee;
  border-radius: 50%;
}

/* On mouse-over, add a grey background color */
.container:hover input ~ .checkmark {
  background-color: #ccc;
}

/* When the radio button is checked, add a blue background */
.container input:checked ~ .checkmark {
  background-color: #2196F3;
}

/* Create the indicator (the dot/circle - hidden when not checked) */
.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the indicator (dot/circle) when checked */
.container input:checked ~ .checkmark:after {
  display: block;
}

/* Style the indicator (dot/circle) */
.container .checkmark:after {
 	top: 9px;
	left: 9px;
	width: 8px;
	height: 8px;
	border-radius: 50%;
	background: white;
}

.requiredFieldError {
  color: $danger;
  font-size: 10px;
  margin-left: 20px;
  margin-bottom: 25px !important;
}
.registrationField {
  margin-bottom: 5px;
}
.form-group {
  display: block;
  margin-bottom: 15px;
}

.form-group input {
  padding: 0;
  height: initial;
  width: initial;
  margin-bottom: 0;
  display: none;
  cursor: pointer;
}

.form-group label {
  position: relative;
  cursor: pointer;
}

.form-group label:before {
  content:'';
  -webkit-appearance: none;
  background-color: transparent;
  border: 1px solid gray;
  box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05), inset 0px -15px 10px -12px rgba(0, 0, 0, 0.05);
  padding: 10px;
  display: inline-block;
  position: relative;
  vertical-align: middle;
  cursor: pointer;
  margin-right: 5px;
}

.form-group input:checked + label:after {
  content: '';
  display: block;
  position: absolute;
  top: 4px;
  left: 9px;
  width: 6px;
  height: 14px;
  border: 2px solid $primary;
  border-width: 0 2px 2px 0;
  transform: rotate(45deg);
}

.form-group input:checked ~ label:before{
  background-color: white;
}

.pagerLeft, .pagerRight{
  font-size:30px;
  background-color:$primary; 
  color:white; 
  padding-left:10px; 
  padding-right:15px; 
  padding-top:5px; 
  padding-bottom:5px
}
.btn{
  height:60px !important;
}
.form-check-label{
  width: 50%;
}
.circle {
  padding: 9px;
  padding-left: 18px;
  padding-right: 18px;
  width: 30px;
  height: 30px;
  line-height: 80px;
  border-radius: 80%;
  font-size: 15px;
  color: #fff;
  text-align: center;
  background: #000
}

.circle-outline{
  background-color:#fff;
  border:1px solid gray;    
  -moz-border-radius:50%;
  -webkit-border-radius:50%;
  padding: 10px;
  padding-left: 18px;
  padding-right: 18px;
  width: 30px;
  height: 30px;
  line-height: 80px;
  border-radius: 80%;
  font-size: 15px;
  text-align: center;
}

.text-primary{
  color: $primary !important;
}

.bg-primary{
  background: $primary !important;
}

.item, .item-content{
  width: 100%;
  float: left;
  height: 100%;
}

.item-menu{
  width: 100%;
  float: left;
}

.item-menu label:hover{
  cursor: pointer;
}

.item-menu label{
  width: 50px;
  height: 50px;
  border-radius: 50%;
  text-align: center;
  background: $warning;
  color: white;
  line-height: 50px;
  margin-right: 2px;
}

.holder{
  min-height: 93vh;
  width: 100%;
  float: left;
  background: white;
  position: relative;
}

.details{
  width: 50%;
  float: left;
  height: 100%;
  text-align: justify;
  padding-left: 50px;
  padding-right: 50px;
  padding-top: 25px;
  padding-bottom: 25px;
  position: relative;
}

.image-holder{
  float: left;
  height: 100%;
  width: 50%;
  overflow: hidden;
  position: relative;
}

img{
  width: 100%;
  height: 93vh;
}

.btn{
  width: 100%;
  margin-top: 0px;
}

.check-icon{
  font-size: 20px;
  float: left;
  width: 5%;
}

ul{
  margin-top: 0px;
}
ul li{
  margin-bottom: 0px;
  width: 100%;
  float: left;
}


ul li label{
  float: left;
  width: 93%;
  margin-left: 2%;
}

h3{
  margin-top: 10px;
  float: left;
  width: 100%;
}
h5{
  margin-top: 0px;
}

.circle-icon{
  position: absolute;
  right: 50px;
  bottom: 50px;
  z-index: 1000;
  color: white;
}

.image-menu-holder{
  width: 100px;
  height: 100px;
  overflow: hidden;
  margin-right: 10px;
}

.image-menu-holder img{
  max-height: 100px;
  max-width: 100px;
  opacity: 0.7;
}

.image-menu-holder img:hover{
  cursor: pointer;
  opacity: 1;
}

.image-menu-holder .active-image{
  opacity: 1;
}

.circle-item{
  margin-right: 5px;
}

.circle-item:hover{
  cursor: pointer;
}

.header{
  background-color: $primary;
  padding-top: 20px;
  padding-bottom: 20px;
  padding-left: 10px;
  color:#fff;
  font-weight: bold;
  font-size: 20px;
}
.checkBox{
  padding-left: 10%;
  padding-top: 15px;
  padding-bottom: 15px;
}

.card{
  width: 100%;
  border: none;
  // margin-left: 30%;
}
@media (max-width: 992px) {
  .image-holder{
    min-height: 30vh;
    overflow-y: hidden;
    width: 100%;
  }

  img{
    width: 100%;
    height: auto;
  }

  .circle-icon{
    left: 10px;
    bottom: 10px;
  }
  .image-menu-holder{
    width: 75px;
    height: 75px;
  }

  .image-menu-holder img{
    max-width: 75px;
    max-height: 75px;
  }
  .details{
    min-height: 70vh;
    width: 100%;
    margin-top: 0px;
    padding-left: 25px;
    padding-right: 25px;
  }
}
</style>
<script>
import dialogueBtn from 'src/modules/generic/dialogueBtn'
import global from 'src/helpers/global'
import COLORS from 'src/assets/style/colors.js'
import COMMON from 'src/common.js'
import ROUTER from 'src/router'
import roundedInput from 'src/modules/generic/roundedInput'
import VueSlider from 'vue-slider-component'
import 'vue-slider-component/theme/default.css'
import AUTH from 'src/services/auth'
import GooglePlacesAutoComplete from 'src/components/increment/generic/location/GooglePlacesAutoComplete'
import CONFIG from 'src/config.js'
export default {
  components: {
    dialogueBtn,
    roundedInput,
    VueSlider,
    GooglePlacesAutoComplete
  },
  mounted(){
    this.location = window.location.hostname
    let params = this.$route.params
    if(params.category){
      this.selectedIndustry = params.category
    }
    setTimeout(() => {
      this.retrievePayloads()
    }, 1000)
  },
  data(){
    return {
      colors: COLORS,
      common: COMMON,
      config: CONFIG,
      selectedIndustry: null,
      page: 1,
      user: AUTH.user,
      router: ROUTER,
      tokenData: AUTH.tokenData,
      isValid: true,
      isEmailValid: true,
      isFirstNameValid: true,
      isLastNameValid: true,
      isBusinessNameValid: true,
      isPhoneNumberValid: true,
      isIndustryValid: true,
      first_name: '',
      last_name: '',
      phone_number: '',
      business_name: '',
      password: '',
      cpassword: '',
      email: '',
      passwordRequirements: '',
      industry: [],
      brand: 'brand',
      errorMessage: null,
      selectedLocation: null,
      property: {
        style: {
          outline: 'none !important',
          boxShadow: 'none !important',
          height: '45px !important',
          borderRadius: '40px !important',
          border: '1px solid $gray !important'
        },
        placeholder: null,
        GOOGLE_API_KEY: CONFIG.GOOGLE.API_KEY,
        results: {
          style: {
            zIndex: '99999999px'
          }
        }
      }
    }
  },
  methods: {
    generateBrand(){
      let parameter = {
        company_name: this.business_name,
        employee_name: this.first_name + '' + this.last_name,
        company_location: JSON.stringify({
          route: this.selectedLocation.route,
          locality: this.selectedLocation.locality,
          region: this.selectedLocation.region,
          country: this.selectedLocation.country,
          latitude: this.selectedLocation.latitude,
          longitude: this.selectedLocation.longitude
        }),
        company_industry: this.selectedIndustry,
        entity: this.brand
      }
      console.log('[params]', parameter)
      this.APIRequest('image_generator/generate_text', parameter).then(res => {
        console.log('[sdfasdfasdf]', res)
      })
    },
    register() {
      if(this.validate() && this.validate2()) {
        this.isValid = true
        let parameter = {
          username: this.email,
          email: this.email,
          password: this.password,
          account_type: 'USER',
          referral_code: null,
          status: 'ADMIN',
          business_name: this.business_name,
          first_name: this.first_name,
          last_name: this.last_name,
          cellular: this.phone_number,
          address: JSON.stringify({
            route: this.selectedLocation.route,
            locality: this.selectedLocation.locality,
            region: this.selectedLocation.region,
            country: this.selectedLocation.country,
            latitude: this.selectedLocation.latitude,
            longitude: this.selectedLocation.longitude
          }),
          details: JSON.stringify({
            brand1: this.brand1,
            brand2: this.brand2,
            brand3: this.brand3
          }),
          industry: JSON.stringify({industry: this.selectedIndustry})
        }
        $('#loading').css({'display': 'block'})
        this.APIRequest('account/create', parameter).then(response => {
          $('#loading').css({'display': 'none'})
          if(response.data !== null) {
            this.createMerchantAndPayload(response.data.data)
            // this.login()
          }else if(response.error !== null){
            if(response.error.status === 100){
              let message = response.error.message
              // if(typeof message.username !== undefined && typeof message.username !== 'undefined'){
              //   this.errorMessage = message.username[0]
              if(typeof message.email !== undefined && typeof message.email !== 'undefined'){
                this.errorMessage = message.email[0]
              }
            }else{
              let message = response.error.message
              this.errorMessage = message
            }
          }
        })
      }
    },
    async createMerchantAndPayload(id) {
      let merchant = {
        account_id: id,
        name: this.email,
        email: this.email,
        addition_informations: JSON.stringify({industry: this.selectedIndustry})
      }
      let payload = {
        account_id: id,
        payload: 'automation_settings',
        payload_value: 'ON'
      }
      this.APIRequest('merchants/create', merchant).then(response => {
        console.log('MERCHANT RESPONSE: ', response)
      }).catch(error => {
        console.log('MERCHANT ERROR', error)
      })
      this.APIRequest('payloads/create', payload).then(response => {
        console.log('PAYLOAD RESPONSE: ', response)
      }).catch(error => {
        console.log('PAYLOAD ERROR', error)
      })

      await this.login()
    },
    validate() {
      if(this.first_name !== '' && this.last_name !== '' && this.phone_number !== '' && this.first_name !== undefined && this.last_name !== undefined && this.phone_number !== undefined && this.email !== '' && this.password !== '' || this.cpassword !== '') {
        if(!global.validateField(this.first_name) && !global.validateField(this.last_name) && global.validateNumber(this.phone_number) === true && !this.email.includes(' ') && global.validateEmail(this.email) && (this.password === this.cpassword)) {
          this.isFirstNameValid = true
          this.isLastNameValid = true
          this.isPhoneNumberValid = true
          this.isEmailValid = true
          this.isValid = true
          return true
        }else if(this.password !== this.cpassword) {
          this.isValid = false
          return false
        }else if(!global.validatePassword(this.password)) {
          this.isValid = false
          this.passwordRequirements = 'Password should be minimum of 8 and maximum of 16.'
          return false
        }else{
          this.isValid = false
          this.isEmailValid = false
          this.isFirstNameValid = false
          this.isLastNameValid = false
          this.isPhoneNumberValid = false
          return false
        }
      }else {
        this.isValid = false
        this.isEmailValid = false
        this.isFirstNameValid = false
        this.isLastNameValid = false
        this.isPhoneNumberValid = false
        return false
      }
    },
    validate2() {
      if(this.business_name !== '' && this.selectedLocation !== null) {
        this.isValid = true
        this.isBusinessNameValid = true
        return true
      }else {
        this.isValid = false
        this.isBusinessNameValid = false
        return false
      }
    },
    next(page){
      if(page === 2 && !this.validate()) {
        console.log('Not valid')
        return
      }else if(page === 3 && !this.validate2()){
        console.log('[Not Valid2]')
        return
      }else{
        this.page = page
      }
    },
    previous(page){
      this.page = page
    },
    getAddressData(e) {
      this.selectedLocation = e
      this.property.placeholder = e
    },
    retrievePayloads(){
      let conditions = [{
        value: 'subscriptions',
        clause: '=',
        column: 'payload'
      }, {
        value: this.selectedIndustry,
        clause: '=',
        column: 'category'
      }]
      let parameter = {
        condition: conditions
      }
      $('#loading').css({'display': 'block'})
      this.APIRequest('payloads/retrieve', parameter).then(response => {
        $('#loading').css({'display': 'none'})
        if(response.data.length > 0) {
          this.industry = response.data[0].category
        }else{
          this.industry = []
        }
      }).catch(error => {
        $('#loading').css({'display': 'none'})
        error
      })
    }
  }
}
</script>
