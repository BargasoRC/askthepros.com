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
