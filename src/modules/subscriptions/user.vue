<template>
  <div class="container-fluid">
    <div class="mt-5">
      <h2> Subscriptions </h2>
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
export default {
  data() {
    return {
      tableActions: [
        {button: `<i class="fas fa-pencil-alt ml-2 mr-2" style="color: #01004E;"></i>`},
        {button: `<i class="fas fa-pause ml-2 mr-2" style="color: #01009A !important;"></i>`},
        {button: `<i class="fas fa-trash-alt ml-2 mr-2" style="color: #FF0000;"></i>`}
      ],
      tableHeaders: [
        {title: 'Membership', key: 'membership', type: 'text'},
        {title: 'Subscription', key: 'subscription', type: 'text'},
        {title: 'Active', key: 'active', type: 'text'},
        {title: 'Created', key: 'created_at', type: 'text'},
        {title: 'Card Expiration', key: 'expiration', type: 'text'}
      ],
      tableData: [
        {
          membership: 'Managed Social Media Posting',
          active: 'Yes',
          subscription: 'Enabled \n Month 1 - $299 (includes one-time set up fee $199) then $99/mo. auto-billed. Cancel anytime. Expires: June 16, 2021',
          created_at: new Date().toLocaleDateString(),
          expiration: new Date().toLocaleDateString()
        },
        {
          membership: 'Managed Social Media Posting',
          active: 'Yes',
          subscription: 'Enabled \n Month 1 - $299 (includes one-time set up fee $199) then $99/mo. auto-billed. Cancel anytime. Expires: June 16, 2021',
          created_at: new Date().toLocaleDateString(),
          expiration: new Date().toLocaleDateString()
        },
        {
          membership: 'Managed Social Media Posting',
          active: 'Yes',
          subscription: 'Enabled \n Month 1 - $299 (includes one-time set up fee $199) then $99/mo. auto-billed. Cancel anytime. Expires: June 16, 2021',
          created_at: new Date().toLocaleDateString(),
          expiration: new Date().toLocaleDateString()
        }
      ]
    }
  },
  components: {
    DataTable
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
  margin-top: 40px;
}
</style>
