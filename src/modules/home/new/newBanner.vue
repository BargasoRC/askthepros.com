<template>
  <div class="container-fluid p-0 mainContainer">
    <div class="bgImg">
    <!-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
  <path fill="#0099ff" fill-opacity="1" d="M0,160L60,138.7C120,117,240,75,360,96C480,117,600,203,720,234.7C840,267,960,245,1080,218.7C1200,192,1320,160,1380,144L1440,128L1440,0L1380,0C1320,0,1200,0,1080,0C960,0,840,0,720,0C600,0,480,0,360,0C240,0,120,0,60,0L0,0Z"></path>
</svg> -->
<div class="cloudLeft">
  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#ffffff" fill-opacity="1" d="M0,320L16,304C32,288,64,256,96,218.7C128,181,160,139,192,144C224,149,256,203,288,234.7C320,267,352,277,384,266.7C416,256,448,224,480,181.3C512,139,544,85,576,74.7C608,64,640,96,672,138.7C704,181,736,235,768,261.3C800,288,832,288,864,266.7C896,245,928,203,960,170.7C992,139,1024,117,1056,128C1088,139,1120,181,1152,218.7C1184,256,1216,288,1248,266.7C1280,245,1312,171,1344,133.3C1376,96,1408,96,1424,96L1440,96L1440,320L1424,320C1408,320,1376,320,1344,320C1312,320,1280,320,1248,320C1216,320,1184,320,1152,320C1120,320,1088,320,1056,320C1024,320,992,320,960,320C928,320,896,320,864,320C832,320,800,320,768,320C736,320,704,320,672,320C640,320,608,320,576,320C544,320,512,320,480,320C448,320,416,320,384,320C352,320,320,320,288,320C256,320,224,320,192,320C160,320,128,320,96,320C64,320,32,320,16,320L0,320Z"></path></svg>
</div>
<div class="cloudRight">
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#ffffff" fill-opacity="1" d="M0,320L16,304C32,288,64,256,96,218.7C128,181,160,139,192,144C224,149,256,203,288,234.7C320,267,352,277,384,266.7C416,256,448,224,480,181.3C512,139,544,85,576,74.7C608,64,640,96,672,138.7C704,181,736,235,768,261.3C800,288,832,288,864,266.7C896,245,928,203,960,170.7C992,139,1024,117,1056,128C1088,139,1120,181,1152,218.7C1184,256,1216,288,1248,266.7C1280,245,1312,171,1344,133.3C1376,96,1408,96,1424,96L1440,96L1440,320L1424,320C1408,320,1376,320,1344,320C1312,320,1280,320,1248,320C1216,320,1184,320,1152,320C1120,320,1088,320,1056,320C1024,320,992,320,960,320C928,320,896,320,864,320C832,320,800,320,768,320C736,320,704,320,672,320C640,320,608,320,576,320C544,320,512,320,480,320C448,320,416,320,384,320C352,320,320,320,288,320C256,320,224,320,192,320C160,320,128,320,96,320C64,320,32,320,16,320L0,320Z"></path></svg>
</div>
    </div>
    <section>
      <div class="row">
        <div class="col d-flex flex-column align-items-center myheader1">
        <div class="col-6 d-flex align-items-center justify-content-center ">
          <p class="header-text-1">Manage Social Media Posting Written by Industry Experts in your Field</p>    
        </div>
        <div class="col d-flex align-items-center align-content-center justify-content-center ">
          <p class="subHeader" >You - Save time and Money - Concentrate on Sales</p>
        </div>
        <div class="col-4">
          <roundedSelectBtn 
                :placeholder="'Choose your Industry'"
                :items="returnIndustry"
                :class="''"
                :styles="{width: '600px'
                }"
                @onSelect="onSelect"
            />
            <button type="button" class="btn btn-warning btn-lg" style="font-size:15px" @click="redirect('/signup')">Try it Now!</button>
        </div>
        </div>

      </div>
    </section>
    <!-- Keeping just in case video option might get used -->
    <!-- <div class="row no-gutters mb-5" >
      <div class="col pt-5 m-auto">
        <CoolLightBox 
          :items="items" 
          :index="index"
          @close="index = null">
        </CoolLightBox>
          <div
            class="image"
            v-for="(image, imageIndex) in items"
            :key="imageIndex"
            @click="index = imageIndex"
            :style="{ backgroundImage: 'url(' + image.thumb + ')' }"
          >
          <div class="play-btn">
            <i class="fa fa-play-circle" aria-hidden="true"></i>
          </div>
          </div>
      </div>
      <div class="col">
      <Industry></Industry>
      </div>
    </div> -->
    <!-- <div class="row mb-5">
      <div class="col d-flex justify-content-center align-items-center myheader2">
        <p class="header-text-2 text-center">3 Posts / Week to Google My Business, Facebook & LinkedIn <br> written by subject matter experts in your field.</p>
      </div>
    </div> -->
  </div>
</template>
<style scoped lang="scss">
@import "~assets/style/colors.scss";
.mainContainer{
  height: 50vh;
  background: linear-gradient(to right,#5c99ed,#5c99ed);
  z-index: -999;
}
.cloudRight{
  width: 50%;
  margin-top: 170px;
  position: absolute;
  right: 0px;
}
.cloudLeft{
  transform: scaleX(-1);
  width: 55%;
  margin-top: 150px;
  position: absolute;
  left: 0px;
}
.bgImg {
  width: 100%;
  z-index: 100;
  position: absolute;
}
.subHeader{
  font-size:20px;
  font-weight: bold;
  color: white;
  z-index: 200;
}
.btn-warning{
  height: 45px!important;
  border-radius:0px 20px 20px 0px;
  position: absolute;
  right: 0px;
  top: 0px;
}
.myheader1 {
  height: 50vh;
  // background: linear-gradient(to right,#5c99ed,#5c99ed);
  background-color: transparent;
  z-index: 1000;
}
.myheader2 {
  height: 30vh;
  background-color: white;
  color: #01009A;
}
.header-text-1 {
  color: white;
  font-size: 40px;
  font-weight: 600;
  font-family: "Work Sans", Sans-serif;
  height: 10vh;
  text-align: center;
  z-index: 200;
}
.header-text-2 {
  color: #01009A;
  font-size: 40px;
  font-weight: 600;
  font-family: "Work Sans", Sans-serif;
}
.image {
  width: 500px;
  height: 300px;
  margin: 0 0 0 auto;
}
// button 
.play-btn {
    background: transparent;
    border-radius: 50%;
    text-align: center;
    line-height: 108px;
    animation: animate 2s linear;
    cursor: pointer;
    width: 100px;
    height: 100px;
    position: relative;
    left: 50%;
    top: 50%;
    transform: translate(-50%,-50%);
}
.play-btn i {
    color: grey;
    opacity: 0.75;
    font-size: 102px;
}
@keyframes animate{
  0%{
    box-shadow: 0 0 0 0 lightgrey;
  }
  40%{
    box-shadow: 0 0 0 50px rgba(255,193,7,0);
  }
  80%{
    box-shadow: 0 0 0 50px rgba(255,193,7,0);
  }
  100%{
    box-shadow: 0 0 0 rgba(255,193,7,0);
  }
}
</style>

<script>
import CoolLightBox from 'vue-cool-lightbox'
import 'vue-cool-lightbox/dist/vue-cool-lightbox.min.css'
import Industry from 'src/modules/home/new/Industry.vue'
import roundedSelectBtn from 'src/modules/generic/roundedSelectBtn'
import global from 'src/helpers/global'
export default {
  components: {
    CoolLightBox,
    Industry,
    roundedSelectBtn
  },
  data() {
    return {
      items: [
        {
          title: 'title',
          description: 'desc',
          thumb: require('assets/img/section3-img_small.png'),
          alt: require('assets/img/section3-img.png'),
          src: 'https://www.youtube.com/embed/DkRIdQa9otU',
          autoplay: true
        }
      ],
      index: null,
      imageIndex1: null,
      industry: [],
      global: global,
      selected: 2
    }
  },
  computed: {
    returnIndustry() {
      return this.industry.map(el => {
        return el.category
      })
    }
  },
  mounted(){
    this.$root.$on('openVideo', () => {
      this.index = 0
    })
    this.retrievePayloads()
  },
  methods: {
    retrievePayloads(){
      let conditions = [{
        value: 'subscriptions',
        clause: '=',
        column: 'payload'
      }]
      let parameter = {
        condition: conditions
      }
      $('#loading').css({'display': 'block'})
      this.APIRequest('payloads/retrieve', parameter).then(response => {
        $('#loading').css({'display': 'none'})
        if(response.data.length > 0) {
          console.log('Log', response)
          this.industry = response.data
        }else{
          this.industry = []
        }
      }).catch(error => {
        $('#loading').css({'display': 'none'})
        error
      })
    },
    onSelect(data) {
      console.log('SELECTED INDUSTRY: ', data)
      this.selected = data.index
      this.global.selectedIndustryIndex = data.index
    },
    login(){
      this.redirect('login')
      window.scrollTo(0, 0)
    },
    register(){
      this.redirect('signup')
      window.scrollTo(0, 0)
    },
    redirect(parameter){
      this.$router.push(parameter)
    }
  }
}
</script>
