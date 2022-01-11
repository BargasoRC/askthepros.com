<template>
  <div class="payment-history-holder" style="margin-top: 25px;">
    <h5 v-if="data.length > 0"> Payment History </h5>
    <div class="col-sm-12 p-0 mt-4">
      <table class="table table-striped table-bordered" style="margin-bottom: 100px;" v-if="data.length > 0">
        <thead>
          <th>Description</th>
          <th>Amount</th>
          <th>Via</th>
          <th>Start date</th>
          <th>End date</th>
          <th>Status</th>
          <th>Actions</th>
        </thead>
        <tbody>
          <tr v-for="(item, index) in data" :key="index">
            <td>{{item.plan.currency + ' ' + item.plan.amount + ' ' + item.plan.plan + ' Monthy Plan'}}</td>
            <td>{{item.currency}} {{item.amount}}</td>
            <td>{{item.payment_method.details.source.card.brand + ' - ****' + item.payment_method.details.source.card.last4}}</td>
            <td>{{item.start_date}}</td>
            <td>{{item.end_date}}</td>
            <td>{{item.status.toUpperCase()}}</td>
            <td>
              <roundedBtn
                :onClick="e => {
                  redirect('/checkout/' + item.plan.plan.toLowerCase().replace(' ', '_'))
                }"
                :text="'Pay Now'"
                v-if="item.status !== 'paid'"
                :styles="{
                  backgroundColor: '#01004E',
                  color: 'white'
                }"
              />
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import roundedBtn from 'src/modules/generic/roundedBtn'
import COLORS from 'src/assets/style/colors.js'
import AUTH from 'src/services/auth'
import ROUTER from 'src/router'
export default {
  mounted(){
    this.retrieve({created_at: 'desc'}, {column: 'created_at', value: ''})
  },
  data() {
    return {
      user: AUTH.user,
      data: [],
      limit: 5,
      offset: 0,
      numPages: null,
      filter: null,
      sort: null,
      activePage: 1
    }
  },
  components: {
    roundedBtn
  },
  methods: {
    pay() {
      this.$router.push(`/${this.user.type.toLowerCase()}/checkout`)
    },
    redirect(route){
      ROUTER.push(route)
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
          value: filter.value + '%',
          column: filter.column,
          clause: 'like'
        }, {
          value: this.user.userID,
          column: 'account_id',
          clause: '='
        }],
        sort: sort,
        limit: this.limit,
        switch: true,
        offset: (this.activePage > 0) ? ((this.activePage - 1) * this.limit) : this.activePage
      }
      this.APIRequest('billings/retrieve_on_history', parameter).then(response => {
        $('#loading').css({'display': 'none'})
        if(response.data && response.data.length > 0) {
          this.data = response.data
        }else{
          this.data = []
        }
      }).catch(error => {
        error
      })
    }
  }
}
</script>

<style lang="scss" scoped>
@import "~assets/style/colors.scss";
.payment_header {
  align-items: center;
}

.payment-history-holder{
  width: 100%;
  float: left;
}
</style>
