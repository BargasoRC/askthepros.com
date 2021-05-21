import config from 'src/config.js'
let APP_EMAIL = 'support@payhiram.ph'
export default {
  sidebarMenu: [
    // {accountType: 'ALL', showOnAdmin: true, accountStatus: 'ALL', description: 'Dashboard', icon: 'fa fa-arrow-right', path: 'dashboard', flag: false, subMenu: null}
      {id: 1, users: 'ALL', parent_id: 0, description: 'DASHBOARD', icon: '', path: 'dashboard', flag: false, subMenu: null},
  ],
  menuOff: [
      {id: 1, users: 'ALL', parent_id: 0, description: 'DASHBOARD', icon: 'fa fa-tachometer', path: 'dashboard', flag: false, subMenu: null},
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
  USER_TYPE_SETTING: false,
  plan: false,
  broadcastingFlag: true,
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
