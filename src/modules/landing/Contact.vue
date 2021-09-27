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
          <img :src="require('assets/img/section3-img.png')" alt="Image" style="width: 60%;height:auto">
        </div>
      </div>
      <div class="col-sm-5 col-md-5 col-lg-5 col-xl-5 col-xs-5 d-flex justify-content-center LoginCardContainer mb-5">
        <div class="card LoginCard">
          <div class="card-body LoginCardBody">
            <div class="d-flex justify-content-center pt-5 pb-2 mb-3">
              <b>Contact Us</b>
            </div>
            <div class="d-flex justify-content-center pb-2 mb-3" style="margin-top: -10px">
              <p>We would love to hear from you!</p>
            </div>
            <div>
              <!-- Name -->
              <p class="mt-2"><b>Name</b></p>
              <p
                class="mb-0 pb-0 requiredFieldError"
                v-if="this.name == '' && isValid === false"
              >{{
                'Required Field'
              }}</p>
              <input type="text" class="inputField" :style="{border: isValid === false && this.name == ''? '1px solid red': ''}" v-model="name">
              <!-- Email -->
              <p class="mt-2"><b>Email</b></p>
              <p
                class="mb-0 pb-0 requiredFieldError"
                v-if="this.isValid == false && this.email == ''"
              >{{
                'Required Field' 
              }}</p>
              <p
                class="mb-0 pb-0 requiredFieldError"
                v-if="this.isValid == false && this.email != ''"
              >{{
                this.isEmailValid ? '' : 'Invalid Email'
              }}</p>
              <input type="email" class="inputField" :style="{border: isValid === false && this.email == ''? '1px solid red': ''}" v-model="email">
              <!-- Subject -->
              <p class="mt-2"><b>Subject</b></p>
              <p
                class="mb-0 pb-0 requiredFieldError"
                v-if="this.subject == '' && isValid === false"
              >{{
                'Required Field'
              }}</p>
              <input type="text" class="inputField" :style="{border: isValid === false && this.subject == ''? '1px solid red': '1px solid'}" v-model="subject">
              <!-- Content -->
              <p class="mt-2"><b>Content</b></p>
              <p
                class="mb-0 pb-0 requiredFieldError"
                v-if="this.content == '' && isValid === false"
              >{{
                'Required Field'
              }}</p>
              <textarea class="mt-2 textArea" name="" id="" cols="30" rows="10" :style="{border: isValid === false && this.content === ''? '1px solid red': ''}" v-model="content"></textarea>
            </div>
            
            <div class="col-sm-12 col-md-12 col-lg-12 d-flex justify-content-center mt-2">
              <dialogueBtn 
                :onClick="send"
                :icon="'fas fa-paper-plane'"
                :icon_position="'right'" 
                :text="'Send Message'"
                :styles="{
                  backgroundColor: '#01004E',
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
      name: '',
      email: '',
      subject: '',
      content: '',
      isValid: true, // made this as the controller to control whether the form gets passed. Gets passed as long as true
      isEmailValid: true
    }
  },
  components: {
    dialogueBtn,
    roundedInput,
    roundedBtn
  },
  created() {
  },
  methods: {
    validate() {
      let email = this.email
      if(email === ''){
        this.isValid = false
        return false
      }else if(!global.validateEmail(email)) {
        this.isValid = false
        this.isEmailValid = false
        return false
      }
      return true
    },
    send(event){
      if(this.validate() && this.name !== '' && this.subject !== '' && this.content !== ''){
        this.isValid = true
        this.isEmailValid = true
        let parameter = {
          name: this.name,
          email: this.email,
          subject: this.subject,
          content: this.content
        }
        $('#loading').css({'display': 'block'})
        this.APIRequest('emails/send_message', parameter).then(response => {
          $('#loading').css({'display': 'none'})
          if(response.data === true) {
            this.name = ''
            this.email = ''
            this.subject = ''
            this.content = ''
          }
        }).catch(error => {
          $('#loading').css({'display': 'none'})
          error
        })
      }else {
        this.isValid = false
        // Another method here
      }
    }
  }
}
</script>

<style lang="scss" scoped>
@import "~assets/style/colors.scss";
.requiredFieldError {
  color: $danger;
  font-size: 10px;
  margin-bottom: 10px !important;
}
.textArea {
  width:100%;
  border: 0.25px solid #84868B;
  box-sizing: border-box;
  border-radius: 5px;
}
.inputField {
  width: 100%;
  height: 45px;
  border: 0.25px solid #84868B;
  box-sizing: border-box;
  border-radius: 5px;
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
.RowContainer {
  background: white;
  padding-top: 15vh;

}
.QouteCardContainer {
  display: flex !important;
  justify-content: center !important;
  align-items: center !important;
  background: none;
  background: white;
}
.LoginContainer {
   min-height: 85vh;
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
  .QouteText {
  font-size: 35px;
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
  .QouteText {
  font-size: 35px;
  }
  .LoginCardContainer {
    -ms-flex: 0 0 100%;
    flex: 0 0 100%;
    max-width: 100%;
  }
    .QouteCard img {
    width: 100% !important;
  }
}
</style>
