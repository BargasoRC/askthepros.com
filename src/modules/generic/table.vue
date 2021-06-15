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
          {{
            returnData(data, item)
          }}
          <div class="font-weight-normal d-flex justify-content-center">
            <span v-for="(btn, i) in tableActions" :key="'btn' + i" v-html="btn.button" v-if="item.type === 'action'" @click="edit(1)"></span>
          </div>
        </th>
      </tr>
    </tbody>
  </table>
</template>

<script>
import ROUTER from 'src/router'
export default {
  props: ['tableActions', 'tableHeaders', 'tableData'],
  methods: {
    returnData(data, item) {
      let temp = ''
      if(item.type !== 'action') {
        temp = data[item.key]
      }
      return temp
    },
    edit(id){
      ROUTER.push('post_management/edit/' + id)
    }
  }
}
</script>

<style>

</style>
