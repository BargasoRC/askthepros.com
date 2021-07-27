<template>
  <div class="container-fluid">
    <Plan :data="data"/>
  </div>
</template>

<script>
import Plan from './plan'
import DataTable from 'src/modules/generic/table'
import AUTH from 'src/services/auth'
export default {
  mounted(){
  },
  data() {
    return {
      user: AUTH.user,
      data: null,
      billings: []
    }
  },
  components: {
    DataTable,
    Plan
  },
  created() {
    this.retrieve()
  },
  methods: {
    onTableAction(data) {
      console.log('Table Action: ', data)
    },
    retrieve(){
      let parameter = {
        condition: [
          {
            value: this.user.userID,
            clause: '=',
            column: 'account_id'
          }
        ],
        sort: {
          created_at: 'desc'
        },
        offset: 0,
        limit: 1
      }
      $('#loading').css({'display': 'block'})
      this.APIRequest('plans/retrieve_with_payments_and_history', parameter).then(response => {
        $('#loading').css({'display': 'none'})
        if(response.data) {
          this.data = response.data
        }else{
          this.data = null
        }
      }).catch(error => {
        $('#loading').css({'display': 'none'})
        error
      })
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
  margin-top: 40px;
}
</style>
