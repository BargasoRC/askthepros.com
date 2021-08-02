<template>
  <div class="container-fluid">
    <div class="row flex-column-reverse ">
      <div class=" col-sm-pull-4">
        <div class="my-title">
          <h3 style="">Profile</h3>
        </div>
        <div class="my-form row my-row">
          <div class=" col-sm-12 input-form">
            <div class="row">
              <div class="col-md-6">
                <p>First Name</p>
                <roundedInput :type="'text'" :placeholder="'Enter your first name here'"
                  :class="!isValidProfile && firstname == '' ? 'mb-0 ' : ' SettingsField'" :styles="{
                        border: !isValidProfile && !firstname ? '1px solid red !important' : 'none',
                      }" v-model="firstname" class="input-style" />
                <div>
                  <p class="mb-0 pb-0 requiredFieldError"
                    v-if="firstname == '' && !isValidProfile">
                    {{
                    'Required Field'
                    }}</p>
                </div>
              </div>
              <div class="col-md-6">
                <p>Last Name</p>
                <roundedInput :type="'text'" :placeholder="'Enter your last name here'"
                  :class="!isValidProfile && lastname == '' ? 'mb-0 ' : ' SettingsField'" :styles="{
                      border: !isValidProfile && !lastname ? '1px solid red !important' : 'none',
                    }" v-model="lastname" class="input-style" />
                <div>
                  <p class="mb-0 pb-0 requiredFieldError"
                    v-if="lastname == '' && !isValidProfile">
                    {{
                    'Required Field'
                    }}</p>
                </div>
              </div>
            </div>
            
            <div class="row">
              <div class="col-md-6">
                <p>Business Name</p>
                <roundedInput :type="'text'" :placeholder="'Enter business name here'"
                  :class="!isValidProfile && businessname == '' ? 'mb-0 ' : ' SettingsField'" :styles="{
                      border: !isValidProfile && !businessname ? '1px solid red !important' : 'none',
                    }" v-model="businessname" class="input-style" />
                <div>
                  <p class="mb-0 pb-0 requiredFieldError"
                    v-if="businessname == '' && !isValidProfile">
                    {{
                    'Required Field'
                    }}</p>
                </div>
              </div>
              <div class="col-md-6">
                <p>Contact Number</p>
                <roundedInput :type="'text'" :placeholder="'Enter your contact number here'"
                  :class="!isValidProfile && contactnumber == '' ? 'mb-0 ' : ' SettingsField'" :styles="{
                      border: !isValidProfile && !contactnumber ? '1px solid red !important' : 'none',
                    }" v-model="contactnumber" class="input-style" />
                <div>
                  <p class="mb-0 pb-0 requiredFieldError"
                    v-if="contactnumber == '' && !isValidProfile">
                    {{
                    'Required Field'
                    }}</p>
                </div>
              </div>
            </div>

          </div>
        </div>

        <roundedBtn :onClick="update_account" :icon="'fas fa-sign-in-alt'" :text="'Update'" :styles="{
          backgroundColor: '#01004E',
          color: 'white'
        }" style="margin-bottom: 5%;" />

      </div>
    </div>
  </div>
</template>
<script>
import dialogueBtn from 'src/modules/generic/dialogueBtn'
import roundedInput from 'src/modules/generic/roundedInput'
import roundedBtn from 'src/modules/generic/roundedBtn'
import COLORS from 'src/assets/style/colors.js'
import AUTH from 'src/services/auth'
import CONFIG from 'src/config.js'
import axios from 'axios'
import $ from 'jquery'
import global from 'src/helpers/global'
import ROUTER from 'src/router'
export default {
  data() {
    return {
      eyeToggle: false,
      colors: COLORS,
      firstname: '',
      middlename: '',
      lastname: '',
      businessname: '',
      contactnumber: '',
      user: AUTH.user,
      config: CONFIG,
      global: global,
      errorMessage: null,
      data: null,
      file: null,
      copiedIndex: null,
      route: '',
      city: '',
      region: '',
      country: '',
      postalZipCode: '',
      username: '',
      email: '',
      oPassword: '',
      confirmPassword: '',
      password: '',
      passwordRequirements: '',
      isValid: true,
      isValidProfile: true,
      isValidAccount: true,
      isValidPassword: true,
      canUpdateAccount: false,
      canUpdateAddress: true,
      canUpdateProfile: false,
      canUpdatePassword: false,
      isShowingOPassword: false,
      isShowingPassword: false,
      isShowingCPassword: false,
      passwordVerified: false,
      emailValidation: ''
    }
  },
  components: {
    dialogueBtn,
    roundedInput,
    roundedBtn
  },
  computed: {
    returnProfile() {
      return this.user.profile
    }
  },
  watch: {
    username: function(val) {
      this.username = val
    },
    firstname: function(val) {
      this.firstname = val
    },
    lastname: function(val) {
      this.lastname = val
    },
    contactnumber: function(val) {
      this.contactnumber = val
    },
    route: function(val) {
      this.route = val
    },
    city: function(val) {
      this.city = val
    },
    region: function(val) {
      this.region = val
    },
    country: function(val) {
      this.country = val
    },
    postalZipCode: function(val) {
      this.postalZipCode = val
    },
    email: function(val) {
      this.email = val
    }
  },
  mounted() {
    if(AUTH.hash('show', localStorage.getItem('login_with')) === 'social_lite') {
      this.passwordVerified = true
    }
    this.retrieveInformation()
  },
  methods: {
    retrieveInformation() {
      let parameter = {
        account_id: this.user.userID
      }
      $('#loading').css({'display': 'block'})
      this.APIRequest('accounts_info/retrieve', parameter).then(response => {
        $('#loading').css({'display': 'none'})
        console.log('Data1: ', response)
        let data = response.data[0]
        this.username = this.user.username
        this.email = this.user.email
        this.businessname = this.user.merchant ? this.user.merchant.name : ''
        AUTH.user.information = response.data[0]
        if(response.data.length > 0) {
          AUTH.user.merchant = [data.merchant]
          this.firstname = data.first_name
          this.lastname = data.last_name
          this.contactnumber = data.cellular_number
          let address = data.address ? JSON.parse(data.address) : {}
          this.route = address ? address.route : ''
          this.city = address ? address.city : ''
          this.region = address ? address.region : ''
          this.country = address ? address.country : ''
          this.postalZipCode = address ? address.postalZipCode : ''
        }
      })
    },
    update_account(event){
      console.log('Can Update: ', this.canUpdateProfile, 'Validated: ', this.validate())
      if(!this.validate()) {
        alert('Not valid')
        return
      }
      if(this.canUpdateProfile === true) {
        let parameter = {
          account_id: this.user.userID,
          first_name: this.firstname,
          middle_name: 'null',
          last_name: this.lastname,
          cellular_number: this.contactnumber
        }
        let info = AUTH.user.information
        console.log('INFO: ', info)
        console.log('Parameters: ', parameter)
        if(Object.keys(info).length > 1){
          this.APIRequest('accounts_info/update_account', parameter).then(response => {
            $('#loading').css({'display': 'none'})
            if(response.error.length === 0){
              this.retrieveInformation()
              console.log('Update profile response: ', response)
              this.canUpdateProfile = false
              alert('Submitted')
            }
          })
        }else{
          $('#loading').css({'display': 'block'})
          this.APIRequest('account_informations/create', parameter).then(response => {
            $('#loading').css({'display': 'none'})
            if(response.error === 0) {
              this.retrieveInformation()
              this.canUpdateProfile = false
            }
          })
        }
        console.log('Business name: ', this.businessname)
        let merchant = {
          name: this.businessname,
          account_id: this.user.userID,
          id: this.user.merchant.id
        }
        let url = 'merchants/update'
        if(this.user.merchant.name !== this.businessname){
          $('#loading').css({'display': 'block'})
          this.APIRequest(url, merchant, response => {
            $('#loading').css({'display': 'none'})
            this.canUpdateProfile = false
            this.retrieveInformation()
          }, error => {
            $('#loading').css({'display': 'none'})
            this.canUpdateProfile = false
            error
          })
        }
      }else{
        alert('Cant update')
      }
    },
    validate() {
      if(this.firstname !== '' || this.lastname !== '' || this.businessname !== '' || this.contactnumber !== '') {
        if(!global.validateField(this.firstname) && !global.validateField(this.lastname) && !global.validateField(this.businessname) && !global.validateNumber(this.contactnumber)) {
          this.isValidProfile = false
          this.canUpdateProfile = false
        }else{
          this.isValidProfile = true
          this.canUpdateProfile = true
        }
      }else {
        this.canUpdateProfile = false
        this.isValidProfile = false
      }
      console.log('Valid: ', this.isValidProfile, 'Can update:" ', this.canUpdateProfile)
      if(!this.isValidProfile) {
        return false
      }else {
        return true
      }
    }
  }
}
</script>

<style scoped lang="scss" scoped>
@import "~assets/style/colors.scss";
.invalidEmail {
  color: $danger;
  font-size: 10px;
  margin-left: 20px;
  margin-bottom: 25px !important;
}
.roudedInput {
  outline: none !important;
  box-shadow: none !important;
  height: 45px !important;
  border-radius: 40px !important;
  border: 1px solid $gray !important;
}
#Image{
  display: none;
  height: 200px;
  width: 200px;
}
.SettingsField {
  margin-bottom: 35px;
}
.holder{
  width: 96%;
  margin-left: 2%;
  margin-right: 2%;
  float: left;
}
.hidden-button{
  background: blue;
}
.my-title{
  border-bottom: solid 1px black;
  max-width: 100%;
}
h3{
  margin-top: 25px;
  font-weight: bold;
  font-size: 21px;
  padding-bottom: 1%;
}
.my-form{
  padding-top: 3%;
}
.input-form{
  background-color: none;
  margin-left: 0%;
}
.input-style{
  padding-left: 3%;
  background-color: none;
  max-width: 78%;
  border: 1px solid black;
}
.input-style ::-moz-placeholder{
  font-style: italic;
}
.profile-pic{
  float: center;
}
.profile-pic h3{
  font-weight: bold; 
  margin-right: 4%; 
  font-size: 19px;
}
.my-icon{
  background-color: none;
  color: $primary;
  float: left;
  max-height: 14.375rem;
  max-width: 12.5rem;
  text-align: center;
  font-size: 170px;
  margin-top: -15%;
}
.field-icon {
  float: right;
  margin-top: -58px;
  margin-right: 24%;
  position: relative;
  z-index: 2;
}
.error-field-icon {
  float: right;
  margin-top: -28px;
  margin-right: 24%;
  position: relative;
  z-index: 2;
}
.requiredFieldError {
  color: $danger;
  font-size: 10px;
  margin-left: 20px;
  margin-bottom: 25px !important;
}
/*
@media (max-width: 768px){
  .profile-pic{
    margin-left: -16%;
  }
}
*/
</style>
