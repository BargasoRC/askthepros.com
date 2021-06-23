<template>
  <div class="container-fluid p-0">
    <div class="card preview_card">
      <div class="card-header preview_card_header d-flex justify-content-between text-white">
        <i class="fas fa-chevron-left mb-0 pb-0" @click="changeView('decrement')"></i>
        <p class="pb-0 mb-0">{{previewTypes[previewIndex]}} Preview</p>
        <i class="fas fa-chevron-right mb-0 pb-0" @click="changeView('increment')"></i>
      </div>
      <div class="card-body preview_card_body">
        <div class="col-sm-12 d-flex justify-content-start post_header p-0">
          <div>
            <i class="fas fa-user-circle avatar"></i>
          </div>
          <div class="ml-2 post_author_header">
            <b class="author">{{user.username ? user.username : user.email}}</b>
            <div class="p-0 job_title_container" v-if="previewTypes[previewIndex].toLowerCase() === 'linkedin'">
              <b class="font-weight-normal job_title"> Job Title / Position </b>
            </div>
            <div class="d-flex justify-content-start post_header">
              <b class="font-weight-normal hours_posted p-0 mr-1">7h</b>
              <div class="dot"> &#9679; </div>
              <i class="fas fa-globe-africa ml-1 visibility"></i>
            </div>
          </div>
        </div>
        <div class="col-sm-12 p-0 mt-5 mb-3" v-if="(returnDescription !== '' && returnDescription) || (files && files.length) > 0">
          <p class="mb-0 p-0">
            {{returnDescription}}
          </p>
        </div>
        <div class="col-sm-12 p-0 d-flex justify-content-between file_container" v-if="(returnDescription !== '' && returnDescription) || files && files.length > 0">
          <div v-for="(el, ndx) in returnFiles" :key="ndx + String(el.id)"
            :class="'file_width ' + (([1, 3, 4].includes(files.length) || files.length >= 5) && ndx === 0 ? 'whole_page ' : '') + (files.length >= 4 && ndx !== 0 ? 'compressed ' : '')" :style="{
              background: `url(${el.url})`,
              backgroundRepeat: 'no-repeat',
              backgroundSize: 'cover',
              backgroundPosition: 'center',
              opacity: files.length > 4 && ndx === 3 ? 0.7 : 1
            }"
          >
            <b 
              v-if="files.length > 4 && ndx === 3"
              :style="{
                position: 'absolute',
                top: '50%',
                left: '50%',
                transform: 'translate(-50%, -50%) !important',
                opacity: 1,
                padding: '7px',
                fontSize: '18px'
              }"
              class="view_more"
            ><i class="fas fa-plus" :style="{
              fontSize: '17px'
            }"></i> {{files.length - 4}}</b>
          </div>
        </div>
        <div class="col-sm-12 p-0" v-if="(returnDescription === '' || !returnDescription) && files.length <= 0">
          <div class="col-sm-12 p-0 mt-5" :style="{
            height: '17px',
            backgroundColor: '#ededed'
          }">
          </div>
          <div class="col-sm-8 p-0" :style="{
            marginTop: '3px',
            height: '17px',
            backgroundColor: '#ededed'
          }">
          </div>
          <div class="col-sm-4 p-0 mb-4" :style="{
            marginTop: '3px',
            height: '17px',
            backgroundColor: '#ededed'
          }">
          </div>
          <div class="col-sm-12 p-0 d-flex justify-content-between file_container">
            <div v-for="(el, ndx) in blank" :key="ndx + String(el.id)"
              :class="'file_width ' + ((blank.length === 3 || blank.length === 1) && ndx === 0 ? 'whole_page' : '')"
              :style="{
                backgroundColor: '#ededed'
              }">
            </div>
          </div>
        </div>
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
export default {
  props: ['description', 'files'],
  mounted(){
  },
  data() {
    return {
      user: AUTH.user,
      colors: COLORS,
      config: CONFIG,
      previewTypes: ['Facebook', 'Linkedin', 'Google My Business'],
      previewIndex: 0,
      blank: [1, 2, 3]
    }
  },
  components: {
    Images,
    Toggle,
    roundedSelectBtn,
    roundedBtn
  },
  computed: {
    returnDescription() {
      return this.description
    },
    returnFiles() {
      return this.files.filter((el, index) => {
        return index <= 3
      })
    }
  },
  methods: {
    changeView(type) {
      if(type === 'increment') {
        if(this.previewIndex + 1 <= this.previewTypes.length - 1) {
          this.previewIndex += 1
        }else{
          this.previewIndex = 0
        }
      }else if(type === 'decrement') {
        if(this.previewIndex - 1 >= 0) {
          this.previewIndex -= 1
        }else{
          this.previewIndex = this.previewTypes.length - 1
        }
      }
    }
  }
}
</script>

<style scoped lang="scss" scoped>
@import "~assets/style/colors.scss";
.view_more {
  color: $primary
}
.job_title_container {
  margin-top: -5px;
}
.job_title {
  font-size: 11px;
}

.compressed {
  width: calc((100% / 3) - 1px) !important;
}
.compressed:after {
  content: "";
  display: block;
  padding-bottom: 80%;
}
.whole_page {
  width: 100% !important;
}
.whole_page:after {
  content: "" !important;
  display: block !important;
  padding-bottom: 50% !important;
}
.file_container {
  flex-wrap: wrap;
}
.file_width {
  width: calc(50% - 1px);
  position: relative;
  margin-top: 1px;
  margin-bottom: 1px;
}
.file_width:after {
  content: "";
  display: block;
  padding-bottom: 95%;
}

.dot {
  font-size: 8px;
  margin-top: -3px;
}
.visibility {
  font-size: 11px;
}
.hours_posted {
  font-size: 11px;
  margin-top: -2px;
}
.post_author_header {
  display: block;
  align-items: center;
}
.author {
  font-size: 12px;
}
.post_header {
  align-items: center;
}
.avatar {
  font-size: 45px;
}
.preview_card_header {
  background-color: $darkPrimary;
  align-items: center;
  border-top-left-radius: 20px;
  border-top-right-radius: 20px;
  min-height: 45px;
}
.holder{
  width: 96%;
  margin-left: 2%;
  margin-right: 2%;
}
.container{
  background-color: $darkPrimary;
  border-top-left-radius: 25%;
  border-top-right-radius: 25%;
  padding-top: 2%;
}
.preview_card {
  border-top-left-radius: 20px;
  border-top-right-radius: 20px;
}
.preview_card_body {
  min-height: calc(100vh - 250px);
}
</style>
