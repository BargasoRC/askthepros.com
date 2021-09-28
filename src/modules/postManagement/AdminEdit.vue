<template>
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-7">
        <div class="card">
          <div class="container">
            <p>Hi {{user.username}}! You can fill up contents of your post by using the field editor
              or directly on the preview section. For other channel, just click the next and previous action.
            </p>
            <div style="text-align: left; font-size: 13px">
              <i>Note:</i>
              <p style="text-align: left; margin-left: 5%">
                <i> No HTML tags allowed.</i>
                <br>
                <i> No Dates that Expire.</i>
                <br>
                <i> No Phone Numbers.</i>
                <br>
                <i> You may encourage a phone call but a phone number is not allowed.</i>
              </p>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label for="post_title"><b>Post Title</b></label>
          <input 
            :class="!this.isValid && title == '' ? 'form-control mb-0' : 'form-control'" 
            placeholder="Post Title" 
            :style="{
              ...!this.isValid && title == '' ? {border: '1px solid red !important'} : '',
              ...{
                height: '45px'
              }
            }"
            v-model="title"
          >
          <p
            class="mb-0 pb-0 requiredFieldError ml-0 mt-1"
            v-if="!this.isValid && title == ''"
          >Required Field</p>
        </div>

        <div class="form-group">
          <label for="description"><b>Description</b></label>
          <textarea 
            :class="!this.isValid && description == '' ? 'form-control mb-0' : 'form-control'" 
            placeholder="Add description here" 
            rows="10"
            :style="{
              ...!this.isValid && description == '' ? {border: '1px solid red !important'} : '',
            }"
            @keyup="charCount()"
            v-model="description"
          >
          </textarea>
          <p
            class="mb-0 pb-0 requiredFieldError ml-0 mt-1"
            v-if="!this.isValid && description == ''"
          >Required Field</p>
          <p style="text-align: right; font-size: 12px; color: gray;">Character count: {{character}}</p>
        </div>
        
        <div class="form-group">
          <label for="category"><b>Category</b></label>
          <searchField
            :placeholder="'Select Industry'"
            :items="industry"
            :styles="{
              background: 'none',
              color: '#84868B !important',
              width: '100% !important',
              borderRadius: '5px !important',
              border: 'none',
              border: !this.isValid && selectedIndustry.length === 0 ? '1px solid red !important' : 'none',
              marginBottom: !this.isValid && selectedIndustry.length === 0 ? '0px' : '35px'
            }"
            :dropdownItemStyles="{
              borderRadius: '5px',
              overflow: 'hidden',
              width: 'calc(100% - 30px)'
            }"
            :class="!this.isValid && selectedIndustry.length === 0 ? 'multiselect__tags1' : 'none'"
            :selectedIndex="selectedIndex"
            @onSelect="onSelect"
            v-if="!isClearing"
            ref="searchField"
          />
          <p
            class="mb-0 pb-0 requiredFieldError ml-0 mt-1"
            v-if="!this.isValid &&selectedIndustry.length === 0"
          >Required Field</p>
        </div>

        <div class="form-group" style="margin-top: 3%">
          <label for="post_setting"><b>Post Setting</b></label>
          <div class="Row row">
            <div class="Column col-4" style="margin-left: -20%"><Toggle :text="'Facebook'" v-model="facebook" :isChecked="facebook" v-if="!isClearing"/></div>
            <div class="Column col-5"><Toggle :text="'Google My Business'" v-model="googleMyBusiness" :isChecked="googleMyBusiness" v-if="!isClearing"/></div>
            <div class="Column col-3"><Toggle :text="'Linkedin'" v-model="linkedin" :isChecked="linkedin" v-if="!isClearing"/></div>
          </div>
        </div>
        <br>
        
        <b>File(s)</b>
        <Images @formData="form" v-if="!isClearing" @filePreview="storeImages" @add="add" :edit="$route.params.parameter != undefined ? true : false" :imagesRetrieve="imagesList" :code="$route.params.parameter != undefined ? $route.params.parameter : null"></Images>
        <br>
        <br>
      </div>
      <div class="col-sm-5">
        <div class="col-sm-12 d-flex justify-content-end mt-4 pt-2">
          <roundedBtn
            class="ml-1 mr-1"
            :onClick="() => (status != 'PUBLISH' && status != undefined) ? update('DRAFT') : save('DRAFT')"
            :text="'Save as Draft'"
            :styles="{
              backgroundColor: colors.secondary,
              color: 'white',
              width: '15%',
              outlineColor: colors.secondary
            }"
          />
          <roundedBtn
            class="ml-1 mr-1"
            :onClick="() => (status != 'PUBLISH' && status != undefined) ? update('PUBLISH') : save('PUBLISH')"
            :text="'Publish'"
            :styles="{
                backgroundColor: colors.darkPrimary,
                outlineColor: colors.primary,
                color: 'white',
                width: '15'
            }"
          />
        </div>
        <div class="col-sm-12 mt-5">
          <preview
          v-if="render"
          :selected="returnSelected"
          :files="returnImagesList"
          :first="status === null ? 'false' : 'true'"
          :isAddd="isAdd"
          />
          <!-- :selected="selectedItem" -->
        </div>
      </div>
    </div>
    <errorModal
    ref="errorModal"
    :title="'Error Message'"
    :message="val === true ? 'Your description is invalid or you have reached the maximum number(1500) of characters.' : 'Please fill in all of the fields and put a valid image.'"
    />
  </div>
</template>

<script>
import AUTH from 'src/services/auth'
import roundedBtn from 'src/modules/generic/roundedBtn'
import Images from 'src/modules/generic/previewImage.vue'
import Toggle from 'src/modules/generic/toggleSwitch.vue'
import COLORS from 'src/assets/style/colors.js'
import CONFIG from 'src/config.js'
import roundedSelectBtn from 'src/modules/generic/roundedSelectBtn'
import global from 'src/helpers/global'
import preview from 'src/modules/generic/preview.vue'
import axios from 'axios'
import ROUTER from 'src/router'
import searchField from 'src/modules/generic/searchField.vue'
import errorModal from 'src/components/increment/generic/Modal/Alert.vue'
export default {
  mounted(){
    this.retrievePayloads()
    if(this.$route.params.parameter === undefined){
      this.title = ''
      this.description = ''
      this.facebook = false
      this.linkedin = false
      this.googleMyBusiness = false
      this.selectedIndex = null
      this.status = null
      this.retrieveBranding()
    }else{
      this.retrieveEditPosts(this.$route.params.parameter)
    }
  },
  data() {
    return {
      user: AUTH.user,
      colors: COLORS,
      config: CONFIG,
      status: null,
      industry: global.industry,
      selectedIndustry: [],
      global: global,
      imagesList: [],
      errorMessage: null,
      idImage: null,
      file: null,
      isValid: true,
      title: '',
      description: '',
      facebook: false,
      googleMyBusiness: false,
      linkedin: false,
      isClearing: false,
      character: 0,
      selectedIndex: null,
      selectedItem: null,
      render: false,
      addImage: [],
      isAdd: false,
      isEmpty: true,
      val: false
    }
  },
  components: {
    Images,
    Toggle,
    roundedSelectBtn,
    roundedBtn,
    preview,
    searchField,
    errorModal
  },
  computed: {
    returnIndustry() {
      return this.industry.map(el => {
        return el.category
      })
    },
    returnImagesList() {
      return this.imagesList
    },
    returnDescription() {
      return this.description
    },
    returnSelected() {
      this.render = false
      this.selectedItem = {
        description: this.description,
        branding: this.selectedItem.branding
      }
      this.render = true
      return this.selectedItem
    }
  },
  methods: {
    // EDIT A POST
    retrievePayloads(){
      let conditions = [{
        value: 'subscriptions',
        clause: '=',
        column: 'payload'
      }]
      let parameter = {
        condition: conditions
      }
      $('#loading').css({'display': 'block'})
      this.APIRequest('payloads/retrieve', parameter).then(response => {
        $('#loading').css({'display': 'none'})
        if(response.data.length > 0) {
          this.industry = response.data
        }else{
          this.industry = []
        }
      }).catch(error => {
        $('#loading').css({'display': 'none'})
        error
      })
    },
    retrieveEditPosts() {
      let parameter = {
        account_id: this.user.userID,
        code: this.$route.params.parameter
      }
      $('#loading').css({'display': 'block'})
      this.APIRequest('post/retrieve_by_code', parameter).then(response => {
        $('#loading').css({'display': 'none'})
        if(!response.error) {
          response.data.filter(el => {
            if(el.code === this.$route.params.parameter){
              this.selectedItem = el
              this.status = el.status
              this.render = true
              this.title = el.title
              this.description = el.description
              var channel = el.channels
              if(channel.includes('FACEBOOK')){
                this.facebook = true
              }
              if(channel.includes('LINKEDIN')){
                this.linkedin = true
              }
              if(channel.includes('GOOGLE_MY_BUSINESS')){
                this.googleMyBusiness = true
              }
              JSON.parse(el.category).forEach(el => {
                this.$refs.searchField.value.push(el)
              })
              this.imagesList = Object.values(JSON.parse(el.url)).map(el => {
                let temp = {}
                if(this.$route.params.parameter === undefined){
                  return el
                }else{
                  temp['url'] = this.config.BACKEND_URL + el
                  return temp
                }
              })
            }
          })
          this.charCount()
        }
      })
    },
    retrieveBranding() {
      this.render = false
      let parameter = {
        account_id: this.user.userID
      }
      this.APIRequest('brandings/retrieve_by_accountId', parameter).then(response => {
        this.selectedItem = {}
        this.selectedItem['branding'] = {
          details: response.details
        }
        this.render = true
      })
    },
    update(status){
      this.$refs.searchField.returnCategory()
      let selectIndustry = []
      this.selectedIndustry.forEach(element => {
        selectIndustry.push({category: element.category, id: element.id})
      })
      if(this.validate()){
        let channels = []
        this.facebook ? channels.push('FACEBOOK') : null
        this.googleMyBusiness ? channels.push('GOOGLE_MY_BUSINESS') : ''
        this.linkedin ? channels.push('LINKEDIN') : ''
        let parameter = {
          code: this.$route.params.parameter,
          title: this.title,
          description: this.description,
          url: JSON.stringify(this.imagesList),
          account_id: this.user.userID,
          status: status,
          channels: JSON.stringify(channels),
          category: JSON.stringify(selectIndustry)
        }
        this.isClearing = true
        this.APIRequest('post/update', parameter).then(response => {
          $('#loading').css({'display': 'none'})
          if(response.data === true){
            ROUTER.push('/post_management')
          }
        })
      }
    },
    // Adding a Post
    add(add){
      this.isAdd = add
    },
    storeImages(data) {
      this.addImage = data
      if(this.$route.params.parameter === undefined){
        this.imagesList = Object.values(data).map(el => {
          let temp = {}
          temp['url'] = this.config.BACKEND_URL + el
          return temp
        })
      }else if(this.$route.params.parameter !== undefined && this.isAdd === true){
        this.imagesList = Object.values(data).map(el => {
          let temp = {}
          temp['url'] = this.config.BACKEND_URL + el
          return temp
        })
      }else{
        this.imagesList = data
      }
    },
    onSelect(data) {
      this.selectedIndustry = data
      this.isEmpty = false
    },
    save(status) {
      this.$refs.searchField.returnCategory()
      let selectIndustry = []
      this.selectedIndustry.forEach(element => {
        selectIndustry.push({category: element.category, id: element.id})
      })
      console.log('[this.validate]', this.validate(), global.validateDate(this.description))
      if(this.validate()) {
        $('#loading').css({'display': 'block'})
        let channels = []
        this.facebook ? channels.push('FACEBOOK') : null
        this.googleMyBusiness ? channels.push('GOOGLE_MY_BUSINESS') : ''
        this.linkedin ? channels.push('LINKEDIN') : ''
        let parameter = {
          title: this.title,
          description: this.description,
          url: JSON.stringify(this.addImage),
          account_id: this.user.userID,
          status: status,
          channels: JSON.stringify(channels),
          parent: null,
          category: JSON.stringify(selectIndustry)
        }
        this.isClearing = true
        this.APIRequest('post/create', parameter).then(response => {
          $('#loading').css({'display': 'none'})
          if(response.error === null){
            this.title = ''
            this.description = ''
            this.selectedIndustry = null
            this.facebook = false
            this.googleMyBusiness = false
            this.linkedin = false
            this.isClearing = false
            this.imagesList = []
          }
          ROUTER.push('/post_management')
        })
      }
    },
    validate() {
      var checkString = this.description.split(/\r?\n/).map(el => {
        if(el === ''){
          return true
        }
      })
      if(this.selectedIndustry.length <= 0 && this.title === '' && this.title === null && this.title === undefined && this.description === '' && this.description === null && this.description === undefined){
        this.$refs.errorModal.show()
        this.val = false
        return false
      }
      if(this.facebook === false && this.linkedin === false && this.googleMyBusiness === false){
        this.isValid = false
        this.val = false
        this.$refs.errorModal.show()
        return false
      }
      if(this.selectedIndustry.length <= 0) {
        this.isValid = false
        this.val = false
        this.$refs.errorModal.show()
        return false
      }if(this.title === '' && this.title === null && this.title === undefined) {
        this.isValid = false
        this.val = false
        this.$refs.errorModal.show()
        return false
      }if(this.description === '' && this.description === null && this.description === undefined) {
        this.isValid = false
        this.val = false
        this.$refs.errorModal.show()
        return false
      }if(this.googleMyBusiness === true && this.character >= 1500){
        this.isValid = false
        this.val = true
        this.$refs.errorModal.show()
        return false
      }if(this.linkedin === true && checkString.includes(true)){
        this.isValid = false
        this.val = true
        this.$refs.errorModal.show()
        return false
      }if(global.validateHTML(this.description) === true){
        this.isValid = false
        this.val = true
        this.$refs.errorModal.show()
        return false
      }if(global.validatePhoneNumber(this.description)){
        this.isValid = false
        this.val = true
        this.$refs.errorModal.show()
        return false
      }if(global.validateDate(this.description)){
        this.isValid = false
        this.val = true
        this.$refs.errorModal.show()
        return false
      }
      return true
    },
    form(data){
      this.file = data
    },
    charCount(){
      this.character = this.description.length
    }
  }
}
</script>

<style scoped lang="scss" scoped>
@import "~assets/style/colors.scss";
.requiredFieldError {
  color: $danger;
  font-size: 10px;
  margin-left: 20px;
  margin-bottom: 25px !important;
}
.imports{
  margin-top: 10%;
}
// .form-control{
//   margin-bottom: 3%;
// }
.Row {
  display: table;
}
.Column {
  display: table-cell;
}
.card {
  outline-color: white;
  border-color: white;
  margin-top: 3%;
  margin-bottom: 3%;
}
.container {
  padding: 20px 16px;
  border: 1px solid $secondary;
  border-radius: 25px;
  background-color: $secondary;
  text-align: center;
  word-break: break-word;
  color: white;
}
.holder{
  width: 96%;
  margin-left: 2%;
  margin-right: 2%;
  float: left;
}
.title{
 color: $primary
}
textarea{
  padding: 2%;
  box-sizing: border-box;
}
.scrolling-wrapper {
  overflow-x: scroll;
  overflow-y: hidden;
  white-space: nowrap;
  position: relative;
  .demo {
    display: inline-block;
  }
}
#imageCont:hover{
  // background-color: #cae166;
  cursor: pointer;
}
::-webkit-scrollbar-thumb{
  background: #555;
  width: 10px;
  height: 10px;
}
#imageCont:active, #imageCont:focus{
  cursor: pointer;
  color: #a3c026;
}
.image{
  width:100px;
  height:100px;
  transition: .5s ease; 
  backface-visibility: hidden;
  opacity: 1;
}
.imageContainer .image{
  // margin-left: 20px;
}
.imageContainer:hover .image {
  opacity: 0.3;
  background: #ffaa81;
  display: block;
}
.imageContainer:hover .middle {
  opacity: 1;
}
.imageContainer:hover .ImageLabel {
  opacity: 1;
  position: absolute;
  bottom: 50px;
}
.preview{
  color: $primary
}
.multiselect__tags1 {
  border-radius: 5px;
  border: 1px solid red!important;;
}
</style>
