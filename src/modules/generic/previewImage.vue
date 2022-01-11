<template>
  <div class="col-sm-12 p-0 mt-3" style="position: relative;">
    <div>
      <div class="other-image">
      </div>
      <div class="scrolling-wrapper custom_scroll d-flex" style="height: 130px">
        <div v-for="(item, index) in returnImageList" :key="index" :group="item" style="height:100px;width:100px"
          :class="'imageContainer p-10'">
          <img :src="config.BACKEND_URL + item" class="image">
          <label class="middle">
            <i class="fa fa-times-circle text"  @click="deleteImage(index)"></i>
          </label>
        </div>
      </div>

      <div class="d-flex justify-content-start mt-5 mb-5">
        <button id="imageCont" type="button" class="btn add_file" @click="addImage()">Add File</button>
        <input type="file" id="Image" accept="image/*"
          @change="setUpFileUpload($event, add)">
      </div>
    </div>
    <!-- <confirmError
    ref="confirmError"
    :title="'Error Message'"
    :message="'Invalid Image'"
    /> -->
    <div v-if="selectedImage != null" class="modal fade" id="incrementAlert" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title text-primary" id="exampleModalLabel">Error Message</h5>
            <button type="button" class="close" @click="hideModal()" aria-label="Close">
              <span aria-hidden="true" class="text-primary">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <label>Invalid Image</label>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" @click="hideModal()">Close</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade bd-example-modal-lg" role="dialog" id="editImage">
      <div class="modal-dialog modal-lg">
        <div class="modal-content" style="height: 75vh; width: 70%; margin-right: 15%; margin-left: 15%;">
          <div id="tui-image-editor"></div>
          <div style="text-align: right;">
            <!--  background-color: #151515; 1px solid white -->
            <roundedBtn
              :onClick="close"
              :icon="null"
              :text="'Close'"
              :styles="{
                background: '#FF0000',
                color: 'white',
                width: '150px !important',
                minWidth: '150px !important',
                border: 'none',
                margin: '5px'
              }"
              :icon_position="'left'"
            />
            <roundedBtn
              :onClick="saveImage"
              :icon="null"
              :text="'Save Image'"
              :styles="{
                background: '#01009A',
                color: 'white',
                width: '150px !important',
                minWidth: '150px !important',
                border: 'none',
                margin: '10px'
              }"
              :icon_position="'left'"
            />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import AUTH from 'src/services/auth'
import CONFIG from 'src/config.js'
import axios from 'axios'
import COMMON from 'src/common.js'
// import confirmError from 'src/components/increment/generic/Modal/Alert.vue'
import 'tui-color-picker/dist/tui-color-picker.css'
import 'tui-image-editor/dist/tui-image-editor.css'
import roundedBtn from 'src/modules/generic/roundedBtn'
const ImageEditor = require('tui-image-editor')
export default {
  props: ['imagesRetrieve', 'formData', 'edit', 'code'],
  data: () => ({
    user: AUTH.user,
    config: CONFIG,
    common: COMMON,
    selectedImage: null,
    imagesList: [],
    errorMessage: null,
    idImage: null,
    file: null,
    productId: null,
    hasError: false,
    files: [],
    fileUrls: [],
    add: true,
    useDefaultUI: true,
    instance: null,
    imageToEdit: null
  }),
  components: {
    roundedBtn
  },
  mounted(){
    if(this.user.type === 'USER'){
      this.retrieveImageUser()
    }else{
      this.retrieveImage()
    }
    this.imagesList = []
    this.files = []
    this.fileUrls = []
  },
  computed: {
    returnImageList(){
      return this.imagesList
    },
    imagesData(){
      return this.imagesRetrieve
    }
  },
  methods: {
    close(){
      $('#editImage').modal('hide')
    },
    saveImage() {
      let imageName = this.instance.getImageName()
      let base = this.instance.toDataURL()
      var arr = base.split(',')
      let mime = arr[0].match(/:(.*?);/)[1]
      let bstr = atob(arr[1])
      let n = bstr.length
      let u8arr = new Uint8Array(n)
      while(n--){
        u8arr[n] = bstr.charCodeAt(n)
      }
      let finalImageName = imageName.split('.')[0] + '.' + mime.split('/')[1]
      this.file = new File([u8arr], imageName, {type: mime})
      this.upload(true)
      $('#editImage').modal('hide')
    },
    show(){
      $('#incrementAlert').modal({
        show: true,
        backdrop: 'static',
        keyboard: false
      })
    },
    hideModal(){
      $('#incrementAlert').modal('hide')
    },
    addImage(){
      this.instance = new ImageEditor(
        document.querySelector('#tui-image-editor'),
        {
          includeUI: {
            loadImage: {
              path: null,
              name: 'image'
            },
            theme: {
              'common.backgroundColor': 'white',
              'loadButton.backgroundColor': '#F1B814',
              'loadButton.border': '#F1B814',
              'submenu.normalIcon.color': '#8c8c8c',
              'submenu.normalLabel.color': '#8c8c8c',
              'submenu.activeIcon.color': 'black',
              'submenu.activeLabel.color': 'black',
              'submenu.partition.color': '#01009A',
              'submenu.backgroundColor': 'white',
              'common.bisize.height': '0px',
              'downloadButton.display': 'none'
            },
            menuBarPosition: 'bottom'
          }
        }
      )
      $('#editImage').modal({backdrop: 'static', keyboard: false})
      $('#editImage').modal('show')
    },
    selectImage(url){
      this.selectedImage = url
    },
    setUpFileUpload(event, add){
      let files = event.target.files || event.dataTransfer.files
      if(!files.length){
        return false
      }else{
        this.file = files[0]
        let filename = this.file.name.toLowerCase()
        if(filename.substring(filename.lastIndexOf('.')) === '.png' || filename.substring(filename.lastIndexOf('.')) === '.jpg' || filename.substring(filename.lastIndexOf('.')) === '.jpeg' || filename.substring(filename.lastIndexOf('.')) === '.gif' || filename.substring(filename.lastIndexOf('.')) === '.tif' || filename.substring(filename.lastIndexOf('.')) === '.bmp'){
          this.createFile(files[0], add)
        }else{
          this.show()
          // this.$refs.confirmError.show()
          this.file = null
        }
      }
    },
    createFile(file, add){
      let fileReader = new FileReader()
      fileReader.readAsDataURL(file)
      this.upload(add)
    },
    upload(add){
      if(this.file.size < 10240 && this.file != null){
        this.show()
        this.file = null
        return
      }
      this.validateImage(this.file.name)
      if(this.hasError === true){
        return
      }
      let formData = new FormData()
      formData.append('file', this.file)
      formData.append('file_url', this.file.name.replace(' ', '_'))
      formData.append('account_id', this.user.userID)
      formData.append('category', `product${this.productId}`)
      $('#loading').css({'display': 'block'})
      axios.post(this.config.BACKEND_URL + '/images/upload?token=' + AUTH.tokenData.token, formData).then(response => {
        $('#loading').css({'display': 'none'})
        this.hasError = false
        if(response.data.data !== null){
          this.imagesList.push(response.data.data)
          this.$emit('filePreview', this.imagesList)
          this.$emit('add', add)
        }
      })
      this.prevIndex = null
    },
    deleteImage(id){
      this.imagesList.splice(id, 1)
      this.$parent.imagesList = this.imagesList
    },
    retrieveImage(){
      if(this.code != null){
        let parameter = {
          account_id: this.user.userID,
          code: this.code
        }
        $('#loading').css({'display': 'block'})
        this.APIRequest('post/retrieve_by_code', parameter).then(response => {
          $('#loading').css({'display': 'none'})
          if(!response.error) {
            response.data.filter(el => {
              if(el.code === this.$route.params.parameter){
                Object.values(JSON.parse(el.url)).map(el => {
                  this.imagesList.push(el)
                })
              }
            })
          }
        })
      }
    },
    retrieveImageUser(){
      let parameter = {
        code: this.code
      }
      $('#loading').css({'display': 'block'})
      this.APIRequest('post/retrieve_by_codes', parameter).then(response => {
        $('#loading').css({'display': 'none'})
        response.data[0].post.filter(el => {
          Object.values(JSON.parse(el.url)).map(el => {
            this.imagesList.push(el)
          })
        })
      })
    },
    validateImage(imageName){
      this.imagesList.map(el => {
        let name = el.substring(el.lastIndexOf('_') + 1)
        if(imageName === name){
          this.hasError = true
        }
      })
    }
  }
}
</script>

<style scoped lang="scss" scoped>
@import "~assets/style/colors.scss";
.add_file {
  outline: none;
  box-shadow: none;
  border: 1px solid $title;
  border-radius: 10px;
  min-width: 120px;
  background-color: $hover;
  color: $text;
}
.add_file:hover {
  background-color: $hover !important;
}
.add_file:focus {
  outline: none;
  box-shadow: none;
  color: $text !important;
}
.ImageLabel{
  display: none;
}
.row:after {
  content: "";
  display: table;
  clear: both;
}
/* Six columns side by side */
.column {
  width: 16.66%;
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
  background-color: $primary;
  cursor: pointer;
  color: white
}
::-webkit-scrollbar-thumb{
  background: #555;
  width: 10px;
  height: 10px;
}
#imageCont:active, #imageCont:focus{
  cursor: pointer;
  color: $primary;
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
.text {
  color: red;
  cursor: pointer;
  font-size: 20px;
  padding: 16px 32px;
}
.imageContainer:hover .middle:hover .text{
  color: blue !important;
}
.middle {
  transition: .5s ease;
  opacity: 0;
  transform: translate(300%, -215%);
  -ms-transform: translate(-50%, -50%);
  text-align: center;
}
.product-image{
  width: 100%;
  margin-left: 2%;
  margin-right: 2%;
  margin-top: 2%;
  overflow-y: hidden;
  text-align: center;
}
.product-image .main-image{
  height: 350px;
  max-width: 100%;
}
.product-image .fa-image{
  font-size: 250px;
  line-height: 350px;
}
.product-image .other-image{
  height: 0px;
  max-width: 100%;
}
.images .overlay{
  height: 60px;
  z-index: 500;
  width: 80px;
  margin-top: -60px;
  background: rgba(0, 0, 0, 0);
}
#Image{
  display: none;
  height: 200px;
  width: 200px;
}
.images-holder{
  width: 100%;
  min-height: 60px;
  overflow-y: hidden;
}
label{
  width: 15%;
}
.remove-image{
  position: absolute;
}
#featured-image-remove{
  top: 50px;
  right: 5px;
  z-index: 1000;
  font-size: 24px;
}
#other-images-remove{
  top: -20px;
  right: 0px;
  z-index: 1000;
  font-size: 18px;
}
.remove-image:hover{
  cursor: pointer;
}
.custom_scroll::-webkit-scrollbar-track
{
	-webkit-box-shadow: inset 0 0 6px white;
  background: white;
	background-color: #F5F5F5;
}
.custom_scroll::-webkit-scrollbar
{
  width: 10px;
  height: 10px;
}
.custom_scroll::-webkit-scrollbar-thumb
{
	background: rgb(217, 217, 235);
  width: 10em;
}
@media (max-width: 992px){
  .product-image{
    width: 100%;
  }
}
</style>
