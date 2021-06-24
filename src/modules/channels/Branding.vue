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
        <div class="col-sm-12">
          <h3 style="margin-top: 20px;font-size: 20px;">Add Branding.</h3>
          <p class="subheads">These “branding footers” will be added to the end of your social media posts.   They should be one or two short sentences and incorporate your brand name and location. </p>
          <p class="pl-0 mt-5"><b>Branding Footer 1</b></p>
          <textarea class="textArea" rows="5" placeholder="Write your branding footer content here..." v-model="brand1" @keyup="charCount()"></textarea>
          <span class="char-count">Character Count: {{count1}}</span>
          <p class="pl-0 mt-4"><b>Branding Footer 2</b></p>
          <textarea class="textArea" rows="5" placeholder="Write your branding footer content here..." v-model="brand2"></textarea>
          <span class="char-count">Character Count: {{count2}}</span>
          <p class="pl-0 mt-4"><b>Branding Footer 3</b></p>
          <textarea class="textArea" rows="5" placeholder="Write your branding footer content here..." v-model="brand3"></textarea>
          <span class="char-count">Character Count: {{count3}}</span>
          <roundedBtn
            :class="'btnn'"
            :onClick="save"
            :text="'Save'"
            :styles="{
              backgroundColor: '#01004E',
              color: 'white',
            }"
          />
        </div>
      </div>
      <div class="col-sm-5 mt-5">
        <Preview :footer="returnBranding" />
      </div>
    </div>
  </div>
</template>

<script>
import roundedBtn from 'src/modules/generic/roundedBtn'
import COLORS from 'src/assets/style/colors.js'
import ROUTER from 'src/router'
import Preview from 'src/modules/generic/preview.vue'
export default {
  data() {
    return {
      colors: COLORS,
      count1: 0,
      count2: 0,
      count3: 0,
      brand1: '',
      brand2: '',
      brand3: ''
    }
  },
  components: {
    roundedBtn,
    Preview
  },
  computed: {
    returnBranding() {
      return [this.brand1, this.brand2, this.brand3]
    }
  },
  methods: {
    connectMedia(){
      this.$router.push('/user/channels')
    },
    automationSettings(){
      this.$router.push('/user/channels/automation')
    },
    save(){
      console.log('save::::')
    },
    charCount(){
      this.count1 = this.brand1.length
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
