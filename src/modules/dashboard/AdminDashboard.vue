<template>
  <div class="holder">
    <h3 style="margin-top: 25px;font-weight: bold;color: #272727;font-size: 21px;">Welcome to Dashboard!</h3>
    <p>Here are the latest update of activities as of today.</p>

    <div class="row" style="justify-content: space-between; display: flex;">
      <div class="card col-lg-3" v-for="(item, index) in socialMediaBtns" :key="index">
        <div class="card-body">
          <h5 class="card-title">{{item.title}}</h5>
          <p class="card-text" v-html="item.description"></p>
          <dialogueBtn 
            :onClick="connect(item)"
            :icon="'fas fa-cog'"
            :text="'Connect'"
            :styles="{
              backgroundColor: colors.primary,
              color: 'white'
            }"
          />
        </div>
      </div>
    </div>

    <div class="row" style="margin-top: 25px">
      <div class="col-lg-9">
        <h3>Latest Posts</h3>
        <table class="table col-lg-11 table-bordered">
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
      </div>
      <div class="card col-lg-3"  style="margin-top: 25px;">
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
            :icon="'fas fa-cog'"
            :text="'Connect'"
            :styles="{
              backgroundColor: colors.primary,
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
</style>
<script>
import dialogueBtn from 'src/modules/generic/dialogueBtn'
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
    dialogueBtn
  },
  methods: {
    connect(item){
      // ROUTER.push('/' + item.payload)
    }
  }
}
</script>
