<template>
  <div class="content-holder">
    <div class="container text-center">
      <span class="trademark-text">
        <h2>Content Expert in <b>180+ Industries</b>: One-Post Platform</h2>
        <p>Three Easy Steps To Manage Your Social Media Content‎</p>
      </span>
      <span class="cards">
        <span class="card-item" v-for="(item, index) in data">
          <span class="icon-container">
            <span class="icon-holder">
              <img width="60" height="60" :src="item.icon">
            </span>
          </span>
          <span class="item-content">
            <p>{{item.description}}</p>
          </span>
        </span>
    </span>
    </div>
  </div>
</template>
<script>
export default {
  props: ['items', 'placeholder', 'styles', 'selectedIndex', 'dropdownItemStyles'],
  mounted(){
  },
  data() {
    return {
      data: [{
        icon: require('assets/img/search.png'),
        description: 'Create a brief profile with your industry'
      }, {
        icon: require('assets/img/note.png'),
        description: 'We Match you with an Subject Matter Expert in your Industry'
      }, {
        icon: require('assets/img/protect.png'),
        description: 'We post to your Google My Business, Facebook and Linked in 3 times per week'
      }]
    }
  }
}
</script>
<style scoped lang="scss">
@import "~assets/style/colors.scss";
  .content-holder{
    width: 100%;
    float: left;
    min-height: 50vh;
    background: $white;
    overflow-y: hidden;
  }

   .container{
    margin-top: 5vh;
  }

  b{
    color: $primary;
  }

  p{
    font-size: 16px;
  }

  .cards{
    float: left;
    display: flex;
    justify-content: space-between;
    margin-top: 6vh;
  }

  .card-item{
    float: left;
    width: 32%;
    padding-left: 3%;
    padding-right: 3%;
  }

  .icon-container{
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .icon-holder{
    width: 100px;
    height: 100px;
    border-radius: 50%;
    box-shadow: -7px 12px 17px #e9e9e9,  5px 12px 17px #e9e9e9;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .icon-holder i{
    font-size: 35px;
    color: $primary;
    text-shadow: -5px 8px 2px rgb(219, 240, 250);
  }

  .item-content{
    width: 100%;
    float: left;
    margin-top: 25px;
  }
  
  * {
    box-sizing: border-box;
  }

  @media (max-width: 991px){
    h2{
      font-size: 140%;
    }

    p{
      font-size: 14.5px;
    }

  }

  @media (max-width: 548px){
    .cards{
      margin-bottom: 5vh;
      margin-top: 5vh;
      display: block;
    }

    .card-item{
      width: 100% !important;
      padding: 5% !important;
    }
  }
</style>
