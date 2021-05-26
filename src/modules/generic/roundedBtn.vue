<template>
  <button 
    class="btn dialogueBTN"
    :style="styles"
    @click="onClick"
  >
    {{text}} 
    <i 
      :class="icon"
      style="margin-left: 20px;"
    ></i>
  </button>
</template>
<script>
export default {
  props: ['onClick', 'icon', 'text', 'styles']
}
</script>
<style lang="scss" scoped>
@import "~assets/style/colors.scss";
.dialogueBTN{
  outline: none !important;
  box-shadow: none !important;
  border: 0px;
  border-radius: 40px;
  font-weight: 500;
  height: 45px;
  padding-left: 20px;
  padding-right: 20px;
  min-width: 150px;
}
</style>
