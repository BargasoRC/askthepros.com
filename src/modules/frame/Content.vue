<template>
  <div class="content-holder">
    <transition >
      <router-view ></router-view>
    </transition>
  </div>
</template>
<style scoped>
  .content-holder{
    width: 100%;
    min-height: 400px;
    float: left;
    overflow: hidden;
  }/*-- content-holder --*/
</style>
