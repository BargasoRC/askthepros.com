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
          <img :src="require('assets/img/section3-img.png')" alt="Image" style="width: 85%;height:auto">
        </div>
      </div>
      <div class="col-sm-5 col-md-5 col-lg-5 col-xl-5 col-xs-5 d-flex justify-content-center LoginCardContainer mb-5">
        <div class="card LoginCard">
          <div class="card-body LoginCardBody">
            <div class="d-flex justify-content-center pt-5 pb-5 mb-3">
              <b>Reset Password with AskThePros</b>
            </div>
            <div class="login-message-holder login-spacer" v-if="errorMessage != '' && updateFlag === false">
            <span class="text-danger text-center" v-if="errorMessage !== null"><b>Oops!</b> {{errorMessage}}</span>
            </div>
            <div class="login-message-holder login-spacer" v-if="updateFlag === true">
                <span class="text-center">Your password was successully updated! To login click the login button below.</span>
            </div>
            <div class="roudedInput" v-if="updateFlag === false">
                <div class="input-group">
                    <input class="form-control roudedInput !this.isValid && password == ''? 'mb-0 ' : ' LoginField'" style="border: none !important; background: none !important" :type="visibility" placeholder="New Password" v-model="password" @keyup.enter="login()">
                    <span style="background: none; margin-top: 2.5%; margin-right: 3%">
                    <i v-if="visibility == 'password'" @click="showPassword('password')" class="fa fa-eye" aria-hidden="true"></i>
                    <i v-if="visibility == 'text'" @click="hidePassword('password')" class="fa fa-eye-slash" aria-hidden="true"></i>
                  </span>
                </div>
            </div>
            <br>
            <div class="roudedInput" v-if="updateFlag === false">
                <div class="input-group">
                    <input class="form-control roudedInput !this.isValid && password == ''? 'mb-0 ' : ' LoginField'" style="border: none !important; background: none !important" :type="visibilityC" placeholder="Confirm New Password" v-model="c_password" @keyup.enter="login()">
                    <span style="background: none; margin-top: 2.5%; margin-right: 3%">
                    <i v-if="visibilityC == 'password'" @click="showPassword('cpassword')" class="fa fa-eye" aria-hidden="true"></i>
                    <i v-if="visibilityC == 'text'" @click="hidePassword('cpassword')" class="fa fa-eye-slash" aria-hidden="true"></i>
                  </span>
                </div>
            </div>
            <div class="message mt-2 mb-2">
              <i v-if="showResponse" class="resetPasswordMessage">We send recovery email to your email address at <u>{{email}}</u>. Please give us a moment, it may take few minutes. Please check your email address to continue.</i>
              <i v-if="showError" class="resetPasswordMessage" style="color:red">Something went wrong.</i>
            </div>
            <div class="d-flex justify-content-center" v-if="updateFlag === false">
              <dialogueBtn 
                :onClick="reset"
                :icon="'fas fa-sign-in-alt'"
                :text="'Continue'"
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
            <div class="col-sm-12 mb-3 col-md-12 col-lg-12 d-flex justify-content-center">
              <dialogueBtn 
                :onClick="redirect"
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
  name: '',
  mounted(){
    this.code = this.$route.params.code
    this.username = this.$route.params.username
  },
  data() {
    return {
      showResponse: false,
      isEmailError: true,
      showError: false,
      visibility: 'password',
      visibilityC: 'password',
      isValid: true,
      email: null,
      flag: false,
      errorMessage: null,
      password: null,
      c_password: null,
      code: this.$route.params.code,
      username: this.$route.params.username,
      updateFlag: false
    }
  },
  components: {
    dialogueBtn,
    roundedInput,
    roundedBtn
  },
  methods: {
    showPassword(pass) {
      if(pass === 'password'){
        this.visibility = 'text'
      } else {
        this.visibilityC = 'text'
      }
    },
    hidePassword(pass) {
      if(pass === 'cpassword'){
        this.visibilityC = 'password'
      } else {
        this.visibility = 'password'
      }
    },
    reset(){
      this.validate()
      if(this.flag === true){
        let parameter = {
          'username': this.username,
          'code': this.code,
          'password': this.password
        }
        $('#loading').css({display: 'block'})
        this.APIRequest('accounts/update', parameter).then(response => {
          $('#loading').css({display: 'none'})
          if(response.data === true){
            this.updateFlag = true
          }else{
            this.updateFlag = false
          }
        })
      }
    },
    validate(){
      if(this.password === null || this.password === '' || this.cPassword === null || this.cPassword === ''){
        this.flag = false
        this.errorMessage = 'Please fill in all required fields.'
      }else if(this.password !== this.cPassword){
        this.flag = false
        this.errorMessage = 'Please confirm your new password.'
      }else if(this.password.length < 8){
        this.flag = false
        this.errorMessage = 'Password length must be greater than 8 digit characters.'
      }else if(/^[a-zA-Z0-9]+$/.test(this.password)){
        this.flag = false
        this.errorMessage = 'Password must be alphanumeric characters. It should contain 1 number, 1 special character and letters.'
      }else{
        this.flag = true
        this.errorMessage = null
      }
    },
    redirect(event){
      this.$router.push('/login')
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
.roudedInput {
  outline: none !important;
  box-shadow: none !important;
  height: 45px !important;
  border-radius: 40px !important;
  border: 1px solid $gray !important;
}
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
}
.LoginCardBody {}
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
  background: white;
    margin-top: 5%;
}
.LoginCardContainer {
  background: none;
  height: calc(100% + 10px);
}

@media (max-width: 500px) {
  .LoginCard {
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
