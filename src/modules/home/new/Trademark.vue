<template>
<div class="container">
    <div class="header-top">
        <h2>Trademark Registration in <a href="">180+ Countries</a>: One-Stop Platform</h2>
    </div>    
    <div class="subheader-top">
        <p>Just 3 Online Steps, Never Been Easier.‎</p>
    </div>
    <div>
        <div class="row">
            <div class="col-md-4 card">
                <div class="card-circle">
                    <span class="circle"></span>
                    <div class="cir-search"><i class="fas fa-search cir-search-position"></i></div>
                </div>
                <div class="card-title"><h4>Search</h4></div>
                <div class="card-content"><p>Create a brief profile with your industry</p></div>
            </div>
            <div class="ellipsis"><i class="fas fa-ellipsis-h fa-2x e-1"></i></div>
            <div class="col-md-4 card">
                <div class="card-circle">
                    <span class="circle"></span>
                    <div class="cir-search"><i class="far fa-file cir-file-position"></i></div>
                </div>
                <div class="card-title"><h4>File</h4></div>
                <div class="card-content"><p>We Match you with an Subject Matter Expert in your Industry</p></div>
            </div>
            <div class="ellipsis"><i class="fas fa-ellipsis-h fa-2x e-2"></i></div>
            <div class="col-md-4 card">
                <div class="card-circle">
                    <span class="circle"></span>
                    <div class="cir-search"><i class="fas fa-user-shield cir-search-position"></i></div>
                </div>
                <div class="card-title"><h4>Done!</h4></div>
                <div class="card-content"><p>We post to your Google My Business, Facebook and Linked in 3 times per week</p></div>
            </div>
        </div>
    </div>
</div>    
</template>
<style scoped lang="scss">
.container{
    max-width: 1080px;
    margin-bottom: 50px;
}
.header-top{
    font-size: 22px;
    padding: 0.2%;
    width: 100%;
    justify-content: center;
    text-align: center;
    margin-bottom: 10px;
}
.subheader-top{
    margin-top: 20px;
    margin-bottom: 20px;
    justify-content: center;
    text-align: center;
    font-size: 17px;
    font-weight: 500;
    
}
.row{
    width: 100%;
    justify-content: center;
    text-align: center;
}
.card{
    width: 33.3%;
    padding: 2%;
    border: none;
}
.card-circle{
    width: 100%;
    margin-bottom: 20px;
}
.circle{
  height: 125px;
  width: 125px;
  background-color: rgb(204, 204, 204);
  border-radius: 50%;
  display: inline-block;
  text-shadow: -12px 12px 4px rgb(201, 201, 201);
}
.cir-search{
    position: absolute;
}
.cir-search-position{
    position: relative;
    z-index: 4;
    font-size: 70px;
    color: lightblue;
    left: 119px;
    bottom: 109px;
    text-shadow: -12px 12px 4px rgb(124, 154, 165);
}
.cir-file-position{
    position: relative;
    z-index: 4;
    font-size: 75px;
    color: lightblue;
    left: 130px;
    bottom: 109px;
    text-shadow: -12px 12px 4px rgb(124, 154, 165);
}
.card-title{
    margin-top: 15px;
}
.card-content{
    margin-top: 7px;
    margin-bottom: 20px;
    justify-content: center;
    text-align: center;
    padding-left: 4%;
    padding-right: 4%;
    font-size: 15px;
}

.ellipsis{
    font-size: 20px;
    position: absolute;
}
.e-1{
    position: relative;
    right: 175px;
    top: 75px;
    color: grey;
    z-index: 3;
}
.e-2{
    position: relative;
    left: 175px;
    top: 75px;
    color: grey;
    z-index: 3;
}
</style>

