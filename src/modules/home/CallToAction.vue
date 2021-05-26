<template>
  <div id="learn-how" class="sectionn">
    <div class="container">
      <div class="row no-gutters">
        <span class="col-md-6">
          <iframe class="iframe" src="https://www.youtube.com/watch?v=nY75wI85lco" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </span>
        <span class="col-md-6">   
            <h1>Connect your Social Media<br>and Automate.</h1>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the. </p>
        </span>
      </div>
    </div>
  </div>
</template>

<script>
import ROUTER from 'src/router'
export default {
  methods: {
    redirect(parameter) {
      ROUTER.push(parameter)
    }
  }
}
</script>

<style scoped lang='scss'>
@import '~assets/style/colors.scss';
.sectionn {
  background-color: #01004e;
  min-height: 60vh;
  width: 100%;
  color: white;
  font-family: 'Roboto';
}

.row {
  padding-top: 20vh;
}

h1 {
  font-weight: 600;
  color: #F1B814;
  font-size: 40px;
}

p {
  margin-top: 20px;
  font-size: 16px;
}
</style>

