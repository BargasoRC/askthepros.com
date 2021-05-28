<template>
    <div class="jumbotron jumbotron-fluid banner" style="height:786px;padding-top:0px;padding-bottom:0px;margin-bottom:0px">
      <div class="container-fluid" style="padding-left:50%;padding-top:15%;padding-right:65px;">
        <div class="row">
          <h1 class="display-4 banner-text">
            <p style="color:#01004E">Become A Local Expert</p>            
            <p style="color:#01009A">With Automated Social Media<br>Posting.</p>
            </h1>
        </div>
        <div class="row d-flex-md-column justify-content-md-start" style="margin-top:2%;"> 
          <div class="col-md-auto  position-absolute" >
              <dialogueBtn :onClick="login" :icon="'fas fa-sign-in-alt'" :text="'Login'" :styles="{backgroundColor: '#01004E',color: 'white', marginTop: '20px'}"/> 
          </div>
          <div class="col-md-auto " >
            <dialogueBtn :onClick="register" :icon="'fas fa-sign-in-alt'" :text="'Register'" :styles="{backgroundColor: '#F1B814',color: 'white', marginTop: '20px'}"/> 
          </div>
        </div>
      </div>
      <div class="row">
        
      </div>
    </div>
</template>
<style scoped lang="scss">
@import "~assets/style/colors.scss";
.banner {
    // background: linear-gradient(180deg, #FFFFFF 6.77%, rgba(255, 255, 255, 0.782123) 19.79%,
    // rgba(255, 255, 255, 0.326451) 63.54%, rgba(255, 255, 255, 0.535072) 76.04%, rgba(255, 255, 255, 0.184593) 86.46%, rgba(255, 255, 255, 0) 100%), 
    // url("../../assets/img/banner.jpg");
    // background-repeat: no-repeat;
    // background-size: cover;
    // position: relative;
    // background-attachment: fixed;
    // background-position: center top;
}
.banner-text {
  font-family:Roboto;
  font-weight:700;
  font-size:50px;
}
// For Large Screens
@media (min-width:1199px){
.banner-text {
  font-size:60px;
}  
}
// For Medium Screens
@media (min-width: 991px) {
.banner-text {
  font-size:40px;
}
// For Small Screens
@media (max-width: 768px){
.banner-text {
 font-size: 20px;
}
}
}
</style>

<script>
import dialogueBtn from 'src/modules/generic/dialogueBtn.vue'
export default {
  components: {
    dialogueBtn
  },
  data() {
    return {}
  },
  methods: {
  }
}
</script>
