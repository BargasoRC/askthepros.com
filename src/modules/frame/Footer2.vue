<template>
<footer class="page-footer indigo">
  <!-- Footer Links -->
  <div class="container-fluid d-flex justify-content-center" style="background: #F1B814; padding-top: 50px;padding-bottom: 30px;">
    <!-- Grid row -->
    <div class="row w-75 " style="padding-bottom:1%;">
<!--       <div class="col-md-4 ft-col-left ">
        <h5 class="font-weight-bold mt-3 mb-4 ft-title">About</h5>
      </div> -->
      <!-- Grid column -->
      <hr class="clearfix w-100 d-md-none">
      <!-- Grid column -->
      <div class="col-md-4 mx-auto ">
        <!-- Links -->
        <h5 class="font-weight-bold mt-3 mb-4 ft-title" style="font-size: 30px;">About</h5>
        <ul class="list-unstyled">
          <li>
            <div class="ft-link"><a style="margin-left: 14px;" href="https://askthepros.com/terms-of-service/" target="_blank">Terms of Use</a></div>
          </li>
          <li>
            <div class="ft-link"><a style="margin-left: 14px;" href="https://askthepros.com/privacy-policy/" target="_blank">Privacy Policy</a></div>
          </li>
        </ul>
      </div>
      <!-- Grid column -->
      <hr class="clearfix w-100 d-md-none">
      <!-- Grid column -->
      <div class="col-md-4 mx-auto ">
        <!-- Links -->
        <h5 class="font-weight-bold mt-3 ft-title" style="margin-bottom:15px;padding-top:6%;color:#01009A;justify-content:center;text-align:center;font-size:20px;font-weight:500;">We Accept All Major Credit Cards<br> For Fast and Easy Payment</h5>
        <!-- <div class="ft-pay-img"> -->
          <ul class="list-unstyled">
            <li>
              <div style="justify-content:center;text-align:center;"> <img class="payment" src="../../assets/img/pay_methods.png" alt="Payment Methods"> </div>
            </li>
        </ul>
        <div class="end-line" style="padding-left:10px;color:#01009A;">
          <p style="justify-content:center;text-align:center;font-size:14px;">Copyright © 2021 All Rights Reserved. v.0.1.<img src="../../assets/img/logo_small_redo.png" alt="logo" height="21px" width="50px" style="padding-left:10px"></p>
        </div>
      </div>
      <!-- Grid column -->
    </div>
    <!-- Grid row -->
  </div>
</footer>
</template>
<style type="text/css">
.page-footer{
  float: left;
  width: 100%;
  display: block;
}

.ft-title {
  font-size:18px;
  font-weight:700;
  padding-top:10%;
}
.ft-col-left {
  padding-left: 5%;
}
.ft-col-right {
  padding-right: 5%;
}
.ft-link a{
  text-decoration: none;
  color: black;
}
.ft-link {
  margin-left:10px;
  font-size: 20px;
  margin-bottom: 10px;
  width: 100%;
}
.ft-link:hover{
    color: #01009A;
    border-bottom: solid #01009A 2px;
    animation-delay: 0.5s;
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
@media (max-width: 767px){
  .ft-title {
    font-size: 100%;
    text-align: center;
  }
  li{
    text-align: center;
  }
  .payment {
    /* width: 70%; */
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
