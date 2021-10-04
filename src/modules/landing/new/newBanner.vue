<template>
  <div class="cloud-image">
    <div class="text-center container">
      <h1 class="text-white">MANAGED SOCIAL MEDIA POSTING WRITTEN BY INDUSTRY EXPERTS IN YOUR FIELD</h1>    
      <p class="text-white"><b>1.</b> Create & Import Profile &nbsp;&nbsp;<b>2.</b> Just Relax &nbsp;&nbsp;<b>3.</b> Grow your Sales</p>
      <span class="text-center category-selection" v-if="industry && industry.length > 0">
        <select class="form-control" v-model="selected">
          <option v-for="(item, index) in industry" :value="item.category">{{item.category}}</option>
        </select>
        <button class="btn redirect-btn" @click="register()">Try It Now!</button>
      </span>
    </div>

    <div class="left">
      <img :src="require('assets/img/leftcloud.png')">
    </div>
    <div class="right">
      <img :src="require('assets/img/rightcloud.png')">
    </div>
  </div>
</template>
<style scoped lang="scss">
@import "~assets/style/colors.scss";
.cloud-image{
  width: 100%;
  background: $primary;
  min-height: 20vh;
  overflow-y: hidden;
}

.container{
  margin-top: 15vh;
}


.category-selection{
  width: 70%;
  float: left;
  margin-left: 15%;
  margin-right: 15%;
  margin-top: 2vh;
}

.form-control{
  border-top-left-radius: 25px !important;
  border-bottom-left-radius: 25px !important;
  border-top-right-radius: 0px !important;
  border-bottom-right-radius: 0px !important;
  height: 50px !important;
  width: 80%;
  padding-left: 5%;
  margin: auto;
  border: none !important;
  float: left !important;
  font-size: 16px;
}

.btn{
  float: left;
  font-size: 16px;
}

.redirect-btn{
  border-top-right-radius: 25px !important;
  border-bottom-right-radius: 25px !important;
  border-top-left-radius: 0px !important;
  border-bottom-left-radius: 0px !important;
  height: 50px !important;
  width: 20%;
  border: none !important;
  background: $warning;
}

.left{
  width: 50%;
  float: left;
  background: $primary;
  z-index: 10;
}

.right{
  width: 50%;
  float: left;
  background: $primary;
}

.left img, .right img{
  height: 18vh;
  width: auto;
  margin-top: -10vh;
}

.right img{
  float: right;
}

h1{
  width: 90%;
  margin-left: 5%;
  margin-right: 5%;
  font-weight: bold;
  font-size: 36px;
}

p{
  font-size: 20px;
  margin-top: 25px;
}

b{
  color: $warning;
}


@media (max-width: 1400px) {
  .left img, .right img{
  height: 15vh !important;
  width: auto;
  margin-top: -6vh !important;
} 
}

@media (max-width: 1060px) {
  .left img, .right img{
  height: 12vh !important;
  width: auto;
  margin-top: -6vh !important;
} 
}

@media (max-width: 991px){
  .category-selection{
    width: 80% !important;
    margin-left: 10% !important;
    margin-right: 10% !important;
    margin-bottom: 2vh;
  }

  h1{
    font-size: 150%;
    width: 100%;
    margin: unset;
  }

  p{
    font-size: 120%;
  }

  .form-control{
    width: 60%;
    height: 40px !important;
    font-size: 14.5px !important;
  }

  .redirect-btn{
    width: 40%;
    height: 40px !important;
    font-size: 14.5px !important;
  }
}


@media (max-width: 548px){
  .category-selection{
    width: 90% !important;
    margin-left: 5% !important;
    margin-right: 5% !important;
    margin-bottom: 2vh;
  }
}

@media (max-width: 870px) {
  .left img, .right img{
  height: 9vh !important;
  width: auto;
  margin-top: -3vh !important;
} 
}

@media (max-width: 620px) {
  .left img, .right img{
  height: 5vh !important;
  width: auto;
  margin-top: 0 !important;
} 
}
</style>

<script>
import CoolLightBox from 'vue-cool-lightbox'
import 'vue-cool-lightbox/dist/vue-cool-lightbox.min.css'
import Industry from 'src/modules/landing/new/Industry.vue'
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
      selected: null
    }
  },
  mounted(){
    this.$root.$on('openVideo', () => {
      this.index = 0
    })
    setTimeout(() => {
      this.retrievePayloads()
    }, 1000)
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
      console.log('[parameter]', parameter)
      $('#loading').css({'display': 'block'})
      this.APIRequest('payloads/retrieve', parameter).then(response => {
        $('#loading').css({'display': 'none'})
        if(response.data.length > 0) {
          this.industry = response.data
          this.selected = response.data[0].category
        }else{
          this.industry = []
        }
      }).catch(error => {
        $('#loading').css({'display': 'none'})
        error
      })
    },
    login(){
      this.redirect('login')
      window.scrollTo(0, 0)
    },
    register(){
      if(this.selected){
        this.redirect('signup/' + this.selected)
      }else{
        this.redirect('signup')
      }
      window.scrollTo(0, 0)
    },
    redirect(parameter){
      this.$router.push(parameter)
    }
  }
}
</script>
