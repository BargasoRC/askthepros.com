<template>
  <div class="holder">
    <h3 style="margin-top: 25px;font-weight: bold;color: #272727;font-size: 21px;">Welcome to Dashboard!</h3>
    <p class="subwelcome">Here are the latest update of activities as of today.</p>

    <div class="row">
      <div class="col-md-4 mt-2">
        <div class="card" v-if="cards !== null && cards.google === false">
          <div class="card-body">
            <h5 class="card-title">{{socialMediaBtns[0].title}}</h5>
            <p class="card-text" v-html="socialMediaBtns[0].description"></p>
            <dialogueBtn 
              :onClick="(event) => connect(socialMediaBtns[0])"
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

      <div class="col-md-4 mt-2">
        <div class="card" v-if="cards !== null && cards.facebook === false">
          <div class="card-body">
            <h5 class="card-title">{{socialMediaBtns[1].title}}</h5>
            <p class="card-text" v-html="socialMediaBtns[1].description"></p>
            <dialogueBtn 
              :onClick="(event) => connect(socialMediaBtns[1])"
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

      <div class="col-md-4 mt-2">
        <div class="card" v-if="cards !== null && cards.linkedin === false">
          <div class="card-body">
            <h5 class="card-title">{{socialMediaBtns[2].title}}</h5>
            <p class="card-text" v-html="socialMediaBtns[2].description"></p>
            <dialogueBtn 
              :onClick="(event) => connect(socialMediaBtns[2])"
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
    <div class="row" style="margin-top: 25px; margin-bottom: 3%">
      <div class="col-md-12 col-lg-8 col-sm-12">
        <div class="card" style="border-color: light-grey; padding-bottom: 1%; margin-top: 25px;">
          <h3 class="mb-4" style="margin-top: 2%; margin-left: 1%">Latest Posts</h3>
          <table class="table table-striped table-bordered">
            <thead>
              <th v-for="(item, index) in tableHeaders" :key="index">{{item.title}}</th>
            </thead>
            <tbody>
              <tr v-for="(item, index) in tableData" :key="index">
                <td>{{item.post[0] != null ? item.post[0].title : null}}</td>
                <td>{{item.post[0] != null ? displayArray(item.post[0].channels) : null}}</td>
                <td>{{item.link != null ? item.link : null}}</td>
                <td class="text-warning" v-if="item.status === 'review'">Posted - Reviewed by You</td>
                <td class='text-primary' v-else>Posted Automatically</td>
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
      <div class="col-md-4 col-sm-12 mb-5" v-if="cards !== null && cards.brand === false">
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
  mounted(){
    this.retrieveCards()
  },
  data() {
    return {
      tableHeaders: [
        {title: 'Post Title'},
        {title: 'Channel Posted To'},
        {title: 'Links'},
        {title: 'Status'}
      ],
      tableData: [],
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
      user: AUTH.user,
      limit: 5,
      offset: 0,
      numPages: null,
      activePage: 1,
      sort: null,
      filter: null,
      cards: null
    }
  },
  components: {
    dialogueBtn,
    roundedBtn
  },
  created() {
    this.retrieveHistoryPosts({created_at: 'desc'}, {column: 'created_at', value: ''})
  },
  methods: {
    displayArray(channels){
      if(channels){
        let parsedChannels = JSON.parse(channels)
        let response = ''
        for (var i = 0; i < parsedChannels.length; i++) {
          let item = parsedChannels[i]
          if(i > 0){
            response += ', ' + item
          }else{
            response = item
          }
        }
        return response
      }else{
        return null
      }
    },
    retrieveCards(){
      let parameter = {
        account_id: this.user.userID
      }
      this.APIRequest('dashboards/retrieve_by_user', parameter).then(response => {
        if(response.data){
          this.cards = response.data.cards
        }else{
          this.cards = null
        }
      })
    },
    retrieveHistoryPosts(sort, filter){
      if(sort !== null){
        this.sort = sort
      }
      if(filter !== null){
        this.filter = filter
      }
      if(sort === null && this.sort !== null){
        sort = this.sort
      }
      if(filter === null && this.filter !== null){
        filter = this.filter
      }
      let parameter = {
        condition: [{
          column: filter.column,
          value: filter.value + '%',
          clause: 'like'
        }],
        sort: sort,
        status: 'posted',
        limit: 5,
        account_id: this.user.userID,
        offset: 0
      }
      $('#loading').css({'display': 'block'})
      this.APIRequest('post/retrieve_history', parameter).then(response => {
        $('#loading').css({'display': 'none'})
        console.log('RESPONSE: ', response)
        if(response.data.length > 0){
          this.tableData = response.data
        }else{
          this.tableData = []
        }
      })
    },
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
  min-height: 75vh;
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
