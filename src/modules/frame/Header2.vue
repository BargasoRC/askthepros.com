<template>
  <div class="header" id="header">
    <!-- header for home -->
    <div class="header-section" v-if="isHome">
      <span class="logo">
        <a class="navbar-brand" v-on:click="redirect('/')">
          <img
            src="../../assets/img/logo_white.png"
            style="height: 60px; width: auto;"
          />
        </a>
      </span>
      <span class="menu">
        <span class="navbar-menu-toggler-md">
          <i class="fa fa-bars" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" onclick="void(0)"></i>
        </span>
        <ul class="header-primary-menu">
          <li class="nav-item"><a class="nav-link" @click="redirect('/signup')">Register</a></li>
          <li class="nav-item"><a class="nav-link" @click="redirect('/login')">Login</a></li>
          <li class="nav-item"><a class="nav-link" @click="redirect('/contact')">Contact Us</a></li>
          <li class="nav-item"><a class="nav-link" @click="redirectDirect('/stepper')">Stepper</a></li>
        </ul>
      </span>
    </div>
    <!-- end code for home header -->
    <!-- header for other pages -->
    <div class="header-section2" v-if="!isHome">
      <span class="logo">
        <a class="navbar-brand" v-on:click="redirect('/')">
          <img
            src="../../assets/img/logo_white.png"
            style="height: 60px; width: auto;"
          />
        </a>
      </span>
      <span class="menu">
        <span class="navbar-menu-toggler-md">
          <i class="fa fa-bars" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" onclick="void(0)"></i>
        </span>
        <ul class="header-primary-menu">
          <li class="nav-item"><a class="nav-link" @click="redirect('/signup')">Register</a></li>
          <li class="nav-item"><a class="nav-link" @click="redirect('/login')">Login</a></li>
          <li class="nav-item"><a class="nav-link" @click="redirect('/contact')">Contact Us</a></li>
        </ul>
      </span>
    </div>
    <!-- end code for other pages header -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item" v-on:click="redirect('/signup')" data-toggle="collapse" data-target="#navbarSupportedContent"><a class="nav-link">Register</a></li>
        <li class="nav-item" v-on:click="redirect('/login')" data-toggle="collapse" data-target="#navbarSupportedContent"><a class="nav-link">Login</a></li>
        <li class="nav-item" v-on:click="redirect('/contact')" data-toggle="collapse" data-target="#navbarSupportedContent"><a class="nav-link">Contact Us</a></li>
      </ul>
    </div>
  </div>
</template>
<style scoped lang="scss">
@import "~assets/style/colors.scss";
.header {
  width: 100%;
  float: left;
  min-height: 70px;
  background: $primary;
  overflow-y: hidden;
  position: fixed;
  z-index: 10000;
}
.header-section {
  min-height: 60px;
  overflow-y: hidden;
  width: 60%;
  font-size: 12px;
  color: #fff;
  margin: 5px auto 5px auto;
}

.header-section2 {
  min-height: 60px;
  overflow-y: hidden;
  width: 90%;
  font-size: 12px;
  color: #fff;
  margin: 5px auto 5px auto;
}

.header-section2 .logo {
  width: 20%;
  float: left;
  height: 100%;
}
.header-section2 .menu {
  width: 80%;
  float: left;
  height: 100%;
  margin-top: 10px;
}

.header-section .logo {
  width: 20%;
  float: left;
  height: 100%;
}
.header-section .menu {
  width: 80%;
  float: left;
  height: 100%;
  margin-top: 10px;
}

.navbar-menu-toggler-md {
  width: 100%;
  text-align: right;
  float: left;
  display: none;
}

.menu .header-primary-menu {
  width: 100%;
  float: left;
  min-height: 30px;
  list-style: none;
  overflow-y: hidden;
  padding: 0px;
  margin-bottom: 0px !important;
}
.btn-white {
  background: #fff;
  color: $primary !important;
}
.fa-bars {
  border: solid 1px #fff;
  font-size: 20px !important;
  padding: 10px 8px 10px 8px !important;
  color: #fff !important;
}

.fa-bars:hover {
  cursor: pointer;
}

.menu .header-primary-menu .nav-item {
  float: right;
  font-size: 16px;
  margin-left: 5px;
}

.header-primary-menu .nav-item .nav-link {
  padding: 0.5rem;
}

.header-primary-menu .nav-item a {
  color: $white !important;
  font-weight: bold;
  font-family: MuseoRounded700, sans-serif;
}
.header-primary-menu .nav-item .nav-link:hover {
  cursor: pointer;
  text-decoration: underline;
}

.navbar-toggler {
  background: inherit !important;
  border-radius: 0px !important;
  border: solid 1px #fff;
  font-size: 20px !important;
  padding: 10px 8px 10px 8px !important;
  color: #fff !important;
}
.navbar-toggler:hover {
  color: $primary !important;
  background: #fff !important;
}

.navbar-collapse .show {
  display: none !important;
}

.header-section .logo a img {
  width: 50px;
}
.header-section .logo a label {
  font-size: 18px;
  letter-spacing: 1px;
  font-weight: bold;
  margin-bottom: 0px;
  color: white;
}

@media screen and (min-width: 0px) {
  .headerName p{
    font-size: 11px;
    margin: 0px;
    padding: 0px;
    margin-top: -5px;
    font-style: italic;
    color: $secondary;
  }

  .navbar-brand img{
    margin-top: -10px;
  }
}

@media screen and (min-width: 993px) {
  .navbar-collapse {
    display: none !important;
  }
}

@media screen and (max-width: 992px) {
  .header{
    position: fixed;
  }
  .header-section, .header-section2 {
    width: 90% !important;
    margin: 0 5% 0 5% !important;
  }
  .header-section .logo, .header-section2 .logo {
    width: 80% !important;
    margin-top: 10px !important;
    cursor: pointer !important;
  }
  .header-section .menu, .header-section2 .menu {
    width: 20% !important;
    margin-top: 16px !important;
  }
  .menu .top-menu,
  .menu .header-primary-menu {
    display: none !important;
  }

  .navbar {
    width: 90% !important;
    margin: 0 5% 0 5% !important;
    padding: 0 !important;
  }
  .navbar-collapse {
    width: 100% !important;
    z-index: 100000 !important;
    float: left;
    border-bottom: solid 1px $primary;
    text-align: center !important;
  }
  .navbar-nav {
    background: #fff !important;
    margin: 0 !important;
  }
  .navbar-nav .nav-link {
    width: 100% !important;
    padding: 17px 30px 17px 30px !important;
  }

  .navbar-nav .nav-link:hover {
    background-color: $primary;
    color: #fff;
  }

  .navbar-nav .nav-link {
    color: $primary;
    background-color: white;
  }
  .navbar-menu-toggler-md {
    width: 100%;
    text-align: right;
    float: left;
    display: block;
  }
}
</style>
<script>
import ROUTER from 'src/router'
import Jquery from 'jquery'
import COMMON from 'src/common.js'
import ColorJS from 'src/assets/style/colors.js'
export default {
  computed: {
    isHome() {
      return this.$route.name === 'home'
    }
  },
  mounted() {
    if(this.$route.path !== '/'){
      Jquery('.header').css({
        background: ColorJS.primary
      })
    }
    window.addEventListener('scroll', this.onScroll)
  },
  data() {
    return {
      common: COMMON
    }
  },
  methods: {
    onScroll(){
      var height = Jquery(window).height()
      var scrollTop = Jquery(window).scrollTop()
      var vScroll = parseInt((scrollTop / height) * 100)
      if(vScroll >= 7){
        Jquery('.header').css({
          background: ColorJS.primary
        })
      }else{
        Jquery('.header').css({
          background: ColorJS.primary
        })
      }
    },
    redirectDirect(parameter){
      ROUTER.push(parameter)
    },
    redirect(parameter) {
      if(parameter === '/signup'){
        // ROUTER.push(parameter)
        if(localStorage.getItem('selectedIndustry') != null){
          ROUTER.push(parameter)
        }else{
          alert('Please select industry to proceed.')
        }
      }else{
        ROUTER.push(parameter)
      }
      if(parameter === '/'){
        this.scrollToTop()
      }
    },
    scrollToTop () {
      Jquery('html, body').animate({
        scrollTop: 0
      }, 500)
    },
    scrollTo(div) {
      Jquery('html, body').animate(
        {
          scrollTop: Jquery(div).offset().top
        },
        500
      )
    },
    headerScrollTo(id) {
      let height = Jquery(window).height()
      this.redirect('/' + id)
      window.scrollTo(0, 0)
      window.location.reload()
      Jquery('html, body').animate(
        {
          scrollTop: Jquery(id).offset().top - parseInt(height * 0.0)
        },
        500
      )
    }
  }
}
</script>
