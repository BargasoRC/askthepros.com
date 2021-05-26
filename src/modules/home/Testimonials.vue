<template>
  <div id="testimonials" class="sectionn">
    <div class="container"></div>
  </div>
</template>

<script>
import ROUTER from 'src/router'
export default {
  methods: {
    redirect(parameter) {
      ROUTER.push(parameter)
    }
  }
}
</script>

<style scoped lang='scss'>
@import '~assets/style/colors.scss';
.sectionn {
  background-color: #01004E;
  min-height: 100vh;
  width: 100%;
}
</style>

