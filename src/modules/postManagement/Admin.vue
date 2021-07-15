<template>
  <div class="container-fluid">
    <div class="col-sm-12 col-md-12 col-lg-12 d-flex justify-content-end p-0 mb-5 mt-5">
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
    <div class="col-sm-12 col-md-12 col-lg-12 mt-5 mb-5 p-0">
      <Search 
        :category="category"
        :activeCategoryIndex="0"
        :activeSortingIndex="0"
        @changeSortEvent="() => {} "
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
      <DataTable 
        :tableActions="tableActions"
        :tableHeaders="tableHeaders"
        :tableData="returnTableData"
        @onAction="onTableAction"
      />
    </div>

    <Pager
      :pages="numPages"
      :active="activePage"
      :limit="limit"
      v-if="tableData.length > 0"
    />


    <empty v-if="tableData.length <= 0" :title="'No accounts available!'" :action="'Keep growing.'"></empty>
    
    <Confirmation
      ref="confirm"
      :message="'Are you sure do you want to delete this post?'"
      :title="'Confirmation'"
      @onConfirm="remove($event)"
    ></Confirmation>

    <preview
      ref="preview"
      :description="''"
      :files="[]"
      :footer="'Sample'"
      :previewBodyStyle="{
        minHeight: 'calc(100vh - 100px) !important'
      }"
      >
    </preview>
  </div>
</template>

<script>
import roundedBtn from 'src/modules/generic/roundedBtn'
import Pager from 'src/components/increment/generic/pager/Pager.vue'
import DataTable from 'src/modules/generic/table'
import Confirmation from 'src/components/increment/generic/modal/Confirmation.vue'
import ROUTER from 'src/router'
import Search from 'src/components/increment/generic/filter/Basic'
import preview from 'src/modules/generic/preview.vue'
export default {
  data() {
    return {
      tableActions: [
        {button: `<i class="fas fa-eye ml-2 mr-2" style="color: #01009A !important;"></i>`},
        {button: `<i class="fas fa-pencil-alt ml-2 mr-2" style="color: #01004E;"></i>`},
        {button: `<i class="fas fa-trash-alt ml-2 mr-2" style="color: #FF0000;"></i>`}
      ],
      // table header: should specify;  title, key(will be used as key in table data) and type
      tableHeaders: [
        {title: 'Post No.', key: 'id', type: 'text'},
        {title: 'Date', key: 'created_at', type: 'text'},
        {title: 'Post Title', key: 'title', type: 'text'},
        {title: 'Category', key: 'category', type: 'text'},
        {title: 'Channel Actions', key: 'channels', type: 'text'},
        {title: 'Author', key: 'author', type: 'text'},
        {title: 'status', key: 'status', type: 'text'},
        {title: 'Review', type: 'action'}
      ],
      tableData: [],
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
      activePage: 1
    }
  },
  components: {
    roundedBtn,
    DataTable,
    Confirmation,
    'empty': require('components/increment/generic/empty/Empty.vue'),
    Pager,
    Search,
    preview
  },
  created() {
    this.retrievePosts()
  },
  mounted(){
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
      ROUTER.push('/admin/post_management/edit')
    },
    onTableAction(data){
      console.log('here ', data)
      if(data.buttonIndex === 0){
        this.tableData[data.rowIndex]
        console.log('[preview Here]', this.tableData[data.rowIndex].id)
      }else if(data.buttonIndex === 1){
        let id = this.tableData[data.rowIndex].id
        ROUTER.push('post_management/edit/' + id)
      }else{
        let id = this.tableData[data.rowIndex].id
        this.del(id)
      }
    },
    retrievePosts() {
      let parameter = {
        edit: false
      }
      $('#loading').css({'display': 'block'})
      this.APIRequest('post/retrieve', parameter).then(response => {
        $('#loading').css({'display': 'none'})
        console.log('RESPONSE: ', response)
        if(!response.error) {
          this.tableData = response.data
        }
      })
    },
    del(id){
      this.$refs.confirm.show(id)
    },
    remove(id){
      let parameter = {
        id: id.id
      }
      $('#loading').css({'display': 'block'})
      this.APIRequest('post/delete', parameter).then(response => {
        $('#loading').css({'display': 'none'})
        console.log('RESPONSE: ', response)
        this.retrievePosts()
      })
    }
  }
}
</script>

<style>

</style>
