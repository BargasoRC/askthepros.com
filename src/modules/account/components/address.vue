<template>
  <div class="container-fluid">
    <div class="row flex-column-reverse">
      <div class="col-sm-pull-4">
        <div class="my-title mb-5">
          <h3>Address</h3>
        </div>
        <div class="row">
          <!-- <div class="col-sm-12"> -->
            <!-- <div class="row"> -->
              <!-- <div class="col-md-6 mb-3"> -->
                <div class="col-md-5 mb-3">
                  <!-- <roundedInput :type="'text'" :placeholder="'Enter your city here'"
                  :class="!isValidAddress && city == '' ? 'mb-0 ' : ' SettingsField'" :styles="{
                          border: !isValidAddress && !city ? '1px solid red !important' : 'none',
                        }" v-model="city" class="input-style" />
                  <div>
                    <p class="mb-0 pb-0 requiredFieldError"
                      v-if="city == '' || city == undefined && !isValidAddress">
                      {{
                      'Required Field'
                      }}</p>
                  </div> -->
                  <!-- // last implementation -->
                      <!-- ref="address"
                      id="map"
                      classname="form-control roudedInput"
                      :placeholder="selectedLocation == null ? 'Please type your address' : selectedLocation"
                      v-on:placechanged="getAddressData"
                      country="sg" -->
                  <GooglePlacesAutoComplete
                  :property="property"
                  @onFinish="getAddressData($event)"
                  >
                  </GooglePlacesAutoComplete>
                </div>
                <!-- <roundedBtn :onClick="setLocation" :icon="'fas fa-sign-in-alt'" :text="'Select Location'" :styles="{
                  backgroundColor: '#01004E',
                  color: 'white'
                }" /> -->
                <!-- <div>
                  <p class="mb-0 pb-0 requiredFieldError"
                    v-if="route == '' || route == undefined  && !isValidAddress">
                    {{
                    'Required Field'
                    }}</p>
                </div> -->
              <!-- </div> -->

              <!-- <div class="col-md-6 mb-3">
                <p>City</p>
                <roundedInput :type="'text'" :placeholder="'Enter your city here'"
                  :class="!isValidAddress && city == '' ? 'mb-0 ' : ' SettingsField'" :styles="{
                          border: !isValidAddress && !city ? '1px solid red !important' : 'none',
                        }" v-model="city" class="input-style" />
                  <div>
                  <p class="mb-0 pb-0 requiredFieldError"
                    v-if="city == '' || city == undefined && !isValidAddress">
                    {{
                    'Required Field'
                    }}</p>
                </div>
              </div>
            </div>
            <div class="row">
              <div class=" col-md-6 mb-3">
                <p>Region</p>
                <roundedInput :type="'text'" :placeholder="'Enter your region here'"
                  :class="!isValidAddress && region == '' ? 'mb-0 ' : ' SettingsField'" :styles="{
                            border: !isValidAddress && !region ? '1px solid red !important' : 'none',
                          }" v-model="region" class="input-style" />
                  <div>
                  <p class="mb-0 pb-0 requiredFieldError"
                    v-if="region == '' || region == undefined  && !isValidAddress">
                    {{
                    'Required Field'
                    }}</p>
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <p>Country</p>
                <roundedInput :type="'text'" :placeholder="'Enter your country here'"
                  :class="!isValidAddress && country == '' ? 'mb-0 ' : ' SettingsField'" :styles="{
                          border: !isValidAddress && !country ? '1px solid red !important' : 'none',
                        }" v-model="country" class="input-style" />
                  <div>
                  <p class="mb-0 pb-0 requiredFieldError"
                    v-if="country == '' || country == undefined && !isValidAddress">
                    {{
                    'Required Field'
                    }}</p>
                </div>
              </div>

            </div>
            <div class="row mb-5">
              <div class="col-md-6 mb-3">
                <p>Postal/Zip Code</p>
                <roundedInput :type="'text'" :placeholder="'Enter your postal/zip code here'"
                  :class="!isValidAddress && postalZipCode == '' ? 'mb-0 ' : ' SettingsField'" :styles="{
                            border: !isValidAddress && !postalZipCode ? '1px solid red !important' : 'none',
                          }" v-model="postalZipCode" class="input-style" />
                  <div>
                  <p class="mb-0 pb-0 requiredFieldError"
                    v-if="postalZipCode == '' || postalZipCode == undefined && !isValidAddress">
                    {{
                    'Required Field'
                    }}</p>
                </div>
              </div>
            </div>
          </div> -->
        </div>
        
        <p class="mb-1 pb-0 requiredFieldError"
        v-if="selectedLocation == '' || selectedLocation == null && !isValidAddress">
        {{
        'Required Field'
        }}</p>

        <roundedBtn :onClick="update_address" :icon="'fas fa-sign-in-alt'" :text="'Update'" :styles="{
          backgroundColor: '#01004E',
          color: 'white'
        }" style="margin-bottom: 5%;" />

      </div>
    </div>
  </div>
</template>
<script>
import VueGoogleAutocomplete from 'vue-google-autocomplete'
import GooglePlacesAutoComplete from 'src/components/increment/generic/location/GooglePlacesAutoComplete'
import dialogueBtn from 'src/modules/generic/dialogueBtn'
import roundedInput from 'src/modules/generic/roundedInput'
import roundedBtn from 'src/modules/generic/roundedBtn'
import COLORS from 'src/assets/style/colors.js'
import AUTH from 'src/services/auth'
import CONFIG from 'src/config.js'
import errorModal from 'src/components/increment/generic/Modal/Alert.vue'
import $ from 'jquery'
import global from 'src/helpers/global'
export default {
  data() {
    return {
      eyeToggle: false,
      colors: COLORS,
      user: AUTH.user,
      config: CONFIG,
      global: global,
      errorMessage: null,
      data: null,
      address: '',
      city: '',
      region: '',
      country: '',
      postalZipCode: '',
      isValid: true,
      isValidAddress: true,
      canUpdateAddress: false,
      selectedLocation: null,
      id: null,
      val: false,
      property: {
        style: {
          outline: 'none !important',
          boxShadow: 'none !important',
          height: '45px !important',
          borderRadius: '40px !important',
          border: '1px solid $gray !important'
        },
        placeholder: null,
        GOOGLE_API_KEY: CONFIG.GOOGLE.API_KEY,
        results: {
          style: {
            zIndex: '99999999px'
          }
        }
      }
    }
  },
  props: ['addresData'],
  components: {
    dialogueBtn,
    roundedInput,
    roundedBtn,
    VueGoogleAutocomplete,
    GooglePlacesAutoComplete,
    errorModal
  },
  mounted(){
    this.$parent.retrieveInformation()
    this.retrieveInformation()
  },
  computed: {
    returnProfile() {
      return this.user.profile
    }
  },
  watch: {
    route: function(val){
      this.route = val
    },
    city: function(val){
      this.city = val
    },
    region: function(val){
      this.region = val
    },
    country: function(val){
      this.country = val
    },
    postalZipCode: function(val){
      this.postalZipCode = val
    }
  },
  created() {
    // this.$parent.retrieveInformation()
  },
  methods: {
    getAddressData(e) {
      this.selectedLocation = e
      this.property.placeholder = e
    },
    retrieveInformation() {
      let address = this.user.information.address ? JSON.parse(this.user.information.address) : ''
      this.selectedLocation = Object.keys(address).length > 0 ? address.route + ', ' + address.locality + ', ' + address.region + ', ' + address.country : null
      this.getAddressData(this.selectedLocation)
      this.id = this.user.information.id
    },
    update_address(event){
      if(!this.validate()) {
        this.val = false
        this.$emit('Address', this.val)
        // return
      }
      if(this.canUpdateAddress) {
        let parameter = {
          id: this.user.information.id,
          account_id: this.user.userID,
          address: JSON.stringify({
            route: this.selectedLocation.route,
            locality: this.selectedLocation.locality,
            region: this.selectedLocation.region,
            country: this.selectedLocation.country,
            latitude: this.selectedLocation.latitude,
            longitude: this.selectedLocation.longitude
          })
        }
        $('#loading').css({'display': 'block'})
        this.APIRequest('account_informations/create_with_location', parameter).then(response => {
          $('#loading').css({'display': 'none'})
          if(response.error === 0) {
            this.$parent.retrieveInformation()
            this.val = true
            this.$emit('Address', this.val)
            this.canUpdateProfile = false
          }
        })
        // }
      }
    },
    validate() {
      if(this.selectedLocation) {
        this.canUpdateAddress = true
        this.isValidAddress = true
      }else{
        this.canUpdateAddress = false
        this.isValidAddress = false
      }
      if(!this.isValidAddress) {
        return false
      }else {
        return true
      }
      // if(this.route !== '' || this.region !== '' || this.city !== '' || this.postalZipCode !== '' || this.city !== '' || this.country !== '') {
      //   if(!this.route || !this.region || !this.city || !this.postalZipCode || !this.city || !this.country) {
      //     this.canUpdateAddress = false
      //     this.isValidAddress = false
      //   }else{
      //     this.canUpdateAddress = true
      //     this.isValidAddress = true
      //   }
      // }else {
      //   this.canUpdateAddress = false
      //   this.isValidAddress = false
      // }
      // console.log('Can update profile ', this.canUpdateAddress, 'Is valid address', this.isValidAddress)
      // console.log('Route', this.route)
      // if(!this.isValidAddress) {
      //   return false
      // }else {
      //   return true
      // }
    }
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
  // margin-bottom: 35px;
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
  // margin-bottom: 25px !important;
  margin-bottom: -35px;
}
/*
@media (max-width: 768px){
  .profile-pic{
    margin-left: -16%;
  }
}
*/
</style>
