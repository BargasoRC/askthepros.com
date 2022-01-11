<template>
  <div id="testimonials" class="sectionn">
    <center>
      <h1>Spend your valuable time making sales</h1>
    </center>
    <div id="tcard">
      <carousel>
        <slide v-for="(item, index) in testimonials" :key="index" style="padding-right: 5%; padding-left: 5%">
          <div style="align-items: center; padding-left: 45%; padding-right: 45%"><img id="company" :src="item.company"></div>
          <p><i class="fas fa-quote-left"></i></p>
          <div class="comment-section">
          <h6>{{item.comment}}</h6>
          </div>
          <hr/>
          <div class="row">
            <div class="column photo" style=""><img id="photo" :src="item.photo"></div>
            <div class="column name-job" style="">
              <p id="name">{{item.name}}</p>
              <p id="job">{{item.job}}</p>
            </div>
          </div>
        </slide>
      </carousel>
    </div>
  </div>
</template>

<script>
import ROUTER from 'src/router'
import { Carousel, Slide } from 'vue-carousel'
export default {
  components: {
    Carousel,
    Slide
  },
  data(){
    return{
      testimonials: [
        {
          company: require('assets/img/just-us-insurance.png'),
          comment: 'David Wolfe with Wolfe Media worked with my daughter Heather and I to create a video that conveyed our Business..... David was incredibly Helpful and Knowledgeable.... he allowed as to do as much or a little input that we felt comfortable with.... David also gave easy instructions on what he needed to create the video... David exceeded our expectations.... Excellent Job David.... Thanks Jay and Heather Gray - Just Us Insurance, San Marcos, Ca ',
          photo: require('assets/img/jay-gray.jpg'),
          name: 'Jay Gray',
          job: 'Medicare Agent'
        },
        {
          company: require('assets/img/aging-at-altitude.jpg'),
          comment: `David Wolfe is an expert when it comes to digital marketing. His knowledge about Google My Business and overall optimization has launched my online presence into a whole new level. Highly recommend looking no further if you're looking for a valuable resource in overall digital/video marketing. `,
          photo: require('assets/img/Mary-Hansen.jpg'),
          name: 'Mary Hansen',
          job: 'Medicare Agent'
        },
        {
          company: null,
          comment: `Wolfe Media just made my first Business video for my husband & I. We really didn't know what we were doing. But he put it all together & madw it look perfect. I highly recommend using them for Video Production. `,
          photo: require('assets/img/deina-prof.jpg'),
          name: 'Deina Hildebrand',
          job: 'Medicare Agent'
        },
        {
          company: null,
          comment: `I feel so confident from the help I received from David Wolfe about my marketing my Google business. He took the time to answer all my questions. I think Wolfe Media is incredible! `,
          photo: require('assets/img/Janetta-Bouman.jpg'),
          name: 'Janetta Bouman',
          job: 'Medicare Agent'
        },
        {
          company: null,
          comment: `David has helped me put together videos, helped me market My Google Business page and really helped my social presence overall and taken it to a whole new level. He's been awesome and I highly recommend him to all my peers! `,
          photo: require('assets/img/Zeb-Christensen.jpg'),
          name: 'Zeb Christensen',
          job: 'Medicare Agent'
        },
        {
          company: require('assets/img/just-us-insurance.png'),
          comment: `Bill Kellaway with BackOfficeDesigns.com has done an incredible job with our JustusInsurance.com and also our Insr4u.com... Both of our websites are enterprise class websites. BIll has been very patient with my daughter Heather and myself throughout the years, helping us with any tweaks we need on the website... I have known Bill for over 25 years, and there is no one that know of that has more knowledge about Websites / Search Engine Marketing / Internet Strategies. Bill is a 5 Star kind of guy in our Book. `,
          photo: require('assets/img/jay-gray.jpg'),
          name: 'Jay Gray',
          job: 'Medicare Agent'
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
hr {
  background-color: $primary;
  margin-top: 20px;
  margin-bottom: 20px;
}
.photo{
  width:10%;
  margin-left: 1em;
}
.name-job{
  width:70%; 
}
.comment-section{
  height: 30vh;
}
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
  padding-top: 5%;
  padding-right: 5%;
  padding-left: 5%;
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
  margin: 5%;
  min-height: 50vh;
  border-radius: 5px;
  float: left;
  width: 32%;
}
@media screen and (max-width: 1525px) {
  .comment-section{
    height: 45vh!important;
  }
  .name-job{
    margin-left: 1em !important;
  }
  .photo{
    margin-left: 1em!important;
  }
}

@media screen and (max-width: 991px) {
  .comment-section{
    height: 50vh !important;
  }
  .name-job{
    margin-left: 20px!important;
  }
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
  height: 50px;
  // width: 120px;
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

#photo {
  height: 50px;
  width: 50px;
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
@media screen and (max-width: 786px) {
  .comment-section{
      height: 55vh!important;
  }

}
@media screen and (max-width: 767px) {
  .single-card {
    width: 90%;
    margin: 5%;
  }
}
</style>
