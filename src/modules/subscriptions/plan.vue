<template>
  <div class="container-fluid">
    <div style="margin-top: 25px;">
      <h5> Subscriptions </h5>
    </div>
    <div class="mt-4">
      <p style="margin-top: 0px; font-size: 1rem; color: grey" v-if="data && data.plan === null">You have no active subscriptions to display. Select your membership now to get better experience with automated media posting.</p>
      <p style="margin-top: 0px; font-size: 1rem; color: grey" v-else>Your account is active.</p>
    </div>
    <div class="col-md-12 mt-5" v-if="data && data.plan !== null">
      <div class="pricing col-sm-3 p-0 pb-5">
        <div>
          <div> 
            <div class="layer1">
              <h6>{{data.plan.plan}}</h6>
              <p> {{data.plan.amount}} {{data.plan.currency}} / Month</p>

              <p v-if="data.plan.end_date !== null">
                Expire on {{data.plan.end_date}}
              </p>
            </div>
          </div>
        </div>
        <roundedBtn 
          :onClick="() => {
            cancelPlanConfirmation()
          }"
          v-if="data.plan.end_date === null"
          :text="'Cancel Plan'" 
          :styles="{
            marginTop: '20px',
            backgroundColor: colors.danger,
            color: 'white'
          }"
        />

        <!-- <roundedBtn 
          :onClick="() => {
            // change plan
          }"
          :text="'Change Plan'" 
          v-if="data.plan.end_date === null"
          :styles="{
            marginTop: '20px',
            backgroundColor: colors.darkPrimary,
            color: 'white'
          }"
        /> -->

        <roundedBtn 
          :onClick="() => {
            this.redirect('/checkout/' + data.plan.plan.toLowerCase().replace(' ', '_'))
          }"
          :text="'Subscribe'"
          v-if="data.plan.end_date !== null"
          :styles="{
            marginTop: '20px',
            backgroundColor: colors.darkPrimary,
            color: 'white'
          }"
        />
      </div>
    </div>

    <div class="subscription-holder" v-if="data && data.plan === null">
      <div v-for="(item, index) in industry" :key="index" class="subscription-item">
        <div>
          <div class="layer1">
            <h6 class="text-primary">{{item.category}}</h6>
            <p> {{item.payload_value}} USD / Month</p>

            <roundedBtn
              :onClick="() => { redirect('/checkout/' + item.category.toLowerCase().replace(' ', '_'))}"
              :text="'Subscribe'"
              :styles="{
                backgroundColor: colors.darkPrimary,
                color: 'white'
              }"
            />
          </div>
        </div>
      </div>
      
    </div>

    <div class="col-md-12" style="margin-bottom: 50px;" v-if="data && data.payment_method !== null">
      <PaymentMethods :data="data.payment_method"/>
    </div>

    <div class="col-md-12" style="margin-bottom: 100px;">
      <UserPayment/>
    </div>

    <Confirmation
      ref="confirm"
      :message="'Are you sure do you want to cancel your plan?'"
      :title="'Confirmation'"
      @onConfirm="e => {
        cancelPlan(e)
      }"
    ></Confirmation>

  </div>
</template>

<script>
import DataTable from 'src/modules/generic/table'
import dialogueBtn from 'src/modules/generic/dialogueBtn'
import UserPayment from 'src/modules/payments/user.vue'
import PaymentMethods from 'src/modules/payments/PaymentMethods.vue'
import AUTH from 'src/services/auth'
import global from 'src/helpers/global'
import roundedBtn from 'src/modules/generic/roundedBtn'
import Colors from 'src/assets/style/colors.js'
import Confirmation from 'src/components/increment/generic/modal/Confirmation.vue'
export default {
  mounted(){
    this.retrieve()
  },
  data() {
    return {
      user: AUTH.user,
      industry: [],
      colors: Colors,
      selectedId: null
    }
  },
  components: {
    DataTable,
    dialogueBtn,
    UserPayment,
    PaymentMethods,
    roundedBtn,
    Confirmation
  },
  props: ['data', 'billings'],
  methods: {
    redirect(parameter){
      this.$router.push(parameter)
    },
    test(parameter){
      console.log(parameter)
    },
    cancelPlanConfirmation(){
      if(this.data && this.data.plan){
        this.selectedId = this.data.plan.id
        setTimeout(() => {
          this.$refs.confirm.show(this.data.plan.id)
        }, 100)
      }
    },
    cancelPlan(){
      if(this.data && this.data.plan){
        let parameter = {
          id: this.data.plan.id,
          account_id: this.user.userID
        }
        $('#loading').css({'display': 'block'})
        this.APIRequest('plans/cancel_plan', parameter).then(response => {
          $('#loading').css({'display': 'none'})
          this.$parent.retrieve()
        }).catch(error => {
          $('#loading').css({'display': 'none'})
          error
        })
      }
    },
    retrieveRoot(){
      this.$parent.retrieve()
    },
    retrieve(){
      if(this.data && this.data.plan !== null){
        return
      }
      let conditions = [{
        value: 'subscriptions',
        clause: '=',
        column: 'payload'
      }]
      if(this.user !== null && this.user.merchant && this.user.merchant.length > 0 && this.user.merchant[0] !== undefined){
        if(this.user.merchant[0].addition_informations){
          let industry = JSON.parse(this.user.merchant[0].addition_informations)
          conditions.push({
            value: industry.industry,
            column: 'category',
            clause: '='
          })
        }
      }
      if(this.user !== null && this.user.merchant && this.user.merchant.addition_informations){
        conditions.push({
          value: this.user.merchant.addition_informations.industry,
          column: 'category',
          clause: '='
        })
      }
      let parameter = {
        condition: conditions
      }
      $('#loading').css({'display': 'block'})
      this.APIRequest('payloads/retrieve', parameter).then(response => {
        $('#loading').css({'display': 'none'})
        if(response.data.length > 0) {
          this.industry = response.data
        }else{
          this.industry = []
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
  padding-bottom: 30px;
}

.pricing .layer1 {
  background-color: $primary;
  border-radius: 22.5px;
  padding: 15px;
  padding-top: 25px;
  padding-bottom: 25px;
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

.text-primary{
  color: $primary !important;
}

.subscription-holder{
  width: 100%;
  float: left;
  margin-top:25px;
}

.subscription-item{
  width: 24%;
  margin-right: 1%;
  float: left;
  padding: 15px;
  border-radius: 5px;
  border: solid 1px #ddd;
}

</style>
