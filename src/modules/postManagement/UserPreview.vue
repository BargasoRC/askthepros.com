<template>
  <div class="modal fade" id="selectLocationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content" style="height: 100vh">
        <div class="modal-header bg-primary">
          <h5 class="modal-title" id="exampleModalLabel"></h5>
          <button type="button" class="close" @click="hideModal()" aria-label="Close">
            <span aria-hidden="true" class="text-black">&times;</span>
          </button>
        </div>
        <div class="modal-body p-4 pl-5 pr-5">
          <preview
          ref="preview"
          :selected="selected"
          :files="returnFiles"
          :isAddd="isAdd"
          :previewBodyStyle="{
            minHeight: 'calc(100vh - 100px) !important'
          }"
          >
          </preview>
        </div>
      </div>
    </div>
  </div>
</template>
<style scoped lang="scss">
@import "~assets/style/colors.scss";
.modal.fade {
  overflow-y: hidden;
  margin-top: -4%;
  width: 40% !important; 
  // margin-left: 75%; 
  position: 'absolute';
  right: 0;
  left: 60%;
  min-height: 100vh !important;
  -webkit-transition: opacity 0.3s linear, right 0.3s ease-out;
  -moz-transition: opacity 0.3s linear, right 0.3s ease-out;
  -o-transition: opacity 0.3s linear, right 0.3s ease-out;
  transition: opacity 0.3s linear, right 0.3s ease-out;
}
.bg-primary{
  background: white !important;
}
.modal-body{
  background: white !important;
  margin-top: -1%;
}
.modal.content{
  overflow-y: hidden;
  height: 100vh !important;
}
</style>
<script>
import AUTH from 'src/services/auth'
import CONFIG from 'src/config.js'
import preview from 'src/modules/generic/preview.vue'
export default {
  props: ['selected', 'files'],
  mounted(){
  },
  data(){
    return {
      user: AUTH.user,
      config: CONFIG,
      errorMessage: null,
      parameter: null
    }
  },
  computed: {
    returnFiles() {
      return this.files
    }
  },
  components: {
    preview
  },
  methods: {
    show(){
      $('#selectLocationModal').modal('show')
    },
    hideModal(){
      $('#selectLocationModal').modal('hide')
    }
  }
}
</script>
