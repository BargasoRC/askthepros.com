<template>
  <div class="content-holder">
    <span class="text-center trademark-text">
      <h2>Content Expert in <b>180+ Industries</b>: One-Post Platform</h2>
      <p>Three Easy Steps To Manage Your Social Media Content‎</p>
    </span>
    <span class="cards">
      <span class="card-item text-center" v-for="(item, index) in data">
        <span class="icon-container">
          <span class="icon-holder">
            <i :class="item.icon"></i>
          </span>
        </span>
        <span class="item-content">
          <p>{{item.description}}</p>
        </span>
      </span>
    </span>
  </div>
</template>
<script>
export default {
  props: ['items', 'placeholder', 'styles', 'selectedIndex', 'dropdownItemStyles'],
  mounted(){
    console.log('[this]', this.selectedIndex)
  },
  data() {
    return {
      data: [{
        icon: 'fas fa-search',
        description: 'Create a brief profile with your industry'
      }, {
        icon: 'far fa-file',
        description: 'We Match you with an Subject Matter Expert in your Industry'
      }, {
        icon: 'fas fa-user-shield',
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
  .trademark-text{
    margin-top: 2vh;
    width: 100%;
    float: left;
  }

  .cards{
    width: 50%;
    float: left;
    margin-left: 25%;
    margin-right: 25%;
    display: flex;
    justify-content: space-between;
    margin-top: 50px;
  }

  .card-item{
    width: 25%;
    float: left;
    padding-left: 20px;
    padding-right: 20px;
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
    box-shadow: 0px 20px 30px $gray;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  b{
    color: $primary;
  }

  .card-item i{
    font-size: 50px;
    color: $primary;
  }

  .item-content{
    width: 100%;
    float: left;
    margin-top: 25px;
  }

  p{
    font-size: 16px;
  }

  @media (max-width: 991px){
  .cards{
    width: 100%;
    margin: unset;
  }

  .trademark-text{
    margin-bottom: 25px;
  }

  .card-item{
    width: 100%;
    margin: unset;
    margin-bottom: 25px;
  }

  h2{
    font-size: 140%;
  }

  p{
    font-size: 120%;
  }

}

</style>

