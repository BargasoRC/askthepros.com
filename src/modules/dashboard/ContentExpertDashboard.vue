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
    <div class="col-sm-12 col-md-12 col-lg-12 mt-5 p-0 pt-5" v-if="tableData.length > 0">
        <table class="table table-striped table-bordered">
        <!-- <table class="table table-borderless"> -->
        <thead>
          <th v-for="(item, index) in tableHeaders" :key="index">{{item.title}}</th>
        </thead>
        <tbody>
          <tr v-for="(item, index) in tableData" :key="index">
            <td>{{item.created_at_human}} at {{item.time}}</td>
            <td>{{item.title}}</td>
            <td>{{displayArray(item.channels)}}</td>
            <td class="text-warning" v-if="item.status.toLowerCase() === 'draft'">{{item.status.toUpperCase()}}</td>
            <td class="text-primary" v-else>{{item.status.toUpperCase()}}</td>
            <td v-if="item.status.toLowerCase() === 'draft'">
              <i class="fa fa-eye text-primary" @click="showPreview(item)"></i>
              <i class="fa fa-pencil text-primary" @click="edit(item.code)"></i>
              <i class="fa fa-trash text-danger" @click="showDeleteConfirmation(item.id)"></i>
            </td>
            <td v-if="item.status.toLowerCase() === 'publish'">
              <i class="fa fa-eye text-primary"  @click="showPreview(item)"></i>
              <!-- <i class="fas fa-copy text-primary" @click="edit(item.code)"></i> -->
            </td>
          </tr>
        </tbody>
      </table>
    </div >
    <Pager
      :pages="numPages"
      :active="activePage"
      :limit="limit"
      v-if="tableData.length > 0"
    />
    
    <empty v-if="tableData.length <= 0" :title="'No posts available!'" :action="'Keep growing.'"></empty>
    <preview
      ref="previewSelected"
      :selected="selectedItem"
      :files="file"
      :first="'false'"
    /> 
    <Confirmation
      ref="confirm"
      :message="'Are you sure do you want to delete this post?'"
      :title="'Confirmation'"
      @onConfirm="e => {
        remove(e)
      }"
      v-if="deleteId"
    ></Confirmation>
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

td {
border-bottom: 0.5px solid #e0e0e0;
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
import ROUTER from 'src/router'
import preview from 'src/modules/postManagement/UserPreview.vue'
import Pager from 'src/components/increment/generic/pager/Pager.vue'
import Confirmation from 'src/components/increment/generic/modal/Confirmation.vue'
export default {
  data() {
    return {
      user: AUTH.user,
      colors: COLORS,
      limit: 5,
      offset: 0,
      numPages: null,
      activePage: 1,
      filter: null,
      sort: null,
      selectedItem: null,
      deleteId: null,
      file: null,
      tableHeaders: [
        {title: 'Date'},
        {title: 'Post Title'},
        {title: 'Channel Actions'},
        {title: 'Status'},
        {title: 'Actions'}
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
    DataTable,
    Confirmation,
    'empty': require('components/increment/generic/empty/Empty.vue'),
    preview,
    Pager
  },
  created() {
    this.retrieve({created_at: 'desc'}, {column: 'created_at', value: ''})
  },
  mounted() {
    this.retrieve({created_at: 'desc'}, {column: 'created_at', value: ''})
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
      this.$router.push('/post_management/content_edit')
    },
    retrieve(sort, filter) {
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
        account_id: this.user.userID,
        offset: (this.activePage > 0) ? ((this.activePage - 1) * this.limit) : this.activePage
      }
      $('#loading').css({'display': 'block'})
      this.APIRequest('post/retrieve_by_user', parameter).then(response => {
        $('#loading').css({'display': 'none'})
        console.log('RESPONSE: ', response)
        if(response.data.length > 0) {
          this.tableData = response.data
          this.numPages = parseInt(response.size / this.limit) + (response.size % this.limit ? 1 : 0)
        }
      })
    },
    showPreview(item){
      if(this.selectedItem && this.selectedItem.id === item.id){
        this.selectedItem = null
      }else{
        this.selectedItem = item
        if(item.url !== null){
          this.file = Object.values(JSON.parse(item.url)).map(el => {
            let temp = {}
            temp['url'] = this.config.BACKEND_URL + el
            return temp
          })
        }
      }
      setTimeout(() => {
        this.$refs.previewSelected.show()
      }, 100)
      // if(this.selectedItem && this.selectedItem.id === item.id){
      //   this.selectedItem = null
      // }else{
      //   this.selectedItem = item
      //   this.file = item.url
      // }
      // setTimeout(() => {
      //   this.$refs.previewSelected.show()
      // }, 100)
    },
    edit(code) {
      ROUTER.push('/post_management/content_edit/' + code)
    },
    showDeleteConfirmation(id){
      console.log({
        test: 'again'
      })
      this.deleteId = id
      setTimeout(() => {
        this.$refs.confirm.show(id)
      }, 100)
    },
    remove(e){
      let parameter = {
        id: e.id
      }
      $('#loading').css({'display': 'block'})
      this.APIRequest('post/delete', parameter).then(response => {
        $('#loading').css({'display': 'none'})
        console.log('RESPONSE: ', response)
        this.retrieve()
      })
    }
  }
}
</script>
