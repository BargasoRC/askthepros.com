<template>
  <div class="holder">
    <h3 style="margin-top: 25px;">Customize Prior To Posting Channels</h3>
    <p>Review and edit your posts prior to us sending them to your social medial channels. Then, approve once done.</p>

    <h5 class="title">Post Title</h5>
    <textarea class="form-control" placeholder="Type post description" name="post_title" id="post_title" cols="90" rows="10">
      Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.
    </textarea>

    <h5>Files:</h5>
    <div>
        <!-- <div class="row"> -->
            <div class="scrolling-wrapper d-flex" style="height: 150px">
            <div style="height:100px !important;width:100px !important; border:2px solid gray" id="imageCont">
            <!-- <div style="height:100px !important;width:100px !important; border:2px solid gray" id="imageCont" @click="addImage()" :hidden="isEditing===false"> -->
                <i class="fa fa-plus plusIcon" style="font-size:40px;padding:10px; vertical-align:middle;margin-top: 20px;margin-right:1%"></i>
                <input type="file" id="Image" accept="image/*" @change="setUpFileUpload($event)">
                <!-- <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQfTMy2AHYJpPh-4Eojkm_s5QX6_emLxwfZeg&usqp=CAU" style="width:100px;height:100px;border:2px solid black"> -->
            </div>
            <div  v-for="item in returnImageList" :key="item.id" :group="item" style="height:100px;width:100px" :class="isEditing===false ? null : 'imageContainer p-10'">
                <img :src="config.BACKEND_URL + item.url" class="image" @click="selectImage(item.url)">
                <label class="middle"  @click="deleteImage(item.id)" v-if="item.status !== 'featured'">
                <i class="fa fa-times-circle text" :hidden="isEditing===false"></i>
                </label>
                <!-- <div v-if="data.featured !== null">
                <p style="position:relative;font-weight:bold" :class="{'ImageLabel': item.url !== data.featured[0].url}"><i class="fa fa-check" style="color: #cae166"></i> Featured</p>
                </div> -->
            </div>
            <!-- </div> -->
        </div>
    </div>
  </div>
</template>

<script>
import COLORS from 'src/assets/style/colors.js'
export default {
  data() {
    return {
      colors: COLORS,
      limit: 5,
      offset: 0,
      numPages: null,
      activePage: 1
    }
  },
  components: {
  }
}
</script>

<style scoped lang="scss" scoped>
@import "~assets/style/colors.scss";
.title{
 color: $primary
}
textarea{
  padding: 2%;
  box-sizing: border-box;
  border-color: $primary;
}
</style>
