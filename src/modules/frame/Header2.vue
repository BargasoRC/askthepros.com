<template>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="navbar-header"> 
      <a class="navbar-brand" href="#" >
        <img 
          :src="require('../../assets/img/asktheprooslogo-clear.png')" 
          class="logo-brand"
          @click="navigate('')"
        />
      </a>
    </div>
    <div class="navbar-header" >
      <a href="#">
        <button 
            class="navbar-toggler" 
            type="button" 
            @click="showSidebar()"
            style="border:none;color:#01004E"
          >
          <i class="fas fa-bars fa-2x"></i>
        </button> 
      </a>
    </div>
    <!-- Show when screen is <=991px -->
    <div class="sidebar contianer-fluid" id="navbarSupportedContent d-none d-sm-block" v-if="!isActive" >
        <div class="row w-100  justify-content-end no-gutters"  style="padding-right:20%; padding-top:20%; color:#01004E">
          <i class="fas fa-times fa-3x" @click="showSidebar()"></i>
        </div>
        <div class="row no-gutters justify-content-center nav-container">
            <div class="nav_item_m" @click="headerScrollTo('#learn-how')">
              <b class="font-weight-normal nav-text" href="#learn-how" @click="headerScrollTo('#learn-how')">How it Works</b>
            </div>
        </div>
        <!-- <div class="row no-gutters justify-content-center nav-container">
            <div class="nav_item_m" @click="headerScrollTo('#pricing')">
              <b class="font-weight-normal nav-text" href="#pricing"  @click="headerScrollTo('#pricing')">Pricing</b>
            </div>
        </div> -->
        <div class="row no-gutters justify-content-center nav-container">
            <div class="nav_item_m" @click="navigate('contact')">
              <b class="font-weight-normal nav-text" @click="navigate('contact')" :style="'color: ' + ($route.name == 'contactPage' ? '#007bff' : 'black')">Contact Us</b>
            </div>
        </div>
        <div class="row no-gutters justify-content-center nav-container">
            <div class="nav_item_m" @click="navigate('login')">
              <b class="font-weight-normal nav-text" @click="navigate('login')"  :style="'color: ' + ($route.name == 'loginAccount' ? '#007bff' : 'black')">Login</b>
            </div>
        </div>
        <div class="row no-gutters justify-content-center nav-container">
            <div class="nav_item_m" @click="navigate('login')">
              <b class="font-weight-normal nav-text" @click="navigate('login')" :style="'color: ' + ($route.name == 'signup' ? '#007bff' : 'black')">Register</b>
            </div>
        </div>
    </div>
    <!-- Show  when screen is >991px -->
    <div class="navbar-collapse text-center d-none d-lg-block" id="navbarSupportedContent">
      <ul class="nav navbar-nav navbar-right ml-auto">
        <li class="pl-5 pr-5 nav_item">
          <b class="font-weight-normal" @click="this.$refs.content.newBanner.caller()">How It Works</b>
        </li>
        <!-- <li class="pl-5 pr-5 nav_item">
          <b class="font-weight-normal" href="#pricing" @click="headerScrollTo('#pricing')">Pricing</b>
        </li> -->
        <li class="pl-5 pr-5 nav_item">
          <b class="font-weight-normal" @click="navigate('contact')" :style="'color: ' + ($route.name == 'contactPage' ? '#007bff' : 'black')">Contact Us</b>
        </li>
        <li class="pl-5 pr-5 nav_item" @click="navigate('login')">
          <b class="font-weight-normal"  :style="'color: ' + ($route.name == 'loginAccount' ? '#007bff' : 'black')">Login</b>
        </li>
        <li class="pl-5 pr-5 nav_item" @click="navigate('signup')">
          <b class="font-weight-normal" :style="'color: ' + ($route.name == 'signup' ? '#007bff' : 'black')">Register</b>
        </li>
      </ul>
    </div>
  </nav>
</template>

<script>
import Jquery from 'jquery'
export default {
  created() {
  },
  components: {},
  data: () => ({
    isActive: true
  }),
  computed: {
  },
  methods: {
    navigate(route) {
      this.$router.push(`/${route}`)
      this.isActive = true
    },
    headerScrollTo(id) {
      this.navigate(id)
      window.location.reload()
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
window.addEventListener('load', function () {
  Jquery(document).ready(function () {
    if (window.location.hash === '#learn-how') {
      let height = Jquery(window).height()
      Jquery('html, body').animate(
        {
          scrollTop: Jquery('#learn-how').offset().top - parseInt(height * 0.0)
        },
        500
      )
    } else if (window.location.hash === '#pricing') {
      let height = Jquery(window).height()
      Jquery('html, body').animate(
        {
          scrollTop: Jquery('#pricing').offset().top - parseInt(height * 0.0)
        },
        500
      )
    }
  })
})
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
  border-left: 0.5px solid #84868B;
  transition: width 0.5s;
  -webkit-transition: all 0.25s;
}
li {
  text-align: left;
}
.nav-text {
  font-size: 125%;
}
.nav_item {
  cursor: pointer;
}
.nav_item_m {
  border-bottom: 0.5px solid #84868B;
  margin-top: 20px;
  padding-bottom: 20px;
  width: 80%;
}
b {
  color:black;
}
b:hover {
  color:#01009A!important;
}
.nav-container:hover{
  background: #01009A;
}
.nav-container:hover b{
  color: white!important;
}
.navigationBar {
  width: 100%;
	position: fixed;
	top: 0;
  z-index: 100;
}
.navbar {
   background: white !important;
   z-index: 11;
}
.navbar-header {
  background: none !important;
}
#navbarSupportedContent {
  
}
.navbar-brand .logo-brand {
  margin-top: 5%;
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
   .sidebar {
     display: none;
   }
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
      margin-left: 5% !important;
    }
  }

 @media (max-width: 1199px){
   .sidebar {
     display: none;
   }
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
     width: auto !important;
      height: 75px !important;
      margin-left: 5% !important
    }
  }

@media (max-width: 991px){
  b {
  color:black;
  }
  b:hover {
    color: white;
  }
  .sidebar {
     display: block;
   }
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
     width: auto !important;
      height: 75px !important;
      margin-left: 5% !important;
      margin-top: 15%!important;
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
     width: auto !important;
      height: 70px !important;
      margin-left: 5% !important;
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
    .nav-text {
      font-size: 100%;
    }
    .sidebar{
      height: 150vh;
    }
  }

  @media (max-width: 300px){
    .logo-brand{
      width: 30px;
      height: 30px;
    }
  }
</style>
