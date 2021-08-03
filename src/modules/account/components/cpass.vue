<template>
  <div class="container-fluid">
    <div class="row flex-column-reverse">
      <div class="col-sm-pull-4">

        <div class="my-title mb-5">
          <h3>Change Your Password</h3>
        </div>

        <div class="row">
          <div class="col-sm-12">
            <div class="row">
              <div class="col-sm-12">
                <div class="row" v-if="passwordVerified">
                  <div class="col-md-6">
                    <p>New Password</p>
                    <roundedInput :type="isShowingPassword ? 'text' : 'password'"
                      :placeholder="'(Leave blank if unchanged)'"
                      :class="'input-style ' + (!isValidPassword && password == '' ? 'mb-0 ' : ' SettingsField')"
                      :styles="{
                        border: ((!isValidPassword && password == '' ) || (password != confirmPassword)) ? '1px solid red !important' : 'none',
                        marginBottom: '0px'
                      }" 
                      v-model="password" 
                    />
                    <span
                      :class="'fa fa-fw fa-eye ' + (!isValidPassword && password == '' ? 'error-field-icon' : 'field-icon')"
                      @click="() => isShowingPassword = !isShowingPassword" :style="{
                marginTop: '-28px !important'
              }" v-if="isShowingPassword"></span>
                    <span
                      :class="'far fa-eye-slash ' + (!isValidPassword && password == '' ? 'error-field-icon' : 'field-icon')"
                      @click="() => isShowingPassword = !isShowingPassword" :style="{
                marginTop: '-28px !important'
              }" v-if="!isShowingPassword"></span>
                    <div>
                      <p class="mb-0 pb-0 requiredFieldError"
                        v-if="password == '' || password != confirmPassword || passwordRequirements != ''">
                        {{
                        password != confirmPassword ?
                        'does not match'
                        :
                        passwordRequirements != '' ?
                        passwordRequirements
                        :
                        ''
                        }}</p>
                    </div>
                  </div>
                </div>
                <div class="row" v-if="passwordVerified">
                  <div class="col-md-6">
                    <p>Confirm Password</p>
                    <input :type="isShowingCPassword ? 'text' : 'password'" :placeholder="'(Leave blank if unchanged)'"
                      :class="'form-control roudedInput input-style ' + (!isValidPassword && confirmPassword == '' ? 'mb-0 ' : ' SettingsField')"
                      :style="{
                border: ((!isValidPassword && confirmPassword == '') || (password != confirmPassword)) ? '1px solid red !important' : 'none',
                marginBottom: '0px'
              }" v-model="confirmPassword" />
                    <span
                      :class="'fa fa-fw fa-eye ' + (!isValidPassword && password == '' ? 'error-field-icon' : 'field-icon')"
                      @click="() => isShowingCPassword = !isShowingCPassword" v-if="isShowingCPassword" :style="{
                marginTop: '-28px !important'
              }"></span>
                    <span
                      :class="'far fa-eye-slash ' + (!isValidPassword && password == '' ? 'error-field-icon' : 'field-icon')"
                      @click="() => isShowingCPassword = !isShowingCPassword" v-if="!isShowingCPassword" :style="{
                marginTop: '-28px !important'
              }"></span>
                    <div>
                      <p class="mb-0 pb-0 requiredFieldError"
                        v-if="password == '' || password != confirmPassword || passwordRequirements != ''">
                        {{
                        password != confirmPassword ?
                        'does not match'
                        :
                        passwordRequirements != '' ?
                        passwordRequirements
                        :
                        ''
                        }}</p>
                    </div>
                  </div>
                </div>
                <div class="row" v-if="!passwordVerified">
                  <div class="col-md-6 pt-0">
                    <p>Old Password</p>
                    <!-- <roundedInput :type="isShowingOPassword ? 'text' : 'password'"
                      :placeholder="'(Leave blank if unchanged)'"
                      :class="'input-style ' + (!isValidPassword && oPassword == '' ? 'mb-0 ' : ' SettingsField')"
                      :styles="{
                border: !isValidPassword && oPassword == '' ? '1px solid red !important' : 'none',
              }" v-model="oPassword" /> -->
                    <input 
                      :type="isShowingOPassword ? 'text' : 'password'" 
                      :placeholder="'(Leave blank if unchanged)'"
                      :class="'form-control roudedInput input-style ' + (!isValidPassword && oPassword == '' ? 'mb-0 ' : ' SettingsField')"
                      :style="{
                        border: !isValidPassword && oPassword == '' ? '1px solid red !important' : 'none',
                        marginBottom: !isValidPassword && oPassword == '' ? '0px' : '30px',
                      }"
                      v-model="oPassword" 
                    />
                    <span
                      :class="'fa fa-fw fa-eye ' + (!isValidPassword && oPassword == '' ? 'error-field-icon' : 'field-icon')"
                      @click="() => isShowingOPassword = !isShowingOPassword" v-if="isShowingOPassword"></span>
                    <span
                      :class="'far fa-eye-slash ' + (!isValidPassword && oPassword == '' ? 'error-field-icon' : 'field-icon')"
                      @click="() => isShowingOPassword = !isShowingOPassword" v-if="!isShowingOPassword"></span>
                    <div>
                      <p class="mb-0 pb-0 requiredFieldError" v-if="oPassword === '' && !isValidPassword">{{
                        passwordRequirements != '' ?
                        passwordRequirements
                        :
                        ''
                        }}</p>
                    </div>
                  </div>
                  <div class="col-sm-12" :style="{
                    display: 'flex',
                    alignItems: 'center',
                    marginTop: '0px'
                  }">
                    <roundedBtn :onClick="checkPassword" :icon="'fas fa-sign-in-alt'" :text="'Verify Password'" :styles="{
                      backgroundColor: 'rgb(241, 184, 20)',
                      color: 'white',
                      height: '35px'
                    }" />
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <roundedBtn :onClick="update_account" :icon="'fas fa-sign-in-alt'" :text="'Update'" :styles="{
          backgroundColor: '#01004E',
          color: 'white'
        }" style="margin-bottom: 5%; margin-top: 3%;" />

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
    checkPassword(evet){
      if(this.oPassword === '') {
        this.isValidPassword = false
        this.passwordRequirements = 'Required Field!'
        return
      }
      let parameter = {
        id: this.user.userID,
        password: this.oPassword
      }
      $('#loading').css({'display': 'block'})
      this.APIRequest('accounts_info/check_password', parameter, response => {
        $('#loading').css({'display': 'none'})
        if(response.data === true) {
          this.passwordVerified = true
          this.passwordRequirements = ''
          this.oPassword = ''
          this.password = ''
          this.confirmPassword = ''
          this.isValidPassword = true
        }else {
          this.passwordVerified = false
          this.oPassword = ''
          this.passwordRequirements = 'Invalid Password!'
          this.isValidPassword = false
        }
      }, error => {
        $('#loading').css({'display': 'none'})
        console.log('password erro:', error)
      })
    },
    retrieveInformation() {
      let parameter = {
        account_id: this.user.userID
      }
      $('#loading').css({'display': 'block'})
      this.APIRequest('accounts_info/retrieve', parameter).then(response => {
        $('#loading').css({'display': 'none'})
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
      console.log('...updating', this.canUpdateProfile, 'validated: ', !this.validate())
      if(!this.validate()) {
        return
      }
      if(this.canUpdatePassword) {
        let acc = {
          id: this.user.userID,
          password: this.password
        }
        $('#loading').css({'display': 'block'})
        this.APIRequest('accounts/update_password', acc).then(response => {
          $('#loading').css({'display': 'none'})
          this.password = ''
          this.confirmPassword = ''
          this.oPassword = ''
          this.isValidPassword = true
          this.passwordVerified = false
          if(!response.error) {
            console.log('UPDATE PASSWORD RESPONSE: ', response)
          }
        })
      }
    },
    validate() {
      if(this.password !== '' || this.confirmPassword !== '') {
        if(!this.password || !this.confirmPassword) {
          this.isValidPassword = false
          this.canUpdatePassword = false
        }else {
          if(!global.validatePassword(this.password)){
            this.isValidPassword = false
            this.canUpdatePassword = false
            this.passwordRequirements = 'Password should be minimum of 8 and maximum of 16 and should contain at least one digit, lower case, upper case and special character.'
          }else{
            this.canUpdatePassword = true
            this.isValidPassword = true
          }
        }
      }else {
        this.canUpdatePassword = false
      }
      if(!this.isValidPassword) {
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
  padding-left: 3%;
  padding-top: 3%;
  margin-left: -3%;
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
  //margin-left: 20px;
  //margin-bottom: 25px !important;
  margin-top: -30px;
  position: absolute;
}
/*
@media (max-width: 768px){
  .profile-pic{
    margin-left: -16%;
  }
}
*/
</style>
