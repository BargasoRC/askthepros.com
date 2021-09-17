<template>
  <div class="LoginContainer col-sm-12">
    <div class="row RowContainer">
      <div class="col-sm-7 col-md-7 col-lg-7 col-xl-7 col-xs-7 QouteCardContainer mb-5 ">
        <div class="QouteCard">
          <div class="SubQoute">
            <h1 class="QouteText" style="color: #01004E">Become A Local Expert</h1>
          </div>
          <div class="SubQoute">
            <h1 class="QouteText" style="color: #01009A">With Automated Social Media Posting.</h1>
          </div>
          <img :src="require('assets/img/section3-img.png')" alt="Image" style="width: 60%;height:auto">
        </div>
      </div>
      <div class="col-sm-5 col-md-5 col-lg-5 col-xl-5 col-xs-5 d-flex justify-content-center LoginCardContainer mb-5">
        <div class="card RegisterCard">
          <div class="card-body RegisterCardBody">
            <div class="d-flex justify-content-center pt-5 pb-5 mb-3">
              <b>Register with AskThePros</b>
            </div>
            <p
              class="mb-2 pb-0 errorMessage"
              v-if="errorMessage != null"
            >{{errorMessage}}</p>
            <div>
              <p class="mt-2"><b>Username</b></p>
              <roundedInput 
                :type="'text'"
                :placeholder="'Your username here...'"
                :class="!this.isValid && username == '' ? 'mb-0 ' : ' registrationField'"
                :styles="{
                  border: !this.isValid && username == '' ? '1px solid red !important' : 'none',
                }"
                v-model="username"
              />
              <p
                class="mb-0 pb-0 requiredFieldError"
                v-if="!this.isValid && username == ''"
              >Required Field</p>
              <p class="mt-2"><b>Email</b></p>
              <roundedInput 
                :type="'text'"
                :placeholder="'Email Address'"
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
              <p class="mt-2"><b>Confirm Password</b></p>
              <roundedInput 
                :type="'password'"
                :placeholder="'Retype Password'"
                :class="!this.isValid && (password == '' || password != cpassword || passwordRequirements != '') ? 'mb-0 ' : ' registrationField'"
                :styles="{
                  border: !this.isValid && (password == '' || password != cpassword || passwordRequirements != '') ? '1px solid red !important' : 'none',
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
              <p class="mt-2"><b>Industry</b></p>
              <roundedSelectBtn 
                :placeholder="'Select Industry'"
                :items="returnIndustry"
                :class="''"
                :styles="{
                  background: 'none',
                  color: '#84868B !important',
                  width: '100% !important',
                  minWidth: '100% !important',
                  border: !this.isValid && selectedIndustry == null ? '1px solid red !important' : 'none',
                  marginBottom: !this.isValid && selectedIndustry == null ? '0px' : '35px'
                }"
                :selectedIndex="global.selectedIndustryIndex"
                @onSelect="onSelect"
              />
              <p
                class="mb-0 pb-0 requiredFieldError"
                v-if="!this.isValid && selectedIndustry == null"
              >Required Field</p>
            </div>
            <div class="d-flex justify-content-center">
              <!-- <roundedBtn
                :onClick="forgotPassword"
                :text="'Forgot your password?'"
                :styles="{
                  background: 'none',
                  color: '#272727'
                }"
              /> -->
              <dialogueBtn 
                :onClick="register"
                :icon="'fas fa-sign-in-alt'"
                :text="'Register now'"
                :icon_position="'right'"
                :styles="{
                  backgroundColor: colors.darkPrimary,
                  color: 'white'
                }"
              />
            </div>
            <div class="d-flex justify-content-center orSeparatorA">
              <b>OR</b>
            </div>
            <div class="col-sm-12">
              <div class="row">
                <div class="col-sm-4 col-md-4 col-lg-4 mt-1 mb-1">
                  <roundedBtn
                    :onClick="gmailLogin"
                    :icon="'fab fa-google'"
                    :text="'Sign In'"
                    :styles="{
                      background: 'none',
                      color: '#272727',
                      width: '100% !important',
                      minWidth: '100% !important',
                      border: '1px solid #84868B'
                    }"
                    :icon_position="'left'"
                  />
                </div>
                <div class="col-sm-4 col-md-4 col-lg-4 mt-1 mb-1">
                  <roundedBtn
                    :onClick="fbLogin"
                    :icon="'fab fa-facebook-f'"
                    :text="'Sign In'"
                    :styles="{
                      background: 'none',
                      color: '#272727',
                      width: '100% !important',
                      minWidth: '100% !important',
                      border: '1px solid #84868B'
                    }"
                    :icon_position="'left'"
                  />
                </div>
                <div class="col-sm-4 col-md-4 col-lg-4 mt-1 mb-1">
                  <roundedBtn
                    :onClick="linkedInLogin"
                    :icon="'fab fa-linkedin-in'"
                    :text="'Sign In'"
                    :styles="{
                      background: 'none',
                      color: '#272727',
                      width: '100% !important',
                      minWidth: '100% !important',
                      border: '1px solid #84868B'
                    }"
                    :icon_position="'left'"
                  />
                </div>
              </div>
            </div>
            <div class="d-flex justify-content-center orSeparatorB">
              <b>OR</b>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-12 d-flex justify-content-center">
              <dialogueBtn 
                :onClick="login"
                :icon="'fas fa-sign-in-alt'"
                :text="'Login'"
                :icon_position="'right'"
                :styles="{
                  backgroundColor: colors.warning,
                  color: 'white'
                }"
              />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import dialogueBtn from 'src/modules/generic/dialogueBtn'
import roundedInput from 'src/modules/generic/roundedInput'
import roundedBtn from 'src/modules/generic/roundedBtn'
import roundedSelectBtn from 'src/modules/generic/roundedSelectBtn'
import COLORS from 'src/assets/style/colors.js'
import AUTH from 'src/services/auth'
import CONFIG from 'src/config'
import COMMON from 'src/common'
import global from 'src/helpers/global'
export default {
  mounted(){
    this.retrievePayloads()
    this.onSelect(this.global.selectedIndustryIndex)
  },
  data() {
    return {
      username: '',
      password: '',
      cpassword: '',
      email: '',
      config: CONFIG,
      common: COMMON,
      type: 'USER',
      industry: [],
      selectedIndustry: null,
      global: global,
      isValid: true,
      isEmailValid: true,
      passwordRequirements: '',
      colors: COLORS,
      user: AUTH.user,
      errorMessage: null
    }
  },
  components: {
    dialogueBtn,
    roundedInput,
    roundedBtn,
    roundedSelectBtn,
    COLORS
  },
  computed: {
    returnIndustry() {
      return this.industry.map((el, ndx) => {
        return el.category
      })
    }
  },
  methods: {
    retrievePayloads(){
      let conditions = [{
        value: 'subscriptions',
        clause: '=',
        column: 'payload'
      }]
      let parameter = {
        condition: conditions
      }
      $('#loading').css({'display': 'block'})
      this.APIRequest('payloads/retrieve', parameter).then(response => {
        $('#loading').css({'display': 'none'})
        if(response.data.length > 0) {
          this.industry = response.data
        }else{
          this.industry = []
        }
      }).catch(error => {
        $('#loading').css({'display': 'none'})
        error
      })
    },
    gmailLogin(event) {
      console.log('gmail login:::')
      $('#loading').css({'display': 'block'})
      localStorage.setItem('login_with', 'google')
      this.APIRequest('social_lite/authenticate/google/redirect', {}, response => {
        $('#loading').css({'display': 'none'})
        if(response.data && response.data.url) {
          console.log('Authentication with google response: ', response)
          window.location.href = response.data.url
        }
      }, error => {
        $('#loading').css({'display': 'none'})
        console.log('Authentication with google error! ', error)
      })
    },
    fbLogin(event) {
      $('#loading').css({'display': 'block'})
      console.log('facebook login:::')
      localStorage.setItem('login_with', 'facebook')
      this.APIRequest('social_lite/authenticate/facebook/redirect', {}, response => {
        $('#loading').css({'display': 'none'})
        if(response.data && response.data.url) {
          console.log('Authentication with facebook response: ', response)
          window.location.href = response.data.url
        }
      }, error => {
        $('#loading').css({'display': 'none'})
        console.log('Authentication with facebook error! ', error)
      })
    },
    linkedInLogin(event) {
      $('#loading').css({'display': 'block'})
      console.log('linkedin login:::')
      localStorage.setItem('login_with', 'linkedin')
      this.APIRequest('social_lite/authenticate/linkedin/redirect', {}, response => {
        $('#loading').css({'display': 'none'})
        if(response.data && response.data.url) {
          console.log('Authentication with linkedin response: ', response)
          window.location.href = response.data.url
        }
      }, error => {
        $('#loading').css({'display': 'none'})
        console.log('Authentication with linkedin error! ', error)
      })
    },
    onSelect(data) {
      console.log('On Select:::', data)
      this.selectedIndustry = data.index != null ? data.index : data
    },
    login(event) {
      // console.log('login:::')
      this.$router.push('/login')
    },
    register(event) {
      if(this.validate()) {
        this.isValid = true
        let parameter = {
          username: this.username,
          email: this.email,
          password: this.password,
          config: CONFIG,
          account_type: this.type,
          referral_code: null,
          status: 'ADMIN',
          industry: JSON.stringify({industry: this.industry[this.selectedIndustry].category})
        }
        $('#loading').css({'display': 'block'})
        this.APIRequest('account/create', parameter).then(response => {
          $('#loading').css({'display': 'none'})
          if(response.data !== null) {
            this.login()
            // this.createMerchantAndPayload(response.data)
          }else if(response.error !== null){
            if(response.error.status === 100){
              let message = response.error.message
              if(typeof message.username !== undefined && typeof message.username !== 'undefined'){
                this.errorMessage = message.username[0]
              }else if(typeof message.email !== undefined && typeof message.email !== 'undefined'){
                this.errorMessage = message.email[0]
              }
            }
          }
        })
      }
    },
    async createMerchantAndPayload(id) {
      let merchant = {
        account_id: id,
        name: this.username,
        email: this.email,
        addition_informations: JSON.stringify({industry: this.industry[this.selectedIndustry].category})
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
      this.errorMessage = null
      let email = this.email
      let username = this.username
      let password = this.password
      let cpassword = this.cpassword
      let selectedIndustry = this.selectedIndustry
      if(email === '' || username === '' || password === '' || cpassword === '' || selectedIndustry === null || selectedIndustry === undefined){
        this.isValid = false
        return false
      }else if(username.includes(' ')){
        this.isValid = false
        this.errorMessage = 'Username should not contain spaces.'
        return false
      }else if(!global.validateEmail(email)) {
        this.isValid = false
        this.isEmailValid = false
        return false
      }else if(password !== cpassword) {
        if(global.validateEmail(email)) {
          this.isEmailValid = true
        }
        this.isValid = false
        return false
      }else if(!global.validatePassword(password)) {
        if(global.validateEmail(email)) {
          this.isEmailValid = true
        }
        this.isValid = false
        this.passwordRequirements = 'Password should be minimum of 8 and maximum of 16.'
        // this.passwordRequirements = 'Password should be minimum of 8 and maximum of 16 and should contain at least one digit, lower case, upper case and special character.'
        return false
      }
      this.passwordRequirements = ''
      return true
    },
    forgotPassword(event) {
      console.log('forgot password:::')
    }
  }
}
</script>

<style lang="scss" scoped>
@import "~assets/style/colors.scss";
.requiredFieldError {
  color: $danger;
  font-size: 10px;
  margin-left: 20px;
  margin-bottom: 25px !important;
}
.errorMessage {
  margin-top: -14px;
  color: $danger;
  margin-bottom: 25px !important;
  text-align: center;
}
.orSeparatorA {
  margin-top: 35px;
  margin-bottom: 15px;
}
.orSeparatorB {
  margin-top: 15px;
  margin-bottom: 35px;
}
.registrationField {
  margin-bottom: 35px;
}
.QouteText {
  font-size: 50px;
  font-weight: bold;
}
.SubQoute {
  text-align: center;
}
.QouteCard {
  width: 80% !important;
  margin-top: 5vh;
  margin-bottom: 5vh;
  text-align: center;
}
.RegisterCard {
  width: 475px;
  background-color: white;
  border-radius: 20px;
  box-shadow: 3px 3px 1px -2px rgba(1,0,154,0.75);
  -webkit-box-shadow: 3px 3px 1px -2px rgba(1,0,154,0.75);
  -moz-box-shadow: 3px 3px 1px -2px rgba(1,0,154,0.75);
}
.RegisterCardBody {}
.LoginContainer {
  min-height: 85vh;
  background-color: transparent !important;
}
.RowContainer {
  background-color: white !important;
}
.QouteCardContainer {
  display: flex !important;
  justify-content: center !important;
  align-items: center !important;
  background-color: transparent !important;
  margin-top: 5%;
}
.LoginCardContainer {
  background-color: transparent !important;
}

@media (max-width: 500px) {
  .RegisterCard {
    width: 100%;
  }
  .QouteText {
  font-size: 30px;
  }
}
@media(max-width: 1200px) {
  .QouteCardContainer {
    width: 90% !important;
  }
}
@media (max-width: 1150px){
  .QouteCardContainer {
    -ms-flex: 0 0 50%;
    flex: 0 0 50%;
    max-width: 50%;
  }
  .LoginCardContainer {
    -ms-flex: 0 0 50%;
    flex: 0 0 50%;
    max-width: 50%;
  }
}
@media (max-width: 950px){
  .QouteCardContainer {
    -ms-flex: 0 0 40%;
    flex: 0 0 40%;
    max-width: 40%;
  }
  .LoginCardContainer {
    -ms-flex: 0 0 60%;
    flex: 0 0 60%;
    max-width: 60%;
  }
  .QouteText {
  font-size: 35px;
  }
}
@media (max-width: 768px){
  .QouteCardContainer {
    -ms-flex: 0 0 100%;
    flex: 0 0 100%;
    max-width: 100%;
  }
  .LoginCardContainer {
    -ms-flex: 0 0 100%;
    flex: 0 0 100%;
    max-width: 100%;
  }
  .QouteText {
  font-size: 35px;
  }
  .QouteCard img {
    width: 100% !important;
  }
}
</style>
