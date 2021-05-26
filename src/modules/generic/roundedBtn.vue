<template>
  <button 
    class="btn dialogueBTN"
    :style="styles"
    @click="onClick"
  >
    <i 
      :class="icon"
      style="margin-right: 10px;"
      v-if="icon_position == 'left'"
    ></i>
    {{text}} 
    <i 
      :class="icon"
      style="margin-left: 20px;"
      v-if="!icon_position == 'left'"
    ></i>
  </button>
</template>
<script>
export default {
  props: ['onClick', 'icon', 'text', 'styles', 'icon_position']
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
