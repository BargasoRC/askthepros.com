<template>
  <div>
    <Admin v-if="user.type === 'ADMIN'"/>
  </div>
</template>

<script>
import Admin from './admin'
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
<style scoped lang="scss" scoped>
@import "~assets/style/colors.scss";

</style>
