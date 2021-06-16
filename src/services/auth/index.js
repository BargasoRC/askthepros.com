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
    userID: 0,
    username: '',
    email: null,
    type: null,
    status: null,
    profile: null,
    information: null,
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
    ledger: {
      amount: 0,
      currency: 'PHP'
    }
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
      console.log('hi', user)
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
      vue.APIRequest('authenticate/user', {}, (userInfo) => {
        console.log('userInfo')
        this.setUser(userInfo, null, null)
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
      let verifyUrl = type === 'local' ? 'authenticate/user' : 'social_lite/verify_token'
      let parameters = type === 'local' ? {} : {id: id, token: token, provider: localStorage.getItem('login_with')}
      vue.APIRequest(verifyUrl, parameters, (userInfo) => {
        this.setUser(userInfo, null, null)
      }, (response) => {
        this.setToken(null)
        this.tokenData.verifyingToken = false
        this.tokenData.loading = false
        this.hash('hide', response.login_type)
        ROUTER.push({
          path: this.currentPath
        })
      }).catch(error => {
        console.log('ERRRROOORRR:: ', error)
      })
      return true
    }else{
      this.tokenData.verifyingToken = false
      this.tokenData.loading = false
      this.setUser(null)
      return false
    }

  },
  deaunthenticate(){
    this.tokenData.loading = true
    localStorage.removeItem('usertoken')
    localStorage.removeItem('account_id')
    localStorage.removeItem('google_code')
    localStorage.removeItem('google_scope')
    localStorage.removeItem('xyzABCdefPayhiram')
    localStorage.clear()
    this.setUser(null)
    let vue = new Vue()
    vue.APIRequest('authenticate/invalidate')
    this.clearNotifTimer()
    this.tokenData.token = null
    setTimeout(() => {
      this.tokenData.loading = true
    }, 1000)
    ROUTER.go('/')
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
    console.log('dashboard')
    ROUTER.push(`/${this.user.type.toLowerCase()}/dashboard`)
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
  },
  showRequestType(type){
    switch(parseInt(type)){
      case 1: return 'Send'
      case 2: return 'Withdrawal'
      case 3: return 'Deposit'
      case 4: return 'Bills and Payments'
      case 101: return 'Lending'
      case 102: return 'Installment'
    }
  }
}
