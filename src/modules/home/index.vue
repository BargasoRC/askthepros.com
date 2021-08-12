<template>
  <div>
    <NewBanner ref="newBanner"></NewBanner>
    <!-- <HomeBanner></HomeBanner> -->
    <CallToAction></CallToAction>
    <Subscription></Subscription>
    <Testimonials></Testimonials>
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
export default {
  components: {
    HomeBanner,
    CallToAction,
    Subscription,
    Testimonials,
    NewBanner
  },
  data() {
    return {}
  },
  methods: {}
}
</script>
