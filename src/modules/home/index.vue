<template>
  <div>
    <NewBanner></NewBanner>
    <!-- <HomeBanner></HomeBanner> -->
    <!-- <CallToAction></CallToAction>
    <Subscription></Subscription>
    <Testimonials></Testimonials> -->
    <newTestimonials></newTestimonials>
  </div>
</template>
<script>
import ROUTER from 'src/router'
import Jquery from 'jquery'
import NewBanner from 'src/modules/home/new/newBanner.vue'
import HomeBanner from 'src/modules/home/Banner.vue'
import CallToAction from 'src/modules/home/CallToAction.vue'
import Subscription from 'src/modules/home/Subscription.vue'
import Testimonials from 'src/modules/home/Testimonials.vue'
import newTestimonials from 'src/modules/home/new/newTestimonial.vue'
export default {
  components: {
    HomeBanner,
    CallToAction,
    Subscription,
    Testimonials,
    NewBanner,
    newTestimonials
  },
  data() {
    return {}
  },
  methods: {}
}
</script>
