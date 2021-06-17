<template>
  <div class="holder" >
    <div style="border-bottom: 1px solid #aaa; 
              padding-bottom: 2%">
    <h3 style="">Profile</h3>
            </div>
    <div class="">
      <div class="my-form row my-row">
        <div class=" col-9 input-form"  >
          <div class="">
            <p>First Name</p>
              <roundedInput 
                      :type="'text'"
                      :placeholder="''"
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
                  :placeholder="''"
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
                  :placeholder="''"
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
                  :placeholder="''"
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
                  :placeholder="''"
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
                  :placeholder="''"
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
                  :placeholder="''"
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
                  :placeholder="''"
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
                  :placeholder="''"
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
                  :placeholder="''"
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
        <div class=" col-3 profile-pic" style="float=right; margin-top: 1%;">
          <div style="float: left;">
            <h3>Profile picture</h3>
            <div class=" my-icon">
              <i class="fa fa-user-circle-o fa-5x" aria-hidden="true"></i>
            </div>
            <dialogueBtn 
                  :onClick="login"
                  :icon="'fas fa-sign-in-alt'"
                  :text="'Change Profile Picture'"
                  :styles="{
                    backgroundColor: '#063970',
                    color: 'white'
                  }"
                  style="margin-top: 5%"
                />
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
          <p>New Password</p>
          <roundedInput 
                    :type="'text'"
                    :placeholder="'(Leave blank if unchanged)'"
                    :class="!this.isValid && username == '' ? 'mb-0 ' : ' LoginField'"
                    :styles="{
                      border: !this.isValid && username == '' ? '1px solid red !important' : 'none',
                    }"
                    v-model="username"
                    class="input-style"
                  />
              <br>
          <p>Confirm New Password</p>
          <roundedInput 
                    :type="'text'"
                    :placeholder="'(Leave blank if unchanged)'"
                    :class="!this.isValid && username == '' ? 'mb-0 ' : ' LoginField'"
                    :styles="{
                      border: !this.isValid && username == '' ? '1px solid red !important' : 'none',
                    }"
                    v-model="username"
                    class="input-style "
                  />
        <br>
      </div>
    </div>

    <dialogueBtn 
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
  background-color: none;
  float: center;
  margin-top: -5%;
}

.profile-pic h3{
  font-weight: bold; 
  margin-right: 4%; 
  font-size: 19px;
}

.my-icon{
  margin-top: 2%;
  background-color: none;
  color: blue;
  float: center;
  height: 220px;
  width: 210px;
  size: 80px 80px;
  text-align: center;
  padding: 5%;
  padding-top: 30px;
  margin-top: 10%;
  margin-bottom: 5px;
}


</style>
<script>
import dialogueBtn from 'src/modules/generic/dialogueBtn'
import roundedInput from 'src/modules/generic/roundedInput'
import roundedBtn from 'src/modules/generic/roundedBtn'
import COLORS from 'src/assets/style/colors.js'
import ROUTER from 'src/router'
export default {
  data() {
    return {
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
    }
  }
}
</script>
