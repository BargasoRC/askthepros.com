<template>
  <div class="holder" :style="{
    position: 'relative'
  }">
    <h3 style="margin-top: 25px;">Customize Prior To Posting Channels</h3>
    <p style="color: gray">Review and edit your posts prior to us sending them to your social medial channels. Then, approve once done.</p>
    <input class="title text-uppercase" v-model="title" size="120">
    <textarea class="form-control" placeholder="Type post description" name="post_title" id="post_title" cols="90" rows="15" v-model="description" @keyup="charCount()">
    </textarea>
    <div style="margin-top: -8%; border-color: white" v-if="branding != null">
      <textarea style="border-color: white; color: gray; margin-left: 1%" name="branding" id="branding" cols="90" v-model="branding" disabled="disabled">
      </textarea>
    </div>
    <br>
    <p style="text-align: right; font-size: 12px; color: gray;">Character count: {{character}}</p>
    <br>
    <br>
    <h5>Files:</h5>
    <Imagess @formData="form" @filePreview="storeImages" @add="add" :edit="$route.params.parameter != undefined ? true : false" :imagesRetrieve="imagesList" :code="$route.params.parameter != undefined ? $route.params.parameter : null"></Imagess>
    <br>
    <br>

    <h5>Post To:</h5>
    <br>
    <Toggle :text="'Google My Business'" v-model="googleMyBusiness" :isChecked="googleMyBusiness"></Toggle>
    <br>
    <Toggle :text="'Facebook'" v-model="facebook" :isChecked="facebook"></Toggle>
    <br>
    <Toggle :text="'LinkedIn'" v-model="linkedin" :isChecked="linkedin"></Toggle>
    <br>
    <span style="float: right" class="preview" @click="preview(data)"><u><b>Preview</b></u></span>
    <roundedBtn
      :text="'Post'"
      :onClick="post"
      class="button1"
      :styles="{
        backgroundColor: colors.primary,
        color: 'white',
        width: '10%',
        marginBottom: '5%'
      }"
    />
    <br>
    <review
      ref="previewSelected"
      :selected="selectedItem"
      :files="returnImagesList"
      :first="'false'"
      :isAddd="isAdd"
    />
    
    <errorModal
    ref="errorModal"
    :title="'Error Message'"
    :message="'Please fill in all of the fields.'"
    />
  </div>
</template>

<script>
import roundedBtn from 'src/modules/generic/roundedBtn'
import Imagess from 'src/modules/generic/previewImage.vue'
import Toggle from 'src/modules/generic/toggleSwitch.vue'
import COLORS from 'src/assets/style/colors.js'
import CONFIG from 'src/config.js'
import review from './UserPreview.vue'
import AUTH from 'src/services/auth'
import ROUTER from 'src/router'
import errorModal from 'src/components/increment/generic/Modal/Alert.vue'
export default {
  mounted(){
    this.retrieveReview(this.$route.params.parameter)
    this.retrieveBranding()
  },
  data() {
    return {
      user: AUTH.user,
      colors: COLORS,
      config: CONFIG,
      imagesList: [],
      errorMessage: null,
      idImage: null,
      data: [],
      industry: global.industry,
      selectedIndustry: null,
      global: global,
      isValid: true,
      title: null,
      description: null,
      facebook: false,
      googleMyBusiness: false,
      linkedin: false,
      isClearing: false,
      character: 0,
      channel: [],
      channels: [],
      file: null,
      selectedItem: null,
      branding: null,
      addImage: [],
      isAdd: false,
      dataRetrieve: []
    }
  },
  components: {
    Imagess,
    Toggle,
    roundedBtn,
    review,
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
    }
  },
  methods: {
    charCount(){
      this.character = this.description.length
    },
    form(data){
      this.file = data
    },
    toggle(id){
      this.channel.push(id)
    },
    post(){
      if(this.validate()){
        if(this.addImage.length === 0){
          this.imagesList = Object.values(JSON.parse(this.selectedItem.url)).map(el => {
            return el
          })
        }
        let channels = []
        this.facebook ? channels.push('FACEBOOK') : null
        this.googleMyBusiness ? channels.push('GOOGLE_MY_BUSINESS') : ''
        this.linkedin ? channels.push('LINKEDIN') : ''
        let parameter = {
          code: this.$route.params.parameter,
          title: this.title,
          description: this.description,
          url: this.addImage.length > 0 ? JSON.stringify(this.addImage) : JSON.stringify(this.imagesList),
          account_id: this.user.userID,
          channels: JSON.stringify(channels),
          category: this.selectedItem.category,
          parent: this.dataRetrieve.post_id,
          id: this.dataRetrieve.id
        }
        this.isClearing = true
        this.APIRequest('post/update_user', parameter).then(response => {
          $('#loading').css({'display': 'none'})
          if(response.data > 0){
            ROUTER.push('/post_management')
          }
        })
      }
    },
    validate() {
      if(this.title === '' && this.title === null && this.title === undefined && this.description === '' && this.description === null && this.description === undefined){
        this.$refs.errorModal.show()
        return false
      }
      if(this.facebook === false && this.linkedin === false && this.googleMyBusiness === false){
        this.isValid = false
        this.$refs.errorModal.show()
        return false
      }if(this.title === '' && this.title === null && this.title === undefined) {
        this.isValid = false
        this.$refs.errorModal.show()
        return false
      }if(this.description === '' && this.description === null && this.description === undefined) {
        this.isValid = false
        this.$refs.errorModal.show()
        return false
      }
      return true
    },
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
    preview(){
      this.$refs.previewSelected.show()
    },
    retrieveBranding(){
      let parameter = {
        account_id: this.user.userID
      }
      $('#loading').css({'display': 'block'})
      this.APIRequest('brandings/retrieve_by_accountId', parameter).then(response => {
        $('#loading').css({'display': 'none'})
        if(response.details != null) {
          this.branding = Object.values(JSON.parse(response.details))
        }
      })
    },
    retrieveReview(code){
      let parameter = {
        code: code,
        account_id: this.user.userID
      }
      $('#loading').css({'display': 'block'})
      this.APIRequest('post/retrieve_by_codes', parameter).then(response => {
        $('#loading').css({'display': 'none'})
        if(response.data.length > 0) {
          this.dataRetrieve = response.data[0]
          this.selectedItem = response.data[0].post[0]
          this.title = this.selectedItem.title
          this.description = this.selectedItem.description
          this.branding = this.selectedItem.branding != null ? Object.values(JSON.parse(this.selectedItem.branding.details)) : null
          var channel = this.selectedItem.channels
          if(channel.includes('FACEBOOK')){
            this.facebook = true
          }
          if(channel.includes('LINKEDIN')){
            this.linkedin = true
          }
          if(channel.includes('GOOGLE_MY_BUSINESS')){
            this.googleMyBusiness = true
          }
          this.file = this.selectedItem.url
          this.imagesList = Object.values(JSON.parse(this.selectedItem.url)).map(el => {
            let temp = {}
            if(this.$route.params.parameter === undefined){
              return el
            }else{
              temp['url'] = this.config.BACKEND_URL + el
              return temp
            }
          })
          this.charCount()
        }
      })
    }
  }
}
</script>

<style scoped lang="scss" scoped>
@import "~assets/style/colors.scss";
#branding{
  border-color: white;
  background-color: white;
}
.holder{
  width: 96%;
  margin-left: 2%;
  margin-right: 2%;
  float: left;
}
.title{
  color: $primary;
  font-size: 18px;
  margin-bottom: 1%;
  font-weight: bold;
  background-color: rgba(0, 0, 0, 0);
  border: none;
  outline: none;
}
textarea{
  padding: 2%;
  box-sizing: border-box;
  border-color: $primary;
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
  color: $primary;
  cursor: pointer;
}
</style>
