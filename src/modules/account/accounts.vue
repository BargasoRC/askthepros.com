<template>
  <div class="ledger-summary-container">
    <div class="incre-row">
      <h2> Account Management </h2>
    </div>
    <basic-filter 
      v-bind:category="category" 
      :activeCategoryIndex="0"
      :activeSortingIndex="0"
      @changeSortEvent="retrieve($event.sort, $event.filter)"
      @changeStyle="manageGrid($event)"
      :grid="['list', 'th-large']"
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
    
    <table class="table table-borderless table-responsive" v-if="data.length > 0">
      <thead>
        <tr>
          <th scope="col">Date</th>
          <th scope="col">Username</th>
          <th scope="col">Email Address</th>
          <th scope="col">Name</th>
          <th scope="col">Business Name</th>
          <th scope="col">Contact Number</th>
          <th scope="col">Type</th>
          <th scope="col">Status</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(item, index) in returnData" :key="index">
          <td>{{item.created_at}}</td>
          <td>
            <label class="action-link text-primary">{{item.username}}</label>
          </td>
          <td>{{item.email}}</td>
          <td v-if="!item.first_name && !item.last_name">NOT_SET</td>
          <td v-if="item.first_name && !item.last_name">{{item.first_name}}</td>
          <td v-if="!item.first_name && item.last_name">{{item.last_name}}</td>
          <td v-if="item.first_name && item.last_name">{{item.first_name + ' ' + item.last_name}}</td>
          <td>{{item.business_name ? item.business_name : 'NOT_SET'}}</td>
          <td>{{item.cellular_number ? item.cellular_number : 'NOT_SET'}}</td>
          <td>
            <label v-if="editTypeIndex !== index">{{item.account_type}}</label>
            <i class="fa fa-pencil text-primary" style="margin-left: 10px;" @click="setEditTypeIndex(index, item)" v-if="editTypeIndex !== index"></i>
            <span v-if="editTypeIndex === index">
              <select class="form-control" v-model="newAccountType" style="float: left; width: 70%;">
                <option v-if="user.type === 'ADMIN'" v-for="(typeItem, typeIndex) in ['USER', 'EXPERT', 'ADMIN']" :key="typeIndex">{{typeItem}}</option>
                <option v-else v-for="(typeItem, typeIndex) in ['USER', 'EXPERT', 'ADMIN']" :key="typeIndex">{{typeItem}}</option>
              </select>
              <i class="fa fa-check text-primary" style="margin-left: 5px; float: left;" @click="updateType(item, index)"></i>
              <i class="fa fa-times text-danger" style="margin-left: 5px; float: left;" @click="setEditTypeIndex(index, item)"></i>
            </span>
          </td>
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
<style scoped>
.py-3{
  padding-top: 0 !important;
  padding-bottom: 0 !important;
}
.ledger-summary-container{
  width: 100%;
  float: left;
  height: auto;
  margin-bottom: 100px;
  margin-top: 25px;
}

td i {
  padding-right: 0px !important;
  padding-left: 0px !important;
}

td {
border-bottom: 0.5px solid #e0e0e0;
}

@media (max-width: 992px){
  .ledger-summary-container{
    width: 100%;
  }
}

.card{
  margin:2%
}

</style>
<script>
import ROUTER from 'src/router'
import AUTH from 'src/services/auth'
import CONFIG from 'src/config.js'
import Pager from 'src/components/increment/generic/pager/Pager.vue'
export default{
  mounted(){
    $('#loading').css({display: 'block'})
    this.retrieve({created_at: 'desc'}, {column: 'created_at', value: ''})
  },
  computed: {
    returnData(){
      return this.data
    }
  },
  data(){
    return {
      user: AUTH.user,
      data: [],
      data1: [],
      data2: [],
      auth: AUTH,
      selecteditem: null,
      config: CONFIG,
      limit: 5,
      offset: 0,
      numPages: null,
      category: [{
        title: 'Sort by',
        sorting: [{
          title: 'Created ascending',
          payload: 'created',
          payload_value: 'asc'
        }, {
          title: 'Created descending',
          payload: 'created',
          payload_value: 'desc'
        }, {
          title: 'Username ascending',
          payload: 'username',
          payload_value: 'asc'
        }, {
          title: 'Username descending',
          payload: 'username',
          payload_value: 'desc'
        }, {
          title: 'Email ascending',
          payload: 'email',
          payload_value: 'asc'
        }, {
          title: 'Email descending',
          payload: 'email',
          payload_value: 'desc'
        }, {
          title: 'Name ascending',
          payload: 'name',
          payload_value: 'asc'
        }, {
          title: 'Name descending',
          payload: 'name',
          payload_value: 'desc'
        }, {
          title: 'Business Name ascending',
          payload: 'business_name',
          payload_value: 'asc'
        }, {
          title: 'Business Name descending',
          payload: 'business_name',
          payload_value: 'desc'
        }, {
          title: 'Type ascending',
          payload: 'type',
          payload_value: 'asc'
        }, {
          title: 'Type descending',
          payload: 'type',
          payload_value: 'desc'
        }, {
          title: 'Status ascending',
          payload: 'status',
          payload_value: 'asc'
        }, {
          title: 'Status descending',
          payload: 'status',
          payload_value: 'desc'
        }]
      }],
      filter: null,
      sort: null,
      editTypeIndex: null,
      newAccountType: null,
      selectedAccount: null,
      activeItem: 'home',
      activePage: 1
    }
  },
  components: {
    'empty': require('components/increment/generic/empty/Empty.vue'),
    'basic-filter': require('components/increment/generic/filter/Basic.vue'),
    Pager

  },
  methods: {
    setEditTypeIndex(index, item){
      if(index === this.editTypeIndex){
        this.editTypeIndex = null
        this.newAccountType = null
      }else{
        this.selectedAccount = item
        this.editTypeIndex = index
        this.newAccountType = item.account_type
      }
    },
    updateType(item, index){
      if(this.newAccountType === null || this.newAccountType === item.account_type){
        this.setEditTypeIndex(index, item)
        return
      }
      let parameter = {
        id: item.id,
        account_type: this.newAccountType
      }
      $('#loading').css({display: 'block'})
      this.APIRequest('accounts/update_account_type', parameter).then(response => {
        $('#loading').css({display: 'none'})
        this.setEditTypeIndex(index, item)
        this.retrieve(null, null)
      })
    },
    showProfileModal(item){
      this.selecteditem = item
      this.$children[1].$children[0].retrieveLocation(item)
      this.$children[1].$children[0].retrieveImage(item)
      this.selecteditem['payload'] = 'account'
      this.$children[1].$children[0].$children[0].retrieveRatings(item)
      // this.$children[1].$children[0].$children[0].retrieveRatings()
      $('#profileModal').modal('show')
    },
    redirect(params){
      ROUTER.push(params)
    },
    pagination(flag){
      if(flag === false && this.offset > 5){
        this.offset = this.offset - 5
        this.retrieve({created_at: 'desc'}, {column: 'created_at', value: ''})
      }else{
        this.offset = this.offset + 5
        this.retrieve({created_at: 'desc'}, {column: 'created_at', value: ''})
      }
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
          value: filter.value + '%',
          column: filter.column,
          clause: 'like'
        }],
        sort: sort,
        limit: this.limit,
        offset: (this.activePage > 0) ? ((this.activePage - 1) * this.limit) : this.activePage
      }
      if(this.activeItem !== 'home'){
        parameter['accountType'] = this.activeItem
      }
      $('#loading').css({display: 'block'})
      this.APIRequest('users/retrieve', parameter).then(response => {
        $('#loading').css({display: 'none'})
        if(response.data.length > 0){
          this.data = response.data
          this.numPages = parseInt(response.size / this.limit) + (response.size % this.limit ? 1 : 0)
        }else{
          this.data = []
          this.numPages = null
        }
      })
    },
    updateUserStatus(item){
      let parameter = {
        id: item.id.id,
        status: 'BLOCKED'
      }
      $('#loading').css({display: 'block'})
      this.APIRequest('accounts/update_verification', parameter).then(response => {
        $('#loading').css({display: 'none'})
        this.retrieve(null, null)
      })
      $('#profileModal').modal('hide')
    },
    updateStat(item){
      let parameter = {
        id: item.id.id,
        status: 'NOT_VERIFIED'
      }
      $('#loading').css({display: 'block'})
      this.APIRequest('accounts/update_verification', parameter).then(response => {
        $('#loading').css({display: 'none'})
        this.retrieve(null, null)
      })
      $('#profileModal').modal('hide')
    },
    updateStatusByParams(item, status){
      let parameter = {
        id: item.id,
        status: status
      }
      $('#loading').css({display: 'block'})
      this.APIRequest('accounts/update_verification', parameter).then(response => {
        $('#loading').css({display: 'none'})
        this.retrieve(null, null)
      })
      $('#profileModal').modal('hide')
    },
    update(item){
      if(item.status !== 'NOT_VERIFIED'){
        let parameter = {
          id: item.id,
          status: 'GRANTED'
        }
        $('#loading').css({display: 'block'})
        this.APIRequest('accounts/update_verification', parameter).then(response => {
          $('#loading').css({display: 'none'})
          this.retrieve(null, null)
        })
        $('#profileModal').modal('hide')
      }else{
        alert('Not Allowed!')
      }
    },
    isActive (menuItem) {
      return this.activeItem === menuItem
    },
    setActive (menuItem) {
      this.activeItem = menuItem
      this.retrieve({created_at: 'desc'}, {column: 'created_at', value: ''})
    }
  }
}
</script>
