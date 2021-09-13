<template>
  <div>
    <Admin v-if="user.type === 'USER'" />
    <Admin v-if="user.type === 'ADMIN'"/>
    <Expert v-if="user.type === 'EXPERT'"/>
  </div>
</template>

<script>
import Admin from './Admin.vue'
import User from './User.vue'
import Expert from './ContentExpert.vue'
import AUTH from 'src/services/auth'
export default {
  data() {
    return {
      user: AUTH.user
    }
  },
  components: {
    Admin,
    User,
    Expert
  }
}
</script>

<style>

</style>
