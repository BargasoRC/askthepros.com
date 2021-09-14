<template>
  <div class="container-fluid">
    <div class="row flex-column-reverse ">
      <div class=" col-sm-pull-4">
        <div class="my-title">
          <h3 style="">Profile</h3>
        </div>
        <div class="my-form row my-row">
          <div class=" col-sm-12 input-form">
            <div class="row mb-3">
              <div class="col-md-6" >
                <p>First Name</p>
                <roundedInput :type="'text'" :placeholder="'Enter your first name here'"
                  :class="isNotValidProfile == true && firstname == '' ? 'mb-0 ' : ' SettingsField'" :styles="{
                        border: (isNotValidProfile == true && !firstname) ? '1px solid red !important' : 'none',
                      }" v-model="firstname" class="input-style" />
                <div>
                  <p class="mb-0 pb-0 requiredFieldError"
                    v-if="isNotValidProfile == true && (firstname == undefined || firstname == '')">
                    {{
                    'Required Field'
                    }}</p>
                </div>
              </div>
              <div class="col-md-6" >
                <p>Last Name</p>
                <roundedInput :type="'text'" :placeholder="'Enter your last name here'"
                  :class="isNotValidProfile == true && lastname == '' ? 'mb-0 ' : ' SettingsField'" :styles="{
                      border: isNotValidProfile == true && !lastname ? '1px solid red !important' : 'none',
                    }" v-model="lastname" class="input-style" />
                <div>
                  <p class="mb-0 pb-0 requiredFieldError"
                    v-if="isNotValidProfile == true && (lastname == undefined || lastname == '')">
                    {{
                    'Required Field'
                    }}</p>
                </div>
              </div>
            </div>
            
            <div class="row mb-3">
              <div class="col-md-6" >
                <p>Business Name</p>
                <roundedInput :type="'text'" :placeholder="'Enter business name here'"
                  :class="isNotValidProfile == true && businessname == '' ? 'mb-0 ' : ' SettingsField'" :styles="{
                      border: isNotValidProfile == true && !businessname ? '1px solid red !important' : 'none',
                    }" v-model="businessname" class="input-style" />
                <div>
                  <p class="mb-0 pb-0 requiredFieldError"
                    v-if="isNotValidProfile == true && (businessname == '' || businessname == null)">
                    {{
                    'Required Field'
                    }}</p>
                </div>
              </div>
              <div class="col-md-6" >
                <p>Contact Number</p>
                <roundedInput :type="'text'" :placeholder="'Enter your contact number here'"
                  :class="isNotValidProfile == true && contactnumber == '' ? 'mb-0 ' : ' SettingsField'" :styles="{
                      border: isNotValidProfile == true && !contactnumber ? '1px solid red !important' : 'none',
                    }" v-model="contactnumber" class="input-style" />
                <div>
                  <p class="mb-0 pb-0 requiredFieldError"
                    v-if="isNotValidProfile == true && (contactnumber == undefined || contactnumber== '')">
                    {{
                    'Required Field'
                    }}</p>
                </div>
              </div>
            </div>

          </div>
        </div>
        <br><br>
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
      businessname: null,
      contactnumber: '',
      user: AUTH.user,
      config: CONFIG,
      global: global,
      errorMessage: null,
      data: null,
      isValid: true,
      isNotValidProfile: false,
      canUpdateProfile: false
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
  mounted(){
    this.retrieveInformation()
  },
  updated(){
    // this.onUpdate()
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
    businessname: function(val){
      this.businessname = val
    }
  },
  created() {
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
        this.businessname = this.user.merchant ? this.user.merchant[0].name : null
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
        console.log('Not valid')
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
              console.log('Submitted')
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
          id: this.user.merchant[0].id
        }
        let url = 'merchants/update'
        if(this.user.merchant.name !== this.businessname){
          $('#loading').css({'display': 'block'})
          this.APIRequest(url, merchant, response => {
            $('#loading').css({'display': 'none'})
            this.canUpdateProfile = false
            this.retrieveInformation()
            console.log('Updated business')
          }, error => {
            $('#loading').css({'display': 'none'})
            this.canUpdateProfile = false
            error
          })
        }
        alert('Profile Updated')
      }else{
        console.log('Cant update')
      }
    },
    onUpdate(){
      let newinfo = {
        ...AUTH.user.information,
        first_name: this.firstname,
        middle_name: 'null',
        last_name: this.lastname,
        cellular_number: this.contactnumber
      }
      let newMerchant = {
        name: this.businessname
      }
      setTimeout(() => {
        AUTH.user.information = newinfo
        AUTH.user.merchant[0].name = newMerchant
      }, 100)
    },
    validate() {
      if(this.firstname !== '' && this.lastname !== '' && this.businessname !== '' && this.contactnumber !== '' && this.firstname !== undefined && this.lastname !== undefined && this.businessname !== undefined && this.contactnumber !== undefined) {
        if(!global.validateField(this.firstname) && !global.validateField(this.lastname) && !global.validateField(this.businessname) && !global.validateNumber(this.contactnumber)) {
          console.log('[!gla]', global.validateField(this.firstname))
          this.isNotValidProfile = true
          this.canUpdateProfile = false
        }else{
          console.log('[!glb]', global.validateField(this.firstname))
          this.isNotValidProfile = false
          this.canUpdateProfile = true
        }
      }else {
        console.log('[!glc]', this.firstname)
        this.canUpdateProfile = false
        this.isNotValidProfile = true
      }
      console.log('Valid: ', this.isNotValidProfile, 'Can update:" ', this.canUpdateProfile)
      // if(this.isNotValidProfile ) {
      //   return false
      // }else {
      //   return true
      // }
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
  // margin-bottom: 35px;
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
  // margin-bottom: 25px !important;
  margin-bottom: -35px;
}
/*
@media (max-width: 768px){
  .profile-pic{
    margin-left: -16%;
  }
}
*/
</style>
