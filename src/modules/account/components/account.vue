<template>
  <div class="container-fluid">
    <div class="row flex-column-reverse">
      <div class=" col-sm-pull-4">

        <div class="my-title mb-5">
          <h3>Account</h3>
        </div>

        <div class="">
          <div class="row">
            <div class="col-sm-12">
              <div class="row">
                <div class="col-md-6"> 
                  <p>Username</p>
                  <roundedInput :type="'text'" :placeholder="'Username'"
                    :class="!isValidAccount && username == '' ? 'mb-0 ' : ' SettingsField'" :styles="{
                            border: !isValidAccount && username == '' ? '1px solid red !important' : 'none',
                          }" v-model="username" class="input-style" style="background-color: lightgrey;"
                    disabled="1" />
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <p>Email Address</p>
                  <roundedInput :type="'text'" :placeholder="'example@email.domain'"
                    :class="!isValidAccount && email == '' ? 'mb-0 ' : ' SettingsField'" :styles="{
                              border: !isValidAccount && email == '' ? '1px solid red !important' : 'none',
                            }" v-model="email" class="input-style" style="background-color: lightgrey;" />
                  <p
                    class="mb-0 pb-0 invalidEmail"
                    v-if="!this.isValidAccount && email == ''"
                  >{{ (!isValidAccount && emailValidation == '') ? 'Required Field' : emailValidation }}</p>
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
import $ from 'jquery'
import global from 'src/helpers/global'
export default {
  data() {
    return {
      eyeToggle: false,
      colors: COLORS,
      user: AUTH.user,
      config: CONFIG,
      global: global,
      errorMessage: null,
      data: null,
      email: '',
      isValid: true,
      isValidAccount: true,
      canUpdateAccount: false,
      emailValidation: '',
      username: ''
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
    email: function(val){
      this.email = val
    }
  },
  created() {
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
      if(!this.validate()) {
        return
      }
      if(this.canUpdateAccount) {
        if(this.canUpdateAccount) {
          let acc = {
            id: this.user.userID,
            code: this.user.code,
            email: this.email
          }
          $('#loading').css({'display': 'block'})
          this.APIRequest('accounts/update_email', acc).then(response => {
            $('#loading').css({'display': 'none'})
            if(response.error != null) {
              this.isValidAccount = false
              this.email = ''
              this.emailValidation = response.error
            }else{
              this.emailValidation = ''
              this.email = ''
              this.isValidAccount = true
              window.location.reload()
            }
          })
        }
      }
    },
    validate() {
      if(this.username !== '' || this.email !== '') {
        if(!global.validateEmail(this.email)) {
          this.isValidAccount = false
          this.canUpdateAccount = false
        }else {
          this.isValidAccount = true
          this.canUpdateAccount = true
        }
      }else {
        this.canUpdateAccount = false
      }
      if(!this.isValidAccount) {
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
