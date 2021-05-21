import AUTH from 'services/auth'
import COMMON from '../common'
let CONFIG = require('config.js')
let beforeEnter = (to, from, next) => {
  // TODO Redirect if no token when token is required in meta.tokenRequired
  AUTH.currentPath = to.path
  let userID = parseInt(localStorage.getItem('account_id'))
  let token = localStorage.getItem('usertoken')
  COMMON.setFag(to.path)
  if(token !== null && userID > 0){
    if(to.path === '/' || to.meta.tokenRequired === false){
      next({path: '/orders'})
    }else{
      next()
    }
  }else if(to.meta.tokenRequired === true){
    next({path: '/'})
  }else{
    next()
  }
}
var devRoutes = []
let app = require('./dev_routes/app.js')
devRoutes = devRoutes.concat(app.default.routes)
for(let x = 0; x < devRoutes.length; x++){
  devRoutes[x]['beforeEnter'] = beforeEnter
}
let routes = [
  {
    path: '/',
    name: 'login',
    redirect: '/login',
    component: resolve => require(['components/increment/basic/LoginWithoutRegister.vue'], resolve),
    beforeEnter: beforeEnter
  }
]
// if(CONFIG.default.IS_DEV){
routes = routes.concat(devRoutes)
// }
export default{
  routes: routes
}
