<template>
  <div id="testimonials" class="sectionn">
    <div class="container">
      <center>
        <p id="topheader">TESTIMONIALS</p>
        <h1>What our clients says about us.</h1>
      </center>
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
          comment: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna sed do eiusmod tempor incig didunt ut labore et dolore magna sd gsgr gg   gdgdfg   aliqua. ',
          photo: require('assets/img/temp-image.jpg'),
          name: 'Juan Dela Cruz',
          job: 'Founder, SOS Company'
        },
        {
          company: require('assets/img/temp-comp1.png'),
          comment: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna sed do eiusmod tempor incig didunt ut labore et dolore magna sd gsgr gg   gdgdfg   aliqua. ',
          photo: require('assets/img/temp-image2.jpg'),
          name: 'Jane Millers',
          job: 'CMO, Company.com'
        },
        {
          company: require('assets/img/temp-comp2.png'),
          comment: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna sed do eiusmod tempor incig didunt ut labore et dolore magna sd gsgr gg   gdgdfg   aliqua. ',
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
  background-color: #01004E;
  min-height: 100vh;
  width: 100%;
}

center {
  padding-top: 15vh;
}
#tcard{
  padding-bottom: 15vh;
}


* {
  box-sizing: border-box;
}

.holder {
  padding-top: 5vh;
  padding-bottom: 20vh;
}

h1 {
  font-weight: 650;
  color: $warning;
  font-size: 35px;
}

#topheader {
  font-size: 24px;
  color: $white;
}
p {
  font-size: 15px;
  color: $title;
}

.single-card {
  background-color: $white;
  padding: 30px;
  margin: 0.5%;
  min-height: 500px;
  border-radius: 5px;
  float: left;
  width: 32%;
}

@media screen and (max-width: 767px) {
  .single-card {
    width: 90%;
    margin: 5%;
  }
  h1 {
  font-size: 30px;
  }
  #topheader {
  font-size: 20px;
  }
}

#company {
  height: 70px;
}

.card-image{
  text-align: center;
}

p .fas {
  color: $warning;
  font-size: 24px;
  margin-top: 60px;
  text-align: left;
}

h6 {
  font-weight: normal;
  text-align: justify;
  font-size: 16px;
  min-height: 170px;
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
  font-size: 15px;
  font-weight: bold;
}

#job{
  font-size: 15px;
  margin-top: -20px ;
  font-weight: 400;
}
</style>

