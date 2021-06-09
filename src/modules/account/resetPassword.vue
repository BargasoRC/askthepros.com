<template>
  <div class="LoginContainer col-sm-12">
    <div class="row RowContainer">
      <div class="col-sm-7 col-md-7 col-lg-7 col-xl-7 col-xs-7 QouteCardContainer mb-5">
        <div class="QouteCard">
          <div class="SubQoute">
            <h1 class="QouteText" style="color: #01004E">Become A Local Expert</h1>
          </div>
          <div class="SubQoute">
            <h1 class="QouteText" style="color: #01009A">With Automated Social Media Posting.</h1>
          </div>
          <div class="d-flex justify-content-center pl-5">
            <img :src="require('assets/img/section3-img.png')" alt="Image" class="w-75" style="height: 100%;">
          </div>
        </div>
      </div>
      <div class="col-sm-5 col-md-5 col-lg-5 col-xl-5 col-xs-5 d-flex justify-content-center LoginCardContainer mb-5">
        <div class="card LoginCard">
          <div class="card-body LoginCardBody">
            <div class="d-flex justify-content-center pt-5 pb-5 mb-3">
              <b>Request to Reset Password with AskThePros</b>
            </div>
            <div>
              <roundedInput 
                :type="'text'"
                :styles="{
                  border: !this.isEmailError ? '.2px solid red !important' : 'none'
                }"
                :placeholder="'Email Address'"
                :class="''"
                v-model="email"
              />
              <p
                class="mb-0 pb-0 invalidEmail"
                v-if="!this.isEmailError"
              >Invalid email</p>
            </div>
            <div class="message mt-2 mb-2">
              <i v-if="showResponse" class="resetPasswordMessage">We send recory email to yor email address at <u>{{email}}</u>. Please give us a moment, it may take few minutes. Please check your email address to continue.</i>
            </div>
            <div class="d-flex justify-content-center">
              <dialogueBtn 
                :onClick="reset"
                :icon="'fas fa-sign-in-alt'"
                :text="'Send Request'"
                :styles="{
                  backgroundColor: '#01009A',
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
                    :icon="'fab fa-facebook-f'"
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
                    :icon="'fab fa-linkedin-in'"
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
                :onClick="login"
                :icon="'fas fa-sign-in-alt'"
                :text="'Login'"
                :styles="{
                  backgroundColor: '#F1B814',
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
import AUTH from 'src/services/auth'
import global from 'src/helpers/global'
export default {
  data() {
    return {
      email: '',
      showResponse: false,
      isEmailError: true
    }
  },
  components: {
    dialogueBtn,
    roundedInput,
    roundedBtn
  },
  methods: {
    reset(event) {
      console.log('Reset password:::', global.validateEmail(this.email))
      if(global.validateEmail(this.email)){
        this.isEmailError = true
        let parameter = {
          email: this.email
        }
        this.APIRequest('accounts/request_reset', parameter).then(response => {
          if(response.data.length > 0){
            console.log('ACCOUNTS RESPONSE: ', response)
            this.showResponse = true
          }
        })
      }else{
        this.isEmailError = false
      }
    },
    login(event) {
      console.log('login:::')
      this.$router.push('/')
    },
    forgotPassword(event) {
      console.log('forgot password:::')
    },
    gmailLogin(event) {
      console.log('gmail login:::')
    },
    fbLogin(event) {
      console.log('facebook login:::')
    },
    linkedInLogin(event) {
      console.log('linkedin login:::')
    }
  }
}
</script>

<style lang="scss" scoped>
@import "~assets/style/colors.scss";
.invalidEmail {
  color: $danger;
  font-size: 10px;
  margin-left: 20px;
}
.resetPasswordMessage {
  font-size: 12px;
}
.message {
  min-height: 80px;
}
.orSeparatorA {
  margin-top: 35px;
  margin-bottom: 15px;
}
.orSeparatorB {
  margin-top: 15px;
  margin-bottom: 35px;
}
.LoginField {
  margin-bottom: 35px;
}
.QouteText {
  font-size: 50px;
}
.SubQoute {
  text-align: center;
}
.QouteCard {
  width: 80% !important;
}
.LoginCard {
  width: 475px;
  background-color: white;
  border-radius: 20px;
  box-shadow: 3px 3px 1px -2px rgba(1,0,154,0.75);
  -webkit-box-shadow: 3px 3px 1px -2px rgba(1,0,154,0.75);
  -moz-box-shadow: 3px 3px 1px -2px rgba(1,0,154,0.75);
}
.LoginCardBody {}
.LoginContainer {
  min-height: 85vh;
}
.RowContainer {
  background: white;
}
.QouteCardContainer {
  display: flex !important;
  justify-content: center !important;
  align-items: center !important;
  background: white;
    margin-top: 5%;
}
.LoginCardContainer {
  background: none;
}

@media (max-width: 500px) {
  .LoginCard {
    width: 100%;
  }
  .QouteText {
  font-size: 20px;
  }
}
@media(max-width: 1200px) {
  .QouteCardContainer {
    width: 90% !important;
  }
  .QouteText {
  font-size: 40px;
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
  font-size: 30px;
  }
}
</style>
