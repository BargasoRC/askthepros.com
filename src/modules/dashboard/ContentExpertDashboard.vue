<template>
  <div class="holder">
    <h3>Hello, Content Expert!</h3>
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
    <div class="col-sm-12 col-md-12 col-lg-12 mt-5 mb-5 p-0">
      <Search 
        :category="category"
        :activeCategoryIndex="0"
        :activeSortingIndex="0"
        @changeSortEvent="() => {} "  
        :grid="['list']"
      />
    </div>
    <div class="col-sm-12 col-md-12 col-lg-12 mt-5 p-0 pt-5">
      <DataTable 
        :tableActions="tableActions"
        :tableHeaders="tableHeaders"
        :tableData="returnTableData"
      />
    </div >
    <div class="row d-flex flex-row">
      <div class="col d-flex justify-content-end">
        <p style="font-weight:bold; color:black">Page {{pageNo}} of {{pageTotal}}
         </p>
        <i class="fas fa-arrow-left" style="color: #01004E"></i><i class="fas fa-arrow-right" style="color: #01004E
"></i>  
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
.tableHeaders {
  color: $title;
}

#pager {
  font-weight: bold;
  float: right;
  color: $title;
  margin-top: 5vh;
}

.fa-arrow-left, .fa-arrow-right {
  color: $primary;
  font-weight: bold;
  font-size: 24px;
  margin-left: 25px;
}
</style>
<script>
import Search from 'src/components/increment/generic/filter/BasicVersion3.vue'
import DataTable from 'src/modules/generic/table'
import roundedBtn from 'src/modules/generic/roundedBtn'
import COLORS from 'src/assets/style/colors.js'
import AUTH from 'src/services/auth'
export default {
  data() {
    return {
      user: AUTH.user,
      colors: COLORS,
      pageNo: 1,
      pageTotal: 1,
      tableActions: [
        {button: `<i class="fas fa-eye ml-2 mr-2" style="color: #01009A;"></i>`},
        {button: `<i class="fas fa-pencil-alt ml-2 mr-2" style="color: #01004E;"></i>`},
        {button: `<i class="fas fa-clone ml-2 mr-2" style="color: #01004E;"></i>`},
        {button: `<i class="fas fa-trash-alt ml-2 mr-2" style="color: #FF0000;"></i>`}
      ],
      tableHeaders: [
        {title: 'Date', key: 'created_at', type: 'text'},
        {title: 'Post Title', key: 'title', type: 'text'},
        {title: 'Channel Actions', key: 'channels', type: 'text'},
        {title: 'Status', key: 'status', type: 'text'},
        {title: 'Actions', type: 'action'}
      ],
      tableData: [],
      category: [{
        title: 'Sort By',
        sorting: [
          {title: 'Created Ascending', payload: 'created_at', payload_value: 'asc', type: 'text'},
          {title: 'Created Descending', payload: 'created_at', payload_value: 'desc', type: 'text'},
          {title: 'Title Ascending', payload: 'title', payload_value: 'asc', type: 'text'},
          {title: 'Title Descending', payload: 'title', payload_value: 'desc', type: 'text'},
          {title: 'Channel Ascending', payload: 'channel', payload_value: 'asc', type: 'text'},
          {title: 'Channel Descending', payload: 'channel', payload_value: 'desc', type: 'text'},
          {title: 'Status Ascending', payload: 'status', payload_value: 'asc', type: 'text'},
          {title: 'Status Descending', payload: 'status', payload_value: 'desc', type: 'text'}
        ]
      }]
    }
  },
  components: {
    roundedBtn,
    Search,
    DataTable
  },
  created() {
    this.retrievePosts()
  },
  computed: {
    returnTableData() {
      return this.tableData.filter((el, ndx) => {
        el.channels = JSON.parse(el.channels).join(', ').replaceAll('_', ' ')
        return el
      })
    }
  },
  methods: {
    newPost() {
      this.$router.push(`/${this.user.type.toLowerCase()}/post_management`)
    },
    retrievePosts() {
      let parameter = {
        account_id: this.user.userID
      }
      $('#loading').css({'display': 'block'})
      this.APIRequest('post/retrieve_by_user', parameter).then(response => {
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
