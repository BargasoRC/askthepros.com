webpackJsonp([32],{563:function(t,a,n){n(703);var i=n(329)(n(590),n(781),"data-v-958b0f40",null);t.exports=i.exports},590:function(t,a,n){"use strict";Object.defineProperty(a,"__esModule",{value:!0});var i=n(160),e=n.n(i);a.default={created:function(){},components:{},data:function(){return{isActive:!0}},computed:{},methods:{navigate:function(t){this.$router.push("/"+t),this.isActive=!0},headerScrollTo:function(t){this.navigate(t),window.location.reload();var a=e()(window).height();e()("html, body").animate({scrollTop:e()(t).offset().top-parseInt(0*a)},500)},showSidebar:function(){this.isActive=!this.isActive}}},window.addEventListener("load",function(){e()(document).ready(function(){if("#learn-how"===window.location.hash){var t=e()(window).height();e()("html, body").animate({scrollTop:e()("#learn-how").offset().top-parseInt(0*t)},500)}else if("#pricing"===window.location.hash){var a=e()(window).height();e()("html, body").animate({scrollTop:e()("#pricing").offset().top-parseInt(0*a)},500)}})})},650:function(t,a,n){a=t.exports=n(472)(),a.push([t.i,".sidebar[data-v-958b0f40]{min-width:50%;max-width:50%;height:100vh;position:fixed;top:0;right:0;z-index:9999;background-color:#fff;border-left:.5px solid #84868b;transition:width .5s;-webkit-transition:all .25s}li[data-v-958b0f40]{text-align:left}.nav-text[data-v-958b0f40]{font-size:125%}.nav_item[data-v-958b0f40]{cursor:pointer}.nav_item_m[data-v-958b0f40]{border-bottom:.5px solid #84868b;margin-top:20px;padding-bottom:20px;width:80%}b[data-v-958b0f40]{color:#000}b[data-v-958b0f40]:hover{color:#01009a!important}.nav-container[data-v-958b0f40]:hover{background:#01009a}.nav-container:hover b[data-v-958b0f40]{color:#fff!important}.navigationBar[data-v-958b0f40]{width:100%;position:fixed;top:0;z-index:100}.navbar[data-v-958b0f40]{background:#fff!important}.navbar-header[data-v-958b0f40]{background:none!important}.navbar-brand .logo-brand[data-v-958b0f40]{margin-top:5%}.nav-link .navbar-brand[data-v-958b0f40]{font-size:30px}.notificationBar[data-v-958b0f40]{background-color:#ff0045;width:100%;z-index:100;padding-left:48%;display:-ms-flexbox;display:flex;-ms-flex-align:center;align-items:center;-ms-flex-pack:justify;justify-content:space-between;color:#fff;height:60px;margin-bottom:50px!important}.navbar-menu-toggler-md[data-v-958b0f40]{height:50px;float:left;text-align:center;font-size:16px;color:#fff;line-height:50px;display:none}.navbar-menu-toggler-md[data-v-958b0f40]:hover{cursor:pointer;background:#01009a}.active-menu[data-v-958b0f40]{background:#01009a}@media (min-width:1200px){.sidebar[data-v-958b0f40]{display:none}.system-header[data-v-958b0f40]{width:50%!important}.header-navbar[data-v-958b0f40]{width:50%!important;margin-left:18%}.header-navbar-nav[data-v-958b0f40]{width:15%!important}.navbar-menu-toggler-md[data-v-958b0f40]{display:none}.left-menu-icons[data-v-958b0f40]{width:40%!important}.right-menu-icons[data-v-958b0f40]{width:60%!important}.nav-item[data-v-958b0f40]{width:5%!important}.logo-brand[data-v-958b0f40]{width:230px!important;height:100px!important;margin-left:5%!important}}@media (max-width:1199px){.sidebar[data-v-958b0f40]{display:none}.system-header[data-v-958b0f40]{width:70%!important}.header-navbar[data-v-958b0f40]{width:30%!important;margin-left:70%!important}.header-navbar-nav[data-v-958b0f40]{width:30%}.navbar-menu-toggler-md[data-v-958b0f40]{display:none}.left-menu-icons[data-v-958b0f40]{width:60%!important}.right-menu-icons[data-v-958b0f40]{width:40%}.nav-item[data-v-958b0f40]{width:10%}.logo-brand[data-v-958b0f40]{width:auto!important;height:75px!important;margin-left:5%!important}}@media (max-width:991px){b[data-v-958b0f40]{color:#000}b[data-v-958b0f40]:hover{color:#fff}.sidebar[data-v-958b0f40]{display:block}.system-header[data-v-958b0f40]{width:30%}.header-navbar[data-v-958b0f40]{width:70%;margin-left:30%}.header-navbar-nav[data-v-958b0f40]{width:30%}.navbar-menu-toggler-md[data-v-958b0f40]{width:10%;text-align:center;display:block}.left-menu-icons[data-v-958b0f40]{width:60%!important}.right-menu-icons[data-v-958b0f40]{width:40%!important}.nav-item[data-v-958b0f40]{width:10%}.logo-brand[data-v-958b0f40]{width:auto!important;height:75px!important;margin-left:5%!important;margin-top:15%!important}}@media (max-width:767px){.header-margin[data-v-958b0f40]{width:10%!important}.system-header[data-v-958b0f40]{width:15%}.navbar-brand[data-v-958b0f40]{width:90%!important;margin:0!important}.header-navbar[data-v-958b0f40]{width:85%;margin-left:15%}.nav-item[data-v-958b0f40]{width:20%}.logo-brand[data-v-958b0f40]{width:auto!important;height:70px!important;margin-left:5%!important}.left-menu-icons[data-v-958b0f40]{width:40%!important}.right-menu-icons[data-v-958b0f40]{width:60%!important}.hide-on-mobile[data-v-958b0f40]{display:none!important}.nav-text[data-v-958b0f40]{font-size:100%}.sidebar[data-v-958b0f40]{height:150vh}}@media (max-width:300px){.logo-brand[data-v-958b0f40]{width:30px;height:30px}}","",{version:3,sources:["C:/xampp/htdocs/askthepros.com/src/modules/frame/Header2.vue"],names:[],mappings:"AACA,0BAA0B,cAAc,cAAc,aAAa,eAAe,MAAM,QAAQ,aAAa,sBAAuB,+BAAgC,qBAAsB,2BAA4B,CACrN,AACD,oBAAoB,eAAe,CAClC,AACD,2BAA2B,cAAc,CACxC,AACD,2BAA2B,cAAc,CACxC,AACD,6BAA6B,iCAAkC,gBAAgB,oBAAoB,SAAS,CAC3G,AACD,mBAAmB,UAAW,CAC7B,AACD,yBAAyB,uBAAwB,CAChD,AACD,sCAAsC,kBAAkB,CACvD,AACD,wCAAwC,oBAAsB,CAC7D,AACD,gCAAgC,WAAW,eAAe,MAAM,WAAW,CAC1E,AACD,yBAAyB,yBAA2B,CACnD,AACD,gCAAgC,yBAA0B,CACzD,AACD,2CAA2C,aAAa,CACvD,AACD,yCAAyC,cAAc,CACtD,AACD,kCAAkC,yBAAyB,WAAW,YAAY,iBAAiB,oBAAoB,aAAa,sBAAsB,mBAAmB,sBAAsB,8BAA8B,WAAc,YAAY,4BAA6B,CACvR,AACD,yCAAyC,YAAY,WAAW,kBAAkB,eAAe,WAAW,iBAAiB,YAAY,CACxI,AACD,+CAA+C,eAAe,kBAAkB,CAC/E,AACD,8BAA8B,kBAAkB,CAC/C,AACD,0BACA,0BAA0B,YAAY,CACrC,AACD,gCAAgC,mBAAoB,CACnD,AACD,gCAAgC,oBAAqB,eAAe,CACnE,AACD,oCAAoC,mBAAoB,CACvD,AACD,yCAAyC,YAAY,CACpD,AACD,kCAAkC,mBAAoB,CACrD,AACD,mCAAmC,mBAAoB,CACtD,AACD,2BAA2B,kBAAmB,CAC7C,AACD,6BAA6B,sBAAuB,uBAAwB,wBAAyB,CACpG,CACA,AACD,0BACA,0BAA0B,YAAY,CACrC,AACD,gCAAgC,mBAAoB,CACnD,AACD,gCAAgC,oBAAqB,yBAA0B,CAC9E,AACD,oCAAoC,SAAS,CAC5C,AACD,yCAAyC,YAAY,CACpD,AACD,kCAAkC,mBAAoB,CACrD,AACD,mCAAmC,SAAS,CAC3C,AACD,2BAA2B,SAAS,CACnC,AACD,6BAA6B,qBAAsB,sBAAuB,wBAAyB,CAClG,CACA,AACD,yBACA,mBAAmB,UAAW,CAC7B,AACD,yBAAyB,UAAW,CACnC,AACD,0BAA0B,aAAa,CACtC,AACD,gCAAgC,SAAS,CACxC,AACD,gCAAgC,UAAU,eAAe,CACxD,AACD,oCAAoC,SAAS,CAC5C,AACD,yCAAyC,UAAU,kBAAkB,aAAa,CACjF,AACD,kCAAkC,mBAAoB,CACrD,AACD,mCAAmC,mBAAoB,CACtD,AACD,2BAA2B,SAAS,CACnC,AACD,6BAA6B,qBAAsB,sBAAuB,yBAA0B,wBAAyB,CAC5H,CACA,AACD,yBACA,gCAAgC,mBAAoB,CACnD,AACD,gCAAgC,SAAS,CACxC,AACD,+BAA+B,oBAAqB,kBAAqB,CACxE,AACD,gCAAgC,UAAU,eAAe,CACxD,AACD,2BAA2B,SAAS,CACnC,AACD,6BAA6B,qBAAsB,sBAAuB,wBAAyB,CAClG,AACD,kCAAkC,mBAAoB,CACrD,AACD,mCAAmC,mBAAoB,CACtD,AACD,iCAAiC,sBAAuB,CACvD,AACD,2BAA2B,cAAc,CACxC,AACD,0BAA0B,YAAY,CACrC,CACA,AACD,yBACA,6BAA6B,WAAW,WAAW,CAClD,CACA",file:"Header2.vue",sourcesContent:["\n.sidebar[data-v-958b0f40]{min-width:50%;max-width:50%;height:100vh;position:fixed;top:0;right:0;z-index:9999;background-color:white;border-left:0.5px solid #84868B;transition:width 0.5s;-webkit-transition:all 0.25s\n}\nli[data-v-958b0f40]{text-align:left\n}\n.nav-text[data-v-958b0f40]{font-size:125%\n}\n.nav_item[data-v-958b0f40]{cursor:pointer\n}\n.nav_item_m[data-v-958b0f40]{border-bottom:0.5px solid #84868B;margin-top:20px;padding-bottom:20px;width:80%\n}\nb[data-v-958b0f40]{color:black\n}\nb[data-v-958b0f40]:hover{color:#01009A !important\n}\n.nav-container[data-v-958b0f40]:hover{background:#01009A\n}\n.nav-container:hover b[data-v-958b0f40]{color:white !important\n}\n.navigationBar[data-v-958b0f40]{width:100%;position:fixed;top:0;z-index:100\n}\n.navbar[data-v-958b0f40]{background:white !important\n}\n.navbar-header[data-v-958b0f40]{background:none !important\n}\n.navbar-brand .logo-brand[data-v-958b0f40]{margin-top:5%\n}\n.nav-link .navbar-brand[data-v-958b0f40]{font-size:30px\n}\n.notificationBar[data-v-958b0f40]{background-color:#FF0045;width:100%;z-index:100;padding-left:48%;display:-ms-flexbox;display:flex;-ms-flex-align:center;align-items:center;-ms-flex-pack:justify;justify-content:space-between;color:#FFFFFF;height:60px;margin-bottom:50px !important\n}\n.navbar-menu-toggler-md[data-v-958b0f40]{height:50px;float:left;text-align:center;font-size:16px;color:#fff;line-height:50px;display:none\n}\n.navbar-menu-toggler-md[data-v-958b0f40]:hover{cursor:pointer;background:#01009A\n}\n.active-menu[data-v-958b0f40]{background:#01009A\n}\n@media (min-width: 1200px){\n.sidebar[data-v-958b0f40]{display:none\n}\n.system-header[data-v-958b0f40]{width:50% !important\n}\n.header-navbar[data-v-958b0f40]{width:50% !important;margin-left:18%\n}\n.header-navbar-nav[data-v-958b0f40]{width:15% !important\n}\n.navbar-menu-toggler-md[data-v-958b0f40]{display:none\n}\n.left-menu-icons[data-v-958b0f40]{width:40% !important\n}\n.right-menu-icons[data-v-958b0f40]{width:60% !important\n}\n.nav-item[data-v-958b0f40]{width:5% !important\n}\n.logo-brand[data-v-958b0f40]{width:230px !important;height:100px !important;margin-left:5% !important\n}\n}\n@media (max-width: 1199px){\n.sidebar[data-v-958b0f40]{display:none\n}\n.system-header[data-v-958b0f40]{width:70% !important\n}\n.header-navbar[data-v-958b0f40]{width:30% !important;margin-left:70% !important\n}\n.header-navbar-nav[data-v-958b0f40]{width:30%\n}\n.navbar-menu-toggler-md[data-v-958b0f40]{display:none\n}\n.left-menu-icons[data-v-958b0f40]{width:60% !important\n}\n.right-menu-icons[data-v-958b0f40]{width:40%\n}\n.nav-item[data-v-958b0f40]{width:10%\n}\n.logo-brand[data-v-958b0f40]{width:auto !important;height:75px !important;margin-left:5% !important\n}\n}\n@media (max-width: 991px){\nb[data-v-958b0f40]{color:black\n}\nb[data-v-958b0f40]:hover{color:white\n}\n.sidebar[data-v-958b0f40]{display:block\n}\n.system-header[data-v-958b0f40]{width:30%\n}\n.header-navbar[data-v-958b0f40]{width:70%;margin-left:30%\n}\n.header-navbar-nav[data-v-958b0f40]{width:30%\n}\n.navbar-menu-toggler-md[data-v-958b0f40]{width:10%;text-align:center;display:block\n}\n.left-menu-icons[data-v-958b0f40]{width:60% !important\n}\n.right-menu-icons[data-v-958b0f40]{width:40% !important\n}\n.nav-item[data-v-958b0f40]{width:10%\n}\n.logo-brand[data-v-958b0f40]{width:auto !important;height:75px !important;margin-left:5% !important;margin-top:15% !important\n}\n}\n@media (max-width: 767px){\n.header-margin[data-v-958b0f40]{width:10% !important\n}\n.system-header[data-v-958b0f40]{width:15%\n}\n.navbar-brand[data-v-958b0f40]{width:90% !important;margin:0px !important\n}\n.header-navbar[data-v-958b0f40]{width:85%;margin-left:15%\n}\n.nav-item[data-v-958b0f40]{width:20%\n}\n.logo-brand[data-v-958b0f40]{width:auto !important;height:70px !important;margin-left:5% !important\n}\n.left-menu-icons[data-v-958b0f40]{width:40% !important\n}\n.right-menu-icons[data-v-958b0f40]{width:60% !important\n}\n.hide-on-mobile[data-v-958b0f40]{display:none !important\n}\n.nav-text[data-v-958b0f40]{font-size:100%\n}\n.sidebar[data-v-958b0f40]{height:150vh\n}\n}\n@media (max-width: 300px){\n.logo-brand[data-v-958b0f40]{width:30px;height:30px\n}\n}\n"],sourceRoot:""}])},703:function(t,a,n){var i=n(650);"string"==typeof i&&(i=[[t.i,i,""]]),i.locals&&(t.exports=i.locals);n(473)("0eff450e",i,!0)},714:function(t,a,n){t.exports=n.p+"static/img/asktheprooslogo-clear.bacdf57.png"},781:function(t,a,n){t.exports={render:function(){var t=this,a=t.$createElement,i=t._self._c||a;return i("nav",{staticClass:"navbar navbar-expand-lg navbar-light bg-light"},[i("div",{staticClass:"navbar-header"},[i("a",{staticClass:"navbar-brand",attrs:{href:"#"}},[i("img",{staticClass:"logo-brand",attrs:{src:n(714)},on:{click:function(a){return t.navigate("")}}})])]),t._v(" "),i("div",{staticClass:"navbar-header"},[i("a",{attrs:{href:"#"}},[i("button",{staticClass:"navbar-toggler",staticStyle:{border:"none",color:"#01004E"},attrs:{type:"button"},on:{click:function(a){return t.showSidebar()}}},[i("i",{staticClass:"fas fa-bars fa-2x"})])])]),t._v(" "),t.isActive?t._e():i("div",{staticClass:"sidebar contianer-fluid",attrs:{id:"navbarSupportedContent d-none d-sm-block"}},[i("div",{staticClass:"row w-100  justify-content-end no-gutters",staticStyle:{"padding-right":"20%","padding-top":"20%",color:"#01004E"}},[i("i",{staticClass:"fas fa-times fa-3x",on:{click:function(a){return t.showSidebar()}}})]),t._v(" "),i("div",{staticClass:"row no-gutters justify-content-center nav-container"},[i("div",{staticClass:"nav_item_m",on:{click:function(a){return t.headerScrollTo("#learn-how")}}},[i("b",{staticClass:"font-weight-normal nav-text",attrs:{href:"#learn-how"},on:{click:function(a){return t.headerScrollTo("#learn-how")}}},[t._v("Learn How")])])]),t._v(" "),i("div",{staticClass:"row no-gutters justify-content-center nav-container"},[i("div",{staticClass:"nav_item_m",on:{click:function(a){return t.headerScrollTo("#pricing")}}},[i("b",{staticClass:"font-weight-normal nav-text",attrs:{href:"#pricing"},on:{click:function(a){return t.headerScrollTo("#pricing")}}},[t._v("Pricing")])])]),t._v(" "),i("div",{staticClass:"row no-gutters justify-content-center nav-container"},[i("div",{staticClass:"nav_item_m",on:{click:function(a){return t.navigate("contact")}}},[i("b",{staticClass:"font-weight-normal nav-text",style:"color: "+("contactPage"==t.$route.name?"#007bff":"black"),on:{click:function(a){return t.navigate("contact")}}},[t._v("Contact Us")])])]),t._v(" "),i("div",{staticClass:"row no-gutters justify-content-center nav-container"},[i("div",{staticClass:"nav_item_m",on:{click:function(a){return t.navigate("login")}}},[i("b",{staticClass:"font-weight-normal nav-text",style:"color: "+("loginAccount"==t.$route.name?"#007bff":"black"),on:{click:function(a){return t.navigate("login")}}},[t._v("Login")])])]),t._v(" "),i("div",{staticClass:"row no-gutters justify-content-center nav-container"},[i("div",{staticClass:"nav_item_m",on:{click:function(a){return t.navigate("login")}}},[i("b",{staticClass:"font-weight-normal nav-text",style:"color: "+("signup"==t.$route.name?"#007bff":"black"),on:{click:function(a){return t.navigate("login")}}},[t._v("Register")])])])]),t._v(" "),i("div",{staticClass:"navbar-collapse text-center d-none d-lg-block",attrs:{id:"navbarSupportedContent"}},[i("ul",{staticClass:"nav navbar-nav navbar-right ml-auto"},[i("li",{staticClass:"pl-5 pr-5 nav_item"},[i("b",{staticClass:"font-weight-normal",attrs:{href:"#learn-how"},on:{click:function(a){return t.headerScrollTo("#learn-how")}}},[t._v("Learn How")])]),t._v(" "),i("li",{staticClass:"pl-5 pr-5 nav_item"},[i("b",{staticClass:"font-weight-normal",attrs:{href:"#pricing"},on:{click:function(a){return t.headerScrollTo("#pricing")}}},[t._v("Pricing")])]),t._v(" "),i("li",{staticClass:"pl-5 pr-5 nav_item"},[i("b",{staticClass:"font-weight-normal",style:"color: "+("contactPage"==t.$route.name?"#007bff":"black"),on:{click:function(a){return t.navigate("contact")}}},[t._v("Contact Us")])]),t._v(" "),i("li",{staticClass:"pl-5 pr-5 nav_item",on:{click:function(a){return t.navigate("login")}}},[i("b",{staticClass:"font-weight-normal",style:"color: "+("loginAccount"==t.$route.name?"#007bff":"black")},[t._v("Login")])]),t._v(" "),i("li",{staticClass:"pl-5 pr-5 nav_item",on:{click:function(a){return t.navigate("signup")}}},[i("b",{staticClass:"font-weight-normal",style:"color: "+("signup"==t.$route.name?"#007bff":"black")},[t._v("Register")])])])])])},staticRenderFns:[]}}});
//# sourceMappingURL=32.8d3a877c1f92b15c3ad6.js.map