<template>
  <div class="holder">
    <h3 style="margin-top: 25px;">Payments!</h3>

    <div class="row" style="margin-top: 25px">
      <div class="col-lg-12">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th scope="col">Title</th>
              <th scope="col">Channels</th>
              <th scope="col">Links</th>
              <th scope="col">Status</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">Test</th>
              <td>Test</td>
              <td>Test</td>
              <td>Test</td>
            </tr>
            <tr>
              <th scope="row">Test</th>
              <td>Test</td>
              <td>Test</td>
              <td>Test</td>
            </tr>
            <tr>
              <th scope="row">Test</th>
              <td>Test</td>
              <td>Test</td>
              <td>Test</td>
            </tr>
            <tr>
              <th scope="row">Test</th>
              <td>Test</td>
              <td>Test</td>
              <td>Test</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    
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
export default {
  data() {
    return {
      colors: COLORS
    }
  },
  components: {
    dialogueBtn
  },
  methods: {
    connect(item){
      // ROUTER.push('/' + item.payload)
    }
  }
}
</script>
