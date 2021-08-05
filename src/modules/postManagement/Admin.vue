<template>
  <div class="container-fluid">
    <div class="col-sm-12 col-md-12 col-lg-12 d-flex justify-content-end p-0 mb-5 mt-5">
      <roundedBtn 
        :onClick="createNewPost"
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
        @changeSortEvent="() => {}"
        :grid="['list']"
        :sortByStyle="{
          background: '#01004E !important',
          color: 'white'
        }"
        :dropDownStyle="{
          border: '1px solid #01004E !important',
          background: 'none !important',
          color: '#272727 !important',
          borderLeft: '0px',
          outline: 'none !important',
          boxShadow: 'none !important'
        }"
      />
    </div>
    
    <div class="col-sm-12 col-md-12 col-lg-12 mt-5 p-0 pt-5">
      <table class="table table-striped table-bordered">
        <thead>
          <th v-for="(item, index) in tableHeaders" :key="index">{{item.title}}</th>
        </thead>
        <tbody>
          <tr v-for="(item, index) in data" :key="index">
            <td>#{{item.id}}</td>
            <td>{{item.created_at_human}}</td>
            <td>{{item.title}}</td>
            <td>{{display(item.category)}}</td>
            <td>{{displayArray(item.channels)}}</td>
            <td>{{item.author}}</td>
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
              <i class="fa fa-trash text-danger" @click="showDeleteConfirmation(item.id)"></i>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <Pager
      :pages="numPages"
      :active="activePage"
      :limit="limit"
      v-if="data.length > 0"
    />

    <empty v-if="data.length <= 0" :title="'No posts available!'" :action="'Keep growing.'"></empty>
    
    <Confirmation
      ref="confirm"
      :message="'Are you sure do you want to delete this post?'"
      :title="'Confirmation'"
      @onConfirm="e => {
        remove(e)
      }"
      v-if="deleteId"
    ></Confirmation>

    <preview
      ref="previewSelected"
      :selected="selectedItem"
      :files="file"
      :first="'false'"
    />
  </div>
</template>

<script>
import AUTH from 'src/services/auth'
import roundedBtn from 'src/modules/generic/roundedBtn'
import Pager from 'src/components/increment/generic/pager/Pager.vue'
import Confirmation from 'src/components/increment/generic/modal/Confirmation.vue'
import ROUTER from 'src/router'
import CONFIG from 'src/config.js'
import Search from 'src/components/increment/generic/filter/Basic'
import preview from './UserPreview.vue'
export default {
  data() {
    return {
      user: AUTH.user,
      config: CONFIG,
      tableHeaders: [
        {title: 'Post No.'},
        {title: 'Date'},
        {title: 'Post Title'},
        {title: 'Categories'},
        {title: 'Channel Actions'},
        {title: 'Author'},
        {title: 'Status'},
        {title: 'Actions'}
      ],
      data: [],
      category: [{
        title: 'Sort By',
        sorting: [{
          title: 'Post ascending',
          payload: 'post',
          payload_value: 'asc',
          type: 'date'
        }, {
          title: 'Post descending',
          payload: 'post',
          payload_value: 'desc',
          type: 'date'
        }, {
          title: 'Created ascending',
          payload: 'created_at',
          payload_value: 'asc',
          type: 'date'
        }, {
          title: 'Created descending',
          payload: 'created_at',
          payload_value: 'desc',
          type: 'date'
        }, {
          title: 'Title ascending',
          payload: 'title',
          payload_value: 'asc',
          type: 'text'
        }, {
          title: 'Title descending',
          payload: 'title',
          payload_value: 'desc',
          type: 'text'
        }, {
          title: 'Category ascending',
          payload: 'category',
          payload_value: 'asc',
          type: 'text'
        }, {
          title: 'Category descending',
          payload: 'category',
          payload_value: 'desc',
          type: 'text'
        }, {
          title: 'Channel ascending',
          payload: 'channel',
          payload_value: 'asc',
          type: 'text'
        }, {
          title: 'Channel descending',
          payload: 'channel',
          payload_value: 'desc',
          type: 'text'
        }, {
          title: 'Author ascending',
          payload: 'author',
          payload_value: 'asc',
          type: 'text'
        }, {
          title: 'Author descending',
          payload: 'author',
          payload_value: 'desc',
          type: 'text'
        }, {
          title: 'Status ascending',
          payload: 'status',
          payload_value: 'asc',
          type: 'text'
        }, {
          title: 'Status descending',
          payload: 'status',
          payload_value: 'desc',
          type: 'text'
        }]
      }],
      limit: 5,
      offset: 0,
      numPages: null,
      activePage: 1,
      selectedItem: null,
      file: null,
      deleteId: null,
      filter: null,
      sort: null
    }
  },
  components: {
    roundedBtn,
    Confirmation,
    'empty': require('components/increment/generic/empty/Empty.vue'),
    Pager,
    Search,
    preview
  },
  created() {
    this.retrieve({created_at: 'desc'}, {column: 'created_at', value: ''})
  },
  mounted(){
    this.retrieve({created_at: 'desc'}, {column: 'created_at', value: ''})
  },
  methods: {
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
    createNewPost(){
      ROUTER.push('/post_management/edit')
    },
    edit(code) {
      ROUTER.push('/post_management/edit/' + code)
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
      this.APIRequest('post/retrieve', parameter).then(response => {
        $('#loading').css({'display': 'none'})
        if(!response.error) {
          this.data = response.data
          this.numPages = parseInt(response.size / this.limit) + (response.size % this.limit ? 1 : 0)
        }else{
          this.data = []
        }
      })
    },
    showDeleteConfirmation(id){
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
        this.retrieve({created_at: 'desc'}, {column: 'created_at', value: ''})
      })
    },
    showPreview(item){
      if(this.selectedItem && this.selectedItem.id === item.id){
        this.selectedItem = null
      }else{
        this.selectedItem = item
        // this.file = item.url
        this.file = Object.values(JSON.parse(item.url)).map(el => {
          let temp = {}
          temp['url'] = this.config.BACKEND_URL + el
          return temp
        })
      }
      setTimeout(() => {
        this.$refs.previewSelected.show()
      }, 100)
    }
  }
}
</script>
<style scoped lang="scss" scoped>
@import "~assets/style/colors.scss";
.container-fluid{
  min-height: 70vh !important;
}
.text-primary{
  color: #01004E!important;
}
</style>
