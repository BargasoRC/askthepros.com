<template>
  <div class="holder">
    <h3 style="margin-top: 25px;">Customize Prior To Posting Channels</h3>
    <p>Review and edit your posts prior to us sending them to your social medial channels. Then, approve once done.</p>

    <h5 class="title">Post Title</h5>
    <textarea class="form-control" placeholder="Type post description" name="post_title" id="post_title" cols="90" rows="10">
      Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.
    </textarea>
    <br>

    <h5>Files:</h5>
    <Images></Images>
    <br>
    <br>

    <h5>Post To:</h5>
    <br>
    <Toggle :text="'Google My Business'"></Toggle>
    <br>
    <Toggle :text="'Facebook'"></Toggle>
    <br>
    <Toggle :text="'LinkedIn'"></Toggle>
    <br>
    <br>
    <span style="float: right" class="preview"><u><b>Preview</b></u></span>
    <roundedBtn
      :text="'Post'"
      class="button1"
      :styles="{
        backgroundColor: colors.primary,
        color: 'white',
        width: '10%',
        marginBottom: '5%'
      }"
    />
    <br>
  </div>
</template>

<script>
import roundedBtn from 'src/modules/generic/roundedBtn'
import Images from 'src/modules/generic/previewImage.vue'
import Toggle from 'src/modules/generic/toggleSwitch.vue'
import COLORS from 'src/assets/style/colors.js'
import CONFIG from 'src/config.js'
export default {
  mounted(){
  },
  data() {
    return {
      colors: COLORS,
      config: CONFIG,
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
    roundedBtn
  },
  methods: {
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
