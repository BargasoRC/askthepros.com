<template>
  <div class="container-fluid p-0">
    <div class="card preview_card">
      <div class="card-header preview_card_header d-flex justify-content-between text-white">
        <i class="fas fa-chevron-left mb-0 pb-0"></i>
        <p class="pb-0 mb-0">Facebook Preview</p>
        <i class="fas fa-chevron-right mb-0 pb-0"></i>
      </div>
      <div class="card-body preview_card_body">
      </div>
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
.preview_card_header {
  background-color: $darkPrimary;
  align-items: center;
  border-top-left-radius: 20px;
  border-top-right-radius: 20px;
  min-height: 45px;
}
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
.preview_card {
  border-top-left-radius: 20px;
  border-top-right-radius: 20px;
}
.preview_card_body {
  min-height: calc(100vh - 250px);
}
</style>
