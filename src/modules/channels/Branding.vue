<template>
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-7">
        <div class="col-sm-12">
          <h3 style="margin-top: 25px;font-size: 25px;">Social Media Integration</h3>
          <p class="subheads">Connect to your social media channels, then setup your branding and choose your automation.</p>
        </div>
        <div class="col-sm-12 mt-3">
          <roundedBtn
            :onClick="connectMedia"
            :text="'Social Media Channels'"
            class="button"
            :styles="{
              backgroundColor: 'white',
              outlineColor: colors.darkPrimary,
              color: 'white',
              borderTopRightRadius: '0px !important',
              borderBotttomLeftRadius: '0px !important',
            }"
          />
          <roundedBtn
            :text="'Branding'"
            class="button1"
            :styles="{
              backgroundColor: colors.darkPrimary,
              color: 'white',
              outlineColor: colors.darkPrimary,
              borderTopLeftRadius: '0px !important',
              borderBottomLeftRadius: '0px !important',
              borderTopRightRadius: '0px !important',
              borderBottomRightRadius: '0px !important',
              marginLeft: '-5px'
            }"
            :onClick="() => {}"
          />
          <roundedBtn
            :onClick="automationSettings"
            :text="'Automation Settings'"
            class="button2"
            :styles="{
              backgroundColor: 'white',
              outlineColor: colors.darkPrimary,
              color: 'white',
              borderTopLeftRadius: '0px !important',
              borderBottomLeftRadius: '0px !important',
              marginLeft: '-5px'
            }"
          />
        </div>
        <div class="col-sm-12 mb-5">
          <h3 style="margin-top: 20px;font-size: 20px;">Add Branding.</h3>
          <p class="subheads">These “branding footers” will be added to the end of your social media posts.   They should be one or two short sentences and incorporate your brand name and location. </p>
          <p v-if="error" style="color: red">Must have at least 1 branding.</p>
          <p class="pl-0 mt-5"><b>Branding Footer 1</b></p>
          <textarea class="textArea" rows="5" placeholder="Write your branding footer content here..." v-model="brand1"></textarea>
          <span class="char-count">Character Count: {{brand1 && brand1.length}}</span>
          <p class="pl-0 mt-4"><b>Branding Footer 2</b></p>
          <textarea class="textArea" rows="5" placeholder="Write your branding footer content here..." v-model="brand2"></textarea>
          <span class="char-count">Character Count: {{brand2 && brand2.length}}</span>
          <p class="pl-0 mt-4"><b>Branding Footer 3</b></p>
          <textarea class="textArea" rows="5" placeholder="Write your branding footer content here..." v-model="brand3"></textarea>
          <span class="char-count">Character Count: {{brand3 && brand3.length}}</span>
          <roundedBtn
            :class="'btnn'"
            :onClick="saveBrandings"
            :text="'Save'"
            :styles="{
              backgroundColor: '#01004E',
              color: 'white',
            }"
          />
        </div>
      </div>
      <div class="col-sm-5 mt-5">
        <Preview v-if="render"
          :selected="returnSelected" />
      </div>
    </div>
  </div>
</template>

<script>
import roundedBtn from 'src/modules/generic/roundedBtn'
import COLORS from 'src/assets/style/colors.js'
import ROUTER from 'src/router'
import Preview from 'src/modules/generic/preview.vue'
import AUTH from 'src/services/auth'
export default {
  data() {
    return {
      colors: COLORS,
      count: 0,
      count2: 0,
      count3: 0,
      brand1: '',
      brand2: '',
      brand3: '',
      user: AUTH.user,
      render: false,
      selectedItem: null,
      error: false
    }
  },
  components: {
    roundedBtn,
    Preview
  },
  computed: {
    returnSelected() {
      this.render = false
      this.selectedItem = {
        description: null,
        branding: this.selectedItem.branding
      }
      this.render = true
      return this.selectedItem
    },
    returnBranding() {
      return [this.brand1, this.brand2, this.brand3]
    }
  },
  created() {
    this.retrieveBrandings()
  },
  methods: {
    connectMedia(){
      this.$router.push('/channels')
    },
    automationSettings(){
      this.$router.push('/channels/automation')
    },
    charCount(){
      this.count = this.brand.length
    },
    saveBrandings() {
      if(this.brand1 === '' && this.brand2 === '' && this.brand3 === ''){
        this.error = true
        return
      }
      let parameter = {
        condition: [
          {
            value: this.user.userID,
            clause: '=',
            column: 'account_id'
          }
        ],
        offset: 0,
        limit: 1
      }
      $('#loading').css({'display': 'block'})
      this.APIRequest('brandings/retrieve', parameter).then(response => {
        $('#loading').css({'display': 'none'})
        this.error = false
        let brandings = {
          account_id: this.user.userID,
          details: JSON.stringify({
            brand1: this.brand1,
            brand2: this.brand2,
            brand3: this.brand3
          })
        }
        let url = ''
        if(response.data.length > 0) {
          url = 'brandings/update'
          brandings.id = response.data[0].id
        }else if(response.data.length === 0) {
          url = 'brandings/create'
        }
        let self = this

        this.APIRequest(url, brandings).then(response => {
          self.retrieveBrandings()
        })
      }).catch(error => {
        $('#loading').css({'display': 'none'})
        error
      })
    },
    retrieveBrandings() {
      let parameter = {
        condition: [
          {
            value: this.user.userID,
            clause: '=',
            column: 'account_id'
          }
        ],
        offset: 0,
        limit: 1
      }
      $('#loading').css({'display': 'block'})
      this.APIRequest('brandings/retrieve', parameter).then(response => {
        $('#loading').css({'display': 'none'})
        if(response.data.length > 0) {
          let brandings = JSON.parse(response.data[0].details)
          this.brand1 = brandings.brand1
          this.brand2 = brandings.brand2
          this.brand3 = brandings.brand3
          this.selectedItem = {}
          this.selectedItem['branding'] = {
            details: response.data[0].details
          }
          this.render = true
        }
      }).catch(error => {
        $('#loading').css({'display': 'none'})
        error
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
.button{
  border-bottom-right-radius: 0px !important;
}
.button, .button2{
  color: $primary !important;
  border: 1px solid $primary !important;
}
h3{
  font-weight: bold;
}
.textArea {
  width:100%;
  border: 0.25px solid $darkPrimary;
  box-sizing: border-box;
  border-radius: 5px;
  padding: 10px;
}

* {
  box-sizing: border-box;
}

.column {
  float: left;
  width: 50%;
  padding-left: 20px;
  padding-right: 20px;
  position: relative;
}

.row:after {
  content: "";
  display: table;
  clear: both;
}
.char-count {
  font-size: 12px;
  float: right;
  color: $text;
}

.btnn {
  margin-top: 40px;
}
.subheads{
  color: $text;
}
</style>
