<template>
  <div class="container-fluid">
    <h3>Thank You!</h3>
    <p style="margin-top: 25px;"><b class="text-success">Congratulations!</b></p>
    <p>
      You have successfully subscribed to Managed Social Media Posting. You can now connect to your social media accounts and enjoy the benefits to automated social media posting.
    </p>

    <roundedBtn
      :onClick="(e) => redirect('/dashboard')"
      :text="'Go to Dashboard'"
      :styles="{
        backgroundColor: colors.primary,
        border: '1px solid #01004E',
        color: '#fff',
        height: '45px',
        width: '200px'
      }"/>
  </div>
</template>

<script>
import AUTH from 'src/services/auth'
import ROUTER from 'src/router'
import Colors from 'src/assets/style/colors.js'
import roundedBtn from 'src/modules/generic/roundedBtn'
export default {
  mounted(){
    // AUTH.checkAuthentication()
  },
  data() {
    return {
      user: AUTH.user,
      colors: Colors
    }
  },
  components: {
    roundedBtn
  },
  methods: {
    redirect(route) {
      ROUTER.push(route)
    }
  }
}
</script>

<style lang="scss" scoped>
@import "~assets/style/colors.scss";
.container-fluid{
  min-height: 70vh;
  margin-top: 25px;
}
</style>
