<template>
  <div id="pricing" class="sectionn">
    <div class="container">
      <div class="row no-gutters">
        <span class="col-md-7">
          <h1>We offer affordable prices per industry</h1>
          <p>Select the industry you belong to know pricing.</p>
          <select v-model="selected">
            <option disabled value="">Industry</option>
            <option v-for="(item, index) in industry" :key="index">{{item.category}}</option>
          </select>
          <img :src="require('assets/img/section3-img.png')"/>
        </span>
        <span class="col-md-5" style="text-align: center;">
          <div class="pricing">
            <div class="layer1">
              <h6>Finance</h6>
              <p>199USD / Month</p>
            </div>
            <div class="layer2">
              <span v-for="(item, index) in benefit" :key="index">
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
import ROUTER from 'src/router'
import dialogueBtn from 'src/modules/generic/dialogueBtn'
export default {
  components: {
    dialogueBtn
  },
  data(){
    return{
      selected: '',
      benefit: ['Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin'],
      industry: [
        {
          category: 'Manufacturing',
          price: 190,
          benefit: ['Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin']
        },
        {
          category: 'Construction',
          price: 290,
          benefit: ['Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin']
        },
        {
          category: 'Finance',
          price: 199,
          benefit: ['Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin']
        },
        {
          category: 'Transport',
          price: 192,
          benefit: ['Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin']
        },
        {
          category: 'Agriculture',
          price: 100,
          benefit: ['Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin']
        },
        {
          category: 'Retail',
          price: 190,
          benefit: ['Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin']
        },
        {
          category: 'Technology',
          price: 195,
          benefit: ['Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin']
        },
        {
          category: 'Education',
          price: 142,
          benefit: ['Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin']
        },
        {
          category: 'Publishing',
          price: 132,
          benefit: ['Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin']
        },
        {
          category: 'Medicine',
          price: 122,
          benefit: ['Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin']
        }
      ]
    }
  },
  methods: {
    redirect(parameter) {
      ROUTER.push(parameter)
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
  margin-left: 50px;
  border-top-left-radius: 22.5px;
  border-top-right-radius: 22.5px;
  max-width: 350px;
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

