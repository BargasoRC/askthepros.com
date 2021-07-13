<template>
  <div class="holder">
    <h3 style="margin-top: 25px;font-size: 25px;">Social Media Integration</h3>
    <p class="subheads">Connect to your social media channels, then setup your branding and choose your automation.</p>

    <div style="margin-top: 3%">
        <roundedBtn
            :onClick="connectMedia"
            :text="'Social Media Channels'"
            class="button"
            :styles="{
                backgroundColor: 'white',
                outlineColor: colors.darkPrimary,
                color: 'white',
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
                outlineColor: colors.darkPrimary,
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
            :text="'Automation Settings'"
            class="button2"
            :styles="{
                backgroundColor: colors.darkPrimary,
                color: 'white',
                outlineColor: colors.darkPrimary,  
                width: '15%',
                borderTopLeftRadius: '0px !important',
                borderBottomLeftRadius: '0px !important',
                marginLeft: '-5px'
            }"
            :onClick="() => {}"
        />
    </div>
    <h3 style="margin-top: 20px;font-size: 20px;">Choose Review Settings.</h3>
    <p class="subheads">You can review and edit your posts prior to us sending them to your social media channels.</p>
    <div style="margin-left: 2%;margin-top: 2%">
      <input type="radio" id="review" name="automation" value="review" @click="automate('OFF')" :checked="selected=='review'">
      <label for="review">Review</label>
      <p class="desc">Review – We’ll email you a link to your post so you can edit or approve it.</p><br>
      <input type="radio" id="autopost" name="automation" value="autopost" @click="automate('ON')" :checked="selected=='autopost'">
      <label for="autopost">Autopost</label>
      <p class="desc">Autopost – We’ll automatically send your post to your connected channels.</p>
    </div>
    <p class="subheads" style="margin-top: 2%">You may update this setting as often as you like.</p>
    <p class="updateMessage" style="margin-top: 2%; color:#51DB78" v-if="updateMessage != ''">{{updateMessage}}</p>
    <roundedBtn
      :class="'btnn'"
      :onClick="update"
      :text="'Update'"
      :styles="{
        backgroundColor: '#01004E',
        color: 'white',
      }"
    /> 
  </div>
</template>

<script>
import roundedBtn from 'src/modules/generic/roundedBtn'
import COLORS from 'src/assets/style/colors.js'
import ROUTER from 'src/router'
import AUTH from 'src/services/auth'
import $ from 'jquery'
export default {
  data() {
    return {
      user: AUTH.user,
      id: null,
      colors: COLORS,
      selected: '',
      status: '',
      updateMessage: ''
    }
  },
  mounted(){
    this.retrieve()
  },
  components: {
    roundedBtn
  },
  methods: {
    connectMedia(){
      ROUTER.push('/user/channels')
    },
    branding(){
      ROUTER.push('/user/channels/branding')
    },
    update(){
      let parameter = {
        id: this.id,
        payload_value: this.status
      }
      $('#loading').css({'display': 'block'})
      this.APIRequest('payloads/update', parameter).then(response => {
        this.retrieve()
        $('#loading').css({'display': 'none'})
        this.updateMessage = 'Automation settings successfully updated!'
      })
    },
    automate(data){
      this.status = data
      if(data === 'OFF'){
        this.selected = 'review'
      }else if(data === 'ON'){
        this.selected = 'autopost'
      }
    },
    create(){
      let payload = {
        account_id: this.user.userID,
        payload: 'automation_settings',
        payload_value: 'ON'
      }
      this.APIRequest('payloads/create', payload).then(response => {
        console.log('PAYLOAD CREATED: ', response)
        this.retrieve()
      })
    },
    retrieve(){
      let parameter = {
        condition: [{
          value: this.user.userID,
          clause: '=',
          column: 'account_id'
        }],
        offset: 0,
        limit: 1
      }
      $('#loading').css({'display': 'block'})
      this.APIRequest('payloads/retrieve', parameter).then(response => {
        $('#loading').css({'display': 'none'})
        if(response.data.length !== 0){
          this.id = response.data[0].id
          console.log('RESPONSE: ', response.data[0])
          this.status = response.data[0].payload_value
        }else {
          this.create()
        }
        this.automate(this.status)
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

.btnn {
  margin-top: 30px;
}

.button{
  border-bottom-right-radius: 0px !important;
}
.button1, .button{
  color: $primary !important;
  border: 1px solid $primary !important;
}
h3, label{
  font-weight: bold;
}

label {
  font-size: 15px;
  margin-left: 1%;
}

.desc {
  color: $text;
  margin-left: 2%;
}
.subheads{
  color: $text;
}
</style>
