<template>
  <div class="holder">
    <h3 style="margin-top: 25px;">Post Management</h3>
    <p style="color: gray">Connect to your social media channels, then setup your branding and choose your automation.</p>

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
                outlineColor: colors.darkPrimary
            }"
        />
        <roundedBtn
            :text="'History'"
            class="button1"
            :styles="{
                backgroundColor: colors.darkPrimary,
                outlineColor: colors.darkPrimary,
                color: 'white',
                width: '15%',
                borderTopLeftRadius: '0px !important',
                borderBottomLeftRadius: '0px !important',
                marginLeft: '-5px'
            }"
        />
    </div>

    <div class="col-sm-12 col-md-12 col-lg-12 mt-5 p-0 pt-5">
      <DataTable
        :tableHeaders="tableHeaders"
        :tableData="tableData"
        :tableActions="[]"
      />
    </div>

    <Pager
      :pages="numPages"
      :active="activePage"
      :limit="limit"
      v-if="tableData.length > 0"
    />


    <empty v-if="tableData.length <= 0" :title="'No accounts available!'" :action="'Keep growing.'"></empty>
  </div>
</template>

<script>
import roundedBtn from 'src/modules/generic/roundedBtn'
import DataTable from 'src/modules/generic/table'
import COLORS from 'src/assets/style/colors.js'
import Pager from 'src/components/increment/generic/pager/Pager.vue'
import ROUTER from 'src/router'
export default {
  data() {
    return {
      tableHeaders: [
        {title: 'Date Posted', key: 'date', type: 'date'},
        {title: 'Time Posted', key: 'time', type: 'text'},
        {title: 'Post Title', key: 'post_title', type: 'text'},
        {title: 'Channel Posted To', key: 'channels_posted_to', type: 'text'},
        {title: 'Link', key: 'link', type: 'text'},
        {title: 'Status', key: 'status', type: 'text'}
      ],
      tableData: [{
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
    DataTable,
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
