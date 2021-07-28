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
                  :class="!isValidProfile && !firstname ? 'mb-0 ' : ' SettingsField'" :styles="{
                        border: !isValidProfile && !firstname ? '1px solid red !important' : 'none',
                      }" v-model="firstname" class="input-style" />

              </div>
              <div class="col-md-6">
                <p>Last Name</p>
                <roundedInput :type="'text'" :placeholder="'Enter your last name here'"
                  :class="!isValidProfile && !lastname ? 'mb-0 ' : ' SettingsField'" :styles="{
                      border: !isValidProfile && !lastname ? '1px solid red !important' : 'none',
                    }" v-model="lastname" class="input-style" />

              </div>

            </div>
            <div class="row">
              <div class="col-md-6">
                <p>Business Name</p>
                <roundedInput :type="'text'" :placeholder="'Enter your business name here'"
                  :class="!isValidProfile && !businessname ? 'mb-0 ' : ' SettingsField'" :styles="{
                    border: !isValidProfile && !businessname ? '1px solid red !important' : 'none',
                  }" v-model="businessname" class="input-style" />

              </div>
              <div class="col-md-6">
                <p>Contact Number</p>
                <roundedInput :type="'text'" :placeholder="'Enter your contact number here'"
                  :class="!isValidProfile && !contactnumber ? 'mb-0 ' : ' SettingsField'" :styles="{
                    border: !isValidProfile && !contactnumber ? '1px solid red !important' : 'none',
                  }" v-model="contactnumber" class="input-style" />

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
      if(this.canUpdateProfile) {
        let parameter = {
          account_id: this.user.userID
        }
        let info = AUTH.user.information
        console.log('INFO: ', info)
        // Just to check if what fields are updated and only updated fields will be pass as parameters of update
        if(Object.keys(info).length > 1) {
          Object.keys(info).forEach((el, ndx) => {
            if(['first_name', 'last_name', 'cellular_number', 'address'].includes(el)) {
              switch(el) {
                case 'first_name':
                  if(info[el] !== this.firstname) {
                    parameter[el] = this.firstname
                    if(!info[el]) {
                      parameter[el] = this.firstname
                    }
                  }
                  break
                case 'last_name':
                  if(info[el] !== this.lastname) {
                    parameter[el] = this.lastname
                    if(!info[el]) {
                      parameter[el] = this.lastname
                    }
                  }
                  break
                case 'cellular_number':
                  if(info[el] !== this.contactnumber) {
                    parameter[el] = this.contactnumber
                    if(!info[el]) {
                      parameter[el] = this.contactnumber
                    }
                  }
                  break
                case 'address':
                  let address = {}
                  Object.keys(JSON.parse(info[el])).forEach(le => {
                    if(this[le] !== JSON.parse(info[el])[le]){
                      address[info[el]] = this[le]
                    }
                  })
                  if(Object.keys(address).length > 0) {
                    parameter['address'] = JSON.stringify(address)
                  }
                  break
              }
            }
          })
        }else {
          parameter['first_name'] = this.firstname
          parameter['middle_name'] = 'null'
          parameter['last_name'] = this.lastname
          parameter['cellular_number'] = this.contactnumber
          parameter['address'] = JSON.stringify({
            route: this.route,
            city: this.city,
            region: this.region,
            country: this.country,
            postalZipCode: this.postalZipCode
          })
        }
        console.log('Parameters: ', parameter)
        if(Object.keys(info).length > 1 && Object.keys(parameter).length > 1){
          $('#loading').css({'display': 'block'})
          this.APIRequest('accounts_info/update_account', parameter).then(response => {
            $('#loading').css({'display': 'none'})
            if(response.error.length === 0) {
              this.retrieveInformation()
              console.log('UPDATE PROFILE RESPONSE: ', response)
              this.canUpdateProfile = false
            }
          })
        }else if(Object.keys(parameter).length > 1){
          $('#loading').css({'display': 'block'})
          this.APIRequest('account_informations/create', parameter).then(response => {
            $('#loading').css({'display': 'none'})
            if(response.error === 0) {
              this.retrieveInformation()
              this.canUpdateProfile = false
            }
          })
        }
        let condition = {
          condition: [
            {
              value: this.user.userID,
              clause: '=',
              column: 'account_id'
            }
          ],
          offset: 0,
          limit: 1
        }
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
      }
      if(this.canUpdateAccount) {
        let acc = {
          id: this.user.userID,
          code: this.user.code,
          email: this.email
        }
        $('#loading').css({'display': 'block'})
        this.APIRequest('accounts/update_email', acc).then(response => {
          $('#loading').css({'display': 'none'})
          console.log('UPDATE RESPONSE: ', response)
          if(response.error.length > 0) {
            this.isValidAccount = false
            this.email = ''
            this.emailValidation = response.error
            // console.log('UPDATE RESPONSE: ', response)
          }
        })
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
    addImage(){
      $('#Image')[0].click()
    },
    setUpFileUpload(event){
      let files = event.target.files || event.dataTransfer.files
      if(!files.length){
        return false
      }else{
        this.file = files[0]
        this.createFile(files[0])
      }
    },
    createFile(file){
      let fileReader = new FileReader()
      fileReader.readAsDataURL(event.target.files[0])
      this.upload()
    },
    upload(){
      let formData = new FormData()
      formData.append('file', this.file)
      formData.append('file_url', this.file.name)
      formData.append('account_id', this.user.userID)
      $('#loading').css({'display': 'block'})
      axios.post(this.config.BACKEND_URL + '/images/upload?token=' + AUTH.tokenData.token, formData).then(response => {
        $('#loading').css({'display': 'none'})
        if(response.data.data !== null){
          console.log('PROFILE URL: ', response.data.data)
          let profile = response.data.data
          let condition = {
            condition: [
              {
                value: this.user.userID,
                clause: '=',
                column: 'account_id'
              }
            ],
            offset: 0,
            limit: 1
          }
          $('#loading').css({'display': 'block'})
          this.APIRequest('account_profiles/retrieve', condition, response => {
            let accProfile = {
              account_id: this.user.userID,
              url: profile
            }
            let url = ''
            if(response.data.length > 0) {
              accProfile['id'] = response.data[0].id
              url = 'account_profiles/update'
            }else{
              url = 'account_profiles/create'
            }
            this.APIRequest(url, accProfile, response => {
              $('#loading').css({'display': 'none'})
              AUTH.retrieveAccountProfileAndInformation(this.user.userID)
            }, error => {
              $('#loading').css({'display': 'none'})
              error
            })
          }, error => {
            $('#loading').css({'display': 'none'})
            error
          })
        }
      })
    },
    validate() {
      if(this.firstname !== '' || this.lastname !== '' || this.businessname !== '' || this.contactnumber !== '' || this.route !== '' || this.region !== '' || this.city !== '' || this.postalZipCode !== '' || this.city !== '' || this.country !== '') {
        if(!this.firstname || !this.lastname || !this.businessname || !this.contactnumber || !this.route || !this.region || !this.city || !this.postalZipCode || !this.city || !this.country) {
          this.isValidProfile = false
          this.canUpdateProfile = false
        }else{
          this.isValidProfile = true
          this.canUpdateProfile = true
        }
      }else {
        this.canUpdateProfile = false
      }
      console.log('update profile ', this.isValidProfile)
      if(this.username !== '' || this.email !== '') {
        if(!this.username || !this.email || this.email === this.user.email) {
          this.isValidAccount = false
          this.canUpdateAccount = false
        }else {
          this.isValidAccount = true
          this.canUpdateAccount = true
        }
      }else {
        this.canUpdateAccount = false
      }
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
      if(!this.isValidProfile && !this.isValidAccount && !this.isValidPassword) {
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
