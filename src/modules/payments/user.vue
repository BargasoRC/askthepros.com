<template>
  <div>
    <h2> Payment History </h2>
    <div class="col-sm-12 p-0 mt-4">
      <table class="table table-striped table-bordered">
        <thead>
          <th>Description</th>
          <th>Amount</th>
          <th>Start date</th>
          <th>End date</th>
          <th>Actions</th>
        </thead>
        <tbody>
          <tr v-for="(item, index) in data" :key="index">
            <td>{{item.description}}</td>
            <td>{{item.amount}}</td>
            <td>{{item.start_date}}</td>
            <td>{{item.end_date}}</td>
            <td>
              <roudedBtn
                :onClick="pay"
                :text="'Pay Now'"
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
import roudedBtn from 'src/modules/generic/roundedBtn'
import COLORS from 'src/assets/style/colors.js'
import AUTH from 'src/services/auth'
export default {
  data() {
    return {
      user: AUTH.user,
      data: [{
        description: 'Test',
        amount: 250,
        currency: 'USD',
        start_date: 'Test',
        end_date: 'test'
      }]
    }
  },
  components: {
    roudedBtn
  },
  methods: {
    pay() {
      this.$router.push(`/${this.user.type.toLowerCase()}/checkout`)
    }
  }
}
</script>

<style lang="scss" scoped>
@import "~assets/style/colors.scss";
.payment_header {
  align-items: center;
}
</style>
