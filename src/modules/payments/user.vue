<template>
  <div class="container-fluid">
    <div class="col-sm-12 p-0 d-flex justify-content-between mt-5 mb-5 payment_header">
      <div>
        <h2> Payment History </h2>
      </div>
      <roudedBtn
        :onClick="pay"
        :text="'Pay Now'"
        :styles="{
          backgroundColor: '#01004E',
          color: 'white'
        }"
      />
    </div>
    <div class="col-sm-12 p-0 mt-4 payment_table">
      <DataTable 
        :tableActions="tableActions"
        :tableHeaders="tableHeaders"
        :tableData="tableData"
      />
    </div>
  </div>
</template>

<script>
import roudedBtn from 'src/modules/generic/roundedBtn'
import DataTable from 'src/modules/generic/table'
import COLORS from 'src/assets/style/colors.js'
import AUTH from 'src/services/auth'
export default {
  data() {
    return {
      user: AUTH.user,
      tableActions: [],
      tableHeaders: [
        {title: 'Date', key: 'created_at', type: 'text'},
        {title: 'Total', key: 'total', type: 'text'},
        {title: 'Membership', key: 'membership', type: 'text'},
        {title: 'Method', key: 'method', type: 'text'},
        {title: 'Status', key: 'status', type: 'text'},
        {title: 'Invoice', key: 'invoice', type: 'text'}
      ],
      tableData: [
        {
          created_at: new Date().toLocaleDateString(),
          total: 1 + new Date().getSeconds(),
          membership: 'Basic',
          method: 'Credit Cards',
          status: 'Completed',
          invoice: 'ch_12983skxsh17'
        },
        {
          created_at: new Date().toLocaleDateString(),
          total: 1 + new Date().getSeconds(),
          membership: 'Basic',
          method: 'Credit Cards',
          status: 'Pending',
          invoice: 'ch_12983skxsh17'
        }
      ]
    }
  },
  components: {
    DataTable,
    roudedBtn
  },
  methods: {
    pay() {
      this.$router.push(`/${this.user.type}/checkout`)
    }
  }
}
</script>

<style lang="scss" scoped>
@import "~assets/style/colors.scss";
.payment_header {
  align-items: center;
}
.payment_table {
  margin-top: 50px !important;
  border-left: 1px solid $hover;
  border-right: 1px solid $hover;
  border-bottom: 1px solid $hover;
}
</style>
