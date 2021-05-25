<template>
  <input 
    :type="type ? type : 'text'"
    :style="styles"
    :placeholder="placeholder"
    :class="'form-control roudedInput ' + classes"
    @input="onChange"
  />
</template>
<script>
export default {
  props: ['type', 'styles', 'placeholder', 'classes'],
  methods: {
    onChange(event) {
      this.$emit('input', event.target.value)
    }
  }
}
</script>
<style lang="scss" scoped>
@import "~assets/style/colors.scss";
.roudedInput {
  outline: none !important;
  box-shadow: none !important;
  height: 45px !important;
  border-radius: 40px !important;
  border: 1px solid $gray !important;
}
</style>
