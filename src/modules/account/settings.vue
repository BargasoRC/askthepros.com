<template>
  <div class="container-fluid">
    <div class="row flex-column-reverse flex-md-row">
      <div class="col-sm-8 col-sm-pull-4">
    <div class="my-title">
      <h3 style="">Profile</h3>
    </div>
    <div class="my-form row my-row">
      <div class=" col-sm-12 input-form">
        <div class="row">
          <div class="col-md-6">
            <p>First Name</p>
            <roundedInput :type="'text'" :placeholder="'Enter your first name here'"
              :class="!this.isValidProfile && firstname == '' ? 'mb-0 ' : ' SettingsField'" :styles="{
                        border: !this.isValidProfile && firstname == '' ? '1px solid red !important' : 'none',
                      }" v-model="firstname" class="input-style" />
            
          </div>
          <div class="col-md-6">
            <p>Last Name</p>
            <roundedInput :type="'text'" :placeholder="'Enter your last name here'"
              :class="!this.isValidProfile && lastname == '' ? 'mb-0 ' : ' SettingsField'" :styles="{
                      border: !this.isValidProfile && lastname == '' ? '1px solid red !important' : 'none',
                    }" v-model="lastname" class="input-style" />
            
          </div>

        </div>
        <div class="row">
          <div class="col-md-6">
            <p>Business Name</p>
            <roundedInput :type="'text'" :placeholder="'Enter your business name here'"
              :class="!this.isValidProfile && businessname == '' ? 'mb-0 ' : ' SettingsField'" :styles="{
                    border: !this.isValidProfile && businessname == '' ? '1px solid red !important' : 'none',
                  }" v-model="businessname" class="input-style" />
            
          </div>
          <div class="col-md-6">
            <p>Contact Number</p>
            <roundedInput :type="'text'" :placeholder="'Enter your contact number here'"
              :class="!this.isValidProfile && contactnumber == '' ? 'mb-0 ' : ' SettingsField'" :styles="{
                    border: !this.isValidProfile && contactnumber == '' ? '1px solid red !important' : 'none',
                  }" v-model="contactnumber" class="input-style" />
            
          </div>
        </div>

      </div>
    </div>
    <div class="my-title mb-5">
      <h3>Address</h3>
    </div>
    
    <div class="row">
      <div class="col-sm-12">
        <div class="row">
          <div class="col-md-6">
            <p>Route</p>
            <roundedInput :type="'text'" :placeholder="'Enter your route here'"
              :class="!this.isValidAddress && username == '' ? 'mb-0 ' : ' SettingsField'" :styles="{
                            border: !this.isValidAddress && username == '' ? '1px solid red !important' : 'none',
                          }" v-model="route" class="input-style" />
            
          </div>
          
          <div class="col-md-6">
            <p>City</p>
            <roundedInput :type="'text'" :placeholder="'Enter your city here'"
              :class="!this.isValidAddress && username == '' ? 'mb-0 ' : ' SettingsField'" :styles="{
                          border: !this.isValidAddress && username == '' ? '1px solid red !important' : 'none',
                        }" v-model="city" class="input-style" />
            
          </div>
        </div>
        <div class="row">
          <div class=" col-md-6">
            <p>Region</p>
            <roundedInput :type="'text'" :placeholder="'Enter your region here'"
              :class="!this.isValidAddress && username == '' ? 'mb-0 ' : ' SettingsField'" :styles="{
                            border: !this.isValidAddress && username == '' ? '1px solid red !important' : 'none',
                          }" v-model="region" class="input-style" />
            
          </div>
          <div class="col-md-6">
            <p>Country</p>
            <roundedInput :type="'text'" :placeholder="'Enter your country here'"
              :class="!this.isValidAddress && username == '' ? 'mb-0 ' : ' SettingsField'" :styles="{
                          border: !this.isValidAddress && username == '' ? '1px solid red !important' : 'none',
                        }" v-model="country" class="input-style" />
            
          </div>

        </div>
        <div class="row">
          <div class="col-md-6">
            <p>Postal/Zip Code</p>
            <roundedInput :type="'text'" :placeholder="'Enter your postal/zip code here'"
              :class="!this.isValidAddress && username == '' ? 'mb-0 ' : ' SettingsField'" :styles="{
                            border: !this.isValidAddress && username == '' ? '1px solid red !important' : 'none',
                          }" v-model="postalZipCode" class="input-style" />
            
          </div>
        </div>
      </div>
    </div>

    <div class="my-title mb-5">
      <h3>Account</h3>
    </div>
    
    <div class="">
      <div class="row">
        <div class="col-sm-12">
          <div class="row">
            <div class="col-md-6">
              <p>Username</p>
              <roundedInput :type="'text'" :placeholder="'Username'"
                :class="!this.isValidAccount && username == '' ? 'mb-0 ' : ' SettingsField'" :styles="{
                            border: !this.isValidAccount && username == '' ? '1px solid red !important' : 'none',
                          }" v-model="username" class="input-style" style="background-color: lightgrey;" disabled="1"/>
              
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <p>Email Address</p>
              <roundedInput :type="'text'" :placeholder="'example@email.domain'"
                :class="!this.isValidAccount && username == '' ? 'mb-0 ' : ' SettingsField'" :styles="{
                              border: !this.isValidAccount && username == '' ? '1px solid red !important' : 'none',
                            }" v-model="email" class="input-style" style="background-color: lightgrey;" />
              
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="my-title mb-5">
      <h3>Change Your Password</h3>
    </div>
    
    <div class="row">
      <div class="col-sm-12">
        <div class="row">
          <div class="col-md-6 mb-5">
            <p>New Password</p>
            <roundedInput :type="isShowingPassword ? 'text' : 'password'" :placeholder="'(Leave blank if unchanged)'"
              :class="!this.isValidPassword && username == '' ? 'mb-0 ' : ' SettingsField'" :styles="{
                            border: !this.isValidPassword && username == '' ? '1px solid red !important' : 'none',
                          }" v-model="password" class="input-style" id="password-field" :isDisabled="'disabled'"/>
            <div :style="{
              marginTop: '-35px !important'
            }">
              <span class="fa fa-fw fa-eye field-icon" @click="() => isShowingPassword = !isShowingPassword" v-if="isShowingPassword"></span>
              <span class="far fa-eye-slash field-icon" @click="() => isShowingPassword = !isShowingPassword" v-if="!isShowingPassword"></span>
            </div>
            
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <p>Confirm New Password</p>
            <roundedInput :type="isShowingCPassword ? 'text' : 'password'" :placeholder="'(Leave blank if unchanged)'"
              :class="!this.isValidPassword && username == '' ? 'mb-0 ' : ' SettingsField' " :styles="{
                        border: !this.isValidPassword && username == '' ? '1px solid red !important' : 'none',
                      }" v-model="cPassword" class="input-style" id="toggle-field" />
            <div :style="{
              marginTop: '-35px !important'
            }">
              <span class="fa fa-fw fa-eye field-icon" @click="() => isShowingCPassword = !isShowingCPassword" v-if="isShowingCPassword"></span>
              <span class="far fa-eye-slash field-icon" @click="() => isShowingCPassword = !isShowingCPassword" v-if="!isShowingCPassword"></span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <roundedBtn :onClick="update_account" :icon="'fas fa-sign-in-alt'" :text="'Update'" :styles="{
          backgroundColor: '#01004E',
          color: 'white'
        }" style="margin-bottom: 5%; margin-top: 5%;" />

      </div>
      <div class="col-sm-4 text-center mb-5 col-sm-push-8">
        <h3>Profile picture</h3>
        <div class="col-sm-12 mt-3">
          <i class="fas fa-user-circle" aria-hidden="true" :style="{
            fontSize: '150px',
            color: '#01009A'
          }" v-if="!returnProfile"></i>
          <img :src="config.BACKEND_URL + returnProfile.url" v-else :style="{
            width: '170px',
            height: '170px',
            borderRadius: '50%'
          }"/>
        </div>
        <div>
        <div class="mt-4">
          <roundedBtn :icon="'fas fa-sign-in-alt'" :text="'Change Profile Picture'" :styles="{
              backgroundColor: '#01004E',
              color: 'white',
            }" :onClick="addImage" />

          <input type="file" id="Image" accept="images/*"
            @change="setUpFileUpload($event)">
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
      route: '',
      city: '',
      region: '',
      country: '',
      postalZipCode: '',
      username: '',
      email: '',
      cPassword: '',
      password: '',
      isValidProfile: true,
      isValidAddress: true,
      isValidAccount: true,
      isValidPassword: true,
      isShowingPassword: false,
      isShowingCPassword: false
    }
  },
  components: {
    dialogueBtn,
    roundedInput,
    roundedBtn
  },
  computed: {
    returnProfile() {
      return this.user.profile
    }
  },
  mounted() {
    this.username = this.user.username
    this.firstname = this.user.information.first_name
    this.lastname = this.user.information.last_name
    this.contactnumber = this.user.information.cellular_number
    let address = JSON.parse(this.user.information.address)
    this.route = address.route
    this.city = address.city
    this.region = address.region
    this.country = address.country
    this.postalZipCode = address.zipcode
    this.email = this.user.email
  },
  methods: {
    connect(item){
      // ROUTER.push('/' + item.payload)
    },
    update_account(event){
      if(!this.validate()) {
        return
      }
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
      if(this.firstname !== '' || this.lastname !== '' || this.businessname !== '' || this.contactnumber !== '') {
        let parameter = {
          id: this.user.information.id,
          account_id: this.user.userID,
          first_name: this.firstname,
          middle_name: this.middlename,
          last_name: this.lastname,
          cellular_number: this.contactnumber
        }
        $('#loading').css({'display': 'block'})
        this.APIRequest('account_informations/update', parameter).then(response => {
          $('#loading').css({'display': 'none'})
          console.log('RESPONSE: ', response)
          if(!response.error) {
            console.log('UPDATE RESPONSE: ', response)
          }
        })
      }
      if(this.route !== '' || this.region !== '' || this.city !== '' || this.postalZipCode !== '' || this.city !== '' || this.country !== ''){
        let parameter = {
          id: this.user.information.id,
          account_id: this.user.userID,
          address: JSON.stringify({
            route: this.route,
            city: this.city,
            region: this.region,
            country: this.country,
            zipcode: this.postalZipCode
          })
        }
        $('#loading').css({'display': 'block'})
        this.APIRequest('account_informations/update', parameter).then(response => {
          $('#loading').css({'display': 'none'})
          console.log('RESPONSE: ', response)
          if(!response.error) {
            console.log('UPDATE RESPONSE: ', response)
          }
        })
      }
      if(this.username !== '' || this.email !== '') {
        let acc = {
          id: this.user.userID,
          code: this.user.code,
          email: this.email
        }
        $('#loading').css({'display': 'block'})
        this.APIRequest('accounts/update_email', acc).then(response => {
          $('#loading').css({'display': 'none'})
          console.log('RESPONSE: ', response)
          if(!response.error) {
            console.log('UPDATE RESPONSE: ', response)
          }
        })
      }
      if(this.businessname !== ''){
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
        this.APIRequest('merchants/retrieve', condition).then(response => {
          $('#loading').css({'display': 'none'})
          console.log('RESPONSE: ', response)
          let merchant = {
            name: this.businessname,
            account_id: this.user.userID
          }
          let url = ''
          if(response.data.length > 0) {
            merchant['id'] = response.data[0].id
            url = 'merchants/update'
          }else {
            url = 'merchants/create'
          }
          $('#loading').css({'display': 'block'})
          this.APIRequest(url, merchant, response => {
            $('#loading').css({'display': 'none'})
            console.log('MERCHANTS: ', response)
          }, error => {
            $('#loading').css({'display': 'none'})
            error
          })
        })
      }
    },
    addImage(){
      $('#Image')[0].click()
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
          console.log('PROFILE URL: ', response.data.data)
          let profile = response.data.data

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
          this.APIRequest('account_profiles/retrieve', condition, response => {
            let accProfile = {
              account_id: this.user.userID,
              url: profile
            }
            let url = ''
            if(response.data.length > 0) {
              accProfile['id'] = response.data[0].id
              url = 'account_profiles/update'
            }else{
              url = 'account_profiles/create'
            }
            this.APIRequest(url, accProfile, response => {
              $('#loading').css({'display': 'none'})
              AUTH.retrieveAccountProfileAndInformation(this.user.userID)
            }, error => {
              $('#loading').css({'display': 'none'})
              error
            })
          }, error => {
            $('#loading').css({'display': 'none'})
            error
          })
        }
      })
    },
    validate() {
      if(this.firstname !== '' || this.lastname !== '' || this.businessname !== '' || this.contactnumber !== '') {
        if(this.firstname === '' || this.lastname === '' || this.businessname === '' || this.contactnumber === '') {
          this.isValidProfile = false
        }else{
          this.isValidProfile = true
        }
      }
      if(this.route !== '' || this.region !== '' || this.city !== '' || this.postalZipCode !== '' || this.city !== '' || this.country !== '') {
        if(this.route === '' || this.region === '' || this.city === '' || this.postalZipCode === '' || this.city === '' || this.country === '') {
          this.isValidAddress = false
        }else {
          this.isValidAddress = true
        }
      }
      if(this.username !== '' || this.email !== '') {
        if(this.username === '' || this.email === '') {
          this.isValidAccount = false
        }else {
          this.isValidAccount = true
        }
      }
      if(this.password !== '' || this.cPassword !== '') {
        if(this.password === '' || this.cPassword === '') {
          this.isValidPassword = false
        }else {
          this.isValidPassword = true
        }
      }

      if(!this.isValidProfile || !this.isValidAddress || !this.isValidAccount || !this.isValidPassword) {
        return false
      }else {
        return true
      }
    }
  }
}

</script>

<style scoped lang="scss" scoped>
@import "~assets/style/colors.scss";
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
