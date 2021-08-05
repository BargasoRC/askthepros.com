<template>
  <div class="holder">
    <h3>Hello, Admin!</h3>
    <p>Here are the latest update of activities as of today.</p>
    <div class="col-sm-12 col-md-12 col-lg-12 d-flex justify-content-end p-0 mt-0">
        <roundedBtn
            :onClick="newPost"
            :icon="'fas fa-plus'"
            :text="'New Post'"
            :icon_position="'right'"
            :styles="{
                backgroundColor: '#01004E',
                color: 'white'
            }"
        />
    </div>
    <div class="row">
      <div class="col-lg-9 latest_posts">
        <div class="card" style="border-color: light-grey; padding-bottom: 1%; margin-top: 25px;">
          <h3 class="mb-4" style="margin-top: 2%; margin-left: 1%">Latest Posts</h3>
          <table class="table table-striped table-bordered">
            <thead>
              <th v-for="(item, index) in tableHeaders" :key="index">{{item.title}}</th>
            </thead>
            <tbody>
              <tr v-for="(item, index) in data" :key="index">
                <td>{{item.title}}</td>
                <td>{{display(item.category)}}</td>
                <td>{{displayArray(item.channels)}}</td>
                <td>{{item.author}}</td>
                <td :class="item.status === 'DRAFT' ? 'text-warning' : 'text-primary'">{{item.status.toUpperCase()}}</td>
              </tr>
            </tbody>
          </table>
          <div class="row justify-content-between">
            <div class="col-md-6 col-sm-6 col-xs-6">
              <div class="col-sm-12">
                <roundedBtn 
                  :onClick="viewMore"
                  :text="'View more'"
                  :styles="{
                    backgroundColor: colors.darkPrimary,
                    color: 'white'
                  }"
                />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import AUTH from 'src/services/auth'
import roundedBtn from 'src/modules/generic/roundedBtn'
import COLORS from 'src/assets/style/colors.js'
import ROUTER from 'src/router'
import DataTable from 'src/modules/generic/table'
import COMMON from 'src/common.js'
export default {
  data() {
    return {
      colors: COLORS,
      tableActions: [],
      // table header: should specify;  title, key(will be used as key in table data) and type
      tableHeaders: [
        {title: 'Post Title'},
        {title: 'Category'},
        {title: 'Channel Actions'},
        {title: 'Author'},
        {title: 'Status'}
      ],
      data: [],
      user: AUTH.user,
      limit: 5,
      offset: 0,
      numPages: null,
      activePage: 1
    }
  },
  components: {
    roundedBtn,
    DataTable
  },
  created() {
    this.retrievePosts({created_at: 'desc'}, {column: 'created_at', value: ''})
  },
  methods: {
    viewMore(){
      this.$router.push(`/post_management`)
    },
    display(category){
      if(category){
        let parsedCategory = JSON.parse(category)
        let response = ''
        for (var i = 0; i < parsedCategory.length; i++) {
          let item = parsedCategory[i]
          if(i > 0){
            response += ', ' + item.category
          }else{
            response = item.category
          }
        }
        return response
      }else{
        return null
      }
    },
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
    newPost() {
      this.$router.push('/post_management/edit')
    },
    onTableAction(data) {
      console.log('TABLE ACTION: ', data)
    },
    retrievePosts(sort, filter) {
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
        limit: 5,
        account_id: this.user.userID,
        offset: 0
      }
      $('#loading').css({'display': 'block'})
      this.APIRequest('post/retrieve', parameter).then(response => {
        $('#loading').css({'display': 'none'})
        if(!response.error) {
          this.data = response.data
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
.text-primary{
  color: #01004E!important;
}
</style>
