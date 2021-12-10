<template>
  <div class="stepper-container">
    <div class="content-holder">
      <div class="header">
        <b>{{title}}</b>
      </div>
      
      <div class="error" v-if="errorMessage !== null">
        <p class="text-danger"><b>Opps!</b> {{errorMessage}}</p>
      </div>
      
      <div class="body" v-if="active === 0">
        <roundedInput
          :type="'text'"
          :placeholder="'First Name'"
          :class="'mb-0'"
          :styles="{
            border:'1px solid grey !important'
          }"
          v-model="firstName"
        />

       <roundedInput
          :type="'text'"
          :placeholder="'Last Name'"
          :class="'mb-0'"
          :styles="{
            border:'1px solid grey !important',
            marginTop: '25px'
          }"
          v-model="lastName"
        />
      </div>



      <div class="body" v-if="active === 1">
        <roundedInput
          :type="'text'"
          :placeholder="'Business Name'"
          :class="'mb-0'"
          :styles="{
            border:'1px solid lightGrey !important'
          }"
          v-model="businessName"
        />
        <br>
        
        <GooglePlacesAutoComplete
          :property="property"
          @onFinish="getAddressData($event)"
          >
        </GooglePlacesAutoComplete>
       <!-- <roundedInput
          :type="'text'"
          :placeholder="'Business Address'"
          :class="'mb-0'"
          :styles="{
            border:'1px solid grey !important',
            marginTop: '25px'
          }"
          v-model="businessAddress"
        /> -->
      </div>

      <div class="body" v-if="active === 2">
        <label class="container">I want to promote my Company Name Only.
          <input type="radio" name="radio" checked="checked" value="Company" v-model="brand">
          <span class="checkmark"></span>
        </label>
        <label class="container">I want to promote both myself and my Company Name.
          <input type="radio" name="radio" value="Employee of Company" v-model="brand">
          <span class="checkmark"></span>
        </label>
        <label class="container">I want to promote myself only without referencing a Company Name.
          <input type="radio" name="radio" value="Individual" v-model="brand">
          <span class="checkmark"></span>
        </label>
      </div>      

      <div class="footer">
        <dialogueBtn
          :onClick="this.managePrevious"
          :icon="'fas fa-chevron-left'"
          :text="'Previous'"
          :icon_position="'left'"
          :styles="{
            backgroundColor: colors.danger,
            color: 'white'
          }"
          v-if="active > 0"
        />
        <dialogueBtn
          :onClick="this.manageNext"
          :icon="'fas fa-chevron-right'"
          :text="'Next'"
          :icon_position="'right'"
          :styles="{
            backgroundColor: colors.primary,
            color: 'white'
          }"
        />
        
      </div>
    </div>
    
  </div>
</template>
<script>
import roundedInput from 'src/modules/generic/roundedInput'
import dialogueBtn from 'src/modules/generic/dialogueBtn'
import ROUTER from 'src/router'
import AUTH from 'src/services/auth'
import COLORS from 'src/assets/style/colors.js'
import GooglePlacesAutoComplete from 'src/components/increment/generic/location/GooglePlacesAutoComplete'
import CONFIG from 'src/config.js'
export default {
  mounted(){
    console.log('[asdfasdf]', this.$route.params.industry)
    this.selectedIndustry = this.$route.params.industry
  },
  data() {
    return{
      colors: COLORS,
      active: 0,
      title: 'Personal Information',
      firstName: null,
      lastName: null,
      errorMessage: null,
      businessName: null,
      selectedLocation: null,
      businessAddress: null,
      brand: 'brand',
      brand1: null,
      brand2: null,
      brand3: null,
      user: AUTH.user,
      selectedIndustry: null,
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
  props: [],
  components: {
    roundedInput,
    GooglePlacesAutoComplete,
    dialogueBtn
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
      this.APIRequest('image_generator/generate_text', parameter).then(res => {
        if(JSON.parse(res).success === true){
          JSON.parse(res).result[0] = this.brand1
          this.register(JSON.parse(res).result[0])
        }
      })
    },
    register(brand) {
      if(this.validate() && this.validate2()) {
        this.isValid = true
        let parameter = {
          account_type: 'USER',
          referral_code: null,
          status: 'ADMIN',
          business_name: this.businessName,
          first_name: this.firstName,
          last_name: this.lastName,
          address: JSON.stringify({
            route: this.selectedLocation.route,
            locality: this.selectedLocation.locality,
            region: this.selectedLocation.region,
            country: this.selectedLocation.country,
            latitude: this.selectedLocation.latitude,
            longitude: this.selectedLocation.longitude
          }),
          id: this.user.userID,
          details: JSON.stringify({
            brand1: brand,
            brand2: this.brand2,
            brand3: this.brand3
          }),
          industry: JSON.stringify({industry: this.selectedIndustry})
        }
        $('#loading').css({'display': 'block'})
        this.APIRequest('account/create', parameter).then(response => {
          $('#loading').css({'display': 'none'})
          if(response.data.message !== null) {
            ROUTER.push('/login')
            // this.createMerchantAndPayload(response.data.data)
          }else {
            let message = response.error.message
            this.errorMessage = message
          }
        })
      }
    },
    manageContent(){
      switch(this.active){
        case 0: {
          this.title = 'Personal Information'
          break
        }
        case 1: {
          this.title = 'Business Details'
          break
        }
        case 2: {
          this.title = 'Which option best describes your situation?'
          break
        }
      }
    },
    getAddressData(e) {
      this.selectedLocation = e
      this.property.placeholder = e
    },
    validation(){
      this.errorMessage = null
      switch(this.active){
        case 0: {
          if(this.firstName != null && this.lastName !== null){
            return true
          }else{
            this.errorMessage = 'All fields are required.'
            return false
          }
        }
        case 1: {
          if(this.businessName != null && this.selectedLocation !== null){
            return true
          }else{
            this.errorMessage = 'All fields are required.'
            return false
          }
        }
      }
    },
    manageNext(){
      if(this.validation()){
        this.errorMessage = null
        this.active++
        this.manageContent()
      }
    },
    managePrevious(){
      if(this.active > 0){
        this.active--
      }
      this.manageContent()
    }
  }
}
</script>
<style scoped lang="scss">
@import "~assets/style/colors.scss";
.stepper-container{
  width: 100%;
  float: left;
  min-height: 100vh;
  overflow-y: hidden;
  display: flex;
  justify-content: center;
  align-items: center;
  background-color: 'red';
}

.content-holder{
  width: 30%;
  float: left;
}
.header, .footer, .body, .error{
  width: 100%;
  float: left;
}

.body{
  margin-top: 25px;
  margin-bottom: 25px;
}

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
</style>
