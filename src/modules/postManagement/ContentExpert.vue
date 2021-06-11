<template>
  <div class="holder">
    <div class="row">
      <div class="column">
        <div class="headerText">Hi {{user.username}}! You can fill up contents of your post by using the field editor or directly on the preview section. For other channel, just click the next and previous action.</div>
        <p class="pl-0 mt-5"><b>Post Title</b></p>
        <input type="text" class="inputField" placeholder="Write your post title here...">
        <p class="pl-0 mt-5"><b>Description</b></p>
        <textarea class="textArea" name="" id="" rows="30" placeholder="Write your post content here..."></textarea>
        <p class="pl-0 mt-5"><b>Category</b></p>
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
        <p class="pl-0 mt-5"><b>Post Setting</b></p>
        <div class="Row">
          <div class="Column"><Toggle :text="'Facebook'"></Toggle></div>
          <div class="Column"><Toggle :text="'Google My Business'"></Toggle></div>
          <div class="Column"><Toggle :text="'Linkedin'"></Toggle></div>
        </div>
      </div>
      <div class="column">
        <div class="col-sm-12 col-md-12 col-lg-12 d-flex justify-content-end p-0 mb-5 mt-0">
          <roundedBtn
            :onClick="saveDraft"
            :text="'Save as Draft'"
            :styles="{
              backgroundColor: '#F1B814',
              color: 'white',
            }"
          />
          <span style="margin-left: 10px"></span>
          <roundedBtn
            :onClick="publish"
            :text="'Publish'"
            :styles="{
              backgroundColor: '#01009A',
              color: 'white',
            }"
          />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import roundedBtn from 'src/modules/generic/roundedBtn'
import roundedSelectBtn from 'src/modules/generic/roundedSelectBtn'
import global from 'src/helpers/global'
import AUTH from 'src/services/auth'
import Toggle from 'src/modules/generic/toggleSwitch.vue'
import ROUTER from 'src/router'
export default {
  data() {
    return {
      user: AUTH.user,
      industry: global.industry,
      selectedIndustry: null,
      global: global,
      errorMessage: ''
    }
  },
  components: {
    roundedBtn,
    roundedSelectBtn,
    Toggle
  },
  computed: {
    returnIndustry() {
      return this.industry.map(el => {
        return el.category
      })
    }
  },
  methods: {
    publish() {
      console.log('Publish Post:::')
      ROUTER.push('dashboard')
    },
    saveDraft(){
      console.log('Draft Post:::')
      ROUTER.push('dashboard')
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
  min-height: 100vh;
}
* {
  box-sizing: border-box;
}

.column {
  float: left;
  width: 50%;
  padding: 25px;
  position: relative;
}

.row:after {
  content: "";
  display: table;
  clear: both;
}

.headerText {
  color: white;
  background-color: $warning;
  width: 100%;
  min-height: 50px;
  padding: 20px;
  border-radius: 22.5px;
  font-size: 15px;
}

.inputField {
  width: 100%;
  height: 45px;
  border: 0.25px solid $gray;
  box-sizing: border-box;
  border-radius: 5px;
  padding: 10px;
}

.textArea {
  width:100%;
  border: 0.25px solid $gray;
  box-sizing: border-box;
  border-radius: 5px;
  padding: 10px;
}

.Row {
    display: table;
    border-spacing: 10px; /*Optional*/
}
.Column {
    display: table-cell;
}


</style>
