// src/auth/index.js
import {router} from 'src/router/index'
import ROUTER from 'src/router'
import {Howl} from 'howler'
import Vue from 'vue'
import Echo from 'laravel-echo'
import Pusher from 'pusher-js'
import Config from 'src/config.js'
export default {
  user: {
    login_type: 'local',
    userID: 0,
    username: '',
    email: null,
    type: null,
    status: null,
    profile: null,
    information: null,
    plan: null,
    amount: null,
    subAccount: null,
    code: null,
    notifications: {
      data: null,
      current: null,
      prevCurrent: null
    },
    notifSetting: null,
    messages: {
      data: null,
      totalUnreadMessages: 0
    },
    merchant: null
  },
  messenger: {
    messages: [],
    badge: 0,
    messengerGroupId: null,
    group: null
  },
  support: {
    messages: null,
    badge: 0,
    messengerGroupId: null
  },
  notifTimer: {
    timer: null,
    speed: 1000
  },
  tokenData: {
    token: null,
    tokenTimer: false,
    verifyingToken: false,
    loading: false
  },
  otpDataHolder: {
    userInfo: null,
    data: null
  },
  google: {
    code: null,
    scope: null
  },
  echo: null,
  currentPath: false,
  attachmentValue: null,
  setUser(user, notifSetting, subAccount){
    $('#loading').css({display: 'none'})
    console.log('user', user)
    let vue = new Vue()
    if(user === null){
      this.user.userID = 0
      this.user.username = null
      this.user.email = null
      this.user.type = null
      this.user.status = null
      this.user.profile = null
      this.user.information = null
      this.user.subAccount = null
      this.user.code = null
      this.user.merchant = null
      this.user.plan = null
    }else{
      this.user.userID = user.id
      this.user.username = user.username
      this.user.email = user.email
      this.user.type = user.account_type
      this.user.status = user.status
      this.user.profile = user.profile
      this.user.information = user.information
      this.user.subAccount = null
      this.user.code = user.code
      this.user.plan = user.plan
      let merchant = null
      if(user.merchant){
        merchant = {
          ...user.merchant,
          addition_informations: user.merchant.addition_informations ? JSON.parse(user.merchant.addition_informations) : null
        }
      }
      this.user.merchant = merchant
      localStorage.setItem('account_id', this.user.userID)
      setTimeout(() => {
        this.tokenData.verifyingToken = false
        this.tokenData.loading = false
        this.updateData()
      }, 100)
    }
  },
  setToken(token){
    this.tokenData.token = token
    localStorage.setItem('usertoken', token)
    if(token){
      setTimeout(() => {
        let vue = new Vue()
        vue.APIRequest('authenticate/refresh', {}, (response) => {
          this.setToken(response['token'])
        }, (response) => {
          this.deaunthenticate()
        })
      }, 1000 * 60 * 60) // 50min
    }
  },
  hash(type, data) {
    let text = 'login_type'
    if(type === 'hide') {
      localStorage.setItem(text, window.btoa(data))
    }else if(type === 'show') {
      return window.atob(localStorage.getItem(text))
    }
  },
  authenticate(username, password, callback, errorCallback){
    let vue = new Vue()
    let credentials = {
      username: username,
      password: password,
      status: 'VERIFIED'
    }
    vue.APIRequest('authenticate', credentials, (response) => {
      this.tokenData.token = response.token
      this.setToken(this.tokenData.token)
      this.hash('hide', response.login_type)
      vue.APIRequest('authenticate/user', {}, async (userInfo) => {
        this.setUser(userInfo, null, null)
        // this.retrieveAccountProfileAndInformation(userInfo.id)
        await callback(response)
      })
    }, (response, status) => {
      if(errorCallback){
        errorCallback(response, status)
      }
    })
  },
  checkAuthentication(callback, flag = false){
    this.tokenData.verifyingToken = true
    let token = localStorage.getItem('usertoken')
    let id = localStorage.getItem('account_id')
    let type = this.hash('show', null)
    if(token){
      if(flag === false){
        this.tokenData.loading = true
      }
      this.setToken(token)
      let vue = new Vue()
      console.log('TYPE::: ', type)
      this.user.login_type = type
      let verifyUrl = type === 'local' ? 'authenticate/user' : 'social_lite/verify_token'
      let parameters = type === 'local' ? {} : {id: id, token: token, provider: localStorage.getItem('login_with')}
      vue.APIRequest(verifyUrl, parameters, (userInfo) => {
        this.setUser(userInfo, null, null)
      }, (response) => {
        localStorage.clear()
        this.setToken(null)
        this.tokenData.verifyingToken = false
        this.tokenData.loading = false
        this.hash('hide', response.login_type)
        // ROUTER.push({
        //   path: this.currentPath
        // })
      }).catch(error => {
        console.log('ERRRROOORRR:: ', error)
      })

      if(!this.user.information) {
        // this.retrieveAccountProfileAndInformation(id)
      }

      return true
    }else{
      this.tokenData.verifyingToken = false
      this.tokenData.loading = false
      this.setUser(null)
      return false
    }
  },
  async retrieveAccountProfileAndInformation(id) {
    let condition = {
      condition: [
        {
          value: id,
          clause: '=',
          column: 'account_id'
        }
      ],
      offset: 0,
      limit: 1
    }
    let vue = new Vue()
    vue.APIRequest('account_informations/retrieve', condition, response => {
      this.user.information = response.data[0]
    }, error => {
      error
    })
    vue.APIRequest('account_profiles/retrieve', condition, response => {
      if(response.data.length > 0) {
        this.user.profile = response.data[0]
      }
    }, error => {
      error
    })
    vue.APIRequest('merchants/retrieve', condition, response => {
      if(response.data.length > 0) {
        this.user.merchant = response.data[0]
      }
    }, error => {
      error
    })
  },
  deaunthenticate(){
    this.tokenData.loading = false
    localStorage.removeItem('account_id')
    localStorage.removeItem('google_code')
    localStorage.removeItem('google_scope')
    localStorage.removeItem('xyzABCdefPayhiram')
    localStorage.removeItem('connect_with')
    this.setUser(null)
    let vue = new Vue()
    this.clearNotifTimer()
    if(this.hash('show', null) === 'local') {
      vue.APIRequest('authenticate/invalidate').then((response) => {
        localStorage.removeItem('usertoken')
        this.tokenData.token = null
        this.tokenData.loading = false
        ROUTER.go('/')
      })
    }else if(this.hash('show', null) === 'social_lite'){
      localStorage.removeItem('usertoken')
      this.tokenData.token = null
      this.tokenData.loading = false
      ROUTER.go('/')
    }
    localStorage.clear()
    // setTimeout(() => {
    //   this.tokenData.loading = false
    // }, 1000)
  },
  retrieveNotifications(accountId){
    let vue = new Vue()
    let parameter = {
      'account_id': accountId
    }
    vue.APIRequest('notifications/retrieve', parameter).then(response => {
      if(response.data.length > 0){
        this.user.notifications.data = response.data
        this.user.notifications.current = response.size
        if(this.user.notifications.current > 0){
          // this.playNotificationSound()
        }
      }else{
        this.user.notifications.data = null
        this.user.notifications.current = null
      }
    })
  },
  addNotification(notification){
    if(parseInt(this.user.userID) === parseInt(notification.to)){
      this.playNotificationSound()
      if(this.user.notifications.data === null){
        this.user.notifications.data = []
        this.user.notifications.data.push(notification)
        this.user.notifications.current = 1
      }else{
        this.user.notifications.data.unshift(notification)
        this.user.notifications.current += 1
      }
    }
  },
  retrieveMessages(accountId, type){
    let vue = new Vue()
    let parameter = {
      account_id: accountId
    }
    vue.APIRequest('messenger_groups/retrieve_summary_payhiram', parameter).then(response => {
      if(response.data !== null){
        this.user.messages.data = response.data
        this.user.messages.totalUnreadMessages = response.size
      }else{
        this.user.messages.data = null
        this.user.messages.totalUnreadMessages = null
      }
    })
  },
  addMessage(message){
    if(parseInt(message.messenger_group_id) === this.messenger.messengerGroupId && parseInt(message.account_id) !== this.user.userID){
      this.playNotificationSound()
      this.messenger.messages.push(message)
    }
  },
  startNotifTimer(accountId){
    if(this.notifTimer.timer === null){
      this.notifTimer.timer = window.setInterval(() => {
        if(accountId !== null){
          this.retrieveNotifications(accountId)
        }
      }, this.notifTimer.speed)
    }
  },
  clearNotifTimer(){
    if(this.notifTimer.timer !== null){
      window.clearInterval(this.notifTimer.timer)
      this.notifTimer.timer = null
    }
  },
  playNotificationSound(){
    let audio = require('src/assets/audio/notification.mp3')
    let sound = new Howl({
      src: [audio]
    })
    sound.play()
  },
  checkPlan(){
    if(Config.plan === true){
      if(this.user.plan !== null){
        if(this.user.plan.title === 'Expired' && this.user.type !== 'ADMIN'){
          ROUTER.push('/plan')
        }
      }
    }
  },
  redirect(path){
    ROUTER.push(path)
  },
  validateEmail(email){
    let reg = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)+.[a-zA-Z0-9]*$/
    let reqWhiteSpace = /\s/
    if(reqWhiteSpace.test(email)){
      return false
    }
    if(reg.test(email) === false){
      return false
    }else{
      return true
    }
  },
  checkOtp(setting){
    if(setting !== null){
      if(parseInt(setting.email_otp) === 1 || parseInt(setting.sms_otp) === 1){
        // ask otp code here
        $('#authenticateOTP').modal({
          backdrop: 'static',
          keyboard: true,
          show: true
        })
      }else{
        this.updateData()
      }
    }else{
      this.updateData()
    }
  },
  updateData(){
    // console.log('dashboard')
    // ROUTER.push(`/dashboard`)
  },
  setGoogleCode(code, scope){
    localStorage.setItem('google_code', code)
    localStorage.setItem('google_scope', scope)
    this.google.code = code
    this.google.scope = scope
  },
  getGoogleCode(){
    this.google.code = localStorage.getItem('google_code')
    this.google.scope = localStorage.getItem('google_scope')
  },
  displayAmount(amount){
    // amount.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, '1,')
    // console.log(amount)
    var formatter = new Intl.NumberFormat('en-US', {
      style: 'currency',
      currency: 'PHP'
    })
    return formatter.format(amount)
  },
  displayAmountWithCurrency(amount, currency){
    var formatter = new Intl.NumberFormat('en-US', {
      style: 'currency',
      currency: currency
    })
    return formatter.format(amount)
  }
}
