<template>
  <div class="content-holder">
    <login-header></login-header>
    <transition >
      <router-view ></router-view>
    </transition>
    <landing-footer></landing-footer>
  </div>
</template>
<script>
export default {
  components: {
    'login-header': () => import('modules/frame/Header2.vue'),
    'landing-footer': () => import('modules/frame/Footer2.vue')
  }
}
</script>
<style lang="scss" scoped>
@media (min-width: 1200px){
  .content-holder {
    width: 100% !important;
    margin: 0px !important;
    float: left;
  }
}
</style>
