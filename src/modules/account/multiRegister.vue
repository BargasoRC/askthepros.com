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
            Preview
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
              :class="!this.isValid && (phone_number == '' || !isPhoneNumber) ? 'mb-0 ' : ' registrationField'"
              :styles="{
                border: !this.isValid && (phone_number == '' || !isPhoneNumber) ? '1px solid red !important' : 'none',
              }"
              v-model="phone_number"
            />
            <p
              class="mb-0 pb-0 requiredFieldError"
              v-if="!this.isValid && (phone_number == '' || !isPhoneNumber)"
            >{{
              !isPhoneNumber ?
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
              :class="!this.isValid && (industry == '' || !isIndustryValid) ? 'mb-0 ' : ' registrationField'"
              :styles="{
                border: !this.isValid && (industry == '' || !isIndustryValid) ? '1px solid red !important' : 'none',
              }"
              disabled
              v-model="industry"
            />
            <p
              class="mb-0 pb-0 requiredFieldError"
              v-if="!this.isValid && (industry == '' || !isIndustryValid)"
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
        </div>
        <!-- ///////////// -->
        <div class="col-md-6">
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
      <i class="fas fa-angle-right fa-3x" style="float: right; margin-top: 5%" @click="page = 2"></i>
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
      <i class="fas fa-chevron-left fa-3x" style="margin-top: 5%" @click="page = 1"></i>
    </div>
    <div v-if="page===3">
      <!-- <Checkout :addOns="selectedAddOn"/> -->
    </div>
  </div>
</template>
<style scoped lang="scss">
@import "~assets/style/colors.scss";
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
    roundedInput,
    VueSlider,
    GooglePlacesAutoComplete
  },
  mounted(){
    // this.location = window.location.hostname
    // let params = this.$route.params
    // if(params.category){
    //   this.selectedIndustry = params.category
    // }
    // setTimeout(() => {
    //   this.retrievePayloads()
    // }, 1000)
  },
  data(){
    return {
      common: COMMON,
      config: CONFIG,
      page: 1,
      user: AUTH.user,
      router: ROUTER,
      tokenData: AUTH.tokenData,
      isValid: true,
      isEmailValid: true,
      isFirstNameValid: true,
      isLastNameValid: true,
      isBusinessNameValid: true,
      first_name: '',
      last_name: '',
      phone_number: '',
      business_name: '',
      password: '',
      cpassword: '',
      email: '',
      passwordRequirements: '',
      industry: [],
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
    next(page){
      this.page = page
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
