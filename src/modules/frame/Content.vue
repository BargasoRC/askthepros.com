<template>
  <div class="content-holder">
    <transition >
      <router-view ></router-view>
    </transition>
  </div>
</template>
<script>
export default {
  components: {
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
