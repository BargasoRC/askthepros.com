<template>
  
    <div class="jumbotron jumbotron-fluid banner">
      <div class="container-fluid banner-container" style="">
        <div class="row d-flex justify-content-center banner-container-row">
          <h1 class="display-4 banner-container-text">
            <p style="color:#01004E">Become A Local Expert</p>            
            <p style="color:#01009A">With Automated Social Media<br>Posting.</p>
            </h1>
        </div>
        <div class="row d-flex justify-content-center button-container" style=""> 
          <div class="col-md-auto d-flex-row position-absolute button-container-button" >
              <dialogueBtn :onClick="login" :icon="'fas fa-sign-in-alt'" :text="'Login'" :styles="{backgroundColor: '#01004E',color: 'white', marginTop: '20px', marginRight:'30px'}"/> 
              <dialogueBtn :onClick="register" :icon="'fas fa-sign-in-alt'" :text="'Register'" :styles="{backgroundColor: '#F1B814',color: 'white', marginTop: '20px'}"/> 
          </div>
        </div>
      </div>
    </div>
</template>
<style scoped lang="scss">
@import "~assets/style/colors.scss";
.banner {
    height:837px;
    padding-top:0px;
    padding-bottom:0px;
    margin-bottom:0px;
    background: linear-gradient(180deg, #FFFFFF 6.77%, rgba(255, 255, 255, 0.782123) 19.79%,
    rgba(255, 255, 255, 0.326451) 63.54%, rgba(255, 255, 255, 0.535072) 76.04%, rgba(255, 255, 255, 0.184593) 86.46%, rgba(255, 255, 255, 0) 100%), 
    url("../../assets/img/banner.jpg");
    background-repeat: no-repeat;
    background-size: cover;
    position: relative;
    background-position: center top;
}
.banner-container {
   padding-top:15%;
   padding-right:0%;
   padding-left:0%;
}
.banner-container-row {
  padding-left: 30%;
}
.banner-container-text {
  font-weight: 700;
}
.banner-text {
  font-family: 'Roboto';
  font-weight:700;
  font-size:50px;
  padding-left:30%;
}
.button-container {
  margin-top:2%;
  padding-left:20%;
}
// For Large Screens
@media (max-width:1199px){
.banner-container{
  padding-right: 0%;
  padding-left: 0%;
  padding-top: 20%;
}
.button-container {
  padding-left: 10%;
}
}
// For Medium Screens
@media (max-width: 991px) {
.banner-container{
  padding-top: 30%;
}
.banner-container-text {
  font-size:50px;
  padding-left: 0px;
  text-align: center;
}
.banner-container-row {
  padding-left: 0%;
}
.button-container {
  padding-left: 0%;
}
}
// For Small Screens
@media (max-width: 767px){
  .banner-container{
    // padding-top: 30%;
  }
  .banner-container-row {
    padding-left: 0%;
  }
.banner-container-text {
  font-size:40px;
  padding-left: 0px;
  text-align: center;
}
.button-container-button {
  display: flex;
  justify-content: center;
}
@media (max-width:500px){
  .banner-container-text {
    font-size: 30px;
  }
}
}
</style>

<script>
import dialogueBtn from 'src/modules/generic/dialogueBtn.vue'
import bannerContent from 'src/modules/frame/Content.vue'
export default {
  components: {
    dialogueBtn,
    bannerContent
  },
  data() {
    return {}
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
