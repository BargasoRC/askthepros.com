<template>
    <div id="container">
        <div><img class="image_format" :src="require('assets/img/board.jpg')"/></div>
        <div><img class="image_format2" :src="require('assets/img/woman.png')"/></div> 
        <div class="button_list">
            <div class="button_styling">
                <a class="s_button" href="">Veterinarian's</a>
            </div>
            <div class="button_styling">
                <a class="s_button" href="">Medicare Agents</a>
            </div>
            <div class="button_styling">
                <a class="s_button" href="">Real Estate Agents</a>
            </div>
        </div>
    </div>
</template>
<style scoped lang="scss">
#container{
    position: relative;
    height: 400px;
}

.image_format{
    height: 290px;
    width: 500px;
    position: absolute;
    top: 11rem;
    left: 5.5rem;
    z-index: -3;
}

.image_format2{
    position: absolute;
    height: 550px;
    width: 600px;
    top: 1rem;
    left: 2rem;
    z-index: 2;
}
.button_list{
    //margin-top: 11rem;
    position: relative;
    top: 13.5rem;
    left: 0rem;


    @media only screen and (max-width: 600px) {
        body {
            background-color: lightblue;
        }
    }
}

.button_styling {
    margin-bottom: 3.125rem;
    //background-color: lightblue;
    text-align: center;
    justify-content: center;
    width: 48rem;
}

.button_styling .s_button{
    background-color: #01009A;
    padding: 16px;
    padding-left: 35px;
    padding-right: 35px;
    font-family: "Work Sans", Sans-serif;
    font-weight: 600;
    font-size: 30px;
    color: yellow;
    border-radius: 10px;
}

</style>
