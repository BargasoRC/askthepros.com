<template>
  <div class="LoginContainer col-sm-12">
    <div class="row RowContainer">
      <div class="col-sm-7 col-md-7 col-lg-7 col-xl-7 col-xs-7 QouteCardContainer mb-5 ">
        <div class="QouteCard">
          <div class="SubQoute">
            <h1 class="QouteText" style="color: #01004E">Become THE LOCAL</h1>
            <h1 class="QouteText" style="color: #01004E">{{industry.category.replace(/_/g, ' ').toUpperCase()}} Expert</h1>
          </div>
          <div class="SubQoute">
            <h1 class="QouteText" style="color: #01009A">With Automated Social Media Posting.</h1>
          </div>
          <img :src="location === 'localhost' ? require('assets/img/section3-img.png') : 'https://staging.askthepros.com/static/img/section3-img.88fb0ea.png'" alt="Image" style="width: 60%;height:auto">
        </div>
      </div>
      <div class="col-sm-5 col-md-5 col-lg-5 col-xl-5 col-xs-5 d-flex justify-content-center LoginCardContainer mb-5">
        <div class="card RegisterCard">
          <div class="card-body RegisterCardBody">
            <div class="d-flex justify-content-center pt-5 pb-5 mb-3">
              <div class="reg" @click="redirect('/login')">
                Login
              </div>
              <div class="log">
                Register
              </div>
            </div>
            <!-- <p
              class="mb-2 pb-0 errorMessage"
              v-if="errorMessage != null"
            >{{errorMessage}}</p>
            <div> -->
              <!-- <p class="mt-2"><b>Username</b></p>
              <roundedInput 
                :type="'text'"
                :placeholder="'Your username here...'"
                :class="!this.isValid && username == '' ? 'mb-0 ' : ' registrationField'"
                :styles="{
                  border: !this.isValid && username == '' ? '1px solid red !important' : 'none',
                }"
                v-model="username"
              /> -->
              <!-- <p
                class="mb-0 pb-0 requiredFieldError"
                v-if="!this.isValid && username == ''"
              >Required Field</p> -->
              <!-- <p class="mt-2"><b>Email</b></p>
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
              }}</p> -->
            </div>
            <div class="row" style="margin-left: 10%; margin-right: 6%;">
              <p class="col-sm-7" style="font-size: 20px">
                <b>{{industry.category.replace(/_/g, ' ')}}</b>
              </p>
              <p class="col-sm-5" style="font-size: 20px">
                <b>${{industry.payload_value}}/Month</b>
              </p>
            </div>
            <!-- <div class="d-flex justify-content-center">
              <dialogueBtn 
                :onClick="register"
                :icon="'fas fa-sign-in-alt'"
                :text="'Register'"
                :icon_position="'right'"
                :styles="{
                  backgroundColor: colors.darkPrimary,
                  color: 'white'
                }"
              />
            </div> -->
            <div class="d-flex justify-content-center orSeparatorA">
              <!-- <b>Register with Social Media</b> -->
            </div>
            <div class="col-sm-12">
              <!-- <div class="row"> -->
                <div class="col-sm-12 col-md-12 col-lg-12 mt-1 mb-1">
                  <roundedBtn
                    :onClick="gmailLogin"
                    :icon="'fab fa-google'"
                    :text="'Register with Email'"
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
                <br>
                <div class="col-sm-12 col-md-12 col-lg-12 mt-1 mb-1">
                  <roundedBtn
                    :onClick="fbLogin"
                    :icon="'fab fa-facebook-f'"
                    :text="'Register with Facebook'"
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
                <br>
                <div class="col-sm-12 col-md-12 col-lg-12 mt-1 mb-1">
                  <roundedBtn
                    :onClick="linkedInLogin"
                    :icon="'fab fa-linkedin-in'"
                    :text="'Register with LinkedIn'"
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
              <!-- </div> -->
            </div>
            <!-- <div class="d-flex justify-content-center orSeparatorB">
              <b>OR</b>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-12 d-flex justify-content-center">
              <dialogueBtn
                :onClick="login"
                :icon="'fas fa-sign-in-alt'"
                :text="'Login'"
                :icon_position="'right'"
                :styles="{
                  backgroundColor: colors.secondary,
                  color: 'white'
                }"
              />
            </div> -->
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
import ROUTER from 'src/router'
export default {
  mounted(){
    this.location = window.location.hostname
    let params = this.$route.params
    if(params.category){
      this.selectedIndustry = params.category
      // this.selectedIndustry = params.category.replace(/_/g, ' ')
    }
    setTimeout(() => {
      this.retrievePayloads()
    }, 1000)
  },
  data() {
    return {
      username: '',
      password: '',
      cpassword: '',
      email: '',
      location: null,
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
    redirect(parameter) {
      if(parameter === '/signup'){
        if(localStorage.getItem('selectedIndustry') != null){
          ROUTER.push(parameter)
        }else{
          alert('Please select industry to proceed.')
        }
      }else{
        ROUTER.push(parameter)
      }
      if(parameter === '/'){
        this.scrollToTop()
      }
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
          this.industry = response.data[0]
        }else{
          this.industry = []
        }
      }).catch(error => {
        $('#loading').css({'display': 'none'})
        error
      })
    },
    gmailLogin(event) {
      // this.$router.push('/stepper/' + this.selectedIndustry)
      $('#loading').css({'display': 'block'})
      localStorage.setItem('login_with', 'google')
      this.APIRequest('social_lite/authenticate/google/redirect', {}, response => {
        $('#loading').css({'display': 'none'})
        if(response.data && response.data.url) {
          window.location.href = response.data.url
          this.$router.push('/stepper')
        }
      }, error => {
        $('#loading').css({'display': 'none'})
        console.log('Authentication with google error! ', error)
      })
    },
    fbLogin(event) {
      $('#loading').css({'display': 'block'})
      localStorage.setItem('login_with', 'facebook')
      this.APIRequest('social_lite/authenticate/facebook/redirect', {}, response => {
        $('#loading').css({'display': 'none'})
        if(response.data && response.data.url) {
          window.location.href = response.data.url
        }
      }, error => {
        $('#loading').css({'display': 'none'})
        console.log('Authentication with facebook error! ', error)
      })
    },
    linkedInLogin(event) {
      $('#loading').css({'display': 'block'})
      localStorage.setItem('login_with', 'linkedin')
      this.APIRequest('social_lite/authenticate/linkedin/redirect', {}, response => {
        $('#loading').css({'display': 'none'})
        if(response.data && response.data.url) {
          window.location.href = response.data.url
        }
      }, error => {
        $('#loading').css({'display': 'none'})
        console.log('Authentication with linkedin error! ', error)
      })
    },
    login(event) {
      this.$router.push('/login')
    },
    register(event) {
      if(this.validate()) {
        this.isValid = true
        let parameter = {
          username: this.email,
          email: this.email,
          password: this.password,
          // config: CONFIG,
          account_type: this.type,
          referral_code: null,
          status: 'ADMIN',
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
      this.errorMessage = null
      let email = this.email
      let username = this.email
      let password = this.password
      let cpassword = this.cpassword
      let selectedIndustry = this.selectedIndustry
      if(email === '' || username === '' || password === '' || cpassword === '' || selectedIndustry === null || selectedIndustry === undefined){
        this.isValid = false
        return false
      }else if(username.includes(' ')){
        this.isValid = false
        this.errorMessage = 'Email should not contain spaces.'
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
.log{
  background-color: #ffc107;
  padding: 3%;
  border-color: #ffc107;
  border-radius: 10px;
  font-weight: bold;
  // margin-left: 3%;
}
.reg{
  background-color: whitesmoke;
  padding: 3%;
  border-color: whitesmoke;
  border-radius: 10px;
  font-weight: bold;
}
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
  margin-top: 15px;
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
  max-height: 42.5rem;
}

.LoginContainer {
  min-height: 85vh;
  background-color: transparent !important;
}
.RowContainer {
  background-color: white !important;
  padding-top: 15vh;
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

.form-control{
  border-radius: 25px !important;
  height: 50px !important;
  width: 100%;
  margin: auto;
  display: flex;
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
