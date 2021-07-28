<template>
  <div class="container-fluid authentication bg-white">
    <div class="center">
      <div class="loading"></div>
      <div class="loader">
        <span>Authenticating</span>
      </div>
    </div>
  </div>
</template>

<script>
import AUTH from 'src/services/auth'
import ROUTER from 'src/router'
export default {
  data() {
    return {
      user: AUTH.user
    }
  },
  mounted() {
    if(new RegExp(/\?.+=.*/g).test(window.location.href) && (localStorage.getItem('login_with') || localStorage.getItem('connect_with'))) {
      this.loginCallBack()
      this.connectCallback()
    }else {
      try {
        ROUTER.go(-1)
      } catch (error) {
        error
      }
    }
  },
  methods: {
    loginCallBack() {
      if(new RegExp(/\?.+=.*/g).test(window.location.href) && localStorage.getItem('login_with')) {
        let url = window.location.href
        let query = url.substring(url.indexOf('?') + 1)
        // $('#loading').css({'display': 'block'})
        console.log('logging in...')
        this.APIRequest(`social_lite/authenticate/${localStorage.getItem('login_with')}/callback?` + query, {}, response => {
          // $('#loading').css({'display': 'none'})
          console.log('logged in: ', response)
          localStorage.removeItem('login_with')
          localStorage.setItem('usertoken', response.token)
          AUTH.hash('hide', response.login_type)
          console.log('USER @ Index: ', response.user[0])
          AUTH.setUser(response.user[0])
          AUTH.checkAuthentication()
          ROUTER.push(`/dashboard`)
        }, error => {
          // $('#loading').css({'display': 'none'})
          localStorage.removeItem('login_with')
          console.log('Verifying authentication error! ', error)
        })
      }
    },
    connectCallback() {
      if(new RegExp(/\?.+=.*/g).test(window.location.href) && localStorage.getItem('connect_with')) {
        let url = window.location.href
        let query = url.substring(url.indexOf('?') + 1)
        let provider = localStorage.getItem('connect_with')
        this.APIRequest(`social_lite/account/${provider}/callback?` + query, {
          id: this.user.userID
        }, response => {
          console.log('connect response: ', response)
          localStorage.removeItem('connect_with')
          ROUTER.push(`/channels`)
        }, error => {
          ROUTER.push(`/channels`)
          localStorage.removeItem('connect_with')
          console.log('Verifying authentication error! ', error)
        })
      }
    }
  }
}
</script>
<style lang="scss" scoped>
@import "~assets/style/colors.scss";
.authentication {
  position: fixed;
  top: 0;
  left: 0;
  min-width: 100vw;
  min-height: 100vh;
  z-index: 10;
  padding-top: 80px;
}
.center {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%) !important;
}
.loader {
  margin-top: 30px;
  position: relative;
  font-size: 14px;
  background: #fff;
  color: #fff;
  text-transform: uppercase;
  font-weight: bold;
  letter-spacing: 5px;
}
.loader span {
  color: #fff;
  mix-blend-mode: difference;
}
.loader:before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 30px;
  height: 100%;
  background: #000;
  animation: animate 3s linear infinite;
}
.loading {
  width: 50%;
  margin: 0 auto;
  border: 5px solid #f3f3f3;
  border-radius: 50%;
  border-top: 5px solid $primary;
  width: 40px;
  height: 40px;
  -webkit-animation: spin 1s linear infinite; /* Safari */
  animation: spin 1s linear infinite;
}

/* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
@keyframes animate {
  0% {
    left: 0;
  }
  50% {
    left: calc(100% - 30px);
  }
  100% {
    left: 0;
  }
}
</style>
