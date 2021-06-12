<template>
  <div class="holder">
    <h3 style="margin-top: 25px;font-size: 25px;">Social Media Integration</h3>
    <p>Connect to your social media channels, then setup your branding and choose your automation.</p>

    <div style="margin-top: 3%">
        <roundedBtn
            :onClick="connectMedia"
            :text="'Social Media Channels'"
            class="button"
            :styles="{
                backgroundColor: 'white',
                outlineColor: colors.primary,
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
            :text="'Automation Settings'"
            class="button2"
            :styles="{
                backgroundColor: colors.primary,
                color: 'white',
                outlineColor: colors.primary,  
                width: '15%',
                borderTopLeftRadius: '0px !important',
                borderBottomLeftRadius: '0px !important',
                marginLeft: '-5px'
            }"
        />
    </div>
    <h3 style="margin-top: 20px;font-size: 20px;">Choose Review Settings.</h3>
    <p>You can review and edit your posts prior to us sending them to your social media channels.</p>
  </div>
</template>

<script>
import roundedBtn from 'src/modules/generic/roundedBtn'
import COLORS from 'src/assets/style/colors.js'
import ROUTER from 'src/router'
export default {
  data() {
    return {
      colors: COLORS
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
.button1, .button{
  color: $primary !important;
  border: 1px solid $primary !important;
}
h3{
  font-weight: bold;
}

</style>
