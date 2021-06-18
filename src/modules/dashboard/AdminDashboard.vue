<template>
  <div class="holder">
    <h3>Hello, Admin!</h3>
    <p>Here are the latest update of activities as of today.</p>
    <div class="col-sm-12 col-md-12 col-lg-12 d-flex justify-content-end p-0 mb-5 mt-0">
        <roundedBtn
            :onClick="newPost"
            :icon="'fas fa-plus'"
            :text="'New Post'"
            :icon_position="'right'"
            :styles="{
                backgroundColor: '#01009A',
                color: 'white'
            }"
        />
    </div>
    <div class="row">
      <div class="col-lg-9">
        <h3>Latest Posts</h3>
        <table class="table col-lg-11 table-bordered">
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
  margin-bottom: 20vh;
  float: left;
  color: $title;
  min-height: 100vh;
}

h3 {
    margin-top: 25px;
    font-weight: bold;
    font-size: 21px;
}

p {
  color: $text;
} 

</style>
<script>
import roundedBtn from 'src/modules/generic/roundedBtn'
import COLORS from 'src/assets/style/colors.js'
import ROUTER from 'src/router'
export default {
  data() {
    return {
      colors: COLORS
    }
  },
  components: {
    roundedBtn
  },
  methods: {
    newPost() {
      console.log('Admin New Post::')
      // ROUTER.push('post_management')
    }
  }
}
</script>
