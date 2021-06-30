<template>
  <div class="holder">
    <h3 style="margin-top: 25px;font-weight: bold;color: #272727;font-size: 21px;">Welcome to Dashboard!</h3>
    <p class="subwelcome">Here are the latest update of activities as of today.</p>

    <div class="row" style="justify-content: space-between; display: flex;">
      <div class="card col-lg-3" v-for="(item, index) in socialMediaBtns" :key="index">
        <div class="card-body">
          <h5 class="card-title">{{item.title}}</h5>
          <p class="card-text" v-html="item.description"></p>
          <dialogueBtn 
            :onClick="(event) => connect(item)"
            :icon="'fas fa-cogs'"
            :icon_position="'right'"
            :text="'Connect'"
            :styles="{
              backgroundColor: colors.darkPrimary,
              color: 'white'
            }"
          />
        </div>
      </div>
    </div>

    <div class="row justify-content-between latestPost" style="margin-top: 25px;">
      <div class="card col-lg-8" style="border-color: light-grey; width: 25%; padding-bottom: 1%; margin-top: 25px;">
        <h3 id="Tlabel">Latest Posts</h3>
        <table class="table col-lg-11">
          <thead>
            <tr>
              <th scope="col">Title</th>
              <th scope="col">Channels</th>
              <th scope="col">Links</th>
              <th scope="col">Status</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">Test</th>
              <td>Test</td>
              <td>Test</td>
              <td>Test</td>
            </tr>
            <tr>
              <th scope="row">Test</th>
              <td>Test</td>
              <td>Test</td>
              <td>Test</td>
            </tr>
            <tr>
              <th scope="row">Test</th>
              <td>Test</td>
              <td>Test</td>
              <td>Test</td>
            </tr>
            <tr>
              <th scope="row">Test</th>
              <td>Test</td>
              <td>Test</td>
              <td>Test</td>
            </tr>
          </tbody>
        </table>
        <div class="row">
          <div class="col-8 col-sm-6">
            <div class="justify-content-start" style="margin-top: 25px">
              <roundedBtn 
                :onClick="viewMore"
                :text="'View more'"
                :styles="{
                  backgroundColor: colors.darkPrimary,
                  color: 'white'
                }"
              />
            </div>
          </div>
          <div class="col-8 col-sm-6">
            <p id="pager" class="justify-content-end" style="margin-right: 65px; margin-bottom: 35px">Page To Review: {{forReviewTotal}} <i class="fas fa-arrow-right" id="arrowNext" v-on:click="preview()"></i></p>
          </div>
        </div>
      </div>
      <div class="card col-lg-3"  style="margin-top: 25px; height: 200px;">
        <div class="card-body">
          <h5 class="card-title">Setup Your Brand</h5>
          <p class="card-text">
            Build your brand by adding branding footers at the end of your social media post.
            <br>
            <br>
            Setup your branding now!
          </p>
          <dialogueBtn 
            :onClick="setup"
            :icon="'fas fa-cogs'"
            :text="'Setup'"
            :icon_position="'right'"
            :styles="{
              backgroundColor: colors.darkPrimary,
              color: 'white'
            }"
          />
        </div>
      </div>
    </div>
    
  </div>
</template>
<script>
import dialogueBtn from 'src/modules/generic/dialogueBtn'
import roundedBtn from 'src/modules/generic/roundedBtn'
import AUTH from 'src/services/auth'
import COLORS from 'src/assets/style/colors.js'
import ROUTER from 'src/router'
export default {
  data() {
    return {
      socialMediaBtns: [{
        title: 'Google My Business',
        payload: 'google',
        description: 'Reap the benefits of automating your Google My Business postings. <br /><br />Setup and link your account now!'
      }, {
        title: 'Facebook',
        payload: 'facebook',
        description: 'Reap the benefits of automating your Google My Business postings. <br /><br />Setup and link your account now!'
      }, {
        title: 'Linkedin',
        payload: 'linkedin',
        description: 'Reap the benefits of automating your Google My Business postings. <br /><br />Setup and link your account now!'
      }],
      colors: COLORS,
      forReviewTotal: '',
      user: AUTH.user
    }
  },
  components: {
    dialogueBtn,
    roundedBtn
  },
  created() {
    this.connectCallback()
  },
  methods: {
    setup(){
      ROUTER.push('channels/branding')
    },
    viewMore() {
      this.$router.push(`/${this.user.type.toLowerCase()}/post_management`)
    },
    preview() {
      this.$router.push(`/${this.user.type.toLowerCase()}/post_management`)
    },
    connect(item){
      if(item.payload === 'google') {
        this.connectToGmail()
      }else if(item.payload === 'facebook') {
        this.connectToFb()
      }else if(item.payload === 'linkedin') {
        this.connectToLinkedIn()
      }
    },
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
  float: left;
}
.card-text, .subwelcome{
  color: $text;
}
.card-title{
  color: $primary;
  font-weight: 800;
}
#Tlabel{
  margin-bottom: 15px;
  margin-top: 15px;
  font-weight: 800;
  font-size: 20px;
}
#pager {
  font-weight: bold;
  float: right;
  color: $title;
  margin-top: 5vh;
}
#arrowNext{
  color: $darkPrimary;
  padding: 7px
}
</style>
