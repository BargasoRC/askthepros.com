webpackJsonp([23],{477:function(t,a,e){e(692);var s=e(329)(e(565),e(770),"data-v-5a402f1b",null);t.exports=s.exports},508:function(t,a,e){"use strict";e(38);a.a={sidebarMenu:[{accountType:"USER",showOnAdmin:!1,accountStatus:"ALL",description:"Dashboard",icon:"fa fa-tachometer",path:"dashboard",flag:!1,subMenu:null},{accountType:"EXPERT",showOnAdmin:!0,accountStatus:"ALL",description:"Dashboard",icon:"fa fa-tachometer",path:"dashboard",flag:!1,subMenu:null},{accountType:"ADMIN",showOnAdmin:!0,accountStatus:"ALL",description:"Post Management",icon:"fas fa-play",path:"post_management",flag:!1,subMenu:null},{accountType:"ADMIN",showOnAdmin:!0,accountStatus:"ALL",description:"Accounts Management",icon:"fa fa-tachometer",path:"accounts",flag:!1,subMenu:null},{accountType:"ADMIN",showOnAdmin:!0,accountStatus:"ALL",description:"Billing Management",icon:"fa fa-tachometer",path:"billing_management",flag:!1,subMenu:null},{accountType:"ADMIN",showOnAdmin:!0,accountStatus:"ALL",description:"Subscription Management",icon:"fa fa-tachometer",path:"subscriptions_management",flag:!1,subMenu:null},{accountType:"USER",showOnAdmin:!1,accountStatus:"ALL",description:"Post Management",icon:"fa fa-credit-card",path:"post_management",flag:!1,subMenu:null},{accountType:"USER",showOnAdmin:!1,accountStatus:"ALL",description:"Social Media Channels",icon:"fa fa-credit-card",path:"channels",flag:!1,subMenu:null},{accountType:"USER",showOnAdmin:!0,accountStatus:"ALL",description:"Account Settings",icon:"fa fa-cogs",path:"settings",flag:!1,subMenu:null},{accountType:"USER",showOnAdmin:!1,accountStatus:"ALL",description:"Subscription",icon:"fa fa-credit-card",path:"subscriptions",flag:!1,subMenu:null},{accountType:"USER",showOnAdmin:!1,accountStatus:"ALL",description:"Payments",icon:"fa fa-credit-card",path:"payments",flag:!1,subMenu:null}],menuOff:[{id:1,users:"ALL",parent_id:0,description:"Dashboard",icon:"fa fa-tachometer",path:"dashboard",flag:!1,subMenu:null}],APP_NAME:"askthepros.com",APP_NAME_HTML:"askthepros.com",APP_EMAIL:"support@payhiram.ph",APP_SITE:"https://askthepros.com",COMPANY:"Ask The Pros",COMPANY_URL:"http://askthepros.com",COPYRIGHT:"askthepros.com "+(new Date).getFullYear(),USER_TYPE:[{title:"USER"}],pusher:{channel:"askthepros"},USER_TYPE_SETTING:!1,plan:!1,broadcastingFlag:!0,header:["status","notification"],settingsMenu:[{title:"Profile",type:"profile",allowed:["cellular_number","address","sex","birth_date"]},{title:"Account",type:"account",allowed:[]},{title:"Business Profile",type:"merchant",allowed:["email","address"]},{title:"Notifications",type:"notification",allowed:[]},{title:"Identifications",type:"identifications",allowed:[]}],setFag:function(t){this.sidebarMenu.map(function(a){"/"+a.path===t?a.flag=!0:a.flag=!1})}}},528:function(t,a){t.exports="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAMgAAADICAYAAACtWK6eAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyNpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuNi1jMDE0IDc5LjE1Njc5NywgMjAxNC8wOC8yMC0wOTo1MzowMiAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wTU09Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9tbS8iIHhtbG5zOnN0UmVmPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvc1R5cGUvUmVzb3VyY2VSZWYjIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6OTk2QkI4RkE3NjE2MTFFNUE4NEU4RkIxNjQ5MTYyRDgiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6OTk2QkI4Rjk3NjE2MTFFNUE4NEU4RkIxNjQ5MTYyRDgiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENDIChNYWNpbnRvc2gpIj4gPHhtcE1NOkRlcml2ZWRGcm9tIHN0UmVmOmluc3RhbmNlSUQ9InhtcC5paWQ6NjU2QTEyNzk3NjkyMTFFMzkxODk4RDkwQkY4Q0U0NzYiIHN0UmVmOmRvY3VtZW50SUQ9InhtcC5kaWQ6NjU2QTEyN0E3NjkyMTFFMzkxODk4RDkwQkY4Q0U0NzYiLz4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz5WHowqAAAXNElEQVR42uxda4xd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"},565:function(t,a,e){"use strict";Object.defineProperty(a,"__esModule",{value:!0});var s=e(52),i=(e(66),e(38)),n=e(508);a.default={name:"",mounted:function(){this.code=this.$route.params.code,this.username=this.$route.params.username},data:function(){return{email:null,flag:!1,errorMessage:null,password:null,cPassword:null,code:this.$route.params.code,username:this.$route.params.username,updateFlag:!1,config:i.default,common:n.a,visibility:"password",visibilityC:"password"}},methods:{showPassword:function(t){"password"===t?this.visibility="text":this.visibilityC="text"},hidePassword:function(t){"cpassword"===t?this.visibilityC="password":this.visibility="password"},reset:function(){var t=this;if(this.validate(),!0===this.flag){var a={username:this.username,code:this.code,password:this.password};$("#loading").css({display:"block"}),this.APIRequest("accounts/update",a).then(function(a){$("#loading").css({display:"none"}),!0===a.data?t.updateFlag=!0:t.updateFlag=!1})}},validate:function(){null===this.password||""===this.password||null===this.cPassword||""===this.cPassword?(this.flag=!1,this.errorMessage="Please fill in all required fields."):this.password!==this.cPassword?(this.flag=!1,this.errorMessage="Please confirm your new password."):this.password.length<8?(this.flag=!1,this.errorMessage="Password length must be greater than 8 digit characters."):/^[a-zA-Z0-9]+$/.test(this.password)?(this.flag=!1,this.errorMessage="Password must be alphanumeric characters. It should contain 1 number, 1 special character and letters."):(this.flag=!0,this.errorMessage=null)},redirect:function(t){s.a.push(t)}}}},639:function(t,a,e){a=t.exports=e(472)(),a.push([t.i,".holder[data-v-5a402f1b]{margin-top:25px}.custom-holder[data-v-5a402f1b]{margin-top:100px}.signup-header[data-v-5a402f1b]{height:100px;color:#060;width:100%;float:left;text-align:center}.signup-header img[data-v-5a402f1b]{height:100px!important;width:auto!important}.signup-header img[data-v-5a402f1b]:hover{cursor:pointer}.header-title[data-v-5a402f1b]{width:90%;margin:25px 5% 0;font-size:24px;font-weight:700px}.input-holder[data-v-5a402f1b]{width:90%;margin:0 5%}.form-control[data-v-5a402f1b]{height:45px!important}.btn[data-v-5a402f1b]{height:50px!important}.site-title[data-v-5a402f1b]{margin-top:25px;width:100%;float:left}.site-title img[data-v-5a402f1b]{width:50px;float:left;margin-right:10px;margin-left:5%}.site-title .app-name[data-v-5a402f1b]{float:left}.recover-addon[data-v-5a402f1b]{width:170px}.form-spacer[data-v-5a402f1b]{margin-top:10px}.input-group label[data-v-5a402f1b]{width:100%;float:left;line-height:50px;text-align:center}.input-group label b[data-v-5a402f1b]:hover{cursor:pointer}.input-group-addon[data-v-5a402f1b]{width:15%!important;text-align:center!important;padding:0!important;display:block!important;line-height:43px!important}@media (max-width:991px){.custom-holder[data-v-5a402f1b]{box-shadow:0 0 0 0 #fff!important;margin-top:50px!important}}","",{version:3,sources:["C:/xampp/htdocs/askthepros.com/src/components/increment/basic/ResetPassword.vue"],names:[],mappings:"AACA,yBACE,eAAiB,CAClB,AACD,gCACE,gBAAkB,CACnB,AACD,gCACE,aAAc,AACd,WAAe,AACf,WAAY,AACZ,WAAY,AACZ,iBAAmB,CACpB,AACD,oCACE,uBAAyB,AACzB,oBAAuB,CACxB,AACD,0CACE,cAAgB,CACjB,AACD,+BACE,UAAW,AACX,iBAAsB,AACtB,eAAgB,AAChB,iBAAmB,CACpB,AACD,+BACE,UAAW,AACX,WAAmB,CACpB,AACD,+BACE,qBAAwB,CACzB,AACD,sBACE,qBAAwB,CACzB,AACD,6BACE,gBAAiB,AACjB,WAAY,AACZ,UAAY,CACb,AACD,iCAEE,WAAY,AACZ,WAAY,AACZ,kBAAmB,AACnB,cAAgB,CACjB,AACD,uCACE,UAAY,CACb,AACD,gCACE,WAAa,CACd,AACD,8BACE,eAAiB,CAClB,AACD,oCACE,WAAY,AACZ,WAAY,AACZ,iBAAkB,AAClB,iBAAmB,CACpB,AACD,4CACE,cAAgB,CACjB,AACD,oCACE,oBAAsB,AACtB,4BAA8B,AAC9B,oBAAwB,AACxB,wBAA0B,AAC1B,0BAA6B,CAC9B,AAED,yBACA,gCACI,kCAAoC,AACpC,yBAA4B,CAC/B,CACA",file:"ResetPassword.vue",sourcesContent:["\n.holder[data-v-5a402f1b]{\r\n  margin-top: 25px;\n}\n.custom-holder[data-v-5a402f1b]{\r\n  margin-top: 100px;\n}\n.signup-header[data-v-5a402f1b]{\r\n  height: 100px;\r\n  color: #006600;\r\n  width: 100%;\r\n  float: left;\r\n  text-align: center;\n}\n.signup-header img[data-v-5a402f1b]{\r\n  height: 100px !important;\r\n  width: auto !important;\n}\n.signup-header img[data-v-5a402f1b]:hover{\r\n  cursor: pointer;\n}\n.header-title[data-v-5a402f1b]{\r\n  width: 90%;\r\n  margin:  25px 5% 0 5%;\r\n  font-size: 24px;\r\n  font-weight: 700px;\n}\n.input-holder[data-v-5a402f1b]{\r\n  width: 90%;\r\n  margin:  0 5% 0 5%;\n}\n.form-control[data-v-5a402f1b]{\r\n  height: 45px !important;\n}\n.btn[data-v-5a402f1b]{\r\n  height: 50px !important;\n}\n.site-title[data-v-5a402f1b]{\r\n  margin-top: 25px;\r\n  width: 100%;\r\n  float: left;\n}\n.site-title img[data-v-5a402f1b]{\r\n  width: 50px;\r\n  width: 50px;\r\n  float: left;\r\n  margin-right: 10px;\r\n  margin-left: 5%;\n}\n.site-title .app-name[data-v-5a402f1b]{\r\n  float: left;\n}\n.recover-addon[data-v-5a402f1b]{\r\n  width: 170px;\n}\n.form-spacer[data-v-5a402f1b]{\r\n  margin-top: 10px;\n}\n.input-group label[data-v-5a402f1b]{\r\n  width: 100%;\r\n  float: left;\r\n  line-height: 50px;\r\n  text-align: center;\n}\n.input-group label b[data-v-5a402f1b]:hover{\r\n  cursor: pointer;\n}\n.input-group-addon[data-v-5a402f1b]{\r\n  width: 15% !important;\r\n  text-align: center !important;\r\n  padding: 0px !important;\r\n  display: block !important;\r\n  line-height: 43px !important;\n}\r\n/*-------------- Extra Small Screen for Mobile Phones --------------*/\n@media (max-width: 991px){\n.custom-holder[data-v-5a402f1b]{\r\n    box-shadow: 0 0 0 0 #fff !important;\r\n    margin-top: 50px !important;\n}\n}\r\n"],sourceRoot:""}])},692:function(t,a,e){var s=e(639);"string"==typeof s&&(s=[[t.i,s,""]]),s.locals&&(t.exports=s.locals);e(473)("70722a06",s,!0)},770:function(t,a,e){t.exports={render:function(){var t=this,a=t.$createElement,s=t._self._c||a;return s("div",{staticClass:"row holder"},[s("div",{staticClass:"col-lg-4 col-md-6 mx-auto custom-holder"},[s("div",{staticClass:"signup-header",staticStyle:{"margin-top":"50px"}},[s("img",{attrs:{src:e(528)},on:{click:function(a){return t.redirect("/")}}})]),t._v(" "),s("span",{staticStyle:{width:"100%",float:"left","text-align":"center","font-size":"20px","margin-bottom":"20px"}},[t._v("\n      Reset Password\n    ")]),t._v(" "),s("div",{staticClass:"input-holder"},[""!=t.errorMessage&&!1===t.updateFlag?s("div",{staticClass:"login-message-holder login-spacer"},[null!==t.errorMessage?s("span",{staticClass:"text-danger text-center"},[s("b",[t._v("Oops!")]),t._v(" "+t._s(t.errorMessage))]):t._e()]):t._e(),t._v(" "),!0===t.updateFlag?s("div",{staticClass:"login-message-holder login-spacer"},[s("span",{staticClass:"text-center"},[t._v("Your password was successully updated! To login click the button below.")])]):t._e(),t._v(" "),!1===t.updateFlag?s("div",{staticClass:"input-group form-spacer"},[t._m(0),t._v(" "),"checkbox"===t.visibility?s("input",{directives:[{name:"model",rawName:"v-model",value:t.password,expression:"password"}],staticClass:"form-control form-control-login",staticStyle:{"border-right-style":"none"},attrs:{placeholder:"New Password","aria-describedby":"addon-2",type:"checkbox"},domProps:{checked:Array.isArray(t.password)?t._i(t.password,null)>-1:t.password},on:{change:function(a){var e=t.password,s=a.target,i=!!s.checked;if(Array.isArray(e)){var n=t._i(e,null);s.checked?n<0&&(t.password=e.concat([null])):n>-1&&(t.password=e.slice(0,n).concat(e.slice(n+1)))}else t.password=i}}}):"radio"===t.visibility?s("input",{directives:[{name:"model",rawName:"v-model",value:t.password,expression:"password"}],staticClass:"form-control form-control-login",staticStyle:{"border-right-style":"none"},attrs:{placeholder:"New Password","aria-describedby":"addon-2",type:"radio"},domProps:{checked:t._q(t.password,null)},on:{change:function(a){t.password=null}}}):s("input",{directives:[{name:"model",rawName:"v-model",value:t.password,expression:"password"}],staticClass:"form-control form-control-login",staticStyle:{"border-right-style":"none"},attrs:{placeholder:"New Password","aria-describedby":"addon-2",type:t.visibility},domProps:{value:t.password},on:{input:function(a){a.target.composing||(t.password=a.target.value)}}}),t._v(" "),s("span",{staticClass:"input-group-addon",staticStyle:{background:"white"}},["password"==t.visibility?s("i",{staticClass:"fa fa-eye",attrs:{"aria-hidden":"true"},on:{click:function(a){return t.showPassword("password")}}}):t._e(),t._v(" "),"text"==t.visibility?s("i",{staticClass:"fa fa-eye-slash",attrs:{"aria-hidden":"true"},on:{click:function(a){return t.hidePassword("password")}}}):t._e()])]):t._e(),t._v(" "),!1===t.updateFlag?s("div",{staticClass:"input-group form-spacer"},[t._m(1),t._v(" "),"checkbox"===t.visibilityC?s("input",{directives:[{name:"model",rawName:"v-model",value:t.cPassword,expression:"cPassword"}],staticClass:"form-control form-control-login",staticStyle:{"border-right-style":"none"},attrs:{placeholder:"Confirm New Password","aria-describedby":"addon-2",type:"checkbox"},domProps:{checked:Array.isArray(t.cPassword)?t._i(t.cPassword,null)>-1:t.cPassword},on:{change:function(a){var e=t.cPassword,s=a.target,i=!!s.checked;if(Array.isArray(e)){var n=t._i(e,null);s.checked?n<0&&(t.cPassword=e.concat([null])):n>-1&&(t.cPassword=e.slice(0,n).concat(e.slice(n+1)))}else t.cPassword=i}}}):"radio"===t.visibilityC?s("input",{directives:[{name:"model",rawName:"v-model",value:t.cPassword,expression:"cPassword"}],staticClass:"form-control form-control-login",staticStyle:{"border-right-style":"none"},attrs:{placeholder:"Confirm New Password","aria-describedby":"addon-2",type:"radio"},domProps:{checked:t._q(t.cPassword,null)},on:{change:function(a){t.cPassword=null}}}):s("input",{directives:[{name:"model",rawName:"v-model",value:t.cPassword,expression:"cPassword"}],staticClass:"form-control form-control-login",staticStyle:{"border-right-style":"none"},attrs:{placeholder:"Confirm New Password","aria-describedby":"addon-2",type:t.visibilityC},domProps:{value:t.cPassword},on:{input:function(a){a.target.composing||(t.cPassword=a.target.value)}}}),t._v(" "),s("span",{staticClass:"input-group-addon",staticStyle:{background:"white"}},["password"==t.visibilityC?s("i",{staticClass:"fa fa-eye",attrs:{"aria-hidden":"true"},on:{click:function(a){return t.showPassword("cpassword")}}}):t._e(),t._v(" "),"text"==t.visibilityC?s("i",{staticClass:"fa fa-eye-slash",attrs:{"aria-hidden":"true"},on:{click:function(a){return t.hidePassword("cpassword")}}}):t._e()])]):t._e(),t._v(" "),s("br"),t._v(" "),!1===t.updateFlag?s("button",{staticClass:"btn btn-primary btn-block login-spacer",on:{click:function(a){return t.reset()}}},[t._v("Continue")]):t._e(),t._v(" "),s("div",{staticClass:"input-group login-spacer",staticStyle:{"margin-top":"50px","border-top":"solid 1px #ddd"}},[s("label",[s("b",{staticClass:"text-primary",on:{click:function(a){return t.redirect("/login")}}},[t._v("Back to login")])])]),t._v(" "),s("br"),t._v(" "),s("br")])])])},staticRenderFns:[function(){var t=this,a=t.$createElement,e=t._self._c||a;return e("span",{staticClass:"input-group-addon recover-addon",attrs:{id:"addon-2"}},[e("i",{staticClass:"fa fa-key"})])},function(){var t=this,a=t.$createElement,e=t._self._c||a;return e("span",{staticClass:"input-group-addon recover-addon",attrs:{id:"addon-2"}},[e("i",{staticClass:"fa fa-key"})])}]}}});
//# sourceMappingURL=23.50e63e71d06d12883ac3.js.map