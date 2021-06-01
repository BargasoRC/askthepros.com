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
        </div>
      </div>
      <div class="col-sm-5 col-md-5 col-lg-5 col-xl-5 col-xs-5 d-flex justify-content-center LoginCardContainer mb-5">
        <div class="card RegisterCard">
          <div class="card-body RegisterCardBody">
            <div class="d-flex justify-content-center pt-5 pb-5 mb-3">
              <b>Register with AskThePros</b>
            </div>
            <div>
              <roundedInput 
                :type="'text'"
                :styles="{}"
                :placeholder="'Username'"
                :classes="'registrationField'"
                v-model="username"
              />
              <roundedInput 
                :type="'text'"
                :styles="{}"
                :placeholder="'Email Address'"
                :classes="'registrationField'"
                v-model="email"
              />
              <roundedInput 
                :type="'password'"
                :styles="{}"
                :placeholder="'Password'"
                :classes="'registrationField'"
                v-model="password"
              />
              <roundedInput 
                :type="'password'"
                :styles="{}"
                :placeholder="'Confirm Password'"
                :classes="'registrationField'"
                v-model="cpassword"
              />
              <roundedSelectBtn 
                :placeholder="'Select Industry'"
                :items="returnIndustry"
                class="registrationField"
                :styles="{
                  background: 'none',
                  color: '#84868B !important',
                  width: '100% !important',
                  minWidth: '100% !important'
                }"
                :selectedIndex="global.selectedIndustryIndex"
                @onSelect="onSelect"
              />
            </div>
            <div class="d-flex justify-content-between">
              <roundedBtn
                :onClick="forgotPassword"
                :text="'Forgot your password?'"
                :styles="{
                  background: 'none',
                  color: '#272727'
                }"
              />
              <dialogueBtn 
                :onClick="login"
                :icon="'fas fa-sign-in-alt'"
                :text="'Login'"
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
                :onClick="register"
                :icon="'fas fa-sign-in-alt'"
                :text="'Register Now'"
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
import roundedSelectBtn from 'src/modules/generic/roundedSelectBtn'
import AUTH from 'src/services/auth'
import CONFIG from 'src/config'
import COMMON from 'src/common'
import global from 'src/helpers/global'
export default {
  data() {
    return {
      username: '',
      password: '',
      cpassword: '',
      email: '',
      config: CONFIG,
      common: COMMON,
      type: 'USER',
      industry: global.industry,
      selectedIndustry: null,
      global: global
    }
  },
  components: {
    dialogueBtn,
    roundedInput,
    roundedBtn,
    roundedSelectBtn
  },
  computed: {
    returnIndustry() {
      return this.industry.map(el => {
        return el.category
      })
    }
  },
  methods: {
    onSelect(data) {
      console.log('On Select:::')
      this.selectedIndustry = data.index
    },
    login(event) {
      // console.log('login:::')
      this.$router.push('/login')
    },
    register(event) {
      console.log('register:::')
      let parameter = {
        username: this.username,
        email: this.email,
        password: this.password,
        config: CONFIG,
        account_type: this.type,
        referral_code: null,
        status: 'ADMIN'
      }
      $('#loading').css({'display': 'block'})
      this.APIRequest('accounts/create', parameter).then(response => {
        $('#loading').css({'display': 'none'})
        console.log('REGISTRATION RESPONSE: ', response)
        if(response.error !== null){
          if(response.error.status === 100){
            let message = response.error.message
            if(typeof message.username !== undefined && typeof message.username !== 'undefined'){
              this.errorMessage = message.username[0]
            }else if(typeof message.email !== undefined && typeof message.email !== 'undefined'){
              this.errorMessage = message.email[0]
            }
          }else if(response.data !== null){
            if(response.data > 0){
              this.login()
            }
          }
        }
      })
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
}
.SubQoute {
  text-align: center;
}
.QouteCard {
  width: 80% !important;
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
  background-color: transparent !important;
}
.QouteCardContainer {
  display: flex !important;
  justify-content: center !important;
  align-items: center !important;
  background-color: transparent !important;
}
.LoginCardContainer {
  background-color: transparent !important;
}

@media (max-width: 500px) {
  .RegisterCard {
    width: 100%;
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
}
</style>
