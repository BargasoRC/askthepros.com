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
            :onClick="connect(item)"
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
                :onClick="item"
                :text="'View more'"
                :styles="{
                  backgroundColor: colors.darkPrimary,
                  color: 'white'
                }"
              />
            </div>
          </div>
          <div class="col-8 col-sm-6">
            <p id="pager" class="justify-content-end" style="margin-right: 65px; margin-bottom: 35px">Page To Review: {{forReviewTotal}} <i class="fas fa-arrow-right" id="arrowNext" v-on:click="next()"></i></p>
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
            :onClick="connect({
              payload: 'brand'
            })"
            :icon="'fas fa-cogs'"
            :text="'Connect'"
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
<script>
import dialogueBtn from 'src/modules/generic/dialogueBtn'
import roundedBtn from 'src/modules/generic/roundedBtn'
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
      colors: COLORS
    }
  },
  components: {
    dialogueBtn,
    roundedBtn
  },
  methods: {
    connect(item){
      // ROUTER.push('/' + item.payload)
    }
  }
}
</script>
