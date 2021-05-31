<template>
  <div id="pricing" class="sectionn">
    <div class="container">
      <div class="row no-gutters">
        <span class="col-md-7">
          <h1>We offer affordable prices per industry</h1>
          <p>Select the industry you belong to know pricing.</p>
          <div class="selectBtn">
            <dialogueSelectBtn 
            :items="returnIndustry"
            :placeholder="'Industry'"
            :styles="{}"
            :dropdownItemStyles="{}"
            @onSelect="onIndustrySelect"
          />
          </div>
          <!-- <select v-model="selected">
            <option disabled value="">Industry</option>
            <option v-for="(item, index) in industry" :key="index">{{item.category}}</option>
          </select> -->
          <img :src="require('assets/img/section3-img.png')"/>
        </span>
        <span class="col-md-5" style="text-align: center;">
          <div class="pricing">
            <div class="layer1">
              <h6>{{industry[selected].category}}</h6>
              <p>{{industry[selected].price}}USD / Month</p>
            </div>
            <div class="layer2">
              <span v-for="(item, index) in industry[selected].benefit" :key="index">
                <p><i class="fas fa-check"></i>&nbsp;&nbsp;&nbsp;{{item}}</p>
                <hr/>
              </span>
            </div>
            <dialogueBtn :onClick="register" :icon="'fas fa-sign-in-alt'" :text="'Register Now'" :styles="{backgroundColor: '#01004E',color: 'white', marginTop: '20px'}"/>
          </div>
        </span>
      </div>
    </div>
  </div>
</template>

<script>
import dialogueBtn from 'src/modules/generic/dialogueBtn'
import dialogueSelectBtn from 'src/modules/generic/dialogueSelectBtn'
import global from 'src/helpers/global'
export default {
  components: {
    dialogueBtn,
    dialogueSelectBtn
  },
  data(){
    return{
      selected: 2,
      industry: global.industry
    }
  },
  computed: {
    returnIndustry() {
      return this.industry.map(el => {
        return el.category
      })
    }
  },
  methods: {
    onIndustrySelect(data) {
      console.log('SELECTED INDUSTRY: ', data)
      this.selected = data.index
      this.global.selectedIndustryIndex = data.index
    },
    register() {
      this.redirect('signup')
      window.scrollTo(0, 0)
    },
    redirect(parameter) {
      this.$router.push(parameter)
    }
  }
}
</script>

<style scoped lang='scss'>
@import '~assets/style/colors.scss';
.sectionn {
  background-color: $white;
  min-height: 100vh;
  width: 100%;
}

.row {
  padding-top: 20vh;
  padding-bottom: 20vh;
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
  min-height: 60vh;
  border: 0.5px solid $text;
  margin-left: 20%;
  border-top-left-radius: 22.5px;
  border-top-right-radius: 22.5px;
  width: 80%;
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

@media (max-width: 700px) {
  .col-md-7 h1{
    font-size: 30px;
  }
  .col-md-5 p, .col-md-7 p{
    font-size: 20px;
  }
  .col-md-7, .col-md-5 {
    width: 100%;
    text-align: center;
  }
  .pricing {
    margin-top: 20% !important;
    margin: 5%;
    width: 90%;
  }
  .selectBtn {
    margin-top: 5vh;
    margin-bottom: 5vh;
    display: flex;
    justify-content: center;
  }
}
</style>

