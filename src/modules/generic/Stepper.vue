<template>
  <div class="stepper-container">
    <div class="content-holder">
      <div class="header">
        <b>{{title}}</b>
      </div>
      
      <div class="error" v-if="errorMessage !== null">
        <p class="text-danger"><b>Opps!</b> {{errorMessage}}</p>
      </div>
      
      <div class="body" v-if="active === 0">
        <roundedInput
          :type="'text'"
          :placeholder="'First Name'"
          :class="'mb-0'"
          :styles="{
            border:'1px solid grey !important'
          }"
          v-model="firstName"
        />

       <roundedInput
          :type="'text'"
          :placeholder="'Last Name'"
          :class="'mb-0'"
          :styles="{
            border:'1px solid grey !important',
            marginTop: '25px'
          }"
          v-model="lastName"
        />
      </div>



      <div class="body" v-if="active === 1">
        <roundedInput
          :type="'text'"
          :placeholder="'Business Name'"
          :class="'mb-0'"
          :styles="{
            border:'1px solid grey !important'
          }"
          v-model="businessName"
        />

       <roundedInput
          :type="'text'"
          :placeholder="'Business Address'"
          :class="'mb-0'"
          :styles="{
            border:'1px solid grey !important',
            marginTop: '25px'
          }"
          v-model="businessAddress"
        />
      </div>

      <div class="footer">
        <dialogueBtn
          :onClick="this.managePrevious"
          :icon="'fas fa-chevron-left'"
          :text="'Previous'"
          :icon_position="'right'"
          :styles="{
            backgroundColor: colors.danger,
            color: 'white'
          }"
        />
        <dialogueBtn
          :onClick="this.manageNext"
          :icon="'fas fa-chevron-right'"
          :text="'Next'"
          :icon_position="'right'"
          :styles="{
            backgroundColor: colors.primary,
            color: 'white'
          }"
        />
        
      </div>
    </div>
    
  </div>
</template>
<script>
import roundedInput from 'src/modules/generic/roundedInput'
import dialogueBtn from 'src/modules/generic/dialogueBtn'
import COLORS from 'src/assets/style/colors.js'
export default {
  data() {
    return{
      colors: COLORS,
      active: 0,
      title: 'Personal Information',
      firstName: null,
      lastName: null,
      errorMessage: null,
      businessName: null,
      businessAddress: null
    }
  },
  props: [],
  components: {
    roundedInput,
    dialogueBtn
  },
  methods: {
    manageContent(){
      switch(this.active){
        case 0: {
          this.title = 'Personal Information'
          break
        }
        case 1: {
          this.title = 'Business Details'
          break
        }
      }
    },
    validation(){
      this.errorMessage = null
      switch(this.active){
        case 0: {
          if(this.firstName != null && this.lastName !== null){
            return true
          }else{
            this.errorMessage = 'All fields are required.'
            return false
          }
        }
        case 1: {
          if(this.businessName != null && this.businessAddress !== null){
            return true
          }else{
            this.errorMessage = 'All fields are required.'
            return false
          }
        }
      }
    },
    manageNext(){
      if(this.validation()){
        this.errorMessage = null
        this.active++
        this.manageContent()
      }
    },
    managePrevious(){
      if(this.active > 0){
        this.active--
      }
      this.manageContent()
    }
  }
}
</script>
<style scoped lang="scss">
.stepper-container{
  width: 100%;
  float: left;
  min-height: 100vh;
  overflow-y: hidden;
  display: flex;
  justify-content: center;
  align-items: center;
  background-color: 'red';
}

.content-holder{
  width: 30%;
  float: left;
}
.header, .footer, .body, .error{
  width: 100%;
  float: left;
}

.body{
  margin-top: 25px;
  margin-bottom: 25px;
}
</style>
