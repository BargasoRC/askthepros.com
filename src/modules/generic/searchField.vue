<template>
  <div>
    <Multiselect style="width:100%" v-model="value" tag-placeholder="Search Tag" :placeholder="placeholder" :searchable="false" :close-on-select="false" :clear-on-select="false" label="category" track-by="id" :options="items" :multiple="true" @input="returnCategory"></Multiselect>
  </div>
</template>

<script>
import Multiselect from 'vue-multiselect'
export default {
  props: ['items', 'placeholder', 'styles', 'selectedIndex', 'dropdownItemStyles'],
  data() {
    return {
      selectedItem: null,
      value: []
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
<style src="vue-multiselect/dist/vue-multiselect.min.css">
span .multiselect__tag {
    position: relative;
    display: inline-block;
    padding: 4px 26px 4px 10px;
    border-radius: 5px;
    margin-right: 10px;
    color: #fff;
    line-height: 1;
    background: blue;
    margin-bottom: 5px;
    white-space: nowrap;
    overflow: hidden;
    max-width: 100%;
    text-overflow: ellipsis;
}</style>
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
