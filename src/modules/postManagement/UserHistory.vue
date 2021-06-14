<template>
  <div class="holder">
    <h3 style="margin-top: 25px;">Post Management</h3>
    <p>Connect to your social media channels, then setup your branding and choose your automation.</p>

    <div style="margin-top: 3%">
        <roundedBtn
            :onClick="forReview"
            :text="'For Review'"
            class="button"
            :styles="{
                backgroundColor: colors.white,
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
                backgroundColor: colors.primary,
                outlineColor: colors.primary,
                color: 'white',
                width: '15%',
                borderTopLeftRadius: '0px !important',
                borderBottomLeftRadius: '0px !important',
                marginLeft: '-5px'
            }"
        />
    </div>

    <table class="table table-bordered table-responsive" v-if="data.length > 0" style="margin-top: 3%">
      <thead>
        <tr>
          <th scope="col">Date Posted</th>
          <th scope="col">Time Posted</th>
          <th scope="col">Post Title</th>
          <th scope="col">Channels Posted To</th>
          <th scope="col">Link</th>
          <th scope="col">Status</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(item, index) in data" :key="index">
          <td>{{item.date}}</td>
          <td>{{item.time}}</td>
          <td>{{item.post_title}}</td>
          <td>{{item.channels_posted_to}}</td>
          <td><a :href="item.link" target="_blank" style="cursor: pointer; color: gray">{{item.link}}</a></td>
          <td>{{item.status}}</td>
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
        time: '18:00',
        post_title: 'My Post Title',
        channels_posted_to: 'Facebook',
        link: 'https://cdn2.stylecraze.com/wp-content/uploads/2013/07/47-shutterstock_130738760.jpg',
        status: 'Posted Automatically'
      },
      {
        id: 2,
        date: '05/18/2021',
        time: '18:00',
        post_title: 'My Post Title',
        channels_posted_to: 'Google My Business',
        link: 'https://cdn2.stylecraze.com/wp-content/uploads/2013/07/47-shutterstock_130738760.jpg',
        status: 'Posted-Reviewed by You'
      },
      {
        id: 3,
        date: '05/18/2021',
        time: '18:00',
        post_title: 'My Post Title',
        channels_posted_to: 'LinkedIn',
        link: 'https://cdn2.stylecraze.com/wp-content/uploads/2013/07/47-shutterstock_130738760.jpg',
        status: 'Posted Automatically'
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
    forReview(){
      ROUTER.push('/user/post_management')
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
  color: $primary !important;
  border: 1px solid $primary !important;
}
.button1{
  border-color: $primary !important;
}
</style>
