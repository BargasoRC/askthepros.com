export default{
  routes: [{
    path: '/signup/:category?',
    // name: 'signup',
    component: resolve => require(['modules/account/register.vue'], resolve),
    meta: {
      tokenRequired: false
    }
  }, {
    path: '/signup_partner',
    // name: 'signupPartner',
    component: resolve => require(['components/increment/basic/SignupPartner.vue'], resolve),
    meta: {
      tokenRequired: false
    }
  }, {
    path: '/verification/:email',
    // name: 'verification',
    component: resolve => require(['components/increment/basic/Verification.vue'], resolve),
    meta: {
      tokenRequired: false
    }
  }, {
    path: '/login_verification/:username/:code',
    // name: 'loginVerification',
    component: resolve => require(['modules/account/verification.vue'], resolve),
    meta: {
      tokenRequired: false
    }
  }, {
    path: '/login',
    // name: 'loginAccount',
    component: resolve => require(['modules/account/login.vue'], resolve),
    meta: {
      tokenRequired: false
    }
  }, {
    path: '/request_reset_password',
    // name: 'requestResetPassword',
    component: resolve => require(['modules/account/resetPassword.vue'], resolve),
    meta: {
      tokenRequired: false
    }
  }, {
    path: '/reset_password/:username/:code',
    // name: 'resetPassword',
    component: resolve => require(['modules/account/resetNewPassword.vue'], resolve),
    meta: {
      tokenRequired: false
    }
  }, {
    path: '/',
    // name: 'home',
    component: resolve => require(['src/modules/landing/Home.vue'], resolve),
    meta: {
      tokenRequired: false
    }
  }, {
    path: '/dashboard',
    // name: 'home',
    component: resolve => require(['src/modules/dashboard/index.vue'], resolve),
    meta: {
      tokenRequired: true
    }
  }, {
    path: '/payments',
    // name: 'home',
    component: resolve => require(['src/modules/payments/index.vue'], resolve),
    meta: {
      tokenRequired: true
    }
  }, {
    path: '/subscriptions',
    // name: 'home',
    component: resolve => require(['src/modules/subscriptions/index.vue'], resolve),
    meta: {
      tokenRequired: true
    }
  }, {
    path: '/channels',
    // name: 'channel',
    component: resolve => require(['src/modules/channels/index.vue'], resolve),
    meta: {
      tokenRequired: true
    }
  }, {
    path: '/channels/branding',
    // name: 'channel',
    component: resolve => require(['src/modules/channels/Branding.vue'], resolve),
    meta: {
      tokenRequired: true
    }
  }, {
    path: '/channels/automation',
    // name: 'channel',
    component: resolve => require(['src/modules/channels/AutomationSettings.vue'], resolve),
    meta: {
      tokenRequired: true
    }
  }, {
    path: '/accounts',
    // name: 'home',
    component: resolve => require(['src/modules/account/accounts.vue'], resolve),
    meta: {
      tokenRequired: true
    }
  }, {
    path: '/settings',
    // name: 'home',
    component: resolve => require(['src/modules/account/settings.vue'], resolve),
    meta: {
      tokenRequired: true
    }
  }, {
    path: '/post_management',
    // name: 'home',
    component: resolve => require(['src/modules/postManagement/index.vue'], resolve),
    meta: {
      tokenRequired: true
    }
  }, {
    path: '/contact',
    // name: 'contactPage',
    component: resolve => require(['src/modules/landing/Contact.vue'], resolve),
    meta: {
      tokenRequired: false
    }
  }, {
    path: '/post_management/view/:parameter',
    // name: 'post_management',
    component: resolve => require(['src/modules/postManagement/UserReview.vue'], resolve),
    meta: {
      tokenRequired: true
    }
  }, {
    path: '/post_management/history',
    // name: 'post_management',
    component: resolve => require(['src/modules/postManagement/UserHistory.vue'], resolve),
    meta: {
      tokenRequired: true
    }
  }, {
    path: '/post_management/edit/:parameter?',
    // name: 'post_management',
    component: resolve => require(['src/modules/postManagement/AdminEdit.vue'], resolve),
    meta: {
      tokenRequired: true
    }
  }, {
    path: '/post_management/content_edit/:parameter?',
    // name: 'post_management',
    component: resolve => require(['src/modules/postManagement/ContentExpert.vue'], resolve),
    meta: {
      tokenRequired: true
    }
  }, {
    path: '/checkout/:plan',
    // name: 'payment_checkout',
    component: resolve => require(['src/modules/payments/checkout.vue'], resolve),
    meta: {
      tokenRequired: true
    }
  }, {
    path: '/subscriptions_management',
    // name: 'subscriptions_management',
    component: resolve => require(['src/modules/subscriptions/index.vue'], resolve),
    meta: {
      tokenRequired: true
    }
  },
  {
    path: '/billing_management',
    // name: 'billing_management',
    component: resolve => require(['src/modules/billing/index.vue'], resolve),
    meta: {
      tokenRequired: true
    }
  },
  // {
  //   path: '/no_subscriptions',
    // name: 'no_subscriptions',
  //   component: resolve => require(['src/modules/subscriptions/index.vue'], resolve),
  //   meta: {
  //     tokenRequired: true
  //   }
  // }
  {
    path: '/authentication',
    name: 'authentication',
    component: resolve => require(['src/modules/generic/authentication.vue'], resolve),
    meta: {
      tokenRequired: false
    }
  },
  {
    path: '/thankyou',
    name: 'thankyou',
    component: resolve => require(['src/modules/subscriptions/thankYou.vue'], resolve),
    meta: {
      tokenRequired: true
    }
  },
  {
    path: '/stepper/:industry?',
    name: 'stepper',
    component: resolve => require(['src/modules/generic/Stepper.vue'], resolve),
    meta: {
      tokenRequired: false
    }
  }
  ]
}
