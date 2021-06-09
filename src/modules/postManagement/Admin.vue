<template>
  <div>
    <div class="col-sm-12 col-md-12 col-lg-12 d-flex justify-content-end">
      <roundedBtn 
        :onClick="newPost"
        :icon="'fas fa-plus'"
        :text="'New Post'"
        :icon_position="'right'"
        :styles="{
          backgroundColor: '#01009A',
          color: 'white'
        }"
      />
    </div>
    <div>
    </div>
    <div>
    </div>
  </div>
</template>

<script>
import roundedBtn from 'src/modules/generic/roundedBtn'
export default {
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

<style>

</style>
