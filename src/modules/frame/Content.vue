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
    'landing-footer': () => import('modules/frame/Footer.vue')
  }
}
</script>
<style scoped>
  .content-holder{
    width: 100%;
    min-height: 400px;
    float: left;
    overflow: hidden;
    background: linear-gradient(180deg, #fff 6.77%, rgba(255,255,255,0.782123) 19.79%, rgba(255,255,255,0.326451) 63.54%, rgba(255,255,255,0.535072) 76.04%, rgba(255,255,255,0.184593) 86.46%, rgba(255,255,255,0) 100%),url(/src/img/banner.jpg);
    background-repeat: no-repeat;
    background-size: cover;
  }/*-- content-holder --*/
</style>
