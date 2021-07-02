<template>
  <div class="container-fluid">
    <div class="mt-5">
      <h2> Subscriptions </h2>
    </div>
    <div class="mt-2">
      <p style="margin-top: 0px; font-size: 1rem; color: grey">You have no active subscriptions to display. Select your membership now to get better experience with automated media posting.</p>
    </div>
    <div class="col-md-12 mt-5 d-flex justify-content-center">
      <div class="pricing col-sm-3 p-0 pb-5">
        <div class="layer1">
          <h6>Industry</h6>
          <p> 129 USD / Month</p>
        </div>
        <div class="layer2">
          <span>
            <p><i class="fas fa-check"></i>&nbsp;&nbsp;&nbsp;Item</p>
            <hr/>
            <p><i class="fas fa-check"></i>&nbsp;&nbsp;&nbsp;Item</p>
            <hr/>
            <p><i class="fas fa-check"></i>&nbsp;&nbsp;&nbsp;Item</p>
            <hr/>
            <p><i class="fas fa-check"></i>&nbsp;&nbsp;&nbsp;Item</p>
            <hr/>
            <p><i class="fas fa-check"></i>&nbsp;&nbsp;&nbsp;Item</p>
            <hr/>
            <p><i class="fas fa-check"></i>&nbsp;&nbsp;&nbsp;Item</p>
            <hr/>
          </span>
        </div>
        <dialogueBtn 
          :onClick="() => {}"
          :icon="'fas fa-sign-in-alt'" 
          :text="'Register Now'" 
          :icon_position="'right'"  
          :styles="{
            backgroundColor: '#01004E',
            color: 'white', 
            marginTop: '20px'
          }"
        />
      </div>
    </div>
  </div>
</template>

<script>
import DataTable from 'src/modules/generic/table'
import dialogueBtn from 'src/modules/generic/dialogueBtn'
export default {
  data() {
    return {
      tableActions: [
        {button: `<i class="fas fa-pencil-alt ml-2 mr-2" style="color: #01009A;"></i>`},
        {button: `<i class="fas fa-pause ml-2 mr-2" style="color: #01004E !important;"></i>`},
        {button: `<i class="fas fa-trash-alt ml-2 mr-2" style="color: #FF0000;"></i>`}
      ],
      tableHeaders: [
        {title: 'Membership', key: 'membership', type: 'text'},
        {title: 'Subscription', key: 'subscription', type: 'text'},
        {title: 'Active', key: 'active', type: 'text'},
        {title: 'Created', key: 'created_at', type: 'text'},
        {title: 'Card Expiration', key: 'expiration', type: 'text'},
        {title: 'Actions', type: 'action'}
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
  mounted(){
  },
  computed: {
    returnIndustry() {
      return this.industry.map(el => {
        return el.category
      })
    }
  },
  components: {
    DataTable,
    dialogueBtn
  },
  methods: {
    onTableAction(data) {
      console.log('Table Action: ', data)
    },
    currentPlan(){
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
.sectionn {
  background-color: $white;
  min-height: 100vh;
  width: 100%;
}

.row {
  padding-top: 15vh;
  padding-bottom: 15vh;
}

h1 {
  font-weight: 700;
  color: $title;
  font-size: 35px;
}

p {
  margin-top: 20px;
  font-size: 24px;
  color: $title;
}

img {
  width: 85%;
  height: auto;
}

.pricing{
  text-align: center;
  // min-height: 60vh;
  border: 0.5px solid $text;
  // margin-left: 35%;
  border-top-left-radius: 22.5px;
  border-top-right-radius: 22.5px;
  // width: 30%;
  padding-bottom: 30px;
}

.pricing .layer1 {
  background-color: $primary;
  border-top-left-radius: 22.5px;
  border-top-right-radius: 22.5px;
  height: 115px;
  padding-top: 35px;
}

.pricing .layer1 h6{
  color: $warning;
  font-size: 24px;
}

.pricing .layer1 p{
  margin-top: -5px;
  color: $white;
  font-size: 14px;
}

.pricing .layer2 {
  padding-left: 40px;
  padding-right: 40px;
  padding-top: 10px;
  padding-bottom: 40px;
  text-align: left;
}

.pricing .layer2 p {
  font-weight: 300;
  color: $text;
  font-size: 12px;
}

.fa-check {
  font-size: 24px;
  color: $success;
}

hr {
  background-color: $text;
}

</style>
