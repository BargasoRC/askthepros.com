// src/auth/index.js
import {router} from 'src/router/index'
import ROUTER from 'src/router'
import {Howl} from 'howler'
import Vue from 'vue'
import Echo from 'laravel-echo'
import COMMON from 'src/common.js'
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
    },
    storeId: null
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
  notification: {
    type: '',
    order: [],
    crockery: []
  },
  setNotificationType(type) {
    this.notification.type = type
  },
  setNotificationOrders(payload) {
    this.notification.order.push(payload)
  },
  setNotificationCrockery(payload) {
    this.notification.crockery.push(payload)
  },
  setUser(userID, username, email, type, status, profile, notifSetting, subAccount, code, storeId){
    if(userID === null){
      username = null
      email = null
      type = null
      status = null
      profile = null
      notifSetting = null
      subAccount = null
      code = null
    }
    this.user.userID = userID * 1
    this.user.username = username
    this.user.email = email
    this.user.type = type
    this.user.status = status
    this.user.profile = profile
    this.user.notifSetting = notifSetting
    this.user.subAccount = subAccount
    this.user.code = code
    this.user.storeId = storeId
    localStorage.setItem('account_id', this.user.userID)
    localStorage.setItem('store_id', this.user.storeId)
    setTimeout(() => {
      this.tokenData.loading = false
    }, 1000)
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
  authenticate(username, password, callback, errorCallback){
    let vue = new Vue()
    // let credentials = {
    //   username: username,
    //   password: password,
    //   status: 'VERIFIED'
    // }
    let parameter = 'storefront_login' + `?Email=${username}&Password=${password}`
    vue.APIGetRequest(parameter, (response) => {
      this.tokenData.loading = false
      this.tokenData.verifyingToken = false
      if(typeof response !== 'string'){
        let token = response.authorization.access_token
        this.tokenData.token = token
        localStorage.setItem('usertoken', token)
        localStorage.setItem('email', username)
        localStorage.setItem('password', password)
        this.retrieveStoreId(response.customer.id)
        .then(res => {
          if(res.customers.length > 0){
            this.setUser(response.customer.id, null, response.customer.email, null, null, null, null, null, null, res.customers[0].registered_in_store_id)
            ROUTER.push('/orders')
            COMMON.setFag('/orders')
          }
        })
        .catch(error => {
          error
          console.log('Retrieving customer information error')
        })
        $('#loading').css({'display': 'none'})
      }else{
        $('#loading').css({'display': 'none'})
        this.tokenData.loading = false
        this.tokenData.verifyingToken = false
        this.removeAuthentication()
        ROUTER.push('/login')
      }
      if(callback){
        callback(response)
      }
    },
    (response, status) => {
      if(errorCallback){
        errorCallback(response, status)
        this.tokenData.loading = false
        this.tokenData.verifyingToken = false
      }
    }
    )
  },
  customCheckAuthentication(callback, flag = false){
    this.tokenData.verifyingToken = true
    let token = localStorage.getItem('usertoken')
    if(token){
      if(flag === false){
        this.tokenData.loading = true
      }
      this.setToken(token)
      let vue = new Vue()
      let username = localStorage.getItem('email')
      let password = localStorage.getItem('password')
      let storeId = localStorage.getItem('store_id')

      let parameter = 'storefront_login' + `?Email=${username}&Password=${password}`
      vue.APIGetRequest(parameter, response => {
        this.setUser(response.customer.id, null, response.customer.email, null, null, null, null, null, null, storeId)
        this.tokenData.verifyingToken = false
        this.tokenData.loading = false
        let location = window.location.href
        if(this.currentPath){
          // ROUTER.push(this.currentPath)
        }else{
          window.location.href = location
        }
      })
      return true
    }else{
      this.tokenData.verifyingToken = false
      this.setUser(null)
      return false
    }
  },
  removeAuthentication(){
    localStorage.clear()
    this.tokenData.token = null
    this.setUser(null)
    $('#loading').css({'display': 'none'})
    ROUTER.push('/')
  },
  checkAuthentication(callback, flag = false){
    this.tokenData.verifyingToken = true
    let token = localStorage.getItem('usertoken')
    if(token){
      if(flag === false){
        this.tokenData.loading = true
      }
      this.setToken(token)
      let vue = new Vue()
      vue.APIRequest('authenticate/user', {}, (userInfo) => {
        let parameter = {
          'condition': [{
            'value': userInfo.id,
            'clause': '=',
            'column': 'id'
          }]
        }
        vue.APIRequest('accounts/retrieve', parameter).then(response => {
          let profile = response.data[0].account_profile
          let notifSetting = response.data[0].notification_settings
          let subAccount = response.data[0].sub_account
          this.setUser(userInfo.id, userInfo.username, userInfo.email, userInfo.account_type, userInfo.status, profile, notifSetting, subAccount, userInfo.code)
        }).done(response => {
          this.tokenData.verifyingToken = false
          this.tokenData.loading = false
          let location = window.location.href
          if(this.currentPath){
            // ROUTER.push(this.currentPath)
          }else{
            window.location.href = location
          }
        })
        this.retrieveNotifications(userInfo.id)
        this.retrieveMessages(userInfo.id, userInfo.account_type)
        this.getGoogleCode()
      }, (response) => {
        this.setToken(null)
        this.tokenData.verifyingToken = false
        ROUTER.push({
          path: this.currentPath
        })
      })
      return true
    }else{
      this.tokenData.verifyingToken = false
      this.setUser(null)
      return false
    }

  },
  deaunthenticate(){
    this.tokenData.loading = false
    localStorage.removeItem('usertoken')
    localStorage.removeItem('account_id')
    localStorage.removeItem('google_code')
    localStorage.removeItem('google_scope')
    localStorage.removeItem('xyzABCdefPayhiram')
    this.setUser(null)
    let vue = new Vue()
    vue.APIRequest('authenticate/invalidate')
    this.clearNotifTimer()
    this.tokenData.token = null
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
        this.proceedToLogin()
      }
    }else{
      this.proceedToLogin()
    }
  },
  proceedToLogin(){
    this.setToken(this.tokenData.token)
    let userInfo = this.otpDataHolder.userInfo
    let data = this.otpDataHolder.data
    let profile = data[0].account_profile
    let notifSetting = data[0].notification_settings
    let subAccount = data[0].sub_account
    this.setUser(userInfo.id, userInfo.username, userInfo.email, userInfo.account_type, userInfo.status, profile, notifSetting, subAccount)
    ROUTER.push('/requests')
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
  },
  retrieveStoreId(userID) {
    return new Promise((resolve, reject) => {
      let vue = new Vue()
      vue.APIGetRequest(`customers/${userID}`, response => {
        resolve(response)
      }, error => {
        reject(error)
      })
    })
  }
}
