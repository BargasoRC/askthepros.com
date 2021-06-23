<template>
  <div class="container-fluid">
    <div class="mt-5">
      <h2> Billing Management </h2>
    </div>
    <div class="col-sm-12 col-md-12 col-lg-12 mt-5 mb-5 p-0">
      <Search 
        :category="category"
        :activeCategoryIndex="0"
        :activeSortingIndex="0"
        @changeSortEvent="() => {} "
        :grid="['list']"
        :sortByStyle="{
          background: '#01004E !important',
          color: 'white'
        }"
        :dropDownStyle="{
          border: '1px solid #01004E !important',
          background: 'none !important',
          color: '#272727 !important',
          borderLeft: '0px',
          outline: 'none !important',
          boxShadow: 'none !important'
        }"
      />
    </div>
    <div class="table_container">
      <DataTable 
        :tableActions="tableActions"
        :tableHeaders="tableHeaders"
        :tableData="tableData"
        @onAction="onTableAction"
      />
    </div>
  </div>
</template>

<script>
import DataTable from 'src/modules/generic/table'
import Search from 'src/components/increment/generic/filter/Basic'
export default {
  data() {
    return {
      tableActions: [],
      tableHeaders: [
        {title: 'Date', key: 'created_at', type: 'text'},
        {title: 'Username', key: 'username', type: 'text'},
        {title: 'Email Address', key: 'email', type: 'text'},
        {title: 'Membership', key: 'membership', type: 'text'},
        {title: 'Total', key: 'total', type: 'text'},
        {title: 'Method', key: 'method', type: 'text'},
        {title: 'Status', key: 'status', type: 'text'},
        {title: 'Invoice', key: 'invoice', type: 'text'}
      ],
      tableData: [
        {
          created_at: new Date().toLocaleDateString(),
          username: 'Juggernaut',
          email: 'jugger@email.com',
          membership: 'Basic',
          total: '$299.00',
          method: 'Credit Cards',
          status: 'Pending',
          invoice: 'ch_lksdj1l1238XX'
        },
        {
          created_at: new Date().toLocaleDateString(),
          username: 'Juggernaut',
          email: 'jugger@email.com',
          membership: 'Basic',
          total: '$299.00',
          method: 'Credit Cards',
          status: 'Pending',
          invoice: 'ch_lksdj1l1238XX'
        },
        {
          created_at: new Date().toLocaleDateString(),
          username: 'Juggernaut',
          email: 'jugger@email.com',
          membership: 'Basic',
          total: '$299.00',
          method: 'Credit Cards',
          status: 'Pending',
          invoice: 'ch_lksdj1l1238XX'
        }
      ],
      category: [{
        title: 'Sort By',
        sorting: [{
          title: 'Post ascending',
          payload: 'post',
          payload_value: 'asc',
          type: 'date'
        }, {
          title: 'Post descending',
          payload: 'post',
          payload_value: 'desc',
          type: 'date'
        }, {
          title: 'Created ascending',
          payload: 'created_at',
          payload_value: 'asc',
          type: 'date'
        }, {
          title: 'Created descending',
          payload: 'created_at',
          payload_value: 'desc',
          type: 'date'
        }, {
          title: 'Title ascending',
          payload: 'title',
          payload_value: 'asc',
          type: 'text'
        }, {
          title: 'Title descending',
          payload: 'title',
          payload_value: 'desc',
          type: 'text'
        }, {
          title: 'Category ascending',
          payload: 'category',
          payload_value: 'asc',
          type: 'text'
        }, {
          title: 'Category descending',
          payload: 'category',
          payload_value: 'desc',
          type: 'text'
        }, {
          title: 'Channel ascending',
          payload: 'channel',
          payload_value: 'asc',
          type: 'text'
        }, {
          title: 'Channel descending',
          payload: 'channel',
          payload_value: 'desc',
          type: 'text'
        }, {
          title: 'Author ascending',
          payload: 'author',
          payload_value: 'asc',
          type: 'text'
        }, {
          title: 'Author descending',
          payload: 'author',
          payload_value: 'desc',
          type: 'text'
        }, {
          title: 'Status ascending',
          payload: 'status',
          payload_value: 'asc',
          type: 'text'
        }, {
          title: 'Status descending',
          payload: 'status',
          payload_value: 'desc',
          type: 'text'
        }]
      }]
    }
  },
  components: {
    DataTable,
    Search
  },
  methods: {
    onTableAction(data) {
      console.log('Table Action: ', data)
    }
  }
}
</script>

<style lang="scss" scoped>
@import "~assets/style/colors.scss";
.table_container {
  border-left: 1px solid $hover;
  border-right: 1px solid $hover;
  border-bottom: 1px solid $hover;
  margin-top: 70px;
}
</style>
