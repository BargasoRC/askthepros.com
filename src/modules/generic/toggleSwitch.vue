<template>
  <div>
    <label class="switch" :style="styles">
      <input type="checkbox" @input="onChange">
      <span class="slider round"></span>
    </label>
    <span style="margin-left: 20px">{{text}}</span>
  </div>
</template>
<script>
export default {
  props: ['onClick', 'styles', 'text'],
  data() {
    return {
      isOnClickPresent: false
    }
  },
  methods: {
    onChange(event) {
      this.$emit('input', event.target.checked)
    }
  }
}
</script>
<style lang="scss" scoped>
@import "~assets/style/colors.scss";
.switch {
  position: relative;
  display: inline-block;
  width: 40px;
  height: 20px;
  margin-left: 30px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 15px;
  width: 15px;
  left: 3px;
  right: 10px;
  bottom: 3px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: $darkPrimary;
}

input:focus + .slider {
  box-shadow: 0 0 1px $darkPrimary;
}

input:checked + .slider:before {
  -webkit-transform: translateX(20px);
  -ms-transform: translateX(20px);
  transform: translateX(20px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 20px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>
