<template>
  <div class="container-fluid">
    <div class="mt-5">
      <h5> Subscriptions </h5>
    </div>
    <div class="mt-2">
      <p style="margin-top: 0px; font-size: 1rem; color: grey">You have no active subscriptions to display. Select your membership now to get better experience with automated media posting.</p>
    </div>
    <div class="col-md-12 mt-5">
      <div class="pricing col-sm-3 p-0 pb-5">
        <div v-for="(item, index) in industry" :key="index">
          <div v-if="user.merchant.addition_informations.industry == item.category"> 
            <div class="layer1">
              <h6>{{item.category}}</h6>
              <p> {{item.price}} USD / Month</p>
            </div>
          </div>
        </div>
        <roundedBtn
            :onClick="() => { redirect('checkout')}"
            :text="'Subscribe'"
            :styles="{
              backgroundColor: '#01004E',
              color: 'white', 
              marginTop: '20px'
            }"
          />

        <roundedBtn 
          :onClick="() => { redirect('checkout')}"
          :text="'Change Plan'" 
          :styles="{
            marginTop: '20px'
          }"
        />
      </div>
    </div>

    <div class="col-md-12" style="margin-bottom: 50px;">
      <PaymentMethods />
    </div>


    <div class="col-md-12" style="margin-bottom: 100px;">
      <UserPayment />
    </div>

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
export default {
  data() {
    return {
      user: AUTH.user
    }
  },
  mounted(){
  },
  computed: {
    industry: function () {
      return global.industry
    }
  },
  components: {
    DataTable,
    dialogueBtn,
    UserPayment,
    PaymentMethods,
    roundedBtn
  },
  methods: {
    redirect(parameter){
      this.$router.push(parameter)
    },
    test(parameter){
      console.log(parameter)
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

</style>
