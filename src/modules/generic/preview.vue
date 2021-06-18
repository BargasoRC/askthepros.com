<template>
  <div class="holder">
    <div class="container row">
      <i class="fas fa-chevron-left col-4" style="color: white; margin-top: 1%;"></i>
      <p class="col-4" style="color: white; text-align: center; margin-top: 1%;">Facebook Preview</p>
      <i class="fas fa-chevron-right col-4" style="color: white; text-align: -webkit-right; margin-top: 1%;"></i>
    </div>
    <div class="card">

    </div>
  </div>
</template>

<script>
import AUTH from 'src/services/auth'
import roundedBtn from 'src/modules/generic/roundedBtn'
import Images from 'src/modules/generic/previewImage.vue'
import Toggle from 'src/modules/generic/toggleSwitch.vue'
import COLORS from 'src/assets/style/colors.js'
import CONFIG from 'src/config.js'
import roundedSelectBtn from 'src/modules/generic/roundedSelectBtn'
export default {
  mounted(){
  },
  data() {
    return {
      user: AUTH.user,
      colors: COLORS,
      config: CONFIG
    }
  },
  components: {
    Images,
    Toggle,
    roundedSelectBtn,
    roundedBtn
  },
  methods: {
  }
}
</script>

<style scoped lang="scss" scoped>
@import "~assets/style/colors.scss";
.holder{
  width: 96%;
  margin-left: 2%;
  margin-right: 2%;
}
.container{
  background-color: $darkPrimary;
  border-top-left-radius: 25%;
  border-top-right-radius: 25%;
  padding-top: 2%;
}
.card{
  background-color: black;
  border-color: black;
  padding: 10%;
  margin-left: -15px;
  margin-right: inherit;
  height: 75vh;
}
</style>
