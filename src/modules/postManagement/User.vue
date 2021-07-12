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
      <DataTable 
        :tableActions="tableActions"
        :tableHeaders="tableHeaders"
        :tableData="tableData"
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
      tableActions: [
        {button: `<i class="fas fa-eye ml-2 mr-2" style="color: #01009A !important;"></i>`}
      ],
      tableHeaders: [
        {title: 'Date', key: 'created_at', type: 'text'},
        {title: 'Post Title', key: 'title', type: 'text'},
        {title: 'Channel To Post', key: 'channels', type: 'text'},
        {title: 'Status', key: 'status', type: 'status'},
        {title: 'Review', type: 'action'}
      ],
      tableData: [],
      colors: COLORS,
      limit: 5,
      offset: 0,
      numPages: null,
      activePage: 1,
      user: AUTH.user
    }
  },
  components: {
    roundedBtn,
    DataTable,
    'empty': require('components/increment/generic/empty/Empty.vue'),
    Pager
  },
  created() {
    this.retrievePosts()
  },
  methods: {
    history(){
      ROUTER.push('post_management/history')
    },
    onTableAction(data){
      let id = this.tableData[data.rowIndex].id
      ROUTER.push('post_management/view/' + id)
    },
    retrievePosts(){
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
    },
    returnTableData() {
      return this.tableData.filter((el, ndx) => {
        el.channels = JSON.parse(el.channels).join(', ').replaceAll('_', ' ')
        return el
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
}
.button1{
  color: $primary !important;
  border: 1px solid $primary !important;
}
</style>
