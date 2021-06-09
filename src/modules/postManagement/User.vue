<template>
  <div class="holder">
    <h3 style="margin-top: 25px;">Post Management</h3>
    <p>Connect to your social media channels, then setup your branding and choose your automation.</p>

    <div style="margin-top: 3%">
        <roundedBtn
            :text="'For Review'"
            class="button"
            :styles="{
                backgroundColor: colors.primary,
                color: 'white',
                width: '15%',
                borderTopRightRadius: '0px !important',
                borderBotttomLeftRadius: '0px !important',
                outlineColor: colors.primary
            }"
        />
        <roundedBtn
            :text="'History'"
            class="button1"
            :styles="{
                backgroundColor: colors.white,
                color: 'white',
                width: '15%',
                borderTopLeftRadius: '0px !important',
                borderBottomLeftRadius: '0px !important',
                marginLeft: '-3px'
            }"
        />
    </div>
    <p style="margin-top: 5px"><i style="color: red">**</i><i>This section only displays list of post if Automation Settings is set to "Review" not autopost. Post will not be posted on social media channels, unless approved.</i></p>

    <table class="table table-bordered table-responsive" v-if="data.length > 0" style="margin-top: 3%">
      <thead>
        <tr>
          <th scope="col">Date</th>
          <th scope="col">Post Title</th>
          <th scope="col">Channels To Post</th>
          <th scope="col">Status</th>
          <th scope="col">Review</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(item, index) in data" :key="index">
          <td>{{item.date}}</td>
          <td>{{item.post_title}}</td>
          <td>{{item.channels_to_post}}</td>
          <td>{{item.status}}</td>
          <td><i class="fa fa-eye text-primary" style="margin-left: 5px; float: left;" @click="review(item.id)"></i></td>
        </tr>
      </tbody>
    </table>

    <Pager
      :pages="numPages"
      :active="activePage"
      :limit="limit"
      v-if="data.length > 0"
    />


    <empty v-if="data.length <= 0" :title="'No accounts available!'" :action="'Keep growing.'"></empty>
  </div>
</template>

<script>
import roundedBtn from 'src/modules/generic/roundedBtn'
import COLORS from 'src/assets/style/colors.js'
import Pager from 'src/components/increment/generic/pager/Pager.vue'
import ROUTER from 'src/router'
export default {
  data() {
    return {
      data: [{
        id: 1,
        date: '05/18/2021',
        post_title: 'My Post Title',
        channels_to_post: 'Google My Business, Facebook, LinkedIn',
        status: 'Pending'
      },
      {
        id: 2,
        date: '05/18/2021',
        post_title: 'My Post Title',
        channels_to_post: 'Google My Business, Facebook, LinkedIn',
        status: 'Pending'
      },
      {
        id: 3,
        date: '05/18/2021',
        post_title: 'My Post Title',
        channels_to_post: 'Google My Business, Facebook, LinkedIn',
        status: 'Pending'
      }],
      colors: COLORS,
      limit: 5,
      offset: 0,
      numPages: null,
      activePage: 1
    }
  },
  components: {
    roundedBtn,
    'empty': require('components/increment/generic/empty/Empty.vue'),
    Pager
  },
  methods: {
    review(id){
      ROUTER.push('post_management/view/' + id)
    }
  }
}
</script>

<style scoped lang="scss" scoped>
@import "~assets/style/colors.scss";
.holder{
  width: 96%;
  margin-left: 2%;
  margin-right: 2%;
  float: left;
}
.button{
  border-bottom-right-radius: 0px !important;
  outline-color: $primary !important;
}
.button1{
  color: $primary !important;
  outline-color: $primary !important;
}
</style>
