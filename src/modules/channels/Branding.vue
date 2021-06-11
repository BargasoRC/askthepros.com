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
            :text="'Branding'"
            class="button1"
            :styles="{
                backgroundColor: colors.primary,
                color: 'white',
                outlineColor: colors.primary,
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
    <h3 style="margin-top: 20px;font-size: 20px;">Add Branding.</h3>
    <p style="width: 45%">These “branding footers” will be added to the end of your social media posts.   They should be one or two short sentences and incorporate your brand name and location. </p>
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
.button, .button2{
  color: $primary !important;
  border: 1px solid $primary !important;
}
h3{
  font-weight: bold;
}

</style>
