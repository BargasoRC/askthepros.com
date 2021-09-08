<template>
  <div class="container-fluid p-0">
    <div class="bgImg">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
  <path fill="#0099ff" fill-opacity="1" d="M0,160L60,138.7C120,117,240,75,360,96C480,117,600,203,720,234.7C840,267,960,245,1080,218.7C1200,192,1320,160,1380,144L1440,128L1440,0L1380,0C1320,0,1200,0,1080,0C960,0,840,0,720,0C600,0,480,0,360,0C240,0,120,0,60,0L0,0Z"></path>
</svg>
    </div>
    <section>
      <div class="row ">
        <div class="col d-flex flex-column align-items-center myheader1">
        <div class="col-6 d-flex align-items-center justify-content-center ">
          <p class="header-text-1">Manage Social Media Posting Written by Industry Experts in your Field</p>    
        </div>
        <div class="col d-flex align-items-center align-content-center justify-content-center ">
          <p class="subHeader" >You - Save time and Money - Concentrate on Sales</p>
        </div>
        <div class="col-4">
          <roundedSelectBtn 
                :placeholder="'Select Industry'"
                :items="returnIndustry"
                :class="''"
                :styles="{width: '600px'
                }"
                @onSelect="onSelect"
            />
            <button type="button" class="btn btn-warning btn-lg" style="font-size:20px" @click="redirect('/signup')">Search <i class="fas fa-angle-double-right"></i></button>
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
.bgImg {
  width: 100%;
  z-index: -9999;
  position: absolute;
}
.subHeader{
  font-size:20px;
  font-weight: bold;
  color: rgb(241, 184, 20);
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
  // background-image: url('http://www.w3.org/2000/svg');
  // <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#0099ff" fill-opacity="1" d="M0,256L60,266.7C120,277,240,299,360,288C480,277,600,235,720,202.7C840,171,960,149,1080,165.3C1200,181,1320,235,1380,261.3L1440,288L1440,0L1380,0C1320,0,1200,0,1080,0C960,0,840,0,720,0C600,0,480,0,360,0C240,0,120,0,60,0L0,0Z"></path></svg>
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
      industry: global.industry,
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
  },
  methods: {
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
