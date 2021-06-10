<template>
  <div>
    <Admin v-if="user.type === 'ADMIN'"/>
    <Expert v-if-else="user.type === 'EXPERT'"/>
  </div>
</template>

<script>
import Admin from './AdminDashboard.vue'
import Expert from './ContentExpertDashboard.vue'
import AUTH from 'src/services/auth'
export default {
  data() {
    return {
      user: AUTH.user
    }
  },
  components: {
    Admin,
    Expert
  }
}
</script>

<style>

</style>
