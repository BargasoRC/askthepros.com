import config from 'src/config.js'
let APP_EMAIL = 'support@payhiram.ph'
export default {
  sidebarMenu: [
    // {accountType: 'USER', showOnAdmin: true, accountStatus: 'ALL', description: 'Dashboard', icon: 'fa fa-tachometer', path: 'dashboard', flag: false, subMenu: null},
    {accountType: 'EXPERT', showOnAdmin: true, accountStatus: 'ALL', description: 'Dashboard', icon: 'fa fa-tachometer', path: 'dashboard', flag: false, subMenu: null},
    {accountType: 'ADMIN', showOnAdmin: true, accountStatus: 'ALL', description: 'Post Management', icon: 'fas fa-play', path: 'post_management', flag: false, subMenu: null},
    {accountType: 'ADMIN', showOnAdmin: true, accountStatus: 'ALL', description: 'Accounts Management', icon: 'fa fa-tachometer', path: 'accounts', flag: false, subMenu: null},
    {accountType: 'ADMIN', showOnAdmin: true, accountStatus: 'ALL', description: 'Billing Management', icon: 'fa fa-tachometer', path: 'billing_management', flag: false, subMenu: null},
    {accountType: 'ADMIN', showOnAdmin: true, accountStatus: 'ALL', description: 'Subscription Management', icon: 'fa fa-tachometer', path: 'subscriptions_management', flag: false, subMenu: null},
    {accountType: 'USER', showOnAdmin: false, accountStatus: 'ALL', description: 'Post Management', icon: 'fa fa-credit-card', path: 'post_management', flag: false, subMenu: null},
    {accountType: 'USER', showOnAdmin: false, accountStatus: 'ALL', description: 'Social Media Channels', icon: 'fa fa-credit-card', path: 'channels', flag: false, subMenu: null},
    {accountType: 'USER', showOnAdmin: true, accountStatus: 'ALL', description: 'Account Settings', icon: 'fa fa-cogs', path: 'settings', flag: false, subMenu: null},
    {accountType: 'USER', showOnAdmin: false, accountStatus: 'ALL', description: 'Subscription', icon: 'fa fa-credit-card', path: 'subscriptions', flag: false, subMenu: null},
    {accountType: 'USER', showOnAdmin: false, accountStatus: 'ALL', description: 'Payments', icon: 'fa fa-credit-card', path: 'payments', flag: false, subMenu: null}
  ],
  menuOff: [
      {id: 1, users: 'ALL', parent_id: 0, description: 'Dashboard', icon: 'fa fa-tachometer', path: 'dashboard', flag: false, subMenu: null}
  ],
  APP_NAME: 'askthepros.com',
  APP_NAME_HTML: 'askthepros.com',
  APP_EMAIL: APP_EMAIL,
  APP_SITE: 'https://askthepros.com',
  COMPANY: 'Ask The Pros',
  COMPANY_URL: 'http://askthepros.com',
  COPYRIGHT: 'askthepros.com ' + new Date().getFullYear(),
  USER_TYPE: [{
    title: 'USER'
  }],
  pusher: {
    channel: 'askthepros'
  },
  USER_TYPE_SETTING: false,
  plan: false,
  broadcastingFlag: true,
  header: ['status', 'notification'], // 'messenger', '',
  settingsMenu: [
    {title: 'Profile', type: 'profile', allowed: ['cellular_number', 'address', 'sex', 'birth_date']},
    {title: 'Account', type: 'account', allowed: []},
    {title: 'Business Profile', type: 'merchant', allowed: ['email', 'address']},
    {title: 'Notifications', type: 'notification', allowed: []},
    {title: 'Identifications', type: 'identifications', allowed: []}
  ],
  setFag(currentPath){
    this.sidebarMenu.map(item => {
      if(`/${item.path}` === currentPath){
        item.flag = true
      }else{
        item.flag = false
      }
    })
  }
}
