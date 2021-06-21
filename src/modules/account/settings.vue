<template>
  <div class="holder" >
    <div style="border-bottom: 1px solid #aaa; 
              padding-bottom: 2%">
    <h3 style="">Profile</h3>
            </div>
    <div class="">
      <div class="my-form row my-row">
        <div class=" col-md-9 input-form"  >
          <div class="">
            <p>First Name</p>
              <roundedInput 
                      :type="'text'"
                      :placeholder="'Enter your first name here'"
                      :class="!this.isValid && username == '' ? 'mb-0 ' : ' LoginField'"
                      :styles="{
                        border: !this.isValid && username == '' ? '1px solid red !important' : 'none',
                      }"
                      v-model="username"
                      class="input-style"
                    />
              <br>
          </div>
          <div class="">
            <p>Last Name</p>
            <roundedInput 
                  :type="'text'"
                  :placeholder="'Enter your last name here'"
                  :class="!this.isValid && username == '' ? 'mb-0 ' : ' LoginField'"
                  :styles="{
                    border: !this.isValid && username == '' ? '1px solid red !important' : 'none',
                  }"
                  v-model="username"
                  class="input-style"
                />
              <br> 
            </div>   
          <div class="">
            <p>Business Name</p>
            <roundedInput 
                  :type="'text'"
                  :placeholder="'Enter your business name here'"
                  :class="!this.isValid && username == '' ? 'mb-0 ' : ' LoginField'"
                  :styles="{
                    border: !this.isValid && username == '' ? '1px solid red !important' : 'none',
                  }"
                  v-model="username"
                  class="input-style"
                />
              <br>
          </div>
          <div class="">
            <p>Contact Number</p>
            <roundedInput 
                  :type="'text'"
                  :placeholder="'Enter your contact number here'"
                  :class="!this.isValid && username == '' ? 'mb-0 ' : ' LoginField'"
                  :styles="{
                    border: !this.isValid && username == '' ? '1px solid red !important' : 'none',
                  }"
                  v-model="username"
                  class="input-style"
                />   
              <br>
            </div>
            <div class="">
            <p>Address</p>
            <roundedInput 
                  :type="'text'"
                  :placeholder="'Enter your address details here'"
                  :class="!this.isValid && username == '' ? 'mb-0 ' : ' LoginField'"
                  :styles="{
                    border: !this.isValid && username == '' ? '1px solid red !important' : 'none',
                  }"
                  v-model="username"
                  class="input-style"
                />   
              <br>
            </div>
            <div class="">
            <p>Route</p>
            <roundedInput 
                  :type="'text'"
                  :placeholder="'Enter route'"
                  :class="!this.isValid && username == '' ? 'mb-0 ' : ' LoginField'"
                  :styles="{
                    border: !this.isValid && username == '' ? '1px solid red !important' : 'none',
                  }"
                  v-model="username"
                  class="input-style"
                />   
              <br>
            </div>
            <div class="">
            <p>Locality</p>
            <roundedInput 
                  :type="'text'"
                  :placeholder="'Enter locality'"
                  :class="!this.isValid && username == '' ? 'mb-0 ' : ' LoginField'"
                  :styles="{
                    border: !this.isValid && username == '' ? '1px solid red !important' : 'none',
                  }"
                  v-model="username"
                  class="input-style"
                />   
              <br>
            </div>
            <div class="">
            <p>Region</p>
            <roundedInput 
                  :type="'text'"
                  :placeholder="'Enter region'"
                  :class="!this.isValid && username == '' ? 'mb-0 ' : ' LoginField'"
                  :styles="{
                    border: !this.isValid && username == '' ? '1px solid red !important' : 'none',
                  }"
                  v-model="username"
                  class="input-style"
                />   
              <br>
            </div>
            <div class="">
            <p>Country</p>
            <roundedInput 
                  :type="'text'"
                  :placeholder="'Enter country'"
                  :class="!this.isValid && username == '' ? 'mb-0 ' : ' LoginField'"
                  :styles="{
                    border: !this.isValid && username == '' ? '1px solid red !important' : 'none',
                  }"
                  v-model="username"
                  class="input-style"
                />   
              <br>
            </div>
            <div class="">
            <p>Postal/Zip Code</p>
            <roundedInput 
                  :type="'text'"
                  :placeholder="'Enter postal/zip code info'"
                  :class="!this.isValid && username == '' ? 'mb-0 ' : ' LoginField'"
                  :styles="{
                    border: !this.isValid && username == '' ? '1px solid red !important' : 'none',
                  }"
                  v-model="username"
                  class="input-style"
                />   
              <br>
            </div>

          </div>    
        <div class=" col-md-3 profile-pic" style="float=right; margin-top: 1%;">
          <div style="float: left;">
            <h3>Profile picture</h3>
            <div class=" my-icon">
              <i class="fas fa-user-circle" aria-hidden="true" style=""></i>
            </div>
            <div>
              <roundedBtn 
                  :onClick="login"
                  :icon="'fas fa-sign-in-alt'"
                  :text="'Change Profile Picture'"
                  :styles="{
                    backgroundColor: '#063970',
                    color: 'white',
                  }"
                  style="margin-top: 15%;"
                />
            </div>
          </div>
        </div>
      </div>
    </div>

    <h3 style="border-bottom: 1px solid #aaa; 
              padding-bottom: 2%;">Account</h3>
    
    <div class="my-form">
      <div class="input-form col-9">
          <p>Username</p>
          <roundedInput 
                    :type="'text'"
                    :placeholder="'Username'"
                    :class="!this.isValid && username == '' ? 'mb-0 ' : ' LoginField'"
                    :styles="{
                      border: !this.isValid && username == '' ? '1px solid red !important' : 'none',
                    }"
                    v-model="username"
                    class="input-style"
                    style="background-color: lightgrey;"
                  />
              <br>
          <p>Email Address</p>
          <roundedInput 
                    :type="'text'"
                    :placeholder="'example@email.domain'"
                    :class="!this.isValid && username == '' ? 'mb-0 ' : ' LoginField'"
                    :styles="{
                      border: !this.isValid && username == '' ? '1px solid red !important' : 'none',
                    }"
                    v-model="username"
                    class="input-style"
                    style="background-color: lightgrey;"
                  />
              <br>   
      </div>
    </div>

    <h3 style="border-bottom: 1px solid #aaa; 
              padding-bottom: 2%;">Change your Password</h3>

    <div class="my-form">
      <div class="input-form col-9" >
          <div>
            <p>New Password</p>
              <roundedInput 
                        :type="'password'"
                        :placeholder="'(Leave blank if unchanged)'"
                        :class="!this.isValid && username == '' ? 'mb-0 ' : ' LoginField'"
                        :styles="{
                          border: !this.isValid && username == '' ? '1px solid red !important' : 'none',
                        }"
                        v-model="username"
                        class="input-style"
                        id="password-field"
                      />
                      <span class="fa fa-fw fa-eye field-icon"></span>
                  <br>
          </div>

          <div>
            <p>Confirm New Password</p>
            <roundedInput 
                    :type="'password'"
                    :placeholder="'(Leave blank if unchanged)'"
                    :class="!this.isValid && username == '' ? 'mb-0 ' : ' LoginField' "
                    :styles="{
                      border: !this.isValid && username == '' ? '1px solid red !important' : 'none',
                    }"
                    v-model="username"
                    class="input-style"
                    id="toggle-field"
                  />
                  <div>
                    <span class="fa fa-fw fa-eye field-icon" onclick="showPassword()"></span>
                  </div>
          </div>
        <br>
      </div>
    </div>

    <roundedBtn 
                  :onClick="login"
                  :icon="'fas fa-sign-in-alt'"
                  :text="'Update'"
                  :styles="{
                    backgroundColor: '#063970',
                    color: 'white'
                  }"
                  style="margin-bottom: 5%;"
                />
    
  </div>
</template>
<style scoped lang="scss" scoped>
@import "~assets/style/colors.scss";
.holder{
  width: 96%;
  margin-left: 2%;
  margin-right: 2%;
  float: left;
}

h3{
  margin-top: 25px;
  font-weight: bold;
  font-size: 21px;
  
}

.my-form{
  padding: 3%;
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
  margin-top: -29px;
  margin-right: 24%;
  position: relative;
  z-index: 2;
}
/*
@media (max-width: 768px){
  .profile-pic{
    margin-left: -16%;
  }
}
*/

</style>
<script>
import dialogueBtn from 'src/modules/generic/dialogueBtn'
import roundedInput from 'src/modules/generic/roundedInput'
import roundedBtn from 'src/modules/generic/roundedBtn'
import COLORS from 'src/assets/style/colors.js'
import $ from 'jquery'
import ROUTER from 'src/router'
export default {
  data() {
    return {
      eyeToggle: false,
      colors: COLORS
    }
  },
  components: {
    dialogueBtn,
    roundedInput,
    roundedBtn
  },
  methods: {
    connect(item){
      // ROUTER.push('/' + item.payload)
    },
    showPassword(){
      this.eyeToggle = !this.eyeToggle
    }
  }
}

</script>
