<template>
  <!-- Footer -->
<footer class="page-footer indigo">

  <!-- Footer Links -->
  <div class="container-fluid text-center text-md-left" >

    <!-- Grid row -->
    <div class="row" style="background: #F1B814;">

      <!-- Grid column -->
      <div class="col-md-3 mx-auto">

        <!-- Links -->
        <h5 class="font-weight-bold mt-3 mb-4 footer-title">About</h5>

        <ul class="list-unstyled">
          <li>
            <a href="#!">Our Mission</a>
          </li>
          <li>
            <a href="#!">Our Story</a>
          </li>
          <li>
            <a href="#!">Team Members</a>
          </li>
        </ul>

      </div>
      <!-- Grid column -->

      <hr class="clearfix w-100 d-md-none">

      <!-- Grid column -->
      <div class="col-md-3 mx-auto">

        <!-- Links -->
        <h5 class="font-weight-bold mt-3 mb-4 footer-title">Information</h5>

        <ul class="list-unstyled">
          <li>
            <a href="#!">Term and Conditions</a>
          </li>
          <li>
            <a href="#!">Privacy Policy</a>
          </li>
        </ul>

      </div>
      <!-- Grid column -->

      <hr class="clearfix w-100 d-md-none">

      <!-- Grid column -->
      <div class="col-md-3 mx-auto">

        <!-- Links -->
        <h5 class="font-weight-bold mt-3 mb-4 footer-title">We Accept All Major Credit Cards For Fast and Easy Payment</h5>

        <div class="container">
          <div class="row"></div>

        </div>

      </div>
      <!-- Grid column -->

    </div>
    <!-- Grid row -->

  </div>
  <!-- Footer Links -->

  <!-- Copyright -->
  <div class="footer-copyright text-center py-3">© 2020 Copyright:
    <a href="https://mdbootstrap.com/"> MDBootstrap.com</a>
  </div>
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
.footer-title{
  /* font-family:Roboto; */
  font-size:18px;
  font-weight:700;
  padding-top:10%;
  padding-bottom:5%;
}

@media (max-width: 991px){
  .apps-footer{
    display: none;
  }
}
</style>
<script>
import COMMON from 'src/common.js'
export default {
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
