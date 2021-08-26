<template>
  <div>
    <input 
      :type="type ? type : 'text'"
      :style="styles"
      :placeholder="placeholder"
      :class="'form-control roudedInput ' + classes"
      @input="onChange"
      v-on:keyup.enter="onEnter !== undefined ? enter(onEnter($event)).then((res) => {
        return res
      }): () => {}"
    />
    <span style="background: white;" class="input-group-addon password" v-if="visible">
      <i v-if="type == 'password'" @click="showPassword()" class="fa fa-eye" aria-hidden="true"></i>
      <i v-if="type == 'text'" @click="hidePassword()" class="fa fa-eye-slash" aria-hidden="true"></i>
    </span>
  </div>
</template>
<script>
export default {
  props: ['type', 'styles', 'placeholder', 'classes', 'onEnter', 'visible'],
  methods: {
    onChange(event) {
      this.$emit('input', event.target.value)
    },
    enter(event) {
      return new Promise((resolve, reject) => {
        resolve(event)
      })
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
