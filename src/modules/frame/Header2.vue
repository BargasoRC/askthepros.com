<template>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">
        <img 
          :src="require('../../assets/img/asktheprooslogo-clear.png')" 
          class="logo-brand"
          @click="navigate('')"
        />
      </a>
    </div>
    <div class="navbar-header">
      <a href="#">
        <button 
            class="navbar-toggler" 
            type="button" 
            @click="showSidebar()"
          >
          <i class="navbar-toggler-icon"></i>
        </button> 
      </a>
    </div>
    <div class="sidebar container" id="navbarSupportedContent" v-if="!isActive">
        <div id="dismiss" class="flex-row">
          <i class="fas fa-arrow-right" @click="showSidebar()"></i>
        </div>
        <div class="sidebar-header">
            <h3>Bootstrap Sidebar</h3>
        </div>
        <ul class="nav navbar-nav navbar-right ml-auto">
        <li class="pl-5 pr-5 nav_item">
          <b class="font-weight-normal" @click="headerScrollTo('#learn-how')">Learn How</b>
        </li>
        <li class="pl-5 pr-5 nav_item">
          <b class="font-weight-normal" @click="headerScrollTo('#pricing')">Pricing</b>
        </li>
        <li class="pl-5 pr-5 nav_item">
          <b class="font-weight-normal" @click="headerScrollTo()">Contact Us</b>
        </li>
        <li class="pl-5 pr-5 nav_item" @click="navigate('login')">
          <b class="font-weight-normal"  :style="'color: ' + ($route.name == 'loginAccount' ? '#007bff' : 'black')">Login</b>
        </li>
        <li class="pl-5 pr-5 nav_item" @click="navigate('signup')">
          <b class="font-weight-normal" :style="'color: ' + ($route.name == 'signup' ? '#007bff' : 'black')">Register</b>
        </li>
      </ul>
    </div>
    <!-- <div class="navbar-collapse text-center" id="navbarSupportedContent">
      <ul class="nav navbar-nav navbar-right ml-auto">
        <li class="pl-5 pr-5 nav_item">
          <b class="font-weight-normal" @click="headerScrollTo('#learn-how')">Learn How</b>
        </li>
        <li class="pl-5 pr-5 nav_item">
          <b class="font-weight-normal" @click="headerScrollTo('#pricing')">Pricing</b>
        </li>
        <li class="pl-5 pr-5 nav_item">
          <b class="font-weight-normal" @click="headerScrollTo()">Contact Us</b>
        </li>
        <li class="pl-5 pr-5 nav_item" @click="navigate('login')">
          <b class="font-weight-normal"  :style="'color: ' + ($route.name == 'loginAccount' ? '#007bff' : 'black')">Login</b>
        </li>
        <li class="pl-5 pr-5 nav_item" @click="navigate('signup')">
          <b class="font-weight-normal" :style="'color: ' + ($route.name == 'signup' ? '#007bff' : 'black')">Register</b>
        </li>
      </ul>
    </div> -->
  </nav>
</template>

<script>
import Jquery from 'jquery'
export default {
  created() {
  },
  components: {},
  data: () => ({
    isActive: false
  }),
  computed: {
  },
  methods: {
    navigate(route) {
      this.$router.push(`/${route}`)
    },
    headerScrollTo(id) {
      let height = Jquery(window).height()
      Jquery('html, body').animate(
        {
          scrollTop: Jquery(id).offset().top - parseInt(height * 0.0)
        },
        500
      )
    },
    showSidebar(){
      this.isActive = !this.isActive
    }
  }
}
</script>
<style scoped lang="scss">
@import "~assets/style/colors.scss";
.sidebar{
  min-width: 50%;
  max-width: 50%;
  height: 100vh;
  position: fixed;
  top: 0;
  right: 0;
  /* top layer */
  z-index: 9999;
  background-color: white;
}
#dismiss {
    width: 35px;
    height: 35px;
    position: absolute;
    /* top right corner of the sidebar */
    top: 10px;
    right: 10px;
}
.nav_item {
  cursor: pointer;
}
.navigationBar {
  width: 100%;
	position: fixed;
	top: 0;
  z-index: 100;
}
.navbar {
   background: none !important;
}
.navbar-header {
  background: none !important;
}
#navbarSupportedContent {
  
}
.navbar-brand .logo-brand {
  // width: 100px;
  // height: 100px;
  // margin-left: 5% !important
}
.nav-link .navbar-brand {
  font-size: 30px;
}
.notificationBar {
  background-color: #FF0045;
  width: 100%;
  z-index: 100;
  padding-left: 48%;
  display: flex;
  align-items: center;
  justify-content: space-between;
  color: #FFFFFF;
  height: 60px;
  margin-bottom: 50px !important;
}
.navbar-menu-toggler-md{
  height: 50px;
  float: left;
  text-align: center;
  font-size: 16px;
  color: #fff;
  line-height: 50px;
  display: none;
}
.navbar-menu-toggler-md:hover{
  cursor: pointer;
  background: $primary;
}

.active-menu{
  background: $primary;
}


 @media (min-width: 1200px){
    .system-header{
      width: 50% !important;
    }
    .header-navbar{
      width: 50% !important;
      margin-left: 18%;
    }
    .header-navbar-nav{
      width: 15% !important;
    }
    .navbar-menu-toggler-md{
      display: none;
    }
    .left-menu-icons{
      width: 40% !important;
    }
    .right-menu-icons{
      width: 60% !important;
    }
    .nav-item{
      width: 5% !important;
    }
    .logo-brand{
      // margin-left:-50% !important;
      width: 230px !important;
      height: 100px !important;
      margin-left: 5% !important
    }
  }

 @media (max-width: 1199px){
    .system-header{
      width: 70% !important;
    }
    .header-navbar{
      width: 30% !important;
      margin-left: 70% !important;
    }
    .header-navbar-nav{
      width: 30%;
    }
    .navbar-menu-toggler-md{
      display: none;
    }
    .left-menu-icons{
      width: 60% !important;
    }
    .right-menu-icons{
      width: 40%;
    }
    .nav-item{
      width: 10%;
    }
    .logo-brand{
      width: 80px !important;
      height: 50px !important;
      margin-left:-1% !important;
    }
  }

@media (max-width: 991px){
   .system-header{
      width: 30%;
    }
    .header-navbar{
      width: 70%;
      margin-left: 30%;
    }
   .header-navbar-nav{
      width: 30%;
    }
    .navbar-menu-toggler-md{
      width: 10%;
      text-align: center;
      display: block;
    }
    .left-menu-icons{
      width: 60% !important;
    }
    .right-menu-icons{
      width: 40% !important;
    }
    .nav-item{
      width: 10%;
    }
    .logo-brand{
      margin-left:-1% !important;
      width: 80px !important;
      height: 50px !important;
      margin-left: 5% !important
    }
 }

/*-------------- Small Screen for Mobile Phones --------------*/
 @media (max-width: 767px){
    .header-margin{
     width: 10% !important;
    }
    
    .system-header{
      width: 15%;
    }
    
    .navbar-brand{
      width: 90% !important;
      margin: 0px !important;
    }
    
    .header-navbar{
      width: 85%;
      margin-left: 15%;
    }

    .nav-item{
      width: 20%;
    }

    .logo-brand{
      width: 80px !important;
      height: 50px !important;
    }

    .left-menu-icons{
      width: 40% !important;
    }

    .right-menu-icons{
      width: 60% !important;
    }

    .hide-on-mobile{
      display: none !important;
    }
  }

  @media (max-width: 300px){
    .logo-brand{
      width: 30px;
      height: 30px;
    }
  }
</style>
