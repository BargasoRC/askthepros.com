<template>
    <div class="container">
        <div class="row flex-column-reverse flex-md-row">
            <div class="col-sm-8 col-sm-pull-4"></div>
            <div class="my-title">
                <h3 style="">Profile</h3>
                </div>
                <div class="my-form row my-row">
                <div class=" col-sm-12 input-form">
                    <div class="row">
                    <div class="col-md-6">
                        <p>First Name</p>
                        <roundedInput :type="'text'" :placeholder="'Enter your first name here'"
                        :class="!isValidProfile && !firstname ? 'mb-0 ' : ' SettingsField'" :styles="{
                                border: !isValidProfile && !firstname ? '1px solid red !important' : 'none',
                            }" v-model="firstname" class="input-style" />

                    </div>
                    <div class="col-md-6">
                        <p>Last Name</p>
                        <roundedInput :type="'text'" :placeholder="'Enter your last name here'"
                        :class="!isValidProfile && !lastname ? 'mb-0 ' : ' SettingsField'" :styles="{
                            border: !isValidProfile && !lastname ? '1px solid red !important' : 'none',
                            }" v-model="lastname" class="input-style" />

                    </div>

                    </div>
                    <div class="row">
                    <div class="col-md-6">
                        <p>Business Name</p>
                        <roundedInput :type="'text'" :placeholder="'Enter your business name here'"
                        :class="!isValidProfile && !businessname ? 'mb-0 ' : ' SettingsField'" :styles="{
                            border: !isValidProfile && !businessname ? '1px solid red !important' : 'none',
                        }" v-model="businessname" class="input-style" />

                    </div>
                    <div class="col-md-6">
                        <p>Contact Number</p>
                        <roundedInput :type="'text'" :placeholder="'Enter your contact number here'"
                        :class="!isValidProfile && !contactnumber ? 'mb-0 ' : ' SettingsField'" :styles="{
                            border: !isValidProfile && !contactnumber ? '1px solid red !important' : 'none',
                        }" v-model="contactnumber" class="input-style" />

                    </div>
                    </div>

                </div>
                </div>
        </div>
    </div>
</template>
<script>
import dialogueBtn from 'src/modules/generic/dialogueBtn'
import roundedInput from 'src/modules/generic/roundedInput'
import roundedBtn from 'src/modules/generic/roundedBtn'
import COLORS from 'src/assets/style/colors.js'
import AUTH from 'src/services/auth'
import CONFIG from 'src/config.js'
import axios from 'axios'
import $ from 'jquery'
import global from 'src/helpers/global'
import ROUTER from 'src/router'
export default {
  data() {
    return {
    }
  },
  components: {
    dialogueBtn,
    roundedInput,
    roundedBtn
  }
}
</script>
<style scoped lang="scss" scoped>
@import "~assets/style/colors.scss";
.invalidEmail {
  color: $danger;
  font-size: 10px;
  margin-left: 20px;
  margin-bottom: 25px !important;
}
.roudedInput {
  outline: none !important;
  box-shadow: none !important;
  height: 45px !important;
  border-radius: 40px !important;
  border: 1px solid $gray !important;
}
#Image{
  display: none;
  height: 200px;
  width: 200px;
}
.SettingsField {
  margin-bottom: 35px;
}
.holder{
  width: 96%;
  margin-left: 2%;
  margin-right: 2%;
  float: left;
}

.hidden-button{
  background: blue;
}

.my-title{
  border-bottom: solid 1px black;
  max-width: 100%;
}

h3{
  margin-top: 25px;
  font-weight: bold;
  font-size: 21px;
  padding-bottom: 1%;
}

.my-form{
  padding-left: 3%;
  padding-top: 3%;
  margin-left: -3%;
}

.input-form{
  background-color: none;
  margin-left: 0%;
}

.input-style{
  padding-left: 3%;
  background-color: none;
  max-width: 78%;
  border: 1px solid black;
}

.input-style ::-moz-placeholder{
  font-style: italic;
}

.profile-pic{
  float: center;
}

.profile-pic h3{
  font-weight: bold; 
  margin-right: 4%; 
  font-size: 19px;
}

.my-icon{
  background-color: none;
  color: $primary;
  float: left;
  max-height: 14.375rem;
  max-width: 12.5rem;
  text-align: center;
  font-size: 170px;
  margin-top: -15%;
}

.field-icon {
  float: right;
  margin-top: -58px;
  margin-right: 24%;
  position: relative;
  z-index: 2;
}
.error-field-icon {
  float: right;
  margin-top: -28px;
  margin-right: 24%;
  position: relative;
  z-index: 2;
}

.requiredFieldError {
  color: $danger;
  font-size: 10px;
  margin-left: 20px;
  margin-bottom: 25px !important;
}
/*
@media (max-width: 768px){
  .profile-pic{
    margin-left: -16%;
  }
}
*/

</style>
