<template>
  <div class="container-fluid p-0 mainContainer">
    <div class="bgImg">
      <div class="cloudLeft">
        <img :src="require('assets/img/leftcloud.png')">
      </div>
      <div class="cloudRight">
        <img :src="require('assets/img/rightcloud.png')">
      </div>
    </div>
    <section>
      <div class="row banner-content">
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
  height: 45vh;
  background: linear-gradient(to right,#01009A,#01009A);
  //z-index: -999;
}
.background-blue{
  color: red;
  height: 50vh;
  width: 500px;
  justify-content: center;
  text-align: center;
  position: absolute;
  z-index: 250;
}
.cloudRight{
  height: 100%;
  position: absolute;
  right: 0px;
  z-index: 100;
  float: right;
  top: 24vh;
}
.cloudLeft{
 height: 100%;
  position: absolute;
  left: 0px;
  z-index: 100;
  float: left;
  top: 25vh;
}


.bgImg {
  width: 100%;
  height: 100%;
  position: absolute;
}
.banner-content{
  z-index: 200;
}
.subHeader{
  font-size:20px;
  font-weight: bold;
  color: white;
  //z-index: 200;
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
  //z-index: 1000;
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
  //z-index: 200;
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
    box-shadow: 0 0 0 0 rgb(209, 209, 209);
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
