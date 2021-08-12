<template>
  <div class="container-fluid">
    <section>
      <div class="row">
        <div class="col d-flex justify-content-center align-items-center myheader">
          <p class="header-text">Become the Local Pro with Automated Social Media Posting</p>
        </div>
      </div>
    </section>
    <div class="row" >
      <span>hello</span>
      <Industry></Industry>
      <CoolLightBox 
        :items="items" 
        :index="index"
        @close="index = null"
      />
      <div class="images-wrapper">
      <div
        class="image"
        v-for="(image, imageIndex) in items"
        :key="imageIndex"
        @click="index = imageIndex"
        :style="{ backgroundImage: 'url(' + image.thumb + ')' }"
      ></div>
      </div>
    </div>
  </div>
</template>
<style scoped lang="scss">
@import "~assets/style/colors.scss";
.myheader {
  height: 20vh;
  background-color: #01009A;
}
.header-text {
  color: white;
  font-size: 40px;
  font-weight: 600;
  font-family: "Work Sans", Sans-serif;
}
.image {
  height: 50vh;
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
          title: 'Adamantium walls and plasteel bulkheads may seem formidable, but an unshakeable faith in the Immortal Emperor of Man can overcome any barriers',
          description: 'Only in death does duty end',
          thumb: 'https://cosmos-images2.imgix.net/file/spina/photo/20565/191010_nature.jpg?ixlib=rails-2.1.4&auto=format&ch=Width%2CDPR&fit=max&w=835',
          src: 'https://www.youtube.com/embed/DkRIdQa9otU'
        }
      ],
      index: null
    }
  },
  methods: {
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
