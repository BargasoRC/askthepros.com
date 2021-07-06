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
        <div v-for="(item, index1) in industry" :key="index1">
          <div class="layer1" v-if="item.category == auth.user.data.merchant.addition_informations.industry">
            <h6>{{item.category}}</h6>
            <p> {{item.price}}} USD / Month</p>
            <div class="layer2">
              <span v-for="(list, index2) in industry[index1].benefit" :key="index2">
                <p><i class="fas fa-check"></i>&nbsp;&nbsp;&nbsp;{{list}}</p>
                <hr/>            
              </span>
            </div>
          </div>
        </div>
        <dialogueBtn 
          :onClick="() => { redirect('checkout')}"
          :icon="'fas fa-sign-in-alt'" 
          :text="'Current Plan'" 
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
      selected: 0,
      industry: global.industry
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
    },
    redirect(parameter){
      this.$router.push(parameter)
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
