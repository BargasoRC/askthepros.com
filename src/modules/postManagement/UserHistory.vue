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
            :onClick="''"
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

    <div class="col-sm-12 col-md-12 col-lg-12 mt-5 p-0 pt-5" v-if="tableData.length > 0">
      <table class="table table-striped table-bordered">
        <thead>
          <th v-for="(item, index) in tableHeaders" :key="index">{{item.title}}</th>
        </thead>
        <tbody>
          <tr v-for="(item, index) in tableData" :key="index">
            <td>{{item.date}}</td>
            <td>{{item.time}}</td>
            <td>{{item.post[0] != null ? item.post[0].title : null}}</td>
            <td>{{item.post[0] != null ? displayArray(item.post[0].channels) : null}}</td>
            <td style="color: gray"><u>{{item.link}}</u></td>
            <td class="text-primary" v-if="item.post[0].parent === null">Posted Automatically</td>
            <td class="text-warning" v-else>Posted - Reviewed by You</td>
          </tr>
        </tbody>
      </table>
    </div>

    <Pager
      :pages="numPages"
      :active="activePage"
      :limit="limit"
      v-if="tableData.length > 0"
    />


    <empty v-if="tableData.length === 0" :title="'No posts available!'" :action="'Keep growing.'"></empty>
  </div>
</template>

<script>
import roundedBtn from 'src/modules/generic/roundedBtn'
import DataTable from 'src/modules/generic/table'
import COLORS from 'src/assets/style/colors.js'
import Pager from 'src/components/increment/generic/pager/Pager.vue'
import AUTH from 'src/services/auth'
import ROUTER from 'src/router'
export default {
  data() {
    return {
      user: AUTH.user,
      tableHeaders: [
        {title: 'Date Posted'},
        {title: 'Time Posted'},
        {title: 'Post Title'},
        {title: 'Channel Posted To'},
        {title: 'Link'},
        {title: 'Status'}
      ],
      tableData: [],
      colors: COLORS,
      limit: 5,
      offset: 0,
      numPages: null,
      activePage: 1,
      sort: null,
      filter: null
    }
  },
  components: {
    roundedBtn,
    DataTable,
    'empty': require('components/increment/generic/empty/Empty.vue'),
    Pager
  },
  created() {
    this.retrieve({created_at: 'desc'}, {column: 'created_at', value: ''})
  },
  mounted() {
    this.retrieve({created_at: 'desc'}, {column: 'created_at', value: ''})
  },
  methods: {
    displayArray(channels){
      if(channels){
        let parsedChannels = JSON.parse(channels)
        let response = ''
        for (var i = 0; i < parsedChannels.length; i++) {
          let item = parsedChannels[i]
          if(i > 0){
            response += ', ' + item
          }else{
            response = item
          }
        }
        return response
      }else{
        return null
      }
    },
    forReview(){
      ROUTER.push('/post_management')
    },
    retrieve(sort, filter){
      if(sort !== null){
        this.sort = sort
      }
      if(filter !== null){
        this.filter = filter
      }
      if(sort === null && this.sort !== null){
        sort = this.sort
      }
      if(filter === null && this.filter !== null){
        filter = this.filter
      }
      let parameter = {
        condition: [{
          column: filter.column,
          value: filter.value + '%',
          clause: 'like'
        }],
        sort: sort,
        limit: this.limit,
        status: 'for posting',
        account_id: this.user.userID,
        offset: (this.activePage > 0) ? ((this.activePage - 1) * this.limit) : this.activePage
      }
      $('#loading').css({'display': 'block'})
      this.APIRequest('post/retrieve_history', parameter).then(response => {
        $('#loading').css({'display': 'none'})
        console.log('RESPONSE: ', response)
        if(response.data.length > 0){
          this.tableData = response.data
          this.numPages = parseInt(response.size / this.limit) + (response.size % this.limit ? 1 : 0)
        }else{
          this.tableData = []
        }
      })
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
