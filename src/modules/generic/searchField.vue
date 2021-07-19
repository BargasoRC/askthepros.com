<template>
  <div>
    <Multiselect style="width:100%" v-model="value" tag-placeholder="Add this as new tag" placeholder="Search or add a tag" label="name" track-by="code" :options="options" :multiple="true" :taggable="true" @tag="addTag"></Multiselect>
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
        { name: 'Manufacturing', code: 'Man' },
        { name: 'Construction', code: 'Cons' },
        { name: 'Finance', code: 'Fin' },
        { name: 'Transport', code: 'Tra' },
        { name: 'Agriculture', code: 'Agr' },
        { name: 'Retail', code: 'Ret' },
        { name: 'Technology', code: 'Tech' },
        { name: 'Education', code: 'Edu' },
        { name: 'Publishing', code: 'Pub' },
        { name: 'Medicine', code: 'Med' }
      ]
    }
  },
  computed: {
  },
  components: {
    Multiselect
  },
  methods: {
    selectItem(ndx, item) {
      this.selectedItem = item
      let temp = {
        name: item,
        code: ndx
      }
      this.$emit('onSelect', temp)
    },
    addTag(newTag){
      const tag = {
        name: newTag,
        code: newTag.substring(0, 2) + Math.floor((Math.random() * 10000000))
      }
      this.options.push(tag)
      this.value.push(tag)
    },
    returnCategory(){
      console.log('Return Value: ' + JSON.stringify(this.value))
      this.$emit('onSelect', JSON.stringify(this.value))
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
