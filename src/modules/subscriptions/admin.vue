<template>
  <div class="container-fluid">
    <div class="mt-5">
      <h5>Subscription Management</h5>
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
    <div v-if="data.length > 0">
      <table class="table table-striped table-bordered">
        <thead>
          <th v-for="(item, index) in tableHeaders" :key="index">{{item.title}}</th>
        </thead>
        <tbody>
          <tr v-for="(item, index) in data">
            <td>{{item.account.username}}</td>
            <td>{{item.account.email}}</td>
            <td>{{renderPlan(item.plan)}}</td>
            <td>{{item.start_date}}</td>
            <td>{{item.end_date}}</td>
            <td>{{item.payment_method_expiry}}</td>
            <td>{{item.status.toUpperCase()}}</td>
          </tr>
        </tbody>
      </table>
    </div>

    <empty v-if="data.length <= 0" :title="'No billings available!'" :action="'Keep growing.'"></empty>
  </div>
</template>

<script>
import DataTable from 'src/modules/generic/table'
import Search from 'src/components/increment/generic/filter/Basic'
export default {
  mounted(){
    this.retrieve()
  },
  data() {
    return {
      tableActions: [],
      tableHeaders: [
        {title: 'Username'},
        {title: 'Email Address'},
        {title: 'Plan'},
        {title: 'Start Date'},
        {title: 'End Date'},
        {title: 'Payment Method Status'},
        {title: 'Status'}
      ],
      data: [],
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
    Search,
    'empty': require('components/increment/generic/empty/Empty.vue')
  },
  methods: {
    renderPlan(plan){
      if(plan){
        return plan.plan
      }else{
        return null
      }
    },
    onTableAction(data) {
      console.log('Table Action: ', data)
    },
    retrieve(){
      let parameter = {
        sort: {
          start_date: 'desc'
        },
        offset: 0,
        limit: 50
      }
      $('#loading').css({'display': 'block'})
      this.APIRequest('billings/retrieve', parameter).then(response => {
        $('#loading').css({'display': 'none'})
        if(response.data && response.data.length > 0) {
          this.data = response.data
        }else{
          this.data = []
        }
      })
    }
  }
}
</script>

<style lang="scss" scoped>
@import "~assets/style/colors.scss";
</style>
