<template>
  <!-- Footer -->
<footer class="page-footer indigo">

  <!-- Footer Links -->
  <div class="container-fluid d-flex justify-content-center" style="background: #F1B814;">

    <!-- Grid row -->
    <div class="row w-75 " style="padding-bottom:1%;">

      <!-- Grid column -->
      <div class="col-md-4 ft-col-left ">

        <!-- Links -->
        <h5 class="font-weight-bold mt-3 mb-4 ft-title">About</h5>

        <ul class="list-unstyled">
          <li>
            <a class="ft-link" href="#!">Our Mission</a>
          </li>
          <li>
            <a class="ft-link" href="#!">Our Story</a>
          </li>
          <li>
            <a class="ft-link" href="#!">Team Members</a>
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
            <a class="ft-link" href="#!">Terms and Conditions</a>
          </li>
          <li>
            <a class="ft-link" href="#!">Privacy Policy</a>
          </li>
        </ul>

      </div>
      <!-- Grid column -->

      <hr class="clearfix w-100 d-md-none">

      <!-- Grid column -->
      <div class="col-md-4 mx-auto ">

        <!-- Links -->
        <h5 class="font-weight-bold mt-3 mb-4 ft-title" style="margin-bottom:0px;padding-top:6%">We Accept All Major Credit Cards<br> For Fast and Easy Payment</h5>
        <ul class="list-unstyled">
            <li>
              <img src="../../assets/img/pay_methods.jpg" alt="Payment Methods">
            </li>
        </ul>
        <dir class="row d-flex justify-content-start" style="padding-left:5%">
          <p>Copyright © 2021. All Rights Reserved.</p>
          <img src="../../assets/img/logo_small_redo.png" alt="logo" height="21px" width="50px" style="padding-left:10px">
        </dir>
        

      </div>
      <!-- Grid column -->

    </div>
    <!-- Grid row -->

  </div>
  <!-- Footer Links -->

  <!-- Copyright -->
  <!-- <div class="">© 2020 Copyright:
    <a href="https://mdbootstrap.com/"> MDBootstrap.com</a>
  </div> -->
  <!-- Copyright -->

</footer>
<!-- Footer -->
</template>
<style type="text/css">
.apps-footer {
  position: fixed;
  width:100%;
  height:30px;
  bottom: 0px;
  background: transparent;
  left: 10px;
  font-size: 12px;
  z-index: 10000;
}
.ft-title {
  /* font-family:Roboto; */
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
  color: black;
}
@media (max-width: 991px){
  .apps-footer{
    display: none;
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
