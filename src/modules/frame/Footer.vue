<template>
<footer class="page-footer indigo">
  <!-- Footer Links -->
  <div class="container-fluid d-flex justify-content-center" style="background: #F1B814; padding-top: 50px;padding-bottom: 30px;">
    <!-- Grid row -->
    <div class="row w-75 " style="padding-bottom:1%;">
      <!-- Grid column -->
      <div class="col-md-4 ft-col-left ">
        <!-- Links -->
        <h5 class="font-weight-bold mt-3 mb-4 ft-title">About</h5>
        <ul class="list-unstyled">
          <li>
            <a class="ft-link" href="#">Our Mission</a>
          </li>
          <li>
            <a class="ft-link" href="#">Our Story</a>
          </li>
          <li>
            <a class="ft-link" href="#">Team Members</a>
          </li>
        </ul>
      </div>
      <!-- Grid column -->
      <hr class="clearfix w-100 d-md-none">
      <!-- Grid column -->
      <div class="col-md-4 mx-auto ">
        <!-- Links -->
        <h5 class="font-weight-bold mt-3 mb-4 ft-title">Information</h5>
        <ul class="list-unstyled">
          <li>
            <a class="ft-link" href="#">Terms and Conditions</a>
          </li>
          <li>
            <a class="ft-link" href="#">Privacy Policy</a>
          </li>
        </ul>
      </div>
      <!-- Grid column -->
      <hr class="clearfix w-100 d-md-none">
      <!-- Grid column -->
      <div class="col-md-4 mx-auto ">
        <!-- Links -->
        <h5 class="font-weight-bold mt-3 ft-title" style="margin-bottom:15px;padding-top:6%">We Accept All Major Credit Cards<br> For Fast and Easy Payment</h5>
        <ul class="list-unstyled">
            <li>
              <img class="payment" src="../../assets/img/pay_methods.png" alt="Payment Methods">
            </li>
        </ul>
        <div class="end-line" style="padding-left:10px">
          <p>Copyright © 2021. All Rights Reserved.<img src="../../assets/img/logo_small_redo.png" alt="logo" height="21px" width="50px" style="padding-left:10px"></p>
        </div>
      </div>
      <!-- Grid column -->
    </div>
    <!-- Grid row -->
  </div>
</footer>
</template>
<style type="text/css">
.page-footer {
  font-family: 'Roboto';
}
.ft-title {
  font-size:18px;
  font-weight:700;
  padding-top:10%;
  padding-bottom:5%;
}
.ft-col-left {
  padding-left: 5%;
}
.ft-col-right {
  padding-right: 5%;
}
.ft-link {
  color: black;
}
.ft-link:hover {
  color: white;
}

.payment {
  height: 35px;
}

@media (max-width: 767px){
.page-footer {
  text-align: center;
}

.end-line {
  padding-left: 0px !important;
  text-align: center;
}

}

@media (max-width: 1199px){
  .payment {
    height: 30px;
  }
}

@media (max-width: 440px){
  .payment {
    height: 22px;
  }
}
</style>
<script>
import COMMON from 'src/common.js'
import Image from '../../components/increment/generic/modal/Image.vue'
export default {
  components: { Image },
  data(){
    return {
      common: COMMON
    }
  },
  methods: {
    external(url){
      window.open(url, '_BLANK')
    }
  }
}
</script>
