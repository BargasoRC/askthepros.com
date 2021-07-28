<template>
  <div class="holder">
    <h3 style="margin-top: 25px;font-weight: bold;color: #272727;font-size: 21px;">Welcome to Dashboard!</h3>
    <p class="subwelcome">Here are the latest update of activities as of today.</p>

    <div class="row">
      <div class="col-md-4 mt-2" v-for="(item, index) in socialMediaBtns" :key="index">
        <div class="card">
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
    </div>

    <div class="row" style="margin-top: 25px;">
      <div class="col-md-12 col-lg-8 col-sm-12">
        <div class="card" style="border-color: light-grey; padding-bottom: 1%; margin-top: 25px;">
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
          <div class="row justify-content-between">
            <div class="col-md-6 col-sm-6 col-xs-6">
              <div class="col-sm-12">
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
            <div class="col-md-6 col-sm-6 col-xs-6 d-flex justify-content-end">
              <p id="pager" class="mb-3 pl-3 mt-3 pr-3">Page To Review: {{forReviewTotal}} <i class="fas fa-arrow-right" id="arrowNext" v-on:click="preview()"></i></p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4 col-sm-12 mb-5">
        <div class="card"  style="margin-top: 25px; height: 200px;">
          <div class="card-body pb-3">
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
    <div class="modal fade" id="subscriptionModal" tabindex="-1" role="dialog" aria-labelledby="subscriptionModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header subscriptionModalHeader">
            <h5 
              class="modal-title text-warning text-center" 
              id="subscriptionModalLabel"
              :style="{
                textAlign: 'center',
                position: 'fixed',
                left: '50%',
                transform: 'translate(-50%) !important'
              }"
            >
              Welcome
            </h5>
            <button 
              type="button" 
              class="close" 
              data-dismiss="modal" 
              aria-label="Close"
              :style="{
                position: 'absolute',
                right: 0,
                top: 0,
                marginTop: '6px',
                marginRight: '10px'
              }"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body text-center">
            <p> Reap the benefits of automating your social media channels postings. </p>
            <b>SUBSCRIBE TO MANAGE YOUR SOCIAL POSTING</b>
          </div>
          <div class="modal-footer d-flex justify-content-center subscriptionModalFooter">
             <roundedBtn
                data-dismiss="modal" 
                :onClick="subscribe"
                :text="'Subscribe'"
                :icon_position="'right'"
                :icon="'far fa-thumbs-up'"
                :styles="{
                  backgroundColor: colors.darkPrimary,
                  color: 'white'
                }"
              />
          </div>
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
  methods: {
    setup(){
      ROUTER.push('channels/branding')
    },
    viewMore() {
      this.$router.push(`/post_management/history`)
    },
    preview() {
      this.$router.push(`/post_management`)
    },
    connect(item){
      let parameter = {
        condition: [
          {
            value: this.user.userID,
            clause: '=',
            column: 'account_id'
          }
        ],
        offset: 0,
        limit: 1
      }
      $('#loading').css({'display': 'block'})
      this.APIRequest('plans/retrieve', parameter).then(response => {
        $('#loading').css({'display': 'none'})
        console.log('Brandings response: ', response)
        if(response.data.length === 0) {
          $('#subscriptionModal').modal('show')
        }
      }).catch(error => {
        $('#loading').css({'display': 'none'})
        error
      })
    },
    subscribe() {
      this.$router.push(`/subscriptions`)
    }
  }
}
</script>

<style scoped lang="scss" scoped>
@import "~assets/style/colors.scss";
.subscriptionModalHeader {
  min-height: 80px;
  border-bottom: 0px;
}
.subscriptionModalFooter {
  min-height: 80px;
  border-top: 0px;
}
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
  margin-left: 15px;
}
// #pager {
//   font-weight: bold;
//   float: right;
//   color: $title;
//   margin-top: 5vh;
// }
#arrowNext{
  color: $darkPrimary;
  padding: 7px
}
</style>
