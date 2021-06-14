<template>
  <div class="holder">
    <h3 style="margin-top: 25px;font-size: 25px;">Social Media Integration</h3>
    <p>Connect to your social media channels, then setup your branding and choose your automation.</p>

    <div style="margin-top: 3%">
        <roundedBtn
            :text="'Social Media Channels'"
            class="button"
            :styles="{
                backgroundColor: colors.primary,
                color: 'white',
                outlineColor: colors.primary,                
                width: '15%',
                borderTopRightRadius: '0px !important',
                borderBotttomLeftRadius: '0px !important',
            }"
        />
        <roundedBtn
            :onClick="branding"
            :text="'Branding'"
            class="button1"
            :styles="{
                backgroundColor: 'white',
                outlineColor: colors.primary,
                color: 'white',
                width: '15%',
                borderTopLeftRadius: '0px !important',
                borderBottomLeftRadius: '0px !important',
                borderTopRightRadius: '0px !important',
                borderBottomRightRadius: '0px !important',
                marginLeft: '-5px'
            }"
        />
        <roundedBtn
            :onClick="automationSettings"
            :text="'Automation Settings'"
            class="button2"
            :styles="{
                backgroundColor: 'white',
                outlineColor: colors.primary,
                color: 'white',
                width: '15%',
                borderTopLeftRadius: '0px !important',
                borderBottomLeftRadius: '0px !important',
                marginLeft: '-5px'
            }"
        />
    </div>
    <h3 style="margin-top: 20px;font-size: 20px;">Connect Your Social Media Channels.</h3>
    <p>We will post the channels you connect.</p>
    <div class="row">
      <div class="column"  v-for="(item, index) in socialCards" :key="index">
        <div class="card">
          <h3 style="font-weight: bolder;font-size: 21px; color: #01009A;">{{item.title}}</h3>
          <p>{{item.description}}</p>
          <p v-if="!item.stat">Setup and link your account now!</p>
          <p v-if="item.stat">Your account has successfully <span style="color: #51DB78">CONNECTED</span>.</p>
          <roundedBtn v-if="!item.stat" :onClick="connect" :text="'Connect'" :styles="{backgroundColor: '#01004E', color: 'white', height: '45px', width: '150px'}"/>
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
        stat: false
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
  methods: {
    branding(){
      ROUTER.push('/user/channels/branding')
    },
    automationSettings(){
      ROUTER.push('/user/channels/automation')
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
