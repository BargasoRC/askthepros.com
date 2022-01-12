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
            <div class="d-flex justify-content-center pt-5 pb-2 mb-3">
              <b>Verification</b>
            </div>
            <div  style="margin-bottom: 25px !important; text-align: center;" v-bind:class="{'text-danger': flag === false}" class="login-spacer">
              {{message}}
            </div>
            <div class="d-flex justify-content-center">
              <dialogueBtn 
                :onClick="update"
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
import COMMON from 'src/common.js'
export default {
  mounted(){
    this.username = this.$route.params.username
    this.code = this.$route.params.code
    this.retrieveAccount()
    this.setMessage()
  },
  data() {
    return {
      username: this.$route.params.username,
      code: this.$route.params.code,
      account: null,
      flag: null,
      message: null,
      user: AUTH.user,
      verified: false,
      common: COMMON
    }
  },
  components: {
    dialogueBtn,
    roundedInput,
    roundedBtn
  },
  methods: {
    setMessage(){
      this.message = 'Hi ' + this.username + '! Please click the button to verify your email address here in ' + this.common.APP_NAME
    },
    retrieveAccount(){
      let parameter = {
        'condition': [
          {
            'column': 'username',
            'value': this.username,
            'clause': '='
          },
          {
            'column': 'code',
            'value': this.code,
            'clause': '='
          }
        ]
      }
      this.APIRequest('accounts/retrieve', parameter).then(response => {
        if(response.data.length > 0){
          this.account = response.data[0]
        }else{
          this.account = null
        }
      })
    },
    update(){
      this.retrieveAccount()
      if(this.validate() === true && this.account !== null){
        let parameter = {
          'id': this.account.id,
          'status': 'VERIFIED'
        }
        $('#loading').css({display: 'block'})
        this.APIRequest('users/update_verification', parameter).then(response => {
          $('#loading').css({display: 'none'})
          if(response.data === true){
            this.message = 'Congratulations! You\'ve have successfully verified your account. Kindly click the login button to proceed.'
            this.flag = true
            this.verified = true
          }else{
            this.flag = false
            this.verified = false
            this.message = 'Sorry! Internal Error. Kindly verify again or contact the system support.'
          }
        })
      }else{
        this.flag = false
        this.message = 'Sorry! Internal Error. Kindly verify again or contact the system support.'
      }
    },
    validate(){
      if(this.username !== null || this.code !== null){
        this.flag = true
        return true
      }else{
        this.flag = false
        return false
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
.invalidEmail {
  color: $danger;
  font-size: 10px;
  margin-left: 20px;
}
.resetPasswordMessage {
  font-size: 13px;
}
.message {
  min-height: 60px;
  text-align: center;
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
