<template>
  <div class="apps-footer">
    A product of <b class="text-primary action-link" @click="external(common.COMPANY_URL)">{{common.COMPANY}}</b>
  </div>
</template>
<style type="text/css">
.apps-footer {
  position: fixed;
  width:100%;
  height:30px;
  bottom: 0px;
  background: transparent;
  left: 10px;
  font-size: 12px;
  z-index: 10000;
}

@media (max-width: 991px){
  .apps-footer{
    display: none;
  }
}
</style>
<script>
import COMMON from 'src/common.js'
export default {
  data(){
    return {
      common: COMMON
    }
  },
  methods: {
    external(url){
      window.open(url, '_BLANK')
    }
  }
}
</script>
