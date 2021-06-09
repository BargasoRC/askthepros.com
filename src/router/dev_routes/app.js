
export default{
  routes: [{
    path: '/signup',
    name: 'signup',
    component: resolve => require(['modules/account/register.vue'], resolve),
    meta: {
      tokenRequired: false
    }
  }, {
    path: '/signup_partner',
    name: 'signupPartner',
    component: resolve => require(['components/increment/basic/SignupPartner.vue'], resolve),
    meta: {
      tokenRequired: false
    }
  }, {
    path: '/verification/:email',
    name: 'verification',
    component: resolve => require(['components/increment/basic/Verification.vue'], resolve),
    meta: {
      tokenRequired: false
    }
  }, {
    path: '/login_verification/:username/:code',
    name: 'loginVerification',
    component: resolve => require(['components/increment/basic/LoginByVerification.vue'], resolve),
    meta: {
      tokenRequired: false
    }
  }, {
    path: '/login',
    name: 'loginAccount',
    component: resolve => require(['modules/account/login.vue'], resolve),
    meta: {
      tokenRequired: false
    }
  }, {
    path: '/request_reset_password',
    name: 'requestResetPassword',
    component: resolve => require(['modules/account/resetPassword.vue'], resolve),
    meta: {
      tokenRequired: false
    }
  }, {
    path: '/reset_password/:username/:code',
    name: 'resetPassword',
    component: resolve => require(['components/increment/basic/ResetPassword.vue'], resolve),
    meta: {
      tokenRequired: false
    }
  }, {
    path: '/',
    name: 'home',
    component: resolve => require(['src/modules/home/index.vue'], resolve),
    meta: {
      tokenRequired: false
    }
  }, {
    path: '/dashboard',
    name: 'home',
    component: resolve => require(['src/modules/dashboard/index.vue'], resolve),
    meta: {
      tokenRequired: true
    }
  }, {
    path: '/payments',
    name: 'home',
    component: resolve => require(['src/modules/payments/index.vue'], resolve),
    meta: {
      tokenRequired: true
    }
  }, {
    path: '/subscriptions',
    name: 'home',
    component: resolve => require(['src/modules/subscriptions/index.vue'], resolve),
    meta: {
      tokenRequired: true
    }
  }, {
    path: '/channels',
    name: 'home',
    component: resolve => require(['src/modules/channels/index.vue'], resolve),
    meta: {
      tokenRequired: true
    }
  }, {
    path: '/accounts',
    name: 'home',
    component: resolve => require(['src/modules/account/accounts.vue'], resolve),
    meta: {
      tokenRequired: true
    }
  }, {
    path: '/settings',
    name: 'home',
    component: resolve => require(['src/modules/account/settings.vue'], resolve),
    meta: {
      tokenRequired: true
    }
  }, {
    path: '/post_management',
    name: 'home',
    component: resolve => require(['src/modules/postManagement/index.vue'], resolve),
    meta: {
      tokenRequired: true
    }
  }, {
    path: '/contact',
    name: 'home',
    component: resolve => require(['src/modules/home/Contact.vue'], resolve),
    meta: {
      tokenRequired: false
    }
  }
  ]
}
