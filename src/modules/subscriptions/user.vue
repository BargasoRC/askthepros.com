<template>
  <div class="container-fluid">
    <Plan :plan="plan"/>
  </div>
</template>

<script>
import Plan from './plan'
import DataTable from 'src/modules/generic/table'
import AUTH from 'src/services/auth'
export default {
  data() {
    return {
      user: AUTH.user,
      plan: null
    }
  },
  components: {
    DataTable,
    Plan
  },
  created() {
    this.retrieveSubscriptions()
  },
  methods: {
    onTableAction(data) {
      console.log('Table Action: ', data)
    },
    retrieveSubscriptions(){
      let parameter = {
        condition: [
          {
            value: this.user.userID,
            clause: '=',
            column: 'account_id'
          }
        ],
        offset: 0,
        limit: 1
      }
      $('#loading').css({'display': 'block'})
      this.APIRequest('plans/retrieve', parameter).then(response => {
        $('#loading').css({'display': 'none'})
        if(response.data.length === 0) {
          this.plan = null
        }else if(response.data.lenght > 0) {
          this.plan = response.data[0]
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
