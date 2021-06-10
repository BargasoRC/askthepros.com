<template>
  <div>
    <User v-if="user.type === 'USER'" />
    <Admin v-if="user.type === 'ADMIN'"/>
  </div>
</template>

<script>
import Admin from './Admin.vue'
import User from './User.vue'
import AUTH from 'src/services/auth'
export default {
  data() {
    return {
      user: AUTH.user
    }
  },
  components: {
    Admin,
    User
  }
}
</script>

<style>

</style>
