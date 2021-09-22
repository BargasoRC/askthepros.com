<template>
  <div id="testimonials" class="sectionn">
    <center>
      <h1>Spend your valuable time making sales</h1>
    </center>
    <div class="container">
      <div class="row holder" id="tcard">
        <div class="column single-card" v-for="(item, index) in testimonials" :key="index">
          <div class="card-image"><img id="company" :src="item.company"></div>
          <p><i class="fas fa-quote-left"></i></p>
          <h6>{{item.comment}}</h6>
          <hr/>
          <div class="row">
            <div class="column" style="width:30%"><img id="photo" :src="item.photo"></div>
            <div class="column" style="width:70%">
              <p id="name">{{item.name}}</p>
              <p id="job">{{item.job}}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import ROUTER from 'src/router'
export default {
  data(){
    return{
      testimonials: [
        {
          company: require('assets/img/temp-comp.png'),
          comment: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.  ',
          photo: require('assets/img/temp-image.jpg'),
          name: 'Juan Dela Cruz',
          job: 'Founder, SOS Company'
        },
        {
          company: require('assets/img/temp-comp1.png'),
          comment: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. ',
          photo: require('assets/img/temp-image2.jpg'),
          name: 'Jane Millers',
          job: 'CMO, Company.com'
        },
        {
          company: require('assets/img/temp-comp2.png'),
          comment: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. ',
          photo: require('assets/img/temp-image1.jpg'),
          name: 'John Doe',
          job: 'CEO, ABC Company'
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
  min-height: 80vh;
  width: 100%;
  float: left;
  margin-top: 5vh;
}

.container{
  margin-top: 5vh;
}

center {
  background-color: #01009a;
  padding-bottom: 2vh;
  padding-top: 2vh;
}

#tcard{
  padding-bottom: 15vh;
}


* {
  box-sizing: border-box;
}

.holder {
  padding-top: 10vh;
  padding-bottom: 15vh;
}

h1 {
  color: white;
  margin-top: 5vh;
  margin-bottom: 5vh;
  font-weight: bold;
}

p {
  font-size: 16px;
}

.single-card {
  background-color: $white;
  box-shadow: -4px 8px 15px #e9e9e9;
  padding: 30px;
  margin: 0.5%;
  min-height: 50vh;
  border-radius: 5px;
  float: left;
  width: 32%;
}

@media screen and (max-width: 767px) {
  .single-card {
    width: 90%;
    margin: 5%;
  }
}

@media screen and (max-width: 991px) {
  h1{
    font-size: 150% !important;
  }

  h6{
    font-size: 14.5px !important;
  }

  p{
      font-size: 14px !important;
  }

  center {
    padding-bottom: 1.5vh !important;
    padding-top: 1.5vh !important;
  }

}
#company {
  height: 70px;
}

.card-image{
  text-align: center;
}

p .fas {
  color: $primary;
  font-size: 24px;
  margin-top: 2vh;
  text-align: left;
}

h6 {
  font-weight: normal;
  text-align: justify;
  font-size: 16px;
  min-height: 15vh;
}

hr {
  background-color: $primary;
  margin-top: 20px;
  margin-bottom: 20px;
}

#photo {
  height: 50px;
  border-radius: 50px;
  border: 1px solid $warning;
}

#name{
  margin-top: 10px ;
  font-weight: bold;
}

#job{
  margin-top: -20px ;
  font-weight: 400;
}
</style>

