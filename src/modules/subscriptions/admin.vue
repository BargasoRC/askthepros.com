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
        @changeSortEvent="retrieve($event.sort, $event.filter)"
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
          <tr v-for="(item, index) in data" :key="index">
            <td>{{item.account.username}}</td>
            <td>{{item.account.email}}</td>
            <td>{{renderPlan(item.plan)}}</td>
            <td>{{item.start_date}}</td>
            <td>{{item.end_date}}</td>
            <td>{{item.payment_method.status.toUpperCase()}}</td>
            <td>{{item.status.toUpperCase()}}</td>
          </tr>
        </tbody>
      </table>
    </div>

    <empty v-if="data.length <= 0" :title="'No billings available!'" :action="'Keep growing.'"></empty>

    <Pager
      :pages="numPages"
      :active="activePage"
      :limit="limit"
      v-if="data.length > 0"
    />
  </div>
</template>

<script>
import DataTable from 'src/modules/generic/table'
import Search from 'src/components/increment/generic/filter/FilterWithCalendar.vue'
import Pager from 'src/components/increment/generic/pager/Pager.vue'
import AUTH from 'src/services/auth'
export default {
  mounted(){
    if(this.user.type === 'ADMIN'){
      this.retrieve({created_at: 'desc'}, {column: 'created_at', value: ''})
    }
  },
  data() {
    return {
      user: AUTH.user,
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
          title: 'Plan ascending',
          payload: 'details',
          payload_value: 'asc',
          type: 'text'
        }, {
          title: 'Plan descending',
          payload: 'details',
          payload_value: 'desc',
          type: 'text'
        }, {
          title: 'Start Date ascending',
          payload: 'start_date',
          payload_value: 'asc',
          type: 'date'
        }, {
          title: 'Start Date descending',
          payload: 'start_date',
          payload_value: 'desc',
          type: 'date'
        }, {
          title: 'End Date ascending',
          payload: 'end_date',
          payload_value: 'asc',
          type: 'date'
        }, {
          title: 'End Date descending',
          payload: 'end_date',
          payload_value: 'desc',
          type: 'date'
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
      }],
      limit: 5,
      offset: 0,
      numPages: null,
      filter: null,
      sort: null,
      activePage: 1
    }
  },
  components: {
    DataTable,
    Search,
    'empty': require('components/increment/generic/empty/Empty.vue'),
    Pager
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
    retrieve(sort, filter){
      if(sort !== null){
        this.sort = sort
      }
      if(filter !== null){
        this.filter = filter
      }
      if(sort === null && this.sort !== null){
        sort = this.sort
      }
      if(filter === null && this.filter !== null){
        filter = this.filter
      }
      let parameter = {
        condition: [{
          value: filter.value !== null ? '%' + filter.value + '%' : '%%',
          column: filter.column,
          clause: 'like'
        }],
        sort: sort,
        limit: this.limit,
        offset: (this.activePage > 0) ? ((this.activePage - 1) * this.limit) : this.activePage,
        account_id: false,
        switch: false
      }
      console.log('[parameter]', parameter)
      $('#loading').css({'display': 'block'})
      this.APIRequest('billings/retrieve_on_history', parameter).then(response => {
        $('#loading').css({'display': 'none'})
        if(response.data && response.data.length > 0) {
          this.data = response.data
          this.numPages = parseInt(response.size / this.limit) + (response.size % this.limit ? 1 : 0)
        }else{
          this.data = []
          this.numPages = null
        }
      })
    }
  }
}
</script>

<style lang="scss" scoped>
@import "~assets/style/colors.scss";
.container-fluid{
  min-height: 85vh !important;
}
</style>
