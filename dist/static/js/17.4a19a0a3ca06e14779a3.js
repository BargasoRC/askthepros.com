webpackJsonp([17],{512:function(t,e,a){a(849);var n=a(342)(a(701),a(941),"data-v-a3935df6",null);t.exports=n.exports},533:function(t,e,a){a(538);var n=a(342)(a(536),a(539),"data-v-79004f1a",null);t.exports=n.exports},536:function(t,e,a){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default={props:["onClick","icon","text","styles","icon_position"]}},537:function(t,e,a){e=t.exports=a(499)(),e.push([t.i,".dialogueBTN[data-v-79004f1a]{outline:none!important;box-shadow:none!important;border:0;border-radius:40px;font-weight:500;height:45px;padding-left:20px;padding-right:20px;min-width:150px}","",{version:3,sources:["C:/xampp/htdocs/askthepros.com/src/modules/generic/roundedBtn.vue"],names:[],mappings:"AACA,8BAA8B,uBAAwB,0BAA2B,SAAW,mBAAmB,gBAAgB,YAAY,kBAAkB,mBAAmB,eAAe,CAC9L",file:"roundedBtn.vue",sourcesContent:["\n.dialogueBTN[data-v-79004f1a]{outline:none !important;box-shadow:none !important;border:0px;border-radius:40px;font-weight:500;height:45px;padding-left:20px;padding-right:20px;min-width:150px\n}\n"],sourceRoot:""}])},538:function(t,e,a){var n=a(537);"string"==typeof n&&(n=[[t.i,n,""]]),n.locals&&(t.exports=n.locals);a(500)("ed38191a",n,!0)},539:function(t,e){t.exports={render:function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("button",{staticClass:"btn dialogueBTN",style:t.styles,on:{click:t.onClick}},["left"==t.icon_position?a("i",{class:t.icon,staticStyle:{"margin-right":"10px"}}):t._e(),t._v("\n  "+t._s(t.text)+" \n  "),"right"==t.icon_position?a("i",{class:t.icon,staticStyle:{"margin-left":"20px"}}):t._e()])},staticRenderFns:[]}},540:function(t,e,a){a(544);var n=a(342)(a(542),a(545),"data-v-58c6066e",null);t.exports=n.exports},542:function(t,e,a){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default={props:["onClick","icon","text","styles","icon_position"]}},543:function(t,e,a){e=t.exports=a(499)(),e.push([t.i,".dialogueBTN[data-v-58c6066e]{outline:none!important;box-shadow:none!important;border:0;border-radius:40px;font-weight:500;height:45px;border-bottom-right-radius:0;padding-left:20px;padding-right:20px;min-width:150px}","",{version:3,sources:["C:/xampp/htdocs/askthepros.com/src/modules/generic/dialogueBtn.vue"],names:[],mappings:"AACA,8BAA8B,uBAAwB,0BAA2B,SAAW,mBAAmB,gBAAgB,YAAY,6BAA+B,kBAAkB,mBAAmB,eAAe,CAC7N",file:"dialogueBtn.vue",sourcesContent:["\n.dialogueBTN[data-v-58c6066e]{outline:none !important;box-shadow:none !important;border:0px;border-radius:40px;font-weight:500;height:45px;border-bottom-right-radius:0px;padding-left:20px;padding-right:20px;min-width:150px\n}\n"],sourceRoot:""}])},544:function(t,e,a){var n=a(543);"string"==typeof n&&(n=[[t.i,n,""]]),n.locals&&(t.exports=n.locals);a(500)("404493b2",n,!0)},545:function(t,e){t.exports={render:function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("button",{staticClass:"btn dialogueBTN",style:t.styles,on:{click:t.onClick}},["left"==t.icon_position?a("i",{class:t.icon,staticStyle:{"margin-right":"10px"}}):t._e(),t._v("\n  "+t._s(t.text)+" \n  "),"right"==t.icon_position?a("i",{class:t.icon,staticStyle:{"margin-left":"20px"}}):t._e()])},staticRenderFns:[]}},548:function(t,e,a){a(559);var n=a(342)(a(557),a(562),"data-v-890d5ff0",null);t.exports=n.exports},556:function(t,e,a){t.exports=a.p+"static/img/section3-img.88fb0ea.png"},557:function(t,e,a){"use strict";Object.defineProperty(e,"__esModule",{value:!0});var n=a(345),o=a.n(n);e.default={props:["type","styles","placeholder","classes","onEnter"],methods:{onChange:function(t){this.$emit("input",t.target.value)},enter:function(t){return new o.a(function(e,a){e(t)})}}}},558:function(t,e,a){e=t.exports=a(499)(),e.push([t.i,".roudedInput[data-v-890d5ff0]{outline:none!important;box-shadow:none!important;height:45px!important;border-radius:40px!important;border:1px solid #ccc!important}","",{version:3,sources:["C:/xampp/htdocs/askthepros.com/src/modules/generic/roundedInput.vue"],names:[],mappings:"AACA,8BAA8B,uBAAwB,0BAA2B,sBAAuB,6BAA8B,+BAAgC,CACrK",file:"roundedInput.vue",sourcesContent:["\n.roudedInput[data-v-890d5ff0]{outline:none !important;box-shadow:none !important;height:45px !important;border-radius:40px !important;border:1px solid #ccc !important\n}\n"],sourceRoot:""}])},559:function(t,e,a){var n=a(558);"string"==typeof n&&(n=[[t.i,n,""]]),n.locals&&(t.exports=n.locals);a(500)("a77c599e",n,!0)},562:function(t,e){t.exports={render:function(){var t=this,e=t.$createElement;return(t._self._c||e)("input",{class:"form-control roudedInput "+t.classes,style:t.styles,attrs:{type:t.type?t.type:"text",placeholder:t.placeholder},on:{input:t.onChange,keyup:function(e){if(!e.type.indexOf("key")&&t._k(e.keyCode,"enter",13,e.key,"Enter"))return null;void 0!==t.onEnter&&t.enter(t.onEnter(e)).then(function(t){return t})}}})},staticRenderFns:[]}},701:function(t,e,a){"use strict";Object.defineProperty(e,"__esModule",{value:!0});var n=a(540),o=a.n(n),i=a(548),r=a.n(i),s=a(533),d=a.n(s),l=(a(70),a(71));e.default={data:function(){return{email:"",showResponse:!1,isEmailError:!0,showError:!1}},components:{dialogueBtn:o.a,roundedInput:r.a,roundedBtn:d.a},methods:{reset:function(t){var e=this;if(console.log("Reset password:::",l.a.validateEmail(this.email)),l.a.validateEmail(this.email)){this.isEmailError=!0;var a={email:this.email};this.APIRequest("accounts/request_reset",a).then(function(t){console.log("ACCOUNTS RESPONSE: ",t),!0===t.data?(e.showResponse=!0,e.showError=!1):(e.showError=!0,e.showResponse=!1)})}else this.isEmailError=!1},redirect:function(t){this.$router.push("/login")},login:function(t){console.log("login:::"),this.$router.push("/")},forgotPassword:function(t){console.log("forgot password:::")},gmailLogin:function(t){console.log("gmail login:::")},fbLogin:function(t){console.log("facebook login:::")},linkedInLogin:function(t){console.log("linkedin login:::")}}}},792:function(t,e,a){e=t.exports=a(499)(),e.push([t.i,".invalidEmail[data-v-a3935df6]{color:red;font-size:10px;margin-left:20px}.resetPasswordMessage[data-v-a3935df6]{font-size:12px}.message[data-v-a3935df6]{min-height:80px}.orSeparatorA[data-v-a3935df6]{margin-top:35px;margin-bottom:15px}.orSeparatorB[data-v-a3935df6]{margin-top:15px;margin-bottom:20px}.LoginField[data-v-a3935df6]{margin-bottom:35px}.QouteText[data-v-a3935df6]{font-size:50px;font-weight:700}.SubQoute[data-v-a3935df6]{text-align:center}.QouteCard[data-v-a3935df6]{width:80%!important;margin-top:5vh;margin-bottom:5vh;text-align:center}.LoginCard[data-v-a3935df6]{width:475px;background-color:#fff;border-radius:20px;box-shadow:3px 3px 1px -2px rgba(1,0,154,.75);-webkit-box-shadow:3px 3px 1px -2px rgba(1,0,154,.75);-moz-box-shadow:3px 3px 1px -2px rgba(1,0,154,.75)}.LoginContainer[data-v-a3935df6]{min-height:85vh}.RowContainer[data-v-a3935df6]{background:#fff;padding-top:15vh}.QouteCardContainer[data-v-a3935df6]{display:-ms-flexbox!important;display:flex!important;-ms-flex-pack:center!important;justify-content:center!important;-ms-flex-align:center!important;align-items:center!important;background:#fff;margin-top:5%}.LoginCardContainer[data-v-a3935df6]{background:none;height:calc(100% + 10px)}@media (max-width:500px){.LoginCard[data-v-a3935df6]{width:100%}.QouteText[data-v-a3935df6]{font-size:30px}}@media (max-width:1200px){.QouteCardContainer[data-v-a3935df6]{width:90%!important}.QouteText[data-v-a3935df6]{font-size:35px}}@media (max-width:1150px){.LoginCardContainer[data-v-a3935df6],.QouteCardContainer[data-v-a3935df6]{-ms-flex:0 0 50%;flex:0 0 50%;max-width:50%}}@media (max-width:950px){.QouteCardContainer[data-v-a3935df6]{-ms-flex:0 0 40%;flex:0 0 40%;max-width:40%}.LoginCardContainer[data-v-a3935df6]{-ms-flex:0 0 60%;flex:0 0 60%;max-width:60%}.QouteText[data-v-a3935df6]{font-size:35px}}@media (max-width:768px){.LoginCardContainer[data-v-a3935df6],.QouteCardContainer[data-v-a3935df6]{-ms-flex:0 0 100%;flex:0 0 100%;max-width:100%}.QouteText[data-v-a3935df6]{font-size:35px}.QouteCard img[data-v-a3935df6]{width:100%!important}}","",{version:3,sources:["C:/xampp/htdocs/askthepros.com/src/modules/account/resetPassword.vue"],names:[],mappings:"AACA,+BAA+B,UAAU,eAAe,gBAAgB,CACvE,AACD,uCAAuC,cAAc,CACpD,AACD,0BAA0B,eAAe,CACxC,AACD,+BAA+B,gBAAgB,kBAAkB,CAChE,AACD,+BAA+B,gBAAgB,kBAAkB,CAChE,AACD,6BAA6B,kBAAkB,CAC9C,AACD,4BAA4B,eAAe,eAAgB,CAC1D,AACD,2BAA2B,iBAAiB,CAC3C,AACD,4BAA4B,oBAAqB,eAAe,kBAAkB,iBAAiB,CAClG,AACD,4BAA4B,YAAY,sBAAuB,mBAAmB,8CAA+C,sDAAuD,kDAAmD,CAC1O,AACD,iCAAiC,eAAe,CAC/C,AACD,+BAA+B,gBAAiB,gBAAgB,CAC/D,AACD,qCAAqC,8BAA+B,uBAAwB,+BAAgC,iCAAkC,gCAAiC,6BAA8B,gBAAiB,aAAa,CAC1P,AACD,qCAAqC,gBAAgB,wBAAwB,CAC5E,AACD,yBACA,4BAA4B,UAAU,CACrC,AACD,4BAA4B,cAAc,CACzC,CACA,AACD,0BACA,qCAAqC,mBAAoB,CACxD,AACD,4BAA4B,cAAc,CACzC,CACA,AACD,0BAGA,0EAAqC,iBAAiB,aAAa,aAAa,CAC/E,CACA,AACD,yBACA,qCAAqC,iBAAiB,aAAa,aAAa,CAC/E,AACD,qCAAqC,iBAAiB,aAAa,aAAa,CAC/E,AACD,4BAA4B,cAAc,CACzC,CACA,AACD,yBAGA,0EAAqC,kBAAkB,cAAc,cAAc,CAClF,AACD,4BAA4B,cAAc,CACzC,AACD,gCAAgC,oBAAqB,CACpD,CACA",file:"resetPassword.vue",sourcesContent:["\n.invalidEmail[data-v-a3935df6]{color:red;font-size:10px;margin-left:20px\n}\n.resetPasswordMessage[data-v-a3935df6]{font-size:12px\n}\n.message[data-v-a3935df6]{min-height:80px\n}\n.orSeparatorA[data-v-a3935df6]{margin-top:35px;margin-bottom:15px\n}\n.orSeparatorB[data-v-a3935df6]{margin-top:15px;margin-bottom:20px\n}\n.LoginField[data-v-a3935df6]{margin-bottom:35px\n}\n.QouteText[data-v-a3935df6]{font-size:50px;font-weight:bold\n}\n.SubQoute[data-v-a3935df6]{text-align:center\n}\n.QouteCard[data-v-a3935df6]{width:80% !important;margin-top:5vh;margin-bottom:5vh;text-align:center\n}\n.LoginCard[data-v-a3935df6]{width:475px;background-color:white;border-radius:20px;box-shadow:3px 3px 1px -2px rgba(1,0,154,0.75);-webkit-box-shadow:3px 3px 1px -2px rgba(1,0,154,0.75);-moz-box-shadow:3px 3px 1px -2px rgba(1,0,154,0.75)\n}\n.LoginContainer[data-v-a3935df6]{min-height:85vh\n}\n.RowContainer[data-v-a3935df6]{background:white;padding-top:15vh\n}\n.QouteCardContainer[data-v-a3935df6]{display:-ms-flexbox !important;display:flex !important;-ms-flex-pack:center !important;justify-content:center !important;-ms-flex-align:center !important;align-items:center !important;background:white;margin-top:5%\n}\n.LoginCardContainer[data-v-a3935df6]{background:none;height:calc(100% + 10px)\n}\n@media (max-width: 500px){\n.LoginCard[data-v-a3935df6]{width:100%\n}\n.QouteText[data-v-a3935df6]{font-size:30px\n}\n}\n@media (max-width: 1200px){\n.QouteCardContainer[data-v-a3935df6]{width:90% !important\n}\n.QouteText[data-v-a3935df6]{font-size:35px\n}\n}\n@media (max-width: 1150px){\n.QouteCardContainer[data-v-a3935df6]{-ms-flex:0 0 50%;flex:0 0 50%;max-width:50%\n}\n.LoginCardContainer[data-v-a3935df6]{-ms-flex:0 0 50%;flex:0 0 50%;max-width:50%\n}\n}\n@media (max-width: 950px){\n.QouteCardContainer[data-v-a3935df6]{-ms-flex:0 0 40%;flex:0 0 40%;max-width:40%\n}\n.LoginCardContainer[data-v-a3935df6]{-ms-flex:0 0 60%;flex:0 0 60%;max-width:60%\n}\n.QouteText[data-v-a3935df6]{font-size:35px\n}\n}\n@media (max-width: 768px){\n.QouteCardContainer[data-v-a3935df6]{-ms-flex:0 0 100%;flex:0 0 100%;max-width:100%\n}\n.LoginCardContainer[data-v-a3935df6]{-ms-flex:0 0 100%;flex:0 0 100%;max-width:100%\n}\n.QouteText[data-v-a3935df6]{font-size:35px\n}\n.QouteCard img[data-v-a3935df6]{width:100% !important\n}\n}\n"],sourceRoot:""}])},849:function(t,e,a){var n=a(792);"string"==typeof n&&(n=[[t.i,n,""]]),n.locals&&(t.exports=n.locals);a(500)("e6d95f3e",n,!0)},941:function(t,e,a){t.exports={render:function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{staticClass:"LoginContainer col-sm-12"},[n("div",{staticClass:"row RowContainer"},[n("div",{staticClass:"col-sm-7 col-md-7 col-lg-7 col-xl-7 col-xs-7 QouteCardContainer mb-5"},[n("div",{staticClass:"QouteCard"},[t._m(0),t._v(" "),t._m(1),t._v(" "),n("img",{staticStyle:{width:"85%",height:"auto"},attrs:{src:a(556),alt:"Image"}})])]),t._v(" "),n("div",{staticClass:"col-sm-5 col-md-5 col-lg-5 col-xl-5 col-xs-5 d-flex justify-content-center LoginCardContainer mb-5"},[n("div",{staticClass:"card LoginCard"},[n("div",{staticClass:"card-body LoginCardBody"},[t._m(2),t._v(" "),n("div",[n("roundedInput",{class:"",attrs:{type:"text",styles:{border:this.isEmailError?"none":".2px solid red !important"},placeholder:"Email Address"},model:{value:t.email,callback:function(e){t.email=e},expression:"email"}}),t._v(" "),this.isEmailError?t._e():n("p",{staticClass:"mb-0 pb-0 invalidEmail"},[t._v(t._s(""==t.email?"Required Field":"Invalid email"))])],1),t._v(" "),n("div",{staticClass:"message mt-2 mb-2"},[t.showResponse?n("i",{staticClass:"resetPasswordMessage"},[t._v("We send recovery email to your email address at "),n("u",[t._v(t._s(t.email))]),t._v(". Please give us a moment, it may take few minutes. Please check your email address to continue.")]):t._e(),t._v(" "),t.showError?n("i",{staticClass:"resetPasswordMessage",staticStyle:{color:"red"}},[t._v("Something went wrong.")]):t._e()]),t._v(" "),n("div",{staticClass:"d-flex justify-content-center"},[n("dialogueBtn",{attrs:{onClick:t.reset,icon:"fas fa-sign-in-alt",text:"Send Request",styles:{backgroundColor:"#01009A",color:"white"}}})],1),t._v(" "),t._m(3),t._v(" "),n("div",{staticClass:"col-sm-12"},[n("div",{staticClass:"row"},[n("div",{staticClass:"col-sm-4 col-md-4 col-lg-4"},[n("roundedBtn",{attrs:{onClick:t.gmailLogin,icon:"fab fa-google",text:"Sign In",styles:{background:"none",color:"272727",width:"100% !important",minWidth:"100% !important",border:"1px solid #84868B"},icon_position:"left"}})],1),t._v(" "),n("div",{staticClass:"col-sm-4 col-md-4 col-lg-4"},[n("roundedBtn",{attrs:{onClick:t.fbLogin,icon:"fab fa-facebook-f",text:"Sign In",styles:{background:"none",color:"272727",width:"100% !important",minWidth:"100% !important",border:"1px solid #84868B"},icon_position:"left"}})],1),t._v(" "),n("div",{staticClass:"col-sm-4 col-md-4 col-lg-4"},[n("roundedBtn",{attrs:{onClick:t.linkedInLogin,icon:"fab fa-linkedin-in",text:"Sign In",styles:{background:"none",color:"272727",width:"100% !important",minWidth:"100% !important",border:"1px solid #84868B"},icon_position:"left"}})],1)])]),t._v(" "),t._m(4),t._v(" "),n("div",{staticClass:"col-sm-12 mb-3 col-md-12 col-lg-12 d-flex justify-content-center"},[n("dialogueBtn",{attrs:{onClick:t.redirect,icon:"fas fa-sign-in-alt",text:"Login",styles:{backgroundColor:"#F1B814",color:"white"}}})],1)])])])])])},staticRenderFns:[function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{staticClass:"SubQoute"},[a("h1",{staticClass:"QouteText",staticStyle:{color:"#01004E"}},[t._v("Become A Local Expert")])])},function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{staticClass:"SubQoute"},[a("h1",{staticClass:"QouteText",staticStyle:{color:"#01009A"}},[t._v("With Automated Social Media Posting.")])])},function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{staticClass:"d-flex justify-content-center pt-5 pb-5 mb-3"},[a("b",[t._v("Request to Reset Password with AskThePros")])])},function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{staticClass:"d-flex justify-content-center orSeparatorA"},[a("b",[t._v("OR")])])},function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{staticClass:"d-flex justify-content-center orSeparatorB"},[a("b",[t._v("OR")])])}]}}});
//# sourceMappingURL=17.4a19a0a3ca06e14779a3.js.map