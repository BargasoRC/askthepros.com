<template>
  <div>
    <Admin v-if="user.type === 'ADMIN'"/>
  </div>
</template>

<script>
import Admin from './Admin.vue'
import AUTH from 'src/services/auth'
export default {
  data() {
    return {
      user: AUTH.user
    }
  },
  components: {
    Admin
  }
}
</script>

<style>

</style>
