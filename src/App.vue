<template>
  <div id="app">
    <div v-bind:style="(globalVariables.showModal) ? 'overflow-y:hidden; height:'+deviceHeight+'px!important': ''">
      <div v-if="tokenData.token !== null && parseInt(user.userID) > 0 && tokenData.loading === false">
       <!-- <custom-header></custom-header> -->
       <CustomHeader/>
       <!-- <system-header></system-header> -->
       <custom-sidebar></custom-sidebar>
       <!-- <system-sidebar></system-sidebar> -->
       <!-- <support-messenger></support-messenger> -->
       <system-footer></system-footer>
       <!-- <tutorial></tutorial> -->
       <!-- <guide></guide> -->
      </div>
      <div v-else-if="tokenData.loading === true">
        <lazy-loading></lazy-loading>
      </div>
      <div v-else-if="tokenData.token === null && parseInt(user.userID) <= 0 && tokenData.loading === false">
        <login-header v-if="$route.name === 'loginAccount' || $route.name === 'signup' "></login-header>
        <system-content v-if="$route.name === 'loginAccount' || $route.name === 'signup' "></system-content>
        <div v-else>
        <!-- <custom-header></custom-header>
        <custom-sidebar></custom-sidebar> -->
        </div>
        <landing-footer></landing-footer>
      </div>
    </div>
    <!-- <system-footer></system-footer> -->
    <system-loading></system-loading>
    <privacy-policy></privacy-policy>
    <terms-and-conditions></terms-and-conditions>
    <error-modal></error-modal>
  </div>
</template>
<style lang="scss">
@import "~assets/style/colors.scss";
.mx-input-wrapper, .mx-input-wrapper input{
  height: 45px !important;
}
.half-width{
  width: 50%
}
.push-half-right{
  margin-left: 50%
}
.nav a{
  font-size: 15px
}
.dropdown-menu li a{
  padding: 10px;
}
.container {
   min-height:100%;
   position:relative;
}

/*
  BACKGROUND
*/

.bg-primary{
  background: $primary !important; 
}

.bg-secondary{
  background: $primary !important; 
}

/*
  BTNS
*/
.btn-primary{
  background: $primary !important;
  border-color: $primary !important;
  height: 35px !important;
}

.btn-primary:hover{
  background: $darkPrimary !important;
  border-color: $darkPrimary !important;
}

.btn-primary:active{
  background: $darkPrimary !important;
  border-color: $darkPrimary !important;
}

.btn-secondary{
  background: $secondary !important;
  border-color: $secondary !important;
  height: 35px !important;
}

.btn-secondary:hover{
  background: $secondary !important;
  border-color: $secondary !important;
}

.btn-danger{
  background: $danger !important;
  height: 35px !important;
}

.btn-danger:hover{
  background: $danger !important;
  border-color: $danger !important;
}

.btn-warning{
  background: $warning !important;
  height: 35px !important;
}

/* TEXT */

.text-primary{
  color: $primary !important;
}

.text-white{
  color: $white !important;
}

.text-gray{
  color: #555 !important;
}

.text-yellow{
  color: $warning !important;
}

/* 
  
  OTHERS
  
*/
.page-link{
  color: $primary !important;
  background: inherit;
}
.empty-table:hover{
  cursor: pointer;
  color: white !important;
  background: $primary !important;
}
.page-link:hover{
  cursor: pointer;
  background: $primary !important;
  color: white !important;
}

.action-link:hover{
  color: $primary !important;
  cursor: pointer;
}
.text-underline:hover{
  cursor: pointer;
  text-decoration: underline;
}
.breadcrumb{
  color: $primary;
  background: inherit !important;
  border: none !important;
}
.breadcrumb:hover{
  cursor: pointer;
  text-decoration: underline; 
}
td i{
  font-size: 16px !important;
  padding-right: 10px;
}
td i:hover{
  cursor: pointer;
  color: $primary !important; 
}

.modal { 
  overflow-y: auto !important;
  z-index: 10000 !important;
}

</style>
<script>
import ROUTER from './router'
import AUTH from './services/auth'
import global from './helpers/global'
import CustomHeader from 'modules/frame/Header2.vue'
export default {
  name: 'app',
  mounted(){
    console.log('header', this.tokenData)
  },
  // created(){
    // this.validate()
  // },
  data(){
    return {
      user: AUTH.user,
      tokenData: AUTH.tokenData,
      currentRoute: ROUTER.currentRoute.name,
      deviceHeight: document.documentElement.clientHeight,
      appGlobal: {
        showModal: false
      },
      globalVariables: global
    }
  },
  methods: {
    logOut(){
      AUTH.deaunthenticate()
    },
    validate(){
      if(this.tokenData.verifyingToken === false && this.tokenData.token !== null){
        ROUTER.push('/dashboard')
      }else{
        ROUTER.push('/login')
      }
    }
  },
  components: {
    'login-header': () => import('modules/home/Landing/Header.vue'),
    'system-header': () => import('components/increment/generic/frame/Header.vue'),
    'system-sidebar': () => import('components/increment/generic/frame/Sidebar.vue'),
    'system-content': () => import('modules/frame/Content.vue'),
    'system-footer': () => import('components/increment/generic/frame/Footer.vue'),
    'system-loading': () => import('components/loader/Loading.vue'),
    'landing-footer': () => import('modules/home/Landing/Footer.vue'),
    'guide': () => import('modules/guide/Guide.vue'),
    'privacy-policy': () => import('modules/docs/PrivacyPolicy.vue'),
    'terms-and-conditions': () => import('modules/docs/TermsAndConditions.vue'),
    'support-messenger': () => import('components/increment/support/Support.vue'),
    'tutorial': () => import('components/increment/generic/tutorial/Tutorial.vue'),
    'error-modal': () => import('components/increment/generic/modal/Error.vue'),
    'lazy-loading': () => import('components/increment/generic/lazy/loading.vue'),
    // 'custom-header': () => import('modules/frame/Header2.vue'),
    'custom-sidebar': () => import('modules/frame/Sidebar.vue'),
    CustomHeader
  }
}
</script>
