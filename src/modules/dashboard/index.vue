<template>
  <div>
    <Admin v-if="user.type === 'ADMIN'"/>
    <Expert v-if="user.type === 'EXPERT'"/>
    <User v-if="user.type === 'USER'"/>
  </div>
</template>

<script>
import Admin from './AdminDashboard.vue'
import Expert from './ContentExpertDashboard.vue'
import User from './UserDashboard.vue'
import AUTH from 'src/services/auth'
export default {
  data() {
    return {
      user: AUTH.user
    }
  },
  components: {
    Admin,
    Expert,
    User
  }
}
</script>

<style>

</style>
