<template>
  <div class="holder" :style="{
    position: 'relative'
  }">
    <h3 style="margin-top: 25px;">Customize Prior To Posting Channels</h3>
    <p style="color: gray">Review and edit your posts prior to us sending them to your social medial channels. Then, approve once done.</p>

    <input class="title text-uppercase" v-model="data.title">
    <textarea class="form-control" placeholder="Type post description" name="post_title" id="post_title" cols="90" rows="10" v-model="data.description">
    </textarea>
    <br>
    <br>
    <h5>Files:</h5>
    <Imagess @formData="form" @filePreview="storeImages" :edit="$route.params.parameter != undefined ? true : false" :imagesRetrieve="imagesList"></Imagess>
    <br>
    <br>

    <h5>Post To:</h5>
    <br>
    <Toggle :text="'Google My Business'" v-model="googleMyBusiness" @input="toggle('GOOGLE_MY_BUSINESS')" :isChecked="googleMyBusiness"></Toggle>
    <br>
    <Toggle :text="'Facebook'" v-model="facebook" @input="toggle('FACEBOOK')" :isChecked="facebook"></Toggle>
    <br>
    <Toggle :text="'LinkedIn'" v-model="linkedin" @input="toggle('LINKEDIN')" :isChecked="linkedin"></Toggle>
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
export default {
  mounted(){
    this.retrieveReview(this.$route.params.parameter)
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
      title: '',
      description: '',
      facebook: false,
      googleMyBusiness: false,
      linkedin: false,
      isClearing: false,
      character: 0,
      channel: [],
      channels: [],
      file: null,
      selectedItem: null
    }
  },
  components: {
    Imagess,
    Toggle,
    roundedBtn,
    review
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
    form(data){
      this.file = data
      console.log('forms: ', data)
    },
    toggle(id){
      this.channel.push(id)
    },
    post(){
      console.log(this.data.title)
      var count = {}
      this.channel.forEach(function(i) {
        count[i] = (count[i] || 0) + 1
      })
      if((count.FACEBOOK % 2 === 0) || count.FACEBOOK === undefined){
      }else{
        this.channels.push('FACEBOOK')
      }
      if((count.GOOGLE_MY_BUSINESS % 2 === 0) || count.GOOGLE_MY_BUSINESS === undefined){
      }else{
        this.channels.push('GOOGLE_MY_BUSINESS')
      }
      if((count.LINKEDIN % 2 === 0) || count.LINKEDIN === undefined){
      }else{
        this.channels.push('LINKEDIN')
      }
      console.log('[channels]', this.channels, this.data.title, this.data.description)
    },
    storeImages(data) {
      this.imagesList = data
    },
    preview(data){
      this.$refs.preview.show(data)
    },
    retrieveReview(id){
      let parameter = {
        account_id: this.user.userID,
        id: id
      }
      $('#loading').css({'display': 'block'})
      this.APIRequest('post/retrieve_by_id', parameter).then(response => {
        $('#loading').css({'display': 'none'})
        console.log('RESPONSE: ', response.data[0])
        if(!response.error) {
          this.data = response.data[0]
          var channel = response.data[0].channels
          if(channel.includes('FACEBOOK')){
            this.facebook = true
          }
          if(channel.includes('LINKEDIN')){
            this.linkedin = true
          }
          if(channel.includes('GOOGLE_MY_BUSINESS')){
            this.googleMyBusiness = true
          }
          this.description = response.data[0].description
          this.imagesList = Object.values(JSON.parse(response.data[0].url)).map(el => {
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
