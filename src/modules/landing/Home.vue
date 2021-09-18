<template>
  <div>
    <login-header></login-header>
    <NewBanner ref="ThisBanner"></NewBanner>
    <!-- <Trademark></Trademark> -->
    <!-- <HomeBanner></HomeBanner> -->
    <!-- <CallToAction></CallToAction>
    <Subscription></Subscription>
    <Testimonials></Testimonials> -->
    <!-- <newTestimonials></newTestimonials> -->
    <landing-footer></landing-footer>
  </div>
</template>
<script>
import ROUTER from 'src/router'
import Jquery from 'jquery'
import Trademark from 'src/modules/landing/new/Trademark.vue'
import NewBanner from 'src/modules/landing/new/newBanner.vue'
import HomeBanner from 'src/modules/landing/Banner.vue'
import CallToAction from 'src/modules/landing/CallToAction.vue'
import Subscription from 'src/modules/landing/Subscription.vue'
import Testimonials from 'src/modules/landing/Testimonials.vue'
import newTestimonials from 'src/modules/landing/new/newTestimonial.vue'
export default {
  components: {
    HomeBanner,
    CallToAction,
    Subscription,
    Testimonials,
    NewBanner,
    newTestimonials,
    Trademark,
    'login-header': () => import('modules/frame/Header2.vue'),
    'landing-footer': () => import('modules/frame/Footer2.vue')
  },
  data() {
    return {}
  },
  methods: {}
}
</script>
