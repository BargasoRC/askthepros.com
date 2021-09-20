<template>
  <div class="LoginContainer">
    <div class="row RowContainer">
      <div class="col-sm-7 col-md-7 col-lg-7 col-xl-7 col-xs-7 QouteCardContainer mb-5">
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
        <div class="card LoginCard">
          <div class="card-body LoginCardBody">
            <div class="d-flex justify-content-center pt-5 pb-5 mb-3">
              <b>Login with AskThePros</b>
            </div>
            <div>
              <p
                class="mb-2 pb-0 errorMessage"
                v-if="errorMessage != ''"
              >{{errorMessage}}</p>
              <roundedInput 
                :type="'text'"
                :placeholder="'Username'"
                :class="!this.isValid && username == '' ? 'mb-0 ' : ' LoginField'"
                :styles="{
                  border: !this.isValid && username == '' ? '1px solid red !important' : 'none',
                }"
                v-model="username"
              />
              <p
                class="mb-0 pb-0 invalidEmail"
                v-if="!this.isValid && username == ''"
              >Required Field</p>

              <div class="roudedInput">
                <div class="input-group">
                    <input class="form-control roudedInput !this.isValid && password == ''? 'mb-0 ' : ' LoginField'" style="border: none !important; background: none !important" :type="visibility" placeholder="Password" v-model="password" @keyup.enter="login()">
                    <span style="background: none; margin-top: 2.5%; margin-right: 3%">
                    <i v-if="visibility == 'password'" @click="showPassword()" class="fa fa-eye" aria-hidden="true"></i>
                    <i v-if="visibility == 'text'" @click="hidePassword()" class="fa fa-eye-slash" aria-hidden="true"></i>
                  </span>
                </div>
              </div>
              <br>

              <!-- <roundedInput 
                :type="'password'"
                :placeholder="'Password'"
                :class="!this.isValid && password == ''? 'mb-0 ' : ' LoginField'"
                :styles="{
                  border: !this.isValid && password == '' ? '1px solid red !important' : 'none'
                }"
                v-model="password"
                :onEnter="login"
              /> -->
              <p
                class="mb-0 pb-0 invalidEmail"
                v-if="!this.isValid && password == ''"
              >Required Field</p>
            </div>
            <div class="d-flex justify-content-between">
              <roundedBtn
                :onClick="forgotPassword"
                :text="'Forgot your password?'"
                :styles="{
                  background: 'none',
                  color: '272727'
                }"
              />
              <dialogueBtn 
                :onClick="login"
                :icon="'fas fa-sign-in-alt'"
                :text="'Login'"
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
                <div class="col-sm-4 col-md-4 col-lg-4">
                  <roundedBtn
                    :onClick="gmailLogin"
                    :icon="'fab fa-google'"
                    :text="'Sign In'"
                    :styles="{
                      background: 'none',
                      color: '272727',
                      width: '100% !important',
                      minWidth: '100% !important',
                      border: '1px solid #84868B'
                    }"
                    :icon_position="'left'"
                  />
                </div>
                <div class="col-sm-4 col-md-4 col-lg-4">
                  <roundedBtn
                    :onClick="fbLogin"
                    :icon="'fa fa-facebook'"
                    :text="'Sign In'"
                    :styles="{
                      background: 'none',
                      color: '272727',
                      width: '100% !important',
                      minWidth: '100% !important',
                      border: '1px solid #84868B'
                    }"
                    :icon_position="'left'"
                  />
                </div>
                <div class="col-sm-4 col-md-4 col-lg-4">
                  <roundedBtn
                    :onClick="linkedInLogin"
                    :icon="'fab fa-linkedin-square'"
                    :text="'Sign In'"
                    :styles="{
                      background: 'none',
                      color: '272727',
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
                :onClick="register"
                :icon="'fas fa-sign-in-alt'"
                :text="'Register Now'"
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
import COLORS from 'src/assets/style/colors.js'
import AUTH from 'src/services/auth'
import ROUTER from 'src/router'
export default {
  data() {
    return {
      username: '',
      password: '',
      errorMessage: '',
      isValid: true,
      colors: COLORS,
      user: AUTH.user,
      visibility: 'password'
    }
  },
  components: {
    dialogueBtn,
    roundedInput,
    roundedBtn
  },
  mounted() {},
  methods: {
    showPassword() {
      this.visibility = 'text'
    },
    hidePassword() {
      this.visibility = 'password'
    },
    login(event) {
      if(this.username !== '' && this.password !== '') {
        this.isValid = true
        $('#loading').css({'display': 'block'})
        AUTH.authenticate(this.username, this.password, (response) => {
          $('#loading').css({'display': 'none'})
          ROUTER.push(`/dashboard`)
        }, (response, status) => {
          $('#loading').css({'display': 'none'})
          if(status === 401){
            this.errorMessage = 'Username and Password did not match.'
          }else if(status === 402){
            this.errorMessage = response.error
          }
        })
      }else{
        this.isValid = false
      }
    },
    register(event) {
      console.log('register:::')
      this.$router.push('/signup')
    },
    forgotPassword(event) {
      console.log('forgot password:::')
      this.$router.push('/request_reset_password')
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
    }
  }
}
</script>

<style lang="scss" scoped>
@import "~assets/style/colors.scss";
.roudedInput {
  outline: none !important;
  box-shadow: none !important;
  height: 45px !important;
  border-radius: 40px !important;
  border: 1px solid $gray !important;
}
.errorMessage {
  margin-top: -14px;
  color: $danger;
  font-size: 10px;
  margin-bottom: 25px !important;
  text-align: center;
}
.invalidEmail {
  color: $danger;
  font-size: 10px;
  margin-left: 20px;
  margin-bottom: 25px !important;
}
.orSeparatorA {
  margin-top: 35px;
  margin-bottom: 15px;
}
.orSeparatorB {
  margin-top: 15px;
  margin-bottom: 20px;
}
.LoginField {
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
.LoginCard {
  width: 475px;
  background-color: white;
  border-radius: 20px;
  box-shadow: 3px 3px 1px -2px rgba(1,0,154,0.75);
  -webkit-box-shadow: 3px 3px 1px -2px rgba(1,0,154,0.75);
  -moz-box-shadow: 3px 3px 1px -2px rgba(1,0,154,0.75);
  max-height: 42.5rem;
}
.LoginCardBody {
}
.LoginContainer {
  min-height: 85vh;
  margin-top: 100px;
}
.RowContainer {
  background: white;
}
.QouteCardContainer {
  display: flex !important;
  justify-content: center !important;
  align-items: center !important;
  background: none;
  margin-top: 5%;
}
.LoginCardContainer {
  background: none;
}

@media (max-width: 500px) {
  .LoginCard {
    width: 100%;
    max-height: 50.5rem;
  }
  .QouteText {
  font-size: 30px;
  }
}
@media(max-width: 1200px) {
  .QouteCardContainer {
    width: 90% !important;
  }
  .QouteText {
  font-size: 35px;
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
