<template>
  <div class="holder row">
    <div class="col-6">
      <div class="card">
        <div class="container">
          <p>Hi {{user.username}}! You can fill up contents of your post by using the field editor
            or directly on the preview section. For other channel, just click the next and previous action.
          </p>
        </div>
      </div>

      <div class="form-group">
        <label for="post_title"><b>Post Title</b></label>
        <input class="form-control" placeholder="Post Title">
      </div>

      <div class="form-group">
        <label for="description"><b>Description</b></label>
        <textarea class="form-control" placeholder="Add description here" rows="10">
        </textarea>
        <!-- <textarea class="form-control" placeholder="Add more details here" v-model="request.reason" rows="10"> -->
      </div>

      <div class="form-group">
        <label for="category"><b>Category</b></label>
        <roundedSelectBtn 
            :placeholder="'Select Industry'"
            :items="returnIndustry"
            :styles="{
              background: 'none',
              color: '#84868B !important',
              width: '100% !important',
              borderRadius: '5px !important',
              border: 'none',
              marginBottom: !this.isValid && selectedIndustry == null ? '0px' : '35px'
            }"
            :dropdownItemStyles="{
              borderRadius: '5px',
              overflow: 'hidden',
              width: 'calc(100% - 50px)'
            }"
            :selectedIndex="global.selectedIndustryIndex"
            @onSelect="onSelect"
          />
      </div>

      <div class="form-group" style="margin-top: 3%">
        <label for="post_setting"><b>Post Setting</b></label>
        <div class="Row row">
          <div class="Column col-4" style="margin-left: -20%"><Toggle :text="'Facebook'"></Toggle></div>
          <div class="Column col-5"><Toggle :text="'Google My Business'"></Toggle></div>
          <div class="Column col-3"><Toggle :text="'Linkedin'"></Toggle></div>
        </div>
      </div>
      <br>
      
      <h5>Files:</h5>
      <Images></Images>
      <br>
      <br>
    </div>
    <div class="col-6" style="margin-top: 1%">
      <div class="float-right col-3">
        <roundedBtn
            :onClick="publish"
            :text="'Publish'"
            :styles="{
                backgroundColor: colors.primary,
                outlineColor: colors.primary,
                color: 'white',
                width: '15'
            }"
        />
      </div>
      <div class="float-right col-3">
        <roundedBtn
            :onClick="draft"
            :text="'Save as Draft'"
            :styles="{
                backgroundColor: colors.warning,
                color: 'white',
                width: '15%',
                outlineColor: colors.warning
            }"
        />
    </div>
    </div>
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
export default {
  mounted(){
  },
  data() {
    return {
      user: AUTH.user,
      colors: COLORS,
      config: CONFIG,
      industry: global.industry,
      selectedIndustry: null,
      global: global,
      imagesList: [{
        id: 1,
        url: '/storage/image/asktheprooslogo.jpg'
      },
      {
        id: 2,
        url: '/storage/image/asktheprooslogo.jpg'
      },
      {
        id: 3,
        url: '/storage/image/asktheprooslogo.jpg'
      }],
      errorMessage: null,
      idImage: null,
      file: null
    }
  },
  components: {
    Images,
    Toggle,
    roundedSelectBtn,
    roundedBtn
  },
  methods: {
  }
}
</script>

<style scoped lang="scss" scoped>
@import "~assets/style/colors.scss";
.form-control{
  margin-bottom: 3%;
}

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
  border: 1px solid $warning;
  border-radius: 25px;
  background-color: $warning;
  text-align: center;
  word-break: break-word;
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
  color: $primary
}
</style>
