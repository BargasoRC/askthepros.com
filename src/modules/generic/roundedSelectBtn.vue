<template>
  <div style="width: 100% position: relative">
    <button
      class="btn dialogueBTN select-btn"
      type="button"
      id="dropdownMenuLink"
      data-toggle="dropdown"
      aria-haspopup="true"
      aria-expanded="false"
      :style="styles"
    >
      {{ 
        selectedItem ?
          selectedItem 
        : 
          selectedIndex != undefined && selectedIndex != null ?
            items[selectedIndex]
          :
            placeholder 
      }}
    </button>
    <div 
      class="dropdown-menu"
      :style="{
        ...{
          borderRadius: '15px',
          overflow: 'hidden',
          width: 'calc(100% - 35px)'
        },
        ...dropdownItemStyles
      }"
    >
      <b
        class="dropdown-item font-weight-normal select-item"
        href="#"
        v-for="(el, ndx) in items"
        :key="ndx"
        @click="selectItem(ndx, el)"
        :style="{
          color: (
            dropdownItemStyles ? 
              dropdownItemStyles.color ?
                dropdownItemStyles.color
              :
                '#272727'
            :
              '#272727'
          )
        }"
      >
        {{ el }}
      </b
      >
    </div>
  </div>
</template>

<script>
export default {
  props: ['items', 'placeholder', 'styles', 'selectedIndex', 'dropdownItemStyles'],
  data() {
    return {
      selectedItem: null
    }
  },
  methods: {
    selectItem(ndx, item) {
      this.selectedItem = item
      let temp = {
        index: ndx,
        item: item
      }
      this.$emit('onSelect', temp)
    }
  }
}
</script>

<style lang="scss" scoped>
@import "~assets/style/colors.scss";
.select-btn {
  font: 13px sans-serif;
  padding-left: 1em;
  padding-right: 1.6em;
  display: flex;
  justify-content: space-between;
  background: $white !important;
  outline: none;
}

.select-btn::after {
  display: inline-block;
  width: 10px;
  height: 10px;
  margin: -.3em 0 0 .4em;
  vertical-align: middle;
  content: "";
  border: .3em solid;
  border-width: 0 .15em .15em 0;
  transform: rotateZ(45deg);
  font-weight: 100 !important;
}
.select-item {
  cursor: pointer;
}
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
  display: flex;
  justify-content: space-between;
  align-items: center;
  border: 1px solid $gray !important;
}
</style>
