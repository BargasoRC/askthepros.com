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
      <div class="col-xs-12 col-sm-6 col-md-4 mt-3"  v-for="(item, index) in socialCards" :key="index">
        <div class="card">
          <h3 style="font-weight: bolder;font-size: 21px; color: #01009A;" v-if="item.details === null || (item.details && item.details.page === null)">{{item.title}}</h3>
          <h3 style="font-weight: bolder;font-size: 21px; color: #01009A;" v-if="item.details && item.details.page !== null">
            <i :class="'fa fa-' + item.details.page.type"></i>
            <img :src="item.details.page.details.image" class="page-image-holder">
            {{item.details.page.type === 'google' ? item.details.page.details.locationName : item.details.page.details.name}}
          </h3>
          <p>{{item.description}}</p>
          <p v-if="!item.stat">Setup and link your account now!</p>
          <p v-if="item.stat">Your account has successfully <span style="color: #51DB78">CONNECTED</span>.</p>
          <roundedBtn
            v-if="!item.stat"
            :onClick="(event) => connect(item)"
            :text="'Connect'"
            :styles="{
              backgroundColor: '#01004E',
              color: 'white',
              height: '45px',
              width: '150px'
            }"/>

          <roundedBtn
              v-if="item.stat"
              :onClick="(e) => viewAndAddPages(item)"
              :text="'Add or Remove Pages'"
              :styles="{
                backgroundColor: 'white',
                border: '1px solid #01004E',
                color: '#01004E',
                height: '45px',
                width: '200px'
              }"/>
        </div>
      </div>
    </div>
    <div class="modal" tabindex="-1" role="dialog" ref="modal">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Select Page</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <ul v-if="data && data.length > 0" class="pages-holder">
              <li v-for="(item, index) in data" @click="selectedPage = item" :class="{'active': selectedPage && selectedPage.id === item.id}">
                <img :src="item.image" class="page-image-holder">
                {{page_type === 'google' ? item.locationName : item.name}}
              </li>
            </ul>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal" @click="activePayload = null">Close</button>
            <button type="button" class="btn btn-primary" v-if="selectedPage !== null && activePayload && activePayload.details && (activePayload.details.page === null || activePayload.details.page.page !== selectedPage.id) && activePayload.details.page.page !== selectedPage.name" @click="addPage()">Manage this page</button>
            <button type="button" class="btn btn-danger" v-if="selectedPage !== null && activePayload && activePayload.details && activePayload.details.page !== null && (activePayload.details.page.page === selectedPage.id || activePayload.details.page.page === selectedPage.name)" @click="removePage(activePayload.details.page.id)">Remove this page</button>
          </div>
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
import AUTH from 'src/services/auth'
export default {
  data() {
    return {
      colors: COLORS,
      socialCards: [{
        index: 0,
        title: 'Google My Business',
        payload: 'google',
        description: 'Reap the benefits of automating your Google My Business postings.',
        stat: false,
        details: null
      }, {
        index: 1,
        title: 'Facebook',
        payload: 'facebook',
        description: 'Reap the benefits of automating your Facebook postings.',
        stat: false,
        details: null
      }, {
        index: 2,
        title: 'Linkedin',
        payload: 'linkedin',
        description: 'Reap the benefits of automating your Linkedin postings.',
        stat: false,
        details: null
      }],
      user: AUTH.user,
      socialAuths: [],
      page_type: '',
      data: [],
      selectedPage: null,
      activePayload: null
    }
  },
  components: {
    roundedBtn
  },
  created() {
    this.retrieveSocialAuths()
  },
  methods: {
    retrieveSocialAuths() {
      let condition = {
        condition: [
          {
            value: this.user.userID,
            clause: '=',
            column: 'account_id'
          }
        ],
        offset: 0,
        limit: 3
      }
      $('#loading').css({'display': 'block'})
      this.APIRequest('social_auths/retrieve', condition).then(response => {
        $('#loading').css({'display': 'none'})
        if(response.data){
          this.socialAuths = response.data
          response.data.forEach((el, ndx) => {
            let index = this.socialCards.findIndex(le => le.payload.toLowerCase() === el.type.toLowerCase())
            if(index >= 0) {
              this.socialCards[index].stat = true
              this.socialCards[index].details = el
            }
          })
        }
      }).catch(error => {
        error
        $('#loading').css({'display': 'none'})
      })
    },
    branding(e) {
      this.$router.push('/channels/branding')
    },
    automationSettings(e) {
      this.$router.push('/channels/automation')
    },
    connect(item) {
      $('#loading').css({'display': 'block'})
      let condition = {
        condition: [
          {
            value: this.user.userID,
            clause: '=',
            column: 'account_id'
          },
          {
            value: null,
            clause: '!=',
            column: 'end_date'
          }
        ],
        offset: 0,
        limit: 3
      }
      this.APIRequest('plans/retrieve', condition, response => {
        $('#loading').css({'display': 'none'})
        console.log('response.data', response)
        if(response.data.length > 0) {
          if(item.payload === 'google') {
            this.connectToGmail(item.payload)
          }else if(item.payload === 'facebook') {
            this.connectToFb(item.payload)
          }else if(item.payload === 'linkedin') {
            this.connectToLinkedIn(item.payload)
          }
        }else {
          this.$router.push('/subscriptions')
        }
      }, error => {
        error
        $('#loading').css({'display': 'none'})
      })
    },
    addPage(){
      console.log(this.activePayload.payload, this.selectedPage)
      if(this.selectedPage === null){
        return null
      }
      let parameter = {
        account_id: this.user.userID,
        type: this.activePayload.payload,
        page: this.page_type === 'google' ? this.selectedPage.name : this.selectedPage.id,
        details: JSON.stringify(this.selectedPage)
      }
      $('#loading').css({'display': 'block'})
      this.APIRequest('pages/create', parameter, response => {
        $('#loading').css({'display': 'none'})
        this.retrieveSocialAuths()
      }, error => {
        error
        $('#loading').css({'display': 'none'})
      })
    },
    viewAndAddPages(provider){
      this.activePayload = provider
      if(provider.payload === 'linkedin') {
        this.page_type = 'linkedin'
        let parameter = {
          account_id: this.user.userID
        }
        $('#loading').css({'display': 'block'})
        this.APIRequest('social/retrieve_linkedin_pages', parameter, response => {
          // console.log('LINKEDIN PAGES: ', response)
          $('#loading').css({'display': 'none'})
          this.data = response.data
          let element = this.$refs.modal
          $(element).modal('show')
        }, error => {
          error
          $('#loading').css({'display': 'none'})
        })
      }else if(provider.payload === 'facebook') {
        this.page_type = 'facebook'
        let parameter = {
          account_id: this.user.userID
        }
        $('#loading').css({'display': 'block'})
        this.APIRequest('social/retrieve_fb_pages', parameter, response => {
          console.log('FACEBOOK PAGES: ', response)
          $('#loading').css({'display': 'none'})
          this.data = response.data
          let element = this.$refs.modal
          $(element).modal('show')
        }, error => {
          error
          $('#loading').css({'display': 'none'})
        })
      }else if(provider.payload === 'google') {
        this.page_type = 'google'
        let parameter = {
          account_id: this.user.userID
        }
        $('#loading').css({'display': 'block'})
        this.APIRequest('social/retrive_businesses', parameter, response => {
          console.log('Businesses: ', response)
          $('#loading').css({'display': 'none'})
          this.data = response.data.locations.map((el, ndx) => {
            el['id'] = ndx + 1
            return el
          })
          let element = this.$refs.modal
          $(element).modal('show')
        }, error => {
          error
          $('#loading').css({'display': 'none'})
        })
      }
    },
    removePage(id){
      if(id === null){
        return null
      }
      let parameter = {
        id: id
      }
      $('#loading').css({'display': 'block'})
      this.APIRequest('pages/delete', parameter, response => {
        $('#loading').css({'display': 'none'})
        this.retrieveSocialAuths()
      }, error => {
        error
        $('#loading').css({'display': 'none'})
      })
    },
    disconnect(item) {
      let index = this.socialAuths.findIndex(le => le.type.toLowerCase() === item.payload.toLowerCase())
      let parameter = {
        id: this.socialAuths[index].id
      }
      $('#loading').css({'display': 'block'})
      this.APIRequest('social_auths/delete', parameter).then(response => {
        $('#loading').css({'display': 'none'})
        let index = this.socialCards.findIndex(le => le.payload.toLowerCase() === item.payload.toLowerCase())
        this.socialCards[index].stat = false
      }).catch(error => {
        error
        $('#loading').css({'display': 'none'})
      })
    },
    connectToGmail(payload) {
      console.log('gmail login:::')
      $('#loading').css({'display': 'block'})
      localStorage.setItem('connect_with', payload)
      this.APIRequest(`social_lite/authenticate/${payload}/redirect`, {}, response => {
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
    connectToFb(payload) {
      $('#loading').css({'display': 'block'})
      console.log('facebook login:::')
      localStorage.setItem('connect_with', payload)
      this.APIRequest(`social_lite/authenticate/${payload}/redirect`, {}, response => {
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
    connectToLinkedIn(payload) {
      $('#loading').css({'display': 'block'})
      console.log('linkedin login:::')
      localStorage.setItem('connect_with', payload)
      this.APIRequest(`social_lite/authenticate/${payload}/redirect`, {}, response => {
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


.pages-holder{
  width: 100%;
  float: left;
  padding: 0;
  margin: 0;
  list-style: none;
}

.pages-holder li{
  line-height: 60px;
  padding-left: 20px;
}

.modal-body{
  padding: 0px !important;
}

.page-image-holder{
  height: 40px;
  width: 40px;
  border-radius: 20px;
  margin-right: 10px;
}
.pages-holder li:hover{
  background-color: $gray;
  cursor: pointer;
}

.active{
  background: $primary;
  color: #ffffff;
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
