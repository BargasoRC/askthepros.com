webpackJsonp([18],{511:function(t,e,o){o(848);var a=o(342)(o(704),o(945),"data-v-797532e1",null);t.exports=a.exports},533:function(t,e,o){o(538);var a=o(342)(o(536),o(539),"data-v-79004f1a",null);t.exports=a.exports},536:function(t,e,o){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default={props:["onClick","icon","text","styles","icon_position"]}},537:function(t,e,o){e=t.exports=o(499)(),e.push([t.i,".dialogueBTN[data-v-79004f1a]{outline:none!important;box-shadow:none!important;border:0;border-radius:40px;font-weight:500;height:45px;padding-left:20px;padding-right:20px;min-width:150px}","",{version:3,sources:["C:/xampp/htdocs/askthepros.com/src/modules/generic/roundedBtn.vue"],names:[],mappings:"AACA,8BAA8B,uBAAwB,0BAA2B,SAAW,mBAAmB,gBAAgB,YAAY,kBAAkB,mBAAmB,eAAe,CAC9L",file:"roundedBtn.vue",sourcesContent:["\n.dialogueBTN[data-v-79004f1a]{outline:none !important;box-shadow:none !important;border:0px;border-radius:40px;font-weight:500;height:45px;padding-left:20px;padding-right:20px;min-width:150px\n}\n"],sourceRoot:""}])},538:function(t,e,o){var a=o(537);"string"==typeof a&&(a=[[t.i,a,""]]),a.locals&&(t.exports=a.locals);o(500)("ed38191a",a,!0)},539:function(t,e){t.exports={render:function(){var t=this,e=t.$createElement,o=t._self._c||e;return o("button",{staticClass:"btn dialogueBTN",style:t.styles,on:{click:t.onClick}},["left"==t.icon_position?o("i",{class:t.icon,staticStyle:{"margin-right":"10px"}}):t._e(),t._v("\n  "+t._s(t.text)+" \n  "),"right"==t.icon_position?o("i",{class:t.icon,staticStyle:{"margin-left":"20px"}}):t._e()])},staticRenderFns:[]}},540:function(t,e,o){o(544);var a=o(342)(o(542),o(545),"data-v-58c6066e",null);t.exports=a.exports},542:function(t,e,o){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default={props:["onClick","icon","text","styles","icon_position"]}},543:function(t,e,o){e=t.exports=o(499)(),e.push([t.i,".dialogueBTN[data-v-58c6066e]{outline:none!important;box-shadow:none!important;border:0;border-radius:40px;font-weight:500;height:45px;border-bottom-right-radius:0;padding-left:20px;padding-right:20px;min-width:150px}","",{version:3,sources:["C:/xampp/htdocs/askthepros.com/src/modules/generic/dialogueBtn.vue"],names:[],mappings:"AACA,8BAA8B,uBAAwB,0BAA2B,SAAW,mBAAmB,gBAAgB,YAAY,6BAA+B,kBAAkB,mBAAmB,eAAe,CAC7N",file:"dialogueBtn.vue",sourcesContent:["\n.dialogueBTN[data-v-58c6066e]{outline:none !important;box-shadow:none !important;border:0px;border-radius:40px;font-weight:500;height:45px;border-bottom-right-radius:0px;padding-left:20px;padding-right:20px;min-width:150px\n}\n"],sourceRoot:""}])},544:function(t,e,o){var a=o(543);"string"==typeof a&&(a=[[t.i,a,""]]),a.locals&&(t.exports=a.locals);o(500)("404493b2",a,!0)},545:function(t,e){t.exports={render:function(){var t=this,e=t.$createElement,o=t._self._c||e;return o("button",{staticClass:"btn dialogueBTN",style:t.styles,on:{click:t.onClick}},["left"==t.icon_position?o("i",{class:t.icon,staticStyle:{"margin-right":"10px"}}):t._e(),t._v("\n  "+t._s(t.text)+" \n  "),"right"==t.icon_position?o("i",{class:t.icon,staticStyle:{"margin-left":"20px"}}):t._e()])},staticRenderFns:[]}},547:function(t,e,o){o(559);var a=o(342)(o(557),o(562),"data-v-890d5ff0",null);t.exports=a.exports},556:function(t,e,o){t.exports=o.p+"static/img/section3-img.88fb0ea.png"},557:function(t,e,o){"use strict";Object.defineProperty(e,"__esModule",{value:!0});var a=o(345),n=o.n(a);e.default={props:["type","styles","placeholder","classes","onEnter"],methods:{onChange:function(t){this.$emit("input",t.target.value)},enter:function(t){return new n.a(function(e,o){e(t)})}}}},558:function(t,e,o){e=t.exports=o(499)(),e.push([t.i,".roudedInput[data-v-890d5ff0]{outline:none!important;box-shadow:none!important;height:45px!important;border-radius:40px!important;border:1px solid #ccc!important}","",{version:3,sources:["C:/xampp/htdocs/askthepros.com/src/modules/generic/roundedInput.vue"],names:[],mappings:"AACA,8BAA8B,uBAAwB,0BAA2B,sBAAuB,6BAA8B,+BAAgC,CACrK",file:"roundedInput.vue",sourcesContent:["\n.roudedInput[data-v-890d5ff0]{outline:none !important;box-shadow:none !important;height:45px !important;border-radius:40px !important;border:1px solid #ccc !important\n}\n"],sourceRoot:""}])},559:function(t,e,o){var a=o(558);"string"==typeof a&&(a=[[t.i,a,""]]),a.locals&&(t.exports=a.locals);o(500)("a77c599e",a,!0)},562:function(t,e){t.exports={render:function(){var t=this,e=t.$createElement;return(t._self._c||e)("input",{class:"form-control roudedInput "+t.classes,style:t.styles,attrs:{type:t.type?t.type:"text",placeholder:t.placeholder},on:{input:t.onChange,keyup:function(e){if(!e.type.indexOf("key")&&t._k(e.keyCode,"enter",13,e.key,"Enter"))return null;void 0!==t.onEnter&&t.enter(t.onEnter(e)).then(function(t){return t})}}})},staticRenderFns:[]}},704:function(t,e,o){"use strict";Object.defineProperty(e,"__esModule",{value:!0});var a=o(540),n=o.n(a),i=o(547),s=o.n(i),r=o(533),d=o.n(r);o(70),o(71);e.default={name:"",mounted:function(){this.code=this.$route.params.code,this.username=this.$route.params.username},data:function(){return{showResponse:!1,isEmailError:!0,showError:!1,visibility:"password",visibilityC:"password",isValid:!0,email:null,flag:!1,errorMessage:null,password:null,c_password:null,code:this.$route.params.code,username:this.$route.params.username,updateFlag:!1}},components:{dialogueBtn:n.a,roundedInput:s.a,roundedBtn:d.a},methods:{showPassword:function(t){"password"===t?this.visibility="text":this.visibilityC="text"},hidePassword:function(t){"cpassword"===t?this.visibilityC="password":this.visibility="password"},reset:function(){var t=this;if(this.validate(),!0===this.flag){var e={username:this.username,code:this.code,password:this.password};$("#loading").css({display:"block"}),this.APIRequest("accounts/update",e).then(function(e){$("#loading").css({display:"none"}),!0===e.data?t.updateFlag=!0:(t.updateFlag=!1,t.errorMessage=e.error)})}},validate:function(){null===this.password||""===this.password||null===this.c_password||""===this.c_password?(this.flag=!1,this.errorMessage="Please fill in all required fields."):this.password!==this.c_password?(this.flag=!1,this.errorMessage="Please confirm your new password."):this.password.length<8?(this.flag=!1,this.errorMessage="Password length must be greater than 8 digit characters."):/^[a-zA-Z0-9]+$/.test(this.password)?(this.flag=!1,this.errorMessage="Password must be alphanumeric characters. It should contain 1 number, 1 special character and letters."):(this.flag=!0,this.errorMessage=null)},redirect:function(t){this.$router.push("/login")},login:function(t){console.log("login:::"),this.$router.push("/")},forgotPassword:function(t){console.log("forgot password:::")},gmailLogin:function(t){console.log("gmail login:::")},fbLogin:function(t){console.log("facebook login:::")},linkedInLogin:function(t){console.log("linkedin login:::")}}}},789:function(t,e,o){e=t.exports=o(499)(),e.push([t.i,".roudedInput[data-v-797532e1]{outline:none!important;box-shadow:none!important;height:45px!important;border-radius:40px!important;border:1px solid #ccc!important}.invalidEmail[data-v-797532e1]{color:red;font-size:10px;margin-left:20px}.resetPasswordMessage[data-v-797532e1]{font-size:12px}.message[data-v-797532e1]{min-height:80px}.orSeparatorA[data-v-797532e1]{margin-top:35px;margin-bottom:15px}.orSeparatorB[data-v-797532e1]{margin-top:15px;margin-bottom:20px}.LoginField[data-v-797532e1]{margin-bottom:35px}.QouteText[data-v-797532e1]{font-size:50px;font-weight:700}.SubQoute[data-v-797532e1]{text-align:center}.QouteCard[data-v-797532e1]{width:80%!important;margin-top:5vh;margin-bottom:5vh;text-align:center}.LoginCard[data-v-797532e1]{width:475px;background-color:#fff;border-radius:20px;box-shadow:3px 3px 1px -2px rgba(1,0,154,.75);-webkit-box-shadow:3px 3px 1px -2px rgba(1,0,154,.75);-moz-box-shadow:3px 3px 1px -2px rgba(1,0,154,.75)}.LoginContainer[data-v-797532e1]{min-height:85vh}.RowContainer[data-v-797532e1]{background:#fff;padding-top:15vh}.QouteCardContainer[data-v-797532e1]{display:-ms-flexbox!important;display:flex!important;-ms-flex-pack:center!important;justify-content:center!important;-ms-flex-align:center!important;align-items:center!important;background:#fff;margin-top:5%}.LoginCardContainer[data-v-797532e1]{background:none;height:calc(100% + 10px)}@media (max-width:500px){.LoginCard[data-v-797532e1]{width:100%}.QouteText[data-v-797532e1]{font-size:30px}}@media (max-width:1200px){.QouteCardContainer[data-v-797532e1]{width:90%!important}.QouteText[data-v-797532e1]{font-size:35px}}@media (max-width:1150px){.LoginCardContainer[data-v-797532e1],.QouteCardContainer[data-v-797532e1]{-ms-flex:0 0 50%;flex:0 0 50%;max-width:50%}}@media (max-width:950px){.QouteCardContainer[data-v-797532e1]{-ms-flex:0 0 40%;flex:0 0 40%;max-width:40%}.LoginCardContainer[data-v-797532e1]{-ms-flex:0 0 60%;flex:0 0 60%;max-width:60%}.QouteText[data-v-797532e1]{font-size:35px}}@media (max-width:768px){.LoginCardContainer[data-v-797532e1],.QouteCardContainer[data-v-797532e1]{-ms-flex:0 0 100%;flex:0 0 100%;max-width:100%}.QouteText[data-v-797532e1]{font-size:35px}.QouteCard img[data-v-797532e1]{width:100%!important}}","",{version:3,sources:["C:/xampp/htdocs/askthepros.com/src/modules/account/resetNewPassword.vue"],names:[],mappings:"AACA,8BAA8B,uBAAwB,0BAA2B,sBAAuB,6BAA8B,+BAAgC,CACrK,AACD,+BAA+B,UAAU,eAAe,gBAAgB,CACvE,AACD,uCAAuC,cAAc,CACpD,AACD,0BAA0B,eAAe,CACxC,AACD,+BAA+B,gBAAgB,kBAAkB,CAChE,AACD,+BAA+B,gBAAgB,kBAAkB,CAChE,AACD,6BAA6B,kBAAkB,CAC9C,AACD,4BAA4B,eAAe,eAAgB,CAC1D,AACD,2BAA2B,iBAAiB,CAC3C,AACD,4BAA4B,oBAAqB,eAAe,kBAAkB,iBAAiB,CAClG,AACD,4BAA4B,YAAY,sBAAuB,mBAAmB,8CAA+C,sDAAuD,kDAAmD,CAC1O,AACD,iCAAiC,eAAe,CAC/C,AACD,+BAA+B,gBAAiB,gBAAgB,CAC/D,AACD,qCAAqC,8BAA+B,uBAAwB,+BAAgC,iCAAkC,gCAAiC,6BAA8B,gBAAiB,aAAa,CAC1P,AACD,qCAAqC,gBAAgB,wBAAwB,CAC5E,AACD,yBACA,4BAA4B,UAAU,CACrC,AACD,4BAA4B,cAAc,CACzC,CACA,AACD,0BACA,qCAAqC,mBAAoB,CACxD,AACD,4BAA4B,cAAc,CACzC,CACA,AACD,0BAGA,0EAAqC,iBAAiB,aAAa,aAAa,CAC/E,CACA,AACD,yBACA,qCAAqC,iBAAiB,aAAa,aAAa,CAC/E,AACD,qCAAqC,iBAAiB,aAAa,aAAa,CAC/E,AACD,4BAA4B,cAAc,CACzC,CACA,AACD,yBAGA,0EAAqC,kBAAkB,cAAc,cAAc,CAClF,AACD,4BAA4B,cAAc,CACzC,AACD,gCAAgC,oBAAqB,CACpD,CACA",file:"resetNewPassword.vue",sourcesContent:["\n.roudedInput[data-v-797532e1]{outline:none !important;box-shadow:none !important;height:45px !important;border-radius:40px !important;border:1px solid #ccc !important\n}\n.invalidEmail[data-v-797532e1]{color:red;font-size:10px;margin-left:20px\n}\n.resetPasswordMessage[data-v-797532e1]{font-size:12px\n}\n.message[data-v-797532e1]{min-height:80px\n}\n.orSeparatorA[data-v-797532e1]{margin-top:35px;margin-bottom:15px\n}\n.orSeparatorB[data-v-797532e1]{margin-top:15px;margin-bottom:20px\n}\n.LoginField[data-v-797532e1]{margin-bottom:35px\n}\n.QouteText[data-v-797532e1]{font-size:50px;font-weight:bold\n}\n.SubQoute[data-v-797532e1]{text-align:center\n}\n.QouteCard[data-v-797532e1]{width:80% !important;margin-top:5vh;margin-bottom:5vh;text-align:center\n}\n.LoginCard[data-v-797532e1]{width:475px;background-color:white;border-radius:20px;box-shadow:3px 3px 1px -2px rgba(1,0,154,0.75);-webkit-box-shadow:3px 3px 1px -2px rgba(1,0,154,0.75);-moz-box-shadow:3px 3px 1px -2px rgba(1,0,154,0.75)\n}\n.LoginContainer[data-v-797532e1]{min-height:85vh\n}\n.RowContainer[data-v-797532e1]{background:white;padding-top:15vh\n}\n.QouteCardContainer[data-v-797532e1]{display:-ms-flexbox !important;display:flex !important;-ms-flex-pack:center !important;justify-content:center !important;-ms-flex-align:center !important;align-items:center !important;background:white;margin-top:5%\n}\n.LoginCardContainer[data-v-797532e1]{background:none;height:calc(100% + 10px)\n}\n@media (max-width: 500px){\n.LoginCard[data-v-797532e1]{width:100%\n}\n.QouteText[data-v-797532e1]{font-size:30px\n}\n}\n@media (max-width: 1200px){\n.QouteCardContainer[data-v-797532e1]{width:90% !important\n}\n.QouteText[data-v-797532e1]{font-size:35px\n}\n}\n@media (max-width: 1150px){\n.QouteCardContainer[data-v-797532e1]{-ms-flex:0 0 50%;flex:0 0 50%;max-width:50%\n}\n.LoginCardContainer[data-v-797532e1]{-ms-flex:0 0 50%;flex:0 0 50%;max-width:50%\n}\n}\n@media (max-width: 950px){\n.QouteCardContainer[data-v-797532e1]{-ms-flex:0 0 40%;flex:0 0 40%;max-width:40%\n}\n.LoginCardContainer[data-v-797532e1]{-ms-flex:0 0 60%;flex:0 0 60%;max-width:60%\n}\n.QouteText[data-v-797532e1]{font-size:35px\n}\n}\n@media (max-width: 768px){\n.QouteCardContainer[data-v-797532e1]{-ms-flex:0 0 100%;flex:0 0 100%;max-width:100%\n}\n.LoginCardContainer[data-v-797532e1]{-ms-flex:0 0 100%;flex:0 0 100%;max-width:100%\n}\n.QouteText[data-v-797532e1]{font-size:35px\n}\n.QouteCard img[data-v-797532e1]{width:100% !important\n}\n}\n"],sourceRoot:""}])},848:function(t,e,o){var a=o(789);"string"==typeof a&&(a=[[t.i,a,""]]),a.locals&&(t.exports=a.locals);o(500)("45cee65d",a,!0)},945:function(t,e,o){t.exports={render:function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{staticClass:"LoginContainer col-sm-12"},[a("div",{staticClass:"row RowContainer"},[a("div",{staticClass:"col-sm-7 col-md-7 col-lg-7 col-xl-7 col-xs-7 QouteCardContainer mb-5"},[a("div",{staticClass:"QouteCard"},[t._m(0),t._v(" "),t._m(1),t._v(" "),a("img",{staticStyle:{width:"85%",height:"auto"},attrs:{src:o(556),alt:"Image"}})])]),t._v(" "),a("div",{staticClass:"col-sm-5 col-md-5 col-lg-5 col-xl-5 col-xs-5 d-flex justify-content-center LoginCardContainer mb-5"},[a("div",{staticClass:"card LoginCard"},[a("div",{staticClass:"card-body LoginCardBody"},[t._m(2),t._v(" "),""!=t.errorMessage&&!1===t.updateFlag?a("div",{staticClass:"login-message-holder login-spacer"},[null!==t.errorMessage?a("span",{staticClass:"text-danger text-center"},[a("b",[t._v("Oops!")]),t._v(" "+t._s(t.errorMessage))]):t._e()]):t._e(),t._v(" "),!0===t.updateFlag?a("div",{staticClass:"login-message-holder login-spacer"},[a("span",{staticClass:"text-center"},[t._v("Your password was successully updated! To login click the login button below.")])]):t._e(),t._v(" "),!1===t.updateFlag?a("div",{staticClass:"roudedInput"},[a("div",{staticClass:"input-group"},["checkbox"===t.visibility?a("input",{directives:[{name:"model",rawName:"v-model",value:t.password,expression:"password"}],staticClass:"form-control roudedInput !this.isValid && password == ''? 'mb-0 ' : ' LoginField'",staticStyle:{border:"none !important",background:"none !important"},attrs:{placeholder:"New Password",type:"checkbox"},domProps:{checked:Array.isArray(t.password)?t._i(t.password,null)>-1:t.password},on:{keyup:function(e){return!e.type.indexOf("key")&&t._k(e.keyCode,"enter",13,e.key,"Enter")?null:t.login()},change:function(e){var o=t.password,a=e.target,n=!!a.checked;if(Array.isArray(o)){var i=t._i(o,null);a.checked?i<0&&(t.password=o.concat([null])):i>-1&&(t.password=o.slice(0,i).concat(o.slice(i+1)))}else t.password=n}}}):"radio"===t.visibility?a("input",{directives:[{name:"model",rawName:"v-model",value:t.password,expression:"password"}],staticClass:"form-control roudedInput !this.isValid && password == ''? 'mb-0 ' : ' LoginField'",staticStyle:{border:"none !important",background:"none !important"},attrs:{placeholder:"New Password",type:"radio"},domProps:{checked:t._q(t.password,null)},on:{keyup:function(e){return!e.type.indexOf("key")&&t._k(e.keyCode,"enter",13,e.key,"Enter")?null:t.login()},change:function(e){t.password=null}}}):a("input",{directives:[{name:"model",rawName:"v-model",value:t.password,expression:"password"}],staticClass:"form-control roudedInput !this.isValid && password == ''? 'mb-0 ' : ' LoginField'",staticStyle:{border:"none !important",background:"none !important"},attrs:{placeholder:"New Password",type:t.visibility},domProps:{value:t.password},on:{keyup:function(e){return!e.type.indexOf("key")&&t._k(e.keyCode,"enter",13,e.key,"Enter")?null:t.login()},input:function(e){e.target.composing||(t.password=e.target.value)}}}),t._v(" "),a("span",{staticStyle:{background:"none","margin-top":"2.5%","margin-right":"3%"}},["password"==t.visibility?a("i",{staticClass:"fa fa-eye",attrs:{"aria-hidden":"true"},on:{click:function(e){return t.showPassword("password")}}}):t._e(),t._v(" "),"text"==t.visibility?a("i",{staticClass:"fa fa-eye-slash",attrs:{"aria-hidden":"true"},on:{click:function(e){return t.hidePassword("password")}}}):t._e()])])]):t._e(),t._v(" "),a("br"),t._v(" "),!1===t.updateFlag?a("div",{staticClass:"roudedInput"},[a("div",{staticClass:"input-group"},["checkbox"===t.visibilityC?a("input",{directives:[{name:"model",rawName:"v-model",value:t.c_password,expression:"c_password"}],staticClass:"form-control roudedInput !this.isValid && password == ''? 'mb-0 ' : ' LoginField'",staticStyle:{border:"none !important",background:"none !important"},attrs:{placeholder:"Confirm New Password",type:"checkbox"},domProps:{checked:Array.isArray(t.c_password)?t._i(t.c_password,null)>-1:t.c_password},on:{keyup:function(e){return!e.type.indexOf("key")&&t._k(e.keyCode,"enter",13,e.key,"Enter")?null:t.login()},change:function(e){var o=t.c_password,a=e.target,n=!!a.checked;if(Array.isArray(o)){var i=t._i(o,null);a.checked?i<0&&(t.c_password=o.concat([null])):i>-1&&(t.c_password=o.slice(0,i).concat(o.slice(i+1)))}else t.c_password=n}}}):"radio"===t.visibilityC?a("input",{directives:[{name:"model",rawName:"v-model",value:t.c_password,expression:"c_password"}],staticClass:"form-control roudedInput !this.isValid && password == ''? 'mb-0 ' : ' LoginField'",staticStyle:{border:"none !important",background:"none !important"},attrs:{placeholder:"Confirm New Password",type:"radio"},domProps:{checked:t._q(t.c_password,null)},on:{keyup:function(e){return!e.type.indexOf("key")&&t._k(e.keyCode,"enter",13,e.key,"Enter")?null:t.login()},change:function(e){t.c_password=null}}}):a("input",{directives:[{name:"model",rawName:"v-model",value:t.c_password,expression:"c_password"}],staticClass:"form-control roudedInput !this.isValid && password == ''? 'mb-0 ' : ' LoginField'",staticStyle:{border:"none !important",background:"none !important"},attrs:{placeholder:"Confirm New Password",type:t.visibilityC},domProps:{value:t.c_password},on:{keyup:function(e){return!e.type.indexOf("key")&&t._k(e.keyCode,"enter",13,e.key,"Enter")?null:t.login()},input:function(e){e.target.composing||(t.c_password=e.target.value)}}}),t._v(" "),a("span",{staticStyle:{background:"none","margin-top":"2.5%","margin-right":"3%"}},["password"==t.visibilityC?a("i",{staticClass:"fa fa-eye",attrs:{"aria-hidden":"true"},on:{click:function(e){return t.showPassword("cpassword")}}}):t._e(),t._v(" "),"text"==t.visibilityC?a("i",{staticClass:"fa fa-eye-slash",attrs:{"aria-hidden":"true"},on:{click:function(e){return t.hidePassword("cpassword")}}}):t._e()])])]):t._e(),t._v(" "),a("div",{staticClass:"message mt-2 mb-2"},[t.showResponse?a("i",{staticClass:"resetPasswordMessage"},[t._v("We send recovery email to your email address at "),a("u",[t._v(t._s(t.email))]),t._v(". Please give us a moment, it may take few minutes. Please check your email address to continue.")]):t._e(),t._v(" "),t.showError?a("i",{staticClass:"resetPasswordMessage",staticStyle:{color:"red"}},[t._v("Something went wrong.")]):t._e()]),t._v(" "),!1===t.updateFlag?a("div",{staticClass:"d-flex justify-content-center"},[a("dialogueBtn",{attrs:{onClick:t.reset,icon:"fas fa-sign-in-alt",text:"Continue",styles:{backgroundColor:"#01009A",color:"white"}}})],1):t._e(),t._v(" "),t._m(3),t._v(" "),a("div",{staticClass:"col-sm-12"},[a("div",{staticClass:"row"},[a("div",{staticClass:"col-sm-4 col-md-4 col-lg-4"},[a("roundedBtn",{attrs:{onClick:t.gmailLogin,icon:"fab fa-google",text:"Sign In",styles:{background:"none",color:"272727",width:"100% !important",minWidth:"100% !important",border:"1px solid #84868B"},icon_position:"left"}})],1),t._v(" "),a("div",{staticClass:"col-sm-4 col-md-4 col-lg-4"},[a("roundedBtn",{attrs:{onClick:t.fbLogin,icon:"fab fa-facebook-f",text:"Sign In",styles:{background:"none",color:"272727",width:"100% !important",minWidth:"100% !important",border:"1px solid #84868B"},icon_position:"left"}})],1),t._v(" "),a("div",{staticClass:"col-sm-4 col-md-4 col-lg-4"},[a("roundedBtn",{attrs:{onClick:t.linkedInLogin,icon:"fab fa-linkedin-in",text:"Sign In",styles:{background:"none",color:"272727",width:"100% !important",minWidth:"100% !important",border:"1px solid #84868B"},icon_position:"left"}})],1)])]),t._v(" "),t._m(4),t._v(" "),a("div",{staticClass:"col-sm-12 mb-3 col-md-12 col-lg-12 d-flex justify-content-center"},[a("dialogueBtn",{attrs:{onClick:t.redirect,icon:"fas fa-sign-in-alt",text:"Login",styles:{backgroundColor:"#F1B814",color:"white"}}})],1)])])])])])},staticRenderFns:[function(){var t=this,e=t.$createElement,o=t._self._c||e;return o("div",{staticClass:"SubQoute"},[o("h1",{staticClass:"QouteText",staticStyle:{color:"#01004E"}},[t._v("Become A Local Expert")])])},function(){var t=this,e=t.$createElement,o=t._self._c||e;return o("div",{staticClass:"SubQoute"},[o("h1",{staticClass:"QouteText",staticStyle:{color:"#01009A"}},[t._v("With Automated Social Media Posting.")])])},function(){var t=this,e=t.$createElement,o=t._self._c||e;return o("div",{staticClass:"d-flex justify-content-center pt-5 pb-5 mb-3"},[o("b",[t._v("Reset Password with AskThePros")])])},function(){var t=this,e=t.$createElement,o=t._self._c||e;return o("div",{staticClass:"d-flex justify-content-center orSeparatorA"},[o("b",[t._v("OR")])])},function(){var t=this,e=t.$createElement,o=t._self._c||e;return o("div",{staticClass:"d-flex justify-content-center orSeparatorB"},[o("b",[t._v("OR")])])}]}}});
//# sourceMappingURL=18.06df7fb6b696b315c74c.js.map