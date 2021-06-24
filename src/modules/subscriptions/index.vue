<template>
  <div>
    <User v-if="user.type === 'USER'"/>
    <Admin v-if="user.type === 'ADMIN'"/>
  </div>
</template>
<style scoped lang="scss" scoped>
@import "~assets/style/colors.scss";
.holder{
  width: 96%;
  margin-left: 2%;
  margin-right: 2%;
  float: left;
}
</style>
<script>
import dialogueBtn from 'src/modules/generic/dialogueBtn'
import COLORS from 'src/assets/style/colors.js'
import ROUTER from 'src/router'
import User from './user'
import Admin from './admin'
import AUTH from 'src/services/auth'
export default {
  data() {
    return {
      colors: COLORS,
      user: AUTH.user
    }
  },
  components: {
    dialogueBtn,
    User,
    Admin
  },
  methods: {}
}
</script>
