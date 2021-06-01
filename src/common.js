import config from 'src/config.js'
let APP_EMAIL = 'support@payhiram.ph'
export default {
  sidebarMenu: [
    // {accountType: 'ALL', showOnAdmin: true, accountStatus: 'ALL', description: 'Dashboard', icon: 'fa fa-arrow-right', path: 'dashboard', flag: false, subMenu: null}
      {id: 1, users: 'ALL', parent_id: 0, description: 'Dashboard', icon: 'fa fa-tachometer', path: 'dashboard', flag: false, subMenu: null},
      {id: 2, users: 'ALL', parent_id: 0, description: 'Post Management', icon: 'fa fa-tachometer', path: 'post_management', flag: false, subMenu: null},
      {id: 3, users: 'ADMIN', parent_id: 0, description: 'Accounts Management', icon: 'fa fa-tachometer', path: 'account_management', flag: false, subMenu: null},
      {id: 8, users: 'ADMIN', parent_id: 0, description: 'Billings Managament', icon: 'fa fa-tachometer', path: 'billings_management', flag: false, subMenu: null},
      {id: 9, users: 'ADMIN', parent_id: 0, description: 'Subscriptions Management', icon: 'fa fa-tachometer', path: 'subscriptions_management', flag: false, subMenu: null},
      {id: 5, users: 'ADMIN', parent_id: 0, description: 'Accounts Management', icon: 'fa fa-tachometer', path: 'account_management', flag: false, subMenu: null},
      {id: 4, users: 'USER', parent_id: 0, description: 'Social Media Channels', icon: 'fa fa-tachometer', path: 'social_media_channels', flag: false, subMenu: null},
      {id: 4, users: 'ALL', parent_id: 0, description: 'Account Settings', icon: 'fa fa-tachometer', path: 'account_settings', flag: false, subMenu: null},
      {id: 6, users: 'USER', parent_id: 0, description: 'Subscription', icon: 'fa fa-tachometer', path: 'subscriptions', flag: false, subMenu: null},
      {id: 7, users: 'USER', parent_id: 0, description: 'Payments', icon: 'fa fa-tachometer', path: 'payments', flag: false, subMenu: null}
  ],
  menuOff: [
      {id: 1, users: 'ALL', parent_id: 0, description: 'Dashboard', icon: 'fa fa-tachometer', path: 'dashboard', flag: false, subMenu: null}
  ],
  APP_NAME: 'askthepros.com',
  APP_NAME_HTML: 'askthepros.com',
  APP_EMAIL: APP_EMAIL,
  APP_SITE: 'https://askthepros.com',
  COMPANY: 'Meat The Sea',
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
