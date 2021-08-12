<template>
    <div >
        <!-- <img class="image_format" :src="require('assets/img/boardd.jpg')"/> -->
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
</template>
<style scoped lang="scss">
.image_format{
    height: 600px;
    width: 650px;
}

.button_styling {
    margin-bottom: 20px;
    text-align: center;
    justify-content: center;
    position: relative;
    bottom: 350px;
    margin-bottom: 50px;
}

.button_styling .s_button{
    background-color: #01009A;
    padding: 20px;
    padding-left: 35px;
    padding-right: 35px;
    font-family: "Work Sans", Sans-serif;
    font-weight: 600;
    font-size: 30px;
    color: yellow;
    border-radius: 10px;


}

</style>
