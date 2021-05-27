<template>
  <div class="system-body"> 
     <div class="main-sidebar sidebar-collapse navbar-collapse collapse" v-bind:class="hide" id="idfactory" >
      <div class="sidebar">
        <ul class="sidebar-menu">
            <li class="header">
                <span v-if="menuFlag === true" class="profile-photo">
                  <span class="profile-image-holder"  v-if="user.profile !== null">
                    <img v-bind:src="config.BACKEND_URL + user.profile.url">
                  </span>
                  <i class="fa fa-user-circle-o profile-icon" v-else></i>
                  <i class="fas fa-check text-primary profile-status" v-if="user.status === 'VERIFIED'"></i>
                  Hi {{user.username}}!
                </span>
                <i v-bind:class="toggleSidebar + ' pull-right'" aria-hidden="true" v-on:click="changeToggleSidebarIcon()" id="toggleIcon"></i>
            </li>
            <li v-for="(item, index) in menu" :key="index" :class="item.flag || $route.path === '/' + item.path ? ' active-menu' : ''" v-on:click="setActive(index)" v-if="(((item.accountType === user.type || item.accountType === 'ALL') && user.type !== 'ADMIN') || (user.type === 'ADMIN' && item.showOnAdmin === true)) && (item.accountStatus === 'ALL' || (user.subAccount === null || (user.subAccount !== null && user.subAccount.status === item.accountStatus))) && menuFlag === true" class="menu-holder">
              <i v-bind:class="item.icon" class=" visible"></i> 
              <label>{{item.description}}</label>
              <ul class="sub-menu" v-if="item.subMenu !== null">
                <li v-for="itemSub, indexSub in item.subMenu" v-bind:class="{ 'active-menu': itemSub.flag === true }" v-on:click="setActiveSubMenu(index, indexSub)" v-if="((itemSub.users === user.type || itemSub.users === 'ALL') && itemSub.type !== 'ADMIN') || itemSub.type === 'ADMIN'">
                  <i v-bind:class="itemSub.icon" class=" visible"></i>
                  <label>{{itemSub.description}}</label>
                </li>
              </ul>
            </li>
            <li v-for="item, index in menuOff" v-bind:class="{ 'active-menu': item.flag === true }" v-on:click="setActiveOff(index)" v-if="(((item.accountType === user.type || item.accountType === 'ALL') && user.type !== 'ADMIN') || (user.type === 'ADMIN' && item.showOnAdmin === true)) && menuFlag === false" class="menu-holder-hidden">
              <i v-bind:class="item.icon"></i>
            </li>
          </ul>
        </div>
      </div>

      <!-- Confirmation Modal -->
      <div class="modal" id="timerModal" v-if="confirmation.message !== null">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"><i class="fa fa-warning text-danger"></i> Confirmation!</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
              {{confirmation.message}}
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
            </div>
          </div>
        </div>
      </div>

      <div class="content-holder" v-bind:class="hide">
        <system-notification></system-notification>
        <transition >
          <router-view ></router-view>
        </transition>
      </div>
    </div>
  </div>  
</template>
<style lang="scss">
@import "~assets/style/colors.scss";
.main-sidebar, .content-holder{  
  min-height: 200px;
  overflow: hidden;
  transition: all 1s ease 0s;
  z-index: 1;
  margin-top: 50px;
}
.main-sidebar{
  overflow-y: hidden;
  z-index: 10000;
}

.sidebar{
  min-height: 100vh;
  overflow-y: auto;
}

.sidebar-menu{
  list-style: none;
  padding: 0px;
  margin: 0px;
  min-height: 100vh;
  overflow-y: auto;
}

.sidebar-menu .header{
  font-weight: 700; 
  padding: 15px 2% 15px 2%;
  color: #000;
  text-align: center;
}

.header .switch{
  float: left;
  width: 20%;
}

.header i{
  font-size: 24px;
  color: $primary;
}/*-- toggle-sidebar i --*/

.header i:hover{
  cursor: pointer;
  color: $primary;
}

.profile-photo{
  float: left;
  width: 100%;
  height: 100px;
  margin-top: 20px;
}

.profile-image-holder{
  width: 100%;
  float: left;
  height: 80px;
  text-align: center;
}

.profile-image-holder img{
  width: 80px;
  height: 80px;
  border-radius: 50%;
}

.profile-photo .profile-icon{
  float: left;
  font-size: 80px;
  width: 100%;
  height: 80px;
  margin-bottom: 10px;
}

.profile-photo .profile-status{
  font-size: 12px !important;
  padding-left: 0px !important;
  padding-right: 0px !important;
}

.menu-holder{
  width: 100%;
  float: left;
  min-height: 40px;
  line-height: 40px;
  overflow: hidden;
}

.menu-holder .visible{
  width: 10%;
  float: left;
  text-align: right;
  line-height: 40px;
}

.menu-holder label{
  float: left;
  width: 86%;
  margin-left: 4%;
  margin-top: 0px;
  margin-bottom: 0px;
  line-height: 40px;
}

.menu-holder:hover, .menu-holder i:hover, .menu-holder label:hover, .menu-holder-hidden i:hover{
  cursor: pointer;
  color: $primary;
}

.sub-menu{
  list-style: none;
  padding: 0px;
  margin: 0px;
  z-index: 1;
}

.sub-menu li{
  width: 95%;
  float: left;
  height: 35px;
  line-height: 35px;
  margin-left: 5%;
  color: $primary;
}

.active-menu{
  color: $primary !important;
}

.menu-holder-hidden{
  width: 100%;
  float: left;
  min-height: 50px;
  line-height: 50px;
  overflow: hidden;
  text-align: right;
}

.menu-holder-hidden i{
  font-size: 20px;
  padding-right: 5px; 
}

/*---------------------------------------------------------          

                  RESPONSIVE HANDLER

-----------------------------------------------------------*/
/*-------------- Large Screens for Desktop --------------*/
@media (min-width: 1200px){
  .main-sidebar{
    width:18%;
    float: left;
  }
  .sidebar-collapse{
    display: block;
    position: fixed; /*- fixed sidebar -*/
  }
  .sidebar-menu .header span{
    display: block;
  }
  .content-holder{
    width: 80%;
    margin: 60px 0px 0px 0px;
    margin-right: 1%;
    float: right; /*- changed float left to right -*/
  }
  /*  Change with Menu Toggled */
  .main-sidebar.hidden{
    width: 5%;
    position: fixed; /*- fixed sidebar -*/
  }
  .content-holder.hidden{
    width: 94%;
    margin: 60px 0px 0px 1%;
    float: right; /*- changed float from left to right -*/
  }
}

/*-------------- Medium Screen for Tablets  --------------*/
@media (min-width: 992px) and (max-width: 1199px){
  .main-sidebar{
    width: 23%;
    float: left;
  }
  .content-holder{
    width: 71%;
    margin: 60px 0px 0px 0px;
    margin-right: 1%;
    float: right; /*- changed float from left to right -*/
  }
  .main-sidebar.active{
    padding-left:15%;
  }
  .sidebar-collapse{
    display: block;
    position: fixed; /*- fixed sidebar -*/
  }
  .sidebar-menu .header span{
    display: block;
  }

  /*  Change with Menu Toggled */
  .main-sidebar.hidden{
    width: 5%;
    position: fixed; /*- fixed sidebar -*/
  }
  .content-holder.hidden{
    width: 94%;
    margin: 60px 0px 0px 1%;
    float: right; /*- changed float from left to right -*/
  }
}

/*-------------- Extra Small Screen for Mobile Phones --------------*/
@media (max-width: 991px){
  .main-sidebar{
    width: 100%;
    position: fixed;
    top:0;
    left: 0;
    z-index: 30;
    background-color: rgba(0,0,0,0.5);
    margin-top: 50px;
    height: 100vh;
  }
  .content-holder{
    min-height: 10px;
    width: 96%;
    overflow-y: hidden;
    margin: 60px 2% 0 2%;
    float: left;
  }
  .main-sidebar ul{
    background: $secondary;
    width: 60%;
    min-height: 400px;
    height: 100vh;
  }
   .sm-title{
    text-align: center;
  }

  .sidebar-menu .header span{
    display: none;
  }
  .main-sidebar.hidden{
    
  }
  .header .input-group{
    width: 90%;
    margin: 0 5% 0 5%;
  }
  #toggleIcon{
    display: none;
  }
  .force-collapse{
    display: none;
  }

  .collapse{
    display: none !important;
  }
  .collapse.show{
    display: block !important;
  }
}
@media (max-width: 239px){

  .collapse{
    display: none !important;
  }

  .collapse.show{
    display: block !important;
  }
  .main-sidebar{
    width: 90%;
    position: fixed;
    top:0;
    left: 0;
    z-index: 10;
    background: #fff;
    margin-top: 100px;
    height: 100vh;
  }

  .main-sidebar ul{
    height: 100vh;
  }

  .content-holder{
    width: 96%;
    margin: 60px 2% 0 2%;
    float: left;
  }
  .sm-title,.header{
    display: none;
  }
  .sidebar-menu  li > a{
  padding: 15px 20px 15px 15px;
  display: block;
  }
  .sidebar-menu  ul li > a{
  padding: 10px 15px 10px 25px;
  display: block;
  }
  .sidebar-menu .header span{
    display: none;
  }
  .main-sidebar.hidden{
    
  }
  .header .input-group{
    width: 90%;
    margin: 0 5% 0 5%;
  }
  #toggleIcon{
    display: none;
  }

  .force-collapse{
    display: none;
  }
}
</style>
<script>
import AUTH from 'src/services/auth'
import CONFIG from 'src/config.js'
import COMMON from 'src/common.js'
import ROUTER from 'src/router'
export default {
  mounted(){
  },
  data(){
    return{
      user: AUTH.user,
      config: CONFIG,
      menu: COMMON.sidebarMenu,
      menuOff: COMMON.sidebarMenu,
      toggleSidebar: 'fa fa-toggle-on',
      hide: '',
      flag: false,
      confirmation: {
        message: null,
        action: null
      },
      prevMenu: 0,
      subPrevMenu: 0,
      menuFlag: true
    }
  },
  components: {
    'system-notification': require('components/increment/generic/system/Notifications.vue')
  },
  watch: {
    '$route' (to, from) {
      let index = null
      for(var i = 0; i < COMMON.sidebarMenu.length && !index; i++) {
        let item = COMMON.sidebarMenu[i]
        if(to.path === '/' + item.path) {
          index = i
        }
      }
      if(index !== null){
        this.setActiveOnWatch(index, to.path)
      }else{
        if(this.prevMenu !== null){
          this.menu[this.prevMenu].flag = false
        }
      }
    }
  },
  methods: {
    setActive(index, code = null){
      if(this.prevMenu !== index){
        this.menu[this.prevMenu].flag = false
        this.menu[index].flag = true
        if(this.menu[this.prevMenu].subMenu !== null){
          this.menu[this.prevMenu].subMenu[this.subPrevMenu].flag = false
        }
        this.prevMenu = index
      }
      if(this.menu[index].subMenu === null){
        ROUTER.push('/' + this.menu[this.prevMenu].path)
        $('.navbar-collapse').collapse('hide')
      }
    },
    setActiveOnWatch(index, path){
      if(this.prevMenu !== index){
        this.menu[this.prevMenu].flag = false
        this.menu[index].flag = true
        if(this.menu[this.prevMenu].subMenu !== null){
          this.menu[this.prevMenu].subMenu[this.subPrevMenu].flag = false
        }
        this.prevMenu = index
      }
      if(this.menu[index].subMenu === null){
        ROUTER.push(path)
        $('.navbar-collapse').collapse('hide')
      }
    },
    setActiveOff(index){
      if(this.prevMenu !== index){
        this.menuOff[this.prevMenu].flag = false
        this.menuOff[index].flag = true
        this.prevMenu = index
      }
      if(this.menuOff[index].subMenu === null){
        ROUTER.push('/' + this.menuOff[this.prevMenu].path)
        $('.navbar-collapse').collapse('hide')
      }
    },
    setActiveSubMenu(index, subIndex){
      if(this.prevMenu !== index){
        this.menu[this.prevMenu].flag = false
        this.menu[index].flag = true
        if(this.menu[index].subMenu !== null){
          this.menu[index].subMenu[subIndex].flag = true
        }
        if(this.menu[this.prevMenu].subMenu !== null){
          this.menu[this.prevMenu].subMenu[this.subPrevMenu].flag = false
        }
        this.prevMenu = index
        this.subPrevMenu = subIndex
      }else{
        if(this.subPrevMenu !== subIndex){
          this.menu[this.prevMenu].subMenu[this.subPrevMenu].flag = false
          this.menu[index].subMenu[subIndex].flag = true
          this.subPrevMenu = subIndex
        }else{
          this.subPrevMenu = subIndex
        }
      }
      ROUTER.push('/' + this.menu[this.prevMenu].subMenu[this.subPrevMenu].path)
      $('.navbar-collapse').collapse('hide')
    },
    changeToggleSidebarIcon(){
      if(this.menuFlag === false){
        // from off
        this.menuOff[this.prevMenu].flag = false
        this.prevMenu = 0
      }else{
        // from on
        this.menu[this.prevMenu].flag = false
        if(this.menu[this.prevMenu].subMenu !== null){
          this.menu[this.prevMenu].subMenu[this.subPrevMenu].flag = false
        }
        this.prevMenu = 0
        this.subPrevMenu = 0
      }
      this.menuFlag = !this.menuFlag
      this.toggleSidebar = (this.menuFlag === false) ? 'fa fa-toggle-off' : 'fa fa-toggle-on'
      this.hide = (this.menuFlag === false) ? 'hidden' : ''
    }
  }
}
</script>
