<template>
  <table class="table table-light">
    <thead>
      <tr v-if="tableHeaders && tableActions">
        <th scope="col" v-for="(item, ndx) in tableHeaders" :key="'table' + ndx" :class="item.type === 'action' ? 'text-center' : 'text-left'">
          {{item.title}}
        </th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="(data, index) in tableData" :key="'table_data' + index">
        <th v-for="(item, ndx) in tableHeaders" :key="'td' + ndx" class="font-weight-normal">
            <div class="font-weight-bold" v-if="isBold === true">
            {{
            returnData(data, item)
            }}
            </div>
            <div class="font-weight-normal" v-else-if="isBold === false">
            {{
            returnData(data, item)
            }}
            </div>
          <div class="font-weight-normal d-flex justify-content-center">
            <span v-for="(btn, i) in tableActions" :key="'btn' + i" v-html="btn.button" v-if="item.type === 'action'" @click="item.type === 'action' ? buttonAction(i, index) : () => {}"></span>
          </div>
        </th>
      </tr>
    </tbody>
  </table>
</template>

<script>
export default {
  data() {
    return{
      isBold: false
    }
  },
  props: ['tableActions', 'tableHeaders', 'tableData', 'onAction'],
  methods: {
    returnData(data, item) {
      let temp = ''
      if(item.type !== 'action') {
        if(item.key === 'title' || item.key === 'status'){
          temp = data[item.key]
          this.isBold = false
        }else {
          temp = data[item.key]
          this.isBold = true
        }
      }
      return temp
    },
    buttonAction(index, rowIndex){
      let temp = {
        buttonIndex: index,
        rowIndex: rowIndex
      }
      this.$emit('onAction', temp)
    }
  }
}
</script>

<style>

</style>
