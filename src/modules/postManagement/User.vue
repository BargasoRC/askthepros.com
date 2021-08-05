<template>
  <div class="holder">
    <h3 style="margin-top: 25px;">Post Management</h3>
    <p style="color: gray">Connect to your social media channels, then setup your branding and choose your automation.</p>

    <div style="margin-top: 3%">
        <roundedBtn
            :onClick="()=>{}"
            :text="'For Review'"
            class="button"
            :styles="{
                backgroundColor: colors.darkPrimary,
                color: 'white',
                width: '15%',
                borderTopRightRadius: '0px !important',
                borderBotttomLeftRadius: '0px !important',
                outlineColor: colors.darkPrimary
            }"
        />
        <roundedBtn
            :onClick="history"
            :text="'History'"
            class="button1"
            :styles="{
                backgroundColor: colors.white,
                outlineColor: colors.darkPrimary,
                color: 'white',
                width: '15%',
                borderTopLeftRadius: '0px !important',
                borderBottomLeftRadius: '0px !important',
                marginLeft: '-5px'
            }"
        />
    </div>
    <p style="margin-top: 5px; color: gray"><i style="color: red">**</i><i>This section only displays list of post if Automation Settings is set to "Review" not autopost. Post will not be posted on social media channels, unless approved.</i></p>

    <div class="col-sm-12 col-md-12 col-lg-12 mt-5 p-0 pt-5">
      <table class="table table-striped table-bordered">
        <thead>
          <th v-for="(item, index) in tableHeaders" :key="index">{{item.title}}</th>
        </thead>
        <tbody>
          <tr v-for="(item, index) in tableData" :key="index">
            <td>{{item.date}}</td>
            <td>{{item.post[0] != null ? item.post[0].title : null}}</td>
            <td>{{item.post[0] != null ? displayArray(item.post[0].channels) : null}}</td>
            <td class="text-warning">{{item.status.toUpperCase()}}</td>
            <td>
              <i class="fa fa-eye text-primary" @click="showPreview(item.code)"></i>
            </td>
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


    <empty v-if="tableData.length <= 0" :title="'No posts available!'" :action="'Keep growing.'"></empty>
  </div>
</template>

<script>
import roundedBtn from 'src/modules/generic/roundedBtn'
import DataTable from 'src/modules/generic/table'
import COLORS from 'src/assets/style/colors.js'
import Pager from 'src/components/increment/generic/pager/Pager.vue'
import ROUTER from 'src/router'
import AUTH from 'src/services/auth'
export default {
  data() {
    return {
      tableHeaders: [
        {title: 'Date'},
        {title: 'Post Title'},
        {title: 'Channel To Post'},
        {title: 'Status'},
        {title: 'Review'}
      ],
      tableData: [],
      colors: COLORS,
      limit: 5,
      offset: 0,
      numPages: null,
      activePage: 1,
      filter: null,
      sort: null,
      user: AUTH.user,
      status: null
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
    history(){
      ROUTER.push('post_management/history')
    },
    showPreview(code){
      ROUTER.push('post_management/view/' + code)
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
        status: 'for review',
        account_id: this.user.userID,
        category: this.user.merchant.addition_informations['industry'],
        offset: (this.activePage > 0) ? ((this.activePage - 1) * this.limit) : this.activePage
      }
      console.log('[status]', parameter)
      $('#loading').css({'display': 'block'})
      this.APIRequest('post/retrieve_history', parameter).then(response => {
        $('#loading').css({'display': 'none'})
        console.log('RESPONSEsdfd: ', response)
        if(!response.error) {
          this.tableData = response.data
          this.numPages = parseInt(response.size / this.limit) + (response.size % this.limit ? 1 : 0)
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
  min-height: 70vh;
}
.button{
  border-bottom-right-radius: 0px !important;
}
.button1{
  color: $primary !important;
  border: 1px solid $primary !important;
}
</style>
