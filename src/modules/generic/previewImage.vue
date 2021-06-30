<template>
  <div class="col-sm-12 p-0 mt-3" style="position: relative;">
    <!-- <label class="remove-image text-danger" id="featured-image-remove" @click="removeImage(imagesData.featured !== null ? imagesData.featured[0].id : null)" v-if="selectedImage === null && imagesData.featured !== null">
      <i class="fa fa-times"></i>
    </label> -->
    <div>
      <div class="other-image">
      </div>
      <div class="scrolling-wrapper custom_scroll d-flex" style="height: 130px">
        <div v-for="item in returnImageList" :key="item.id" :group="item" style="height:100px;width:100px"
          :class="'imageContainer p-10'">
          <img :src="item.url" class="image" @click="selectImage(item.url)">
          <!-- <img :src="config.BACKEND_URL + item.url" class="image" @click="selectImage(item.url)"> -->
          <label class="middle">
            <i class="fa fa-times-circle text"  @click="deleteImage(item.id)" v-if="item.status !== 'featured'"></i>
          </label>
            <!-- <div v-if="imagesData.featured !== null">
          <p style="position:relative;font-weight:bold" :class="{'ImageLabel': item.url !== imagesData.featured[0].url}"><i class="fa fa-check" style="color: #cae166"></i> Featured</p>
        </div> -->
        </div>
      </div>
      <div class="d-flex justify-content-start mt-5">
        <button id="imageCont" type="button" class="btn add_file" @click="addImage()">Add File</button>
        <input type="file" id="Image" accept="file_extension|audio/*|video/*|image/*|media_type"
          @change="setUpFileUpload($event)">
      </div>
      <!-- <div style="height:100px !important;width:100px !important; border:2px solid gray" id="imageCont"
          @click="addImage()">
          <i class="fa fa-plus plusIcon"
              style="font-size:40px;padding:10px; vertical-align:middle;margin-top: 20px;margin-right:1%"></i>
          <input type="file" id="Image" accept="file_extension|audio/*|video/*|image/*|media_type"
              @change="setUpFileUpload($event)">
      </div> -->
    </div>
  </div>
</template>

<script>
import AUTH from 'src/services/auth'
import CONFIG from 'src/config.js'
import COMMON from 'src/common.js'
import axios from 'axios'
export default {
  props: ['productImages', 'formData'],
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
    fileUrls: []
  }),
  mounted(){
    // this.retrieveImage()
    // if(this.imagesList.length > 0){
    //   this.imagesList.map(el => {
    //     console.log('true')
    //     if(el.id === this.productImages.featured[0].id){
    //       $(`.${el.id}image`).removeAttr('hidden')
    //     }
    //   })
    // }
    this.imagesList = []
    this.files = []
    this.fileUrls = []
  },
  computed: {
    returnImageList(){
      return this.imagesList
    },
    imagesData(){
      if(this.productImages !== null){
        return this.productImages
      }
    }
  },
  methods: {
    addImage(){
      $('#Image')[0].click()
    },
    selectImage(url){
      this.selectedImage = url
    },
    apply(){
      this.$parent.manageImageUrl(this.selectedImage, 'featured')
    },
    cancel(){
      this.retrieveImage()
      // this.$parent.retrieve()
      this.selectedImage = null
    },
    setUpFileUpload(event){
      let files = event.target.files || event.dataTransfer.files
      if(!files.length){
        return false
      }else{
        this.file = files[0]
        // let filename = this.file.name.toLowerCase()
        this.createFile(this.file)
        // if(filename.substring(filename.lastIndexOf('.')) === '.png' || filename.substring(filename.lastIndexOf('.')) === '.jpg' || filename.substring(filename.lastIndexOf('.')) === '.jpeg' || filename.substring(filename.lastIndexOf('.')) === '.gif' || filename.substring(filename.lastIndexOf('.')) === '.tif' || filename.substring(filename.lastIndexOf('.')) === '.bmp'){
        //   this.createFile(files[0])
        // }else{
        //   this.errorMessage = 'Upload images only!'
        //   this.file = null
        // }
      }
    },
    createFile(file){
      let fileReader = new FileReader()
      fileReader.readAsDataURL(file)
      this.upload()
    },
    upload(){
      // if(parseInt(this.file.size / 1024) > 1024){
      //   this.errorMessage = 'Allowed size is up to 1 MB only'
      //   this.file = null
      //   return
      // }
      // this.validateImage(this.file.name)
      // if(this.hasError === true){
      //   return
      // }
      let formData = new FormData()
      this.files.push(this.file)
      this.fileUrls.push(this.file.name.replace(' ', '_'))
      this.files.forEach((el, index) => {
        formData.append('file' + index, el)
      })
      formData.append('file_url', this.fileUrls)
      formData.append('account_id', this.user.userID)
      this.$emit('formData', formData)
      var reader = new FileReader()
      let self = this
      reader.onloadend = function() {
        let temp = {
          id: self.imagesList.length + 1,
          url: reader.result
        }
        self.imagesList.push(temp)
      }
      reader.readAsDataURL(this.file)
      this.$emit('filePreview', this.imagesList)
      // $('#loading').css({'display': 'block'})
      // axios.post(this.config.BACKEND_URL + '/images/upload?token=' + AUTH.tokenData.token, formData).then(response => {
      //   $('#loading').css({'display': 'none'})
      //   this.hasError = false
      //   this.retrieveImage()
      //   this.$parent.retrieveFeaturedImages()
      //   if(response.data.data !== null){
      //     this.retrieveImage()
      //     this.$parent.retrieveFeaturedImages()
      //   }
      // })
    },
    removeImage(id){
      let parameter = {
        id: id
      }
      this.APIRequest('product_images/delete', parameter).then(response => {
        this.retrieveImage()
        this.$parent.retrieveFeaturedImages()
        this.selectedImage = null
      })
    },
    deleteImage(id){
      this.imagesList = this.imagesList.filter((el, index) => {
        if(el.id === id){
          this.files.splice(index, 1)
        }
        return el.id !== id
      })
      this.$emit('filePreview', this.imagesList)
      let formData = new FormData()
      this.files.push(this.file)
      this.fileUrls.push(this.file.name.replace(' ', '_'))
      this.files.forEach((el, index) => {
        formData.append('file' + index, el)
      })
      formData.append('file_url', this.fileUrls)
      formData.append('account_id', this.user.userID)
      this.$emit('formData', formData)
      // let params = {
      //   id: id
      // }
      // $('#loading').css({display: 'block'})
      // axios.post(this.config.BACKEND_URL + '/images/delete?token=' + AUTH.tokenData.token, params).then(response => {
      //   $('#loading').css({display: 'none'})
      //   this.retrieveImage()
      //   // this.$parent.retrieve()
      // })
    },
    retrieveImage(){
      this.productId = this.productImages.id
      const parameter = {
        condition: [{
          value: this.user.userID,
          column: 'account_id',
          clause: '='
        }],
        sort: {
          created_at: 'desc'
        },
        category: `product${this.productImages.id}`
      }
      $('#loading').css({display: 'block'})
      this.APIRequest('images/retrieve_with_category', parameter).done(response => {
        $('#loading').css({display: 'none'})
        if(response.data.length > 0){
          this.imagesList = response.data
          this.filteredData = response.data
        }else{
          this.productImages = null
          this.filteredData = null
        }
      })
    },
    validateImage(imageName){
      this.imagesList.map(el => {
        let name = el.url.substring(el.url.lastIndexOf('_') + 1)
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
