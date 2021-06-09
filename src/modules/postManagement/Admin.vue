<template>
  <div>
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
      />
    </div>
    <div class="col-sm-12 col-md-12 col-lg-12 mt-5 p-0 pt-5">
      <DataTable 
        :tableActions="tableActions"
        :tableHeaders="tableHeaders"
        :tableData="tableData"
      />
    </div>
  </div>
</template>

<script>
import roundedBtn from 'src/modules/generic/roundedBtn'
import Search from 'src/components/increment/ecommerce/filter/Product.vue'
import DataTable from 'src/modules/generic/table'
export default {
  data() {
    return {
      tableActions: [
        {button: `<i class="fas fa-eye ml-2 mr-2"></i>`}
      ],
      // table header: should specify;  title, key(will be used as key in table data) and type
      tableHeaders: [
        {title: 'Date', key: 'created_at', type: 'text'},
        {title: 'Post Title', key: 'title', type: 'text'},
        {title: 'Channels to Post', key: 'channel', type: 'text'},
        {title: 'status', key: 'status', type: 'text'},
        {title: 'Review', type: 'action'}
      ],
      tableData: [
        {
          title: 'Eyes here',
          channel: 'Youtube channel',
          status: 'Pending',
          created_at: '06/09/2021'
        },
        {
          title: 'Eyes here',
          channel: 'Youtube channel',
          status: 'Pending',
          created_at: '06/09/2021'
        },
        {
          title: 'Eyes here',
          channel: 'Youtube channel',
          status: 'Pending',
          created_at: '06/09/2021'
        },
        {
          title: 'Eyes here',
          channel: 'Youtube channel',
          status: 'Pending',
          created_at: '06/09/2021'
        }
      ],
      category: [{
        title: 'Sort',
        sorting: [{
          title: 'Name ascending',
          payload: 'name',
          payload_value: 'asc',
          type: 'text'
        }, {
          title: 'Name descending',
          payload: 'name',
          payload_value: 'desc',
          type: 'text'
        }, {
          title: 'Crop Type ascending',
          payload: 'crops',
          payload_value: 'asc',
          type: 'text'
        }, {
          title: 'Crop Type descending',
          payload: 'crops',
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
      }]
    }
  },
  components: {
    roundedBtn,
    Search,
    DataTable
  },
  methods: {
    newPost() {
      console.log('New Post:::')
    }
  }
}
</script>

<style>

</style>
