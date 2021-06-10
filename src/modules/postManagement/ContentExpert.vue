<template>
  <div class="holder">
    <div class="row">
      <div class="column">
        <div class="headerText">Hi Kennette! You can fill up contents of your post by using the field editor or directly on the preview section. For other channel, just click the next and previous action.</div>
        <p class="pl-2 mt-2"><b>Post Title</b></p>
        <input type="text" class="inputField">
        <p class="pl-2 mt-2"><b>Description</b></p>
        <textarea class="mt-2 textArea" name="" id="" cols="30" rows="30"></textarea>
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
import Input from '../../components/increment/generic/form/Input.vue'
export default {
  data() {
    return {}
  },
  components: {
    roundedBtn
  },
  methods: {
    newPost() {
      console.log('New Post:::')
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
  border: 0.25px solid #84868B;
  box-sizing: border-box;
  border-radius: 5px;
}

.textArea {
  width:100%;
  border: 0.25px solid #84868B;
  box-sizing: border-box;
  border-radius: 5px;
}
</style>
