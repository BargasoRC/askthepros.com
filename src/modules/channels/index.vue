<template>
  <div class="holder">
    <h3 style="margin-top: 25px;font-size: 25px;">Social Media Integration</h3>
    <p class="subheads">Connect to your social media channels, then setup your branding and choose your automation.</p>

    <div style="margin-top: 3%">
        <roundedBtn
          :text="'Social Media Channels'"
          class="button"
          :styles="{
            backgroundColor: colors.darkPrimary,
            color: 'white',
            outlineColor: colors.darkPrimary,                
            width: '15%',
            borderTopRightRadius: '0px !important',
            borderBotttomLeftRadius: '0px !important',
          }"
          :onClick="() => {}"
        />
        <roundedBtn
          :text="'Branding'"
          class="button1"
          :styles="{
            backgroundColor: 'white',
            outlineColor: colors.darkPrimary,
            color: colors.darkPrimary,
            width: '15%',
            borderTopLeftRadius: '0px !important',
            borderBottomLeftRadius: '0px !important',
            borderTopRightRadius: '0px !important',
            borderBottomRightRadius: '0px !important',
            marginLeft: '-5px'
          }"
          :onClick="branding"
        />
        <roundedBtn
          :text="'Automation Settings'"
          class="button2"
          :styles="{
            backgroundColor: 'white',
            outlineColor: colors.darkPrimary,
            color: colors.darkPrimary,
            width: '15%',
            borderTopLeftRadius: '0px !important',
            borderBottomLeftRadius: '0px !important',
            marginLeft: '-5px'
          }"
          :onClick="automationSettings"
        />
    </div>
    <h3 style="margin-top: 20px;font-size: 20px;">Connect Your Social Media Channels.</h3>
    <p class="subheads">We will post the channels you connect.</p>
    <div class="row">
      <div class="column"  v-for="(item, index) in socialCards" :key="index">
        <div class="card">
          <h3 style="font-weight: bolder;font-size: 21px; color: #01009A;">{{item.title}}</h3>
          <p>{{item.description}}</p>
          <p v-if="!item.stat">Setup and link your account now!</p>
          <p v-if="item.stat">Your account has successfully <span style="color: #51DB78">CONNECTED</span>.</p>
          <roundedBtn v-if="!item.stat" :onClick="(event) => connect(item)" :text="'Connect'" :styles="{backgroundColor: '#01004E', color: 'white', height: '45px', width: '150px'}"/>
          <roundedBtn v-if="item.stat" :onClick="disconnect" :text="'Remove'" :styles="{backgroundColor: 'white', border: '1px solid #01004E', color: '#01004E', height: '45px', width: '150px'}"/>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import roundedBtn from 'src/modules/generic/roundedBtn'
import dialogueBtn from 'src/modules/generic/dialogueBtn'
import COLORS from 'src/assets/style/colors.js'
import ROUTER from 'src/router'
export default {
  data() {
    return {
      colors: COLORS,
      socialCards: [{
        index: 0,
        title: 'Google My Business',
        payload: 'google',
        description: 'Reap the benefits of automating your Google My Business postings.',
        stat: true
      }, {
        index: 1,
        title: 'Facebook',
        payload: 'facebook',
        description: 'Reap the benefits of automating your Facebook postings.',
        stat: false
      }, {
        index: 2,
        title: 'Linkedin',
        payload: 'linkedin',
        description: 'Reap the benefits of automating your Linkedin postings.',
        stat: false
      }]
    }
  },
  components: {
    roundedBtn
  },
  created() {
    this.connectCallback()
  },
  methods: {
    branding(e) {
      this.$router.push('/user/channels/branding')
    },
    automationSettings(e) {
      this.$router.push('/user/channels/automation')
    },
    connect(item) {
      if(item.payload === 'google') {
        this.connectToGmail()
      }else if(item.payload === 'facebook') {
        this.connectToFb()
      }else if(item.payload === 'linkedin') {
        this.connectToLinkedIn()
      }
    },
    disconnect(e) {},
    connectToGmail() {
      console.log('gmail login:::')
      $('#loading').css({'display': 'block'})
      localStorage.setItem('connect_with', 'google')
      this.APIRequest('social_lite/authenticate/google_connect/redirect', {}, response => {
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
    connectToFb() {
      $('#loading').css({'display': 'block'})
      console.log('facebook login:::')
      localStorage.setItem('connect_with', 'facebook')
      this.APIRequest('social_lite/authenticate/facebook_connect/redirect', {}, response => {
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
    connectToLinkedIn() {
      $('#loading').css({'display': 'block'})
      console.log('linkedin login:::')
      localStorage.setItem('connect_with', 'linkedin')
      this.APIRequest('social_lite/authenticate/linkedin_connect/redirect', {}, response => {
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
    connectCallback() {
      if(new RegExp(/\?.+=.*/g).test(window.location.href) && localStorage.getItem('connect_with')) {
        let url = window.location.href
        let query = url.substring(url.indexOf('?') + 1)
        $('#loading').css({'display': 'block'})
        this.APIRequest(`social_lite/account/${localStorage.getItem('connect_with')}/connect?` + query, {}, response => {
          $('#loading').css({'display': 'none'})
          console.log('connect response: ', response)
          localStorage.removeItem('connect_with')
          this.$router.push(`/${this.user.type.toLowerCase()}/dashboard`)
        }, error => {
          $('#loading').css({'display': 'none'})
          this.$router.push(`/${this.user.type.toLowerCase()}/dashboard`)
          localStorage.removeItem('connect_with')
          console.log('Verifying authentication error! ', error)
        })
      }
    }
  }
}
</script>

<style scoped lang="scss" scoped>
@import "~assets/style/colors.scss";
.holder{
  width: 96%;
  margin-left: 2%;
  margin-right: 2%;
  margin-bottom: 20vh;
  float: left;
  color: $title;
  min-height: 100vh;
}
.button{
  border-bottom-right-radius: 0px !important;
}
.button1, .button2{
  color: $primary !important;
  border: 1px solid $primary !important;
}
h3{
  font-weight: bold;
}

* {
  box-sizing: border-box;
}

.column {
  float: left;
  width: 28%;
  padding: 20px;
}

.row {margin: 0 -5px;}

.row:after {
  content: "";
  display: table;
  clear: both;
}
.subheads{
  color: $text;
}

@media screen and (max-width: 600px) {
  .column {
    width: 100%;
    display: block;
    margin-bottom: 20px;
  }
}

.card {
  border: 0.25px solid grey;
  padding: 25px;
  color: $text;
  border-radius: 5px;
}

.card p{
  padding-top: 10px;
}
</style>
