<template>
  <div class="cloud-image">
    <div class="text-center banner-content">
      <h1 class="text-white">Manage Social Media Posting Written by Industry Experts in your Field</h1>    
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
  float: left;
  background: $primary;
  min-height: 30vh;
  overflow-y: hidden;
}

.banner-content{
  width: 100%;
  float: left;
  margin-top: 20vh;
}


.category-selection{
  width: 40%;
  float: left;
  margin-left: 30%;
  margin-right: 30%;
  margin-top: 2vh;
}

.form-control{
  border-top-left-radius: 25px !important;
  border-bottom-left-radius: 25px !important;
  border-top-right-radius: 0px !important;
  border-bottom-right-radius: 0px !important;
  height: 50px !important;
  width: 80%;
  margin: auto;
  border: none !important;
  float: left !important;
}

.btn{
  float: left;
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
}

.right{
  width: 50%;
  float: left;
  background: $primary;
}

.left img, .right img{
  height: 15vh;
}

.right img{
  float: right;
}

h1{
  width: 50%;
  margin-left: 25%;
  margin-right: 25%;
}

p{
  font-size: 24px;
  margin-top: 25px;
}

b{
  color: $warning;
}


@media (max-width: 991px){
  .category-selection{
    width: 100%;
    margin: unset;
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
  }

  .redirect-btn{
    width: 40%;
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
          this.selected = response.data[0].category
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
