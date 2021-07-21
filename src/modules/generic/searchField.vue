<template>
  <div>
    <Multiselect style="width:100%" v-model="value" tag-placeholder="Add this as new tag" placeholder="Search or add a tag" label="industry" track-by="code" :options="options" :multiple="true" @click="returnCategory"></Multiselect>
  </div>
</template>

<script>
import $ from 'jquery'
import Multiselect from 'vue-multiselect'
export default {
  props: ['items', 'placeholder', 'styles', 'selectedIndex', 'dropdownItemStyles'],
  data() {
    return {
      selectedItem: null,
      value: [],
      options: [
        { industry: 'Manufacturing', code: 'Man' },
        { industry: 'Construction', code: 'Cons' },
        { industry: 'Finance', code: 'Fin' },
        { industry: 'Transport', code: 'Tra' },
        { industry: 'Agriculture', code: 'Agr' },
        { industry: 'Retail', code: 'Ret' },
        { industry: 'Technology', code: 'Tech' },
        { industry: 'Education', code: 'Edu' },
        { industry: 'Publishing', code: 'Pub' },
        { industry: 'Medicine', code: 'Med' }
      ]
    }
  },
  components: {
    Multiselect
  },
  updated() {
  },
  methods: {
    returnCategory(){
      this.$emit('onSelect', this.value)
    }
  }
}
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<style lang="scss" scoped>
@import "~assets/style/colors.scss";
.multiselect__tag{
  background-color: #01009A!important;
}
.inputField{
  outline: none !important;
  box-shadow: none !important;
  border: 0px;
  border-radius: 5px;
  font-weight: 500;
  height: 45px;
  padding-left: 20px;
  padding-right: 20px;
  min-width: 200px;
  width: 100%;
  display: flex;
  justify-content: space-between;
  align-items: center;
  border: 1px solid $gray !important;
}
</style>
