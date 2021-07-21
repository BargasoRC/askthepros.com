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
                backgroundColor: '#01004E',
                color: 'white'
            }"
        />
    </div>
    <div class="row">
      <div class="col-lg-9 latest_posts">
        <h3 class="mb-5">Latest Posts</h3>
        <DataTable 
          :tableActions="tableActions"
          :tableHeaders="tableHeaders"
          :tableData="returnTableData"
          @onAction="onTableAction"
        />
        <div class="col-sm-12">
          <roundedBtn
            :onClick="viewMore"
            :text="'View more'"
            :styles="{
              backgroundColor: '#01004E',
              color: 'white'
            }"
        />
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
        {title: 'Post Title', key: 'title', type: 'text'},
        {title: 'Category', key: 'category', type: 'text'},
        {title: 'Channel Actions', key: 'channels', type: 'text'},
        {title: 'Author', key: 'author', type: 'text'},
        {title: 'Status', key: 'status', type: 'text'}
      ],
      tableData: [],
      user: AUTH.user
    }
  },
  components: {
    roundedBtn,
    DataTable
  },
  created() {
    this.retrievePosts()
  },
  computed: {
    returnTableData() {
      this.tableData = this.tableData.splice(0, 5)
      return this.tableData.filter((el, ndx) => {
        el.channels = JSON.parse(el.channels).join(', ').replaceAll('_', ' ')
        return el
      })
    }
  },
  methods: {
    newPost() {
      this.$router.push(`/${this.user.type.toLowerCase()}/post_management/edit`)
    },
    viewMore() {
      this.$router.push(`/${this.user.type.toLowerCase()}/post_management`)
    },
    onTableAction(data) {
      console.log('TABLE ACTION: ', data)
    },
    retrievePosts() {
      let parameter = {
        edit: false,
        account_id: this.user.userID
      }
      $('#loading').css({'display': 'block'})
      this.APIRequest('post/retrieve', parameter).then(response => {
        $('#loading').css({'display': 'none'})
        console.log('RESPONSE: ', response)
        if(!response.error) {
          this.tableData = response.data
        }
      })
    }
  }
}
</script>
<style scoped lang="scss" scoped>
@import "~assets/style/colors.scss";
.latest_posts {
  border: 1px solid $hover;
  padding-top: 20px;
  padding-bottom: 50px;
}
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
