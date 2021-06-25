<template>
  <div class="holder" >
    <div class="my-title">
    <h3 style="">Profile</h3>
            </div>
    <div class="">
      <div class="my-form row my-row">
        <div class=" col-md-9 input-form"  >
          <div class="row">
            <div class="col-md-6">
              <p>First Name</p>
              <roundedInput 
                      :type="'text'"
                      :placeholder="'Enter your first name here'"
                      :class="!this.isValid && username == '' ? 'mb-0 ' : ' LoginField'"
                      :styles="{
                        border: !this.isValid && username == '' ? '1px solid red !important' : 'none',
                      }"
                      v-model="firstname"
                      class="input-style"
                    />
              <br>
            </div>
            <div class="col-md-6" >
              <p>Last Name</p>
              <roundedInput 
                    :type="'text'"
                    :placeholder="'Enter your last name here'"
                    :class="!this.isValid && username == '' ? 'mb-0 ' : ' LoginField'"
                    :styles="{
                      border: !this.isValid && username == '' ? '1px solid red !important' : 'none',
                    }"
                    v-model="lastname"
                    class="input-style"
                  />
              <br> 
            </div> 
            
          </div>
          <div class="row">
            <div class="col-md-6">
            <p>Business Name</p>
            <roundedInput 
                  :type="'text'"
                  :placeholder="'Enter your business name here'"
                  :class="!this.isValid && username == '' ? 'mb-0 ' : ' LoginField'"
                  :styles="{
                    border: !this.isValid && username == '' ? '1px solid red !important' : 'none',
                  }"
                  v-model="businessname"
                  class="input-style"
                />
              <br>
          </div>
          <div class="col-md-6">
            <p>Contact Number</p>
            <roundedInput 
                  :type="'text'"
                  :placeholder="'Enter your contact number here'"
                  :class="!this.isValid && username == '' ? 'mb-0 ' : ' LoginField'"
                  :styles="{
                    border: !this.isValid && username == '' ? '1px solid red !important' : 'none',
                  }"
                  v-model="contactnumber"
                  class="input-style"
                />   
              <br>
            </div>
          </div>

          </div>    
        <div class=" col-md-3 profile-pic" style="float=right; margin-top: 1%;">
          <div style="float: left;">
            <h3>Profile picture</h3>
            <div class=" my-icon">
              <i class="fas fa-user-circle" aria-hidden="true" style=""></i>
            </div>
            <div>
             
              <span @click="addImage()">
                <roundedBtn
                  :icon="'fas fa-sign-in-alt'"
                  :text="'Change Profile Picture'"
                  :styles="{
                    backgroundColor: '#063970',
                    color: 'white',
                  }"
                  v-model="imgupload"
                  style="margin-top: 15%;"
                />
                     <input ref="image" type="file" accept="images/*" @change="setUpFileUpload($event)" id="newImage">
              </span>
              
            </div>  
          </div>
        </div>
      </div>
    </div>
  <div class="my-title"><h3>Address</h3></div>
    <br>
        <div class="row">
          <div class="col-md-9">
            <div class="row"> 
              <div class="col-md-6">
                <p>Route</p>
                <roundedInput 
                        :type="'text'"
                        :placeholder="'Enter your route here'"
                        :class="!this.isValid && username == '' ? 'mb-0 ' : ' LoginField'"
                        :styles="{
                          border: !this.isValid && username == '' ? '1px solid red !important' : 'none',
                        }"
                        v-model="route"
                        class="input-style"
                      />
                      <br>
              </div>
              <br>
              <div class="col-md-6" >
                <p>City</p>
                <roundedInput 
                      :type="'text'"
                      :placeholder="'Enter your city here'"
                      :class="!this.isValid && username == '' ? 'mb-0 ' : ' LoginField'"
                      :styles="{
                        border: !this.isValid && username == '' ? '1px solid red !important' : 'none',
                      }"
                      v-model="city"
                      class="input-style"
                    />
                    <br> 
              </div>
            </div>
            <div class="row">
              <div class=" col-md-6">
                <p>Region</p>
                <roundedInput 
                        :type="'text'"
                        :placeholder="'Enter your region here'"
                        :class="!this.isValid && username == '' ? 'mb-0 ' : ' LoginField'"
                        :styles="{
                          border: !this.isValid && username == '' ? '1px solid red !important' : 'none',
                        }"
                        v-model="region"
                        class="input-style"
                      />
                <br>
              </div>
              <div class="col-md-6" >
                <p>Country</p>
                <roundedInput 
                      :type="'text'"
                      :placeholder="'Enter your country here'"
                      :class="!this.isValid && username == '' ? 'mb-0 ' : ' LoginField'"
                      :styles="{
                        border: !this.isValid && username == '' ? '1px solid red !important' : 'none',
                      }"
                      v-model="country"
                      class="input-style"
                    />
                <br> 
            </div> 
            
            </div>
            <div class="row">
              <div class="col-md-6">
                <p>Postal/Zip Code</p>
                <roundedInput 
                        :type="'text'"
                        :placeholder="'Enter your postal/zip code here'"
                        :class="!this.isValid && username == '' ? 'mb-0 ' : ' LoginField'"
                        :styles="{
                          border: !this.isValid && username == '' ? '1px solid red !important' : 'none',
                        }"
                        v-model="postal_zip_code"
                        class="input-style"
                      />
                      <br>
              </div>
            </div>
          </div>
        </div>

    <div class="my-title"><h3>Account</h3></div>
    <br>
    <div class="">
      <div class="row">
        <div class="col-md-9">
          <div class="row">
            <div class="col-md-6">
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
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
                <p>Email Address</p>
                <roundedInput 
                          :type="'text'"
                          :placeholder="'example@email.domain'"
                          :class="!this.isValid && username == '' ? 'mb-0 ' : ' LoginField'"
                          :styles="{
                            border: !this.isValid && username == '' ? '1px solid red !important' : 'none',
                          }"
                          v-model="email"
                          class="input-style"
                          style="background-color: lightgrey;"
                        />
                  <br>  
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="my-title"><h3>Change Your Password</h3></div>
    <br>
    <div class="row">
      <div class="col-md-9">
        <div class="row" >
          <div class="col-md-6">
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
        </div>
        <div class="row">
          <div class="col-md-6">
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
        </div>
      </div>      
    </div>

    <roundedBtn 
      :onClick="update_account"
      :icon="'fas fa-sign-in-alt'"
      :text="'Update'"
      :styles="{
        backgroundColor: '#063970',
        color: 'white'
      }"
      style="margin-bottom: 5%; margin-top: 5%;"
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

.hidden-button{
  background: blue;
}

.my-title{
  border-bottom: solid 1px black;
  max-width: 74%;
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
import AUTH from 'src/services/auth'
import CONFIG from 'src/config.js'
import axios from 'axios'
import $ from 'jquery'
import ROUTER from 'src/router'
export default {
  data() {
    return {
      eyeToggle: false,
      colors: COLORS,
      firstname: '',
      middlename: '',
      lastname: '',
      businessname: '',
      contactnumber: '',
      user: AUTH.user,
      config: CONFIG,
      errorMessage: null,
      data: null,
      file: null,
      copiedIndex: null,
      address: [{
        route: '',
        city: '',
        region: '',
        country: '',
        postal_zip_code: ''
      }],
      username: '',
      email: '',
      isValid: true
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
    update_account(event){
      let condition = {
        condition: [
          {
            value: this.user.userID,
            clause: '=',
            column: 'account_id'
          }
        ],
        offset: 0,
        limit: 1
      }
      $('#loading').css({'display': 'block'})
      this.APIRequest('account_informations/retrieve', condition).then(response => {
        $('#loading').css({'display': 'none'})
        let parameter = {
          id: response.data[0].id,
          account_id: this.user.userID,
          first_name: this.firstname,
          middle_name: this.middlename,
          last_name: this.lastname,
          cellular_number: this.contactnumber,
          address: {
            'route': this.route,
            'city': this.city,
            'region': this.region,
            'country': this.country,
            'zipcode': this.postal_zip_code
          }
        }
        $('#loading').css({'display': 'block'})
        this.APIRequest('account_informations/update', parameter).then(response => {
          $('#loading').css({'display': 'none'})
          console.log('RESPONSE: ', response)
          if(!response.error) {
            console.log('UPDATE RESPONSE: ', response)
          }
        })
        $('#loading').css({'display': 'block'})
        this.APIRequest('account/update', parameter).then(response => {
          $('#loading').css({'display': 'none'})
          console.log('RESPONSE: ', response)
          console.log(parameter)
          if(!response.error) {
            console.log('UPDATE RESPONSE: ', response)
          }
        })
      })
    },
    addImage(){
      $('#image')[0].click()
      alert('here')
    },
    setUpFileUpload(event){
      let files = event.target.files || event.dataTransfer.files
      if(!files.length){
        return false
      }else{
        this.file = files[0]
        this.createFile(files[0])
      }
    },
    createFile(file){
      let fileReader = new FileReader()
      fileReader.readAsDataURL(event.target.files[0])
      this.upload()
    },
    upload(){
      let formData = new FormData()
      formData.append('file', this.file)
      formData.append('file_url', this.file.name)
      formData.append('account_id', this.user.userID)
      $('#loading').css({'display': 'block'})
      axios.post(this.config.BACKEND_URL + '/images/upload?token=' + AUTH.tokenData.token, formData).then(response => {
        $('#loading').css({'display': 'none'})
        if(response.data.data !== null){
          this.search()
        }
      })
    }
  }
}

</script>
