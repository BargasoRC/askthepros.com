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
      <input type="radio" id="review" name="automation" value="review">
      <label for="review">Review</label>
      <p class="desc">Review – We’ll email you a link to your post so you can edit or approve it.</p><br>
      <input type="radio" id="autopost" name="automation" value="autopost" checked>
      <label for="autopost">Autopost</label>
      <p class="desc">Autopost – We’ll automatically send your post to your connected channels.</p>
    </div>
    <p class="subheads" style="margin-top: 2%">You may update this setting as often as you like.</p>
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
export default {
  data() {
    return {
      colors: COLORS,
      selected: 'autopost'
    }
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
      console.log('save::::')
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
  margin-top: 40px;
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
