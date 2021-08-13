<template>
  <div class="container-fluid">
    <section>
      <div class="row">
        <div class="col d-flex justify-content-center align-items-center myheader1">
          <p class="header-text-1">Become the Local Pro with Automated Social Media Posting</p>
        </div>
      </div>
    </section>
    <div class="row no-gutters mb-5" >
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
            :style="{ backgroundImage: 'url(' + image.alt + ')' }"
          ></div>
      </div>
      <div class="col">
      <Industry></Industry>
      </div>
    </div>
    <div class="row mb-5">
      <div class="col d-flex justify-content-center align-items-center myheader2">
        <p class="header-text-2 text-center">3 Posts / Week to Google My Business, Facebook & LinkedIn <br> written by subject matter experts in your field.</p>
      </div>
    </div>
  </div>
</template>
<style scoped lang="scss">
@import "~assets/style/colors.scss";
.myheader1 {
  height: 13vh;
  background-color: #01009A;
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
</style>

<script>
import CoolLightBox from 'vue-cool-lightbox'
import 'vue-cool-lightbox/dist/vue-cool-lightbox.min.css'
import Industry from 'src/modules/home/new/Industry.vue'
export default {
  components: {
    CoolLightBox,
    Industry
  },
  data() {
    return {
      items: [
        {
          title: 'title',
          description: 'desc',
          thumb: 'https://images.pexels.com/photos/2764678/pexels-photo-2764678.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260',
          alt: require('assets/img/banner.jpg'),
          src: 'https://www.youtube.com/embed/DkRIdQa9otU',
          autoplay: true
        }
      ],
      index: null,
      imageIndex1: null
    }
  },
  methods: {
    caller(){
      // this.index = imageIndex
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
