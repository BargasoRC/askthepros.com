<template>
  <div id="learn-how" class="sectionn">
    <div class="container">
      <div class="row no-gutters">
        <span class="col-md-6">
          <iframe src="https://www.youtube.com/embed/DkRIdQa9otU"></iframe>
        </span>
        <span class="col-md-6">   
            <h1>Connect your Social Media and Automate.</h1>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the. </p>
            <dialogueBtn :onClick="register" :icon="'fas fa-sign-in-alt'" :text="'Register Now'" :styles="{backgroundColor: '#F1B814',color: 'white', marginTop: '20px'}"/>
        </span>
      </div>
    </div>
  </div>
</template>

<script>
import dialogueBtn from 'src/modules/generic/dialogueBtn'
export default {
  components: {
    dialogueBtn
  },
  methods: {
    register() {
      this.redirect('signup')
      window.scrollTo(0, 0)
    },
    redirect(parameter) {
      this.$router.push(parameter)
    }
  }
}
</script>

<style scoped lang='scss'>
@import '~assets/style/colors.scss';
.sectionn {
  background-color: $darkPrimary;
  min-height: 60vh;
  width: 100%;
  color: white;
  font-family: 'Roboto';
}

.row {
  padding-top: 20vh;
  padding-bottom: 20vh;
}

h1 {
  font-weight: 800;
  color: $warning;
  font-size: 35px;
}

p {
  margin-top: 20px;
  font-size: 24px;
}

iframe{
  width: 80%;
  min-height: 30vh;
  border-radius: 22.5px;
  background-color: $white;
}

@media screen and (max-width: 767px) {
  .col-md-6 {
    text-align: center;
  }
  .col-md-6 h1 {
    margin-top: 10vh;
    font-size: 30px;
  }
  .col-md-6 p {
    font-size: 20px;
  }

  .col-md-6 iframe {
    width: 100%;
  }
}
</style>

