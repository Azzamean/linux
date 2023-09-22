"use strict";(self.webpackChunkgravityforms=self.webpackChunkgravityforms||[]).push([[319],{7667:function(t,e,r){r.r(e);var o=r(5210),n=r(7063),i=r(9662),a=r(6132),c=r(4489),s=r(1747),l=r(1519),u=r.n(l);function d(t,e){var r=Object.keys(t);if(Object.getOwnPropertySymbols){var o=Object.getOwnPropertySymbols(t);e&&(o=o.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),r.push.apply(r,o)}return r}function f(t){for(var e=1;e<arguments.length;e++){var r=null!=arguments[e]?arguments[e]:{};e%2?d(Object(r),!0).forEach((function(e){(0,n.Z)(t,e,r[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(r)):d(Object(r)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(r,e))}))}return t}var p=function(t){var e=Object.entries(t).filter((function(t){var e=(0,o.Z)(t,2),r=e[0],n=e[1];return g().includes(r)&&"string"==typeof n}));return Object.fromEntries(e)},g=function(){return["theme","inputSize","inputBorderRadius","inputBorderColor","inputBackgroundColor","inputPrimaryColor","inputColor","labelFontSize","labelColor","descriptionFontSize","descriptionColor","buttonPrimaryBackgroundColor","buttonPrimaryColor"]},m=function(t,e){new(u())({alertButtonText:(0,i.__)("OK","gravityforms"),content:e,closeButtonTitle:(0,i.__)("Close","gravityforms"),id:"copy-paste-error-alert",maskBlur:!1,maskTheme:"none",mode:"alert",title:t,titleIcon:"circle-delete",titleIconColor:"#DD301D",zIndex:100055}).showDialog()},y=function(){return!!window.isSecureContext||(m((0,i.__)("Copy / Paste Not Available","gravityforms"),(0,i.__)("Copy and paste functionality requires a secure connection. Reload this page using an HTTPS URL and try again.","gravityforms")),!1)},v=function(){return!(navigator.userAgent.indexOf("Firefox")>-1&&"function"!=typeof navigator.clipboard.readText&&(m((0,i.__)("Paste Not Available","gravityforms"),(0,i.__)("Your browser does not have permission to paste from the clipboard. <p>Please navigate to <strong>about:config</strong> and change the preference <strong>dom.events.asyncClipboard.readText</strong> to <strong>true</strong>.","gravityforms")),1))};e.default=function(){return React.createElement(s.Fragment,null,React.createElement(a.PluginBlockSettingsMenuItem,{allowedBlocks:["gravityforms/form"],icon:"",label:(0,i.__)("Copy Form Styles","gravityforms"),onClick:function(){return function(){if(y()){var t=(0,c.select)("core/block-editor").getSelectedBlock();navigator.clipboard.writeText(JSON.stringify(p(t.attributes))).then()}}()}}),React.createElement(a.PluginBlockSettingsMenuItem,{allowedBlocks:["gravityforms/form"],icon:"",label:(0,i.__)("Paste Form Styles","gravityforms"),onClick:function(){y()&&v()&&navigator.clipboard.readText().then((function(t){var e=f({},(0,c.select)("core/block-editor").getSelectedBlock());try{var r=p(JSON.parse(t));e.attributes=f(f({},e.attributes),r),(0,c.dispatch)("core/block-editor").updateBlock(e.clientId,e)}catch(t){m((0,i.__)("Invalid Form Styles","gravityforms"),(0,i.__)("Please ensure the form styles you are trying to paste are in the correct format.","gravityforms"))}}))}}))}},8284:function(t,e,r){r.r(e),r.d(e,{default:function(){return g}});var o=r(5518),n=r(9841),i=r(7329),a=r.n(i),c=window.wp||{},s=(null===a()||void 0===a()?void 0:a().block_editor)||{},l={ready:!1},u={insertButton:null},d=function(t){return c.data.select("core/blocks").getBlockTypes().filter((function(e){return!t||"gravityforms/form"!==e.name})).map((function(t){return t.name}))},f=function(){console.info("Gravity Forms Admin: Resetting Inserter Blocks State"),c.data.dispatch("core/edit-post").showBlockTypes(d(!1))},p=function(){var t=(0,o.queryToJson)();null!=t&&t.gfAddBlock&&(function(){var t;window.wp.data.dispatch("core/edit-post").setIsInserterOpened(!0),t=d(!0),c.data.dispatch("core/edit-post").hideBlockTypes(t),c.data.dispatch("core/edit-post").showBlockTypes(["gravityforms/form"]);var e=setInterval((function(){var t,r,n;u.insertButton=document.querySelector(".editor-block-list-item-gravityforms-form"),u.insertButton&&(l.ready=!0,r=document.createElement("div"),n=u.insertButton.getBoundingClientRect(),r.innerHTML='\n\t<div class="gform-block__tooltip-inner">\n\t\t<span class="gform-block__tooltip-title">'.concat(s.i18n.insert_gform_block_title,"</span>\n\t\t").concat((0,o.sprintf)(s.i18n.insert_gform_block_content,'<a class="gform-link" href="'.concat(s.urls.block_docs,'" rel="noopener" target="_blank">'),"</a>"),"\n\t</div>\n\t"),r.classList.add("gform-block__tooltip"),(0,o.isRtl)()?r.style="left: ".concat(n.right-(275+u.insertButton.clientWidth),"px; top: ").concat(n.top+u.insertButton.clientHeight/2,"px;"):r.style="left: ".concat(n.right+20,"px; top: ").concat(n.top+u.insertButton.clientHeight/2,"px;"),u.insertButton.addEventListener("mouseenter",(function(){r&&(r.style.opacity="0",setTimeout((function(){r.style.zIndex="-1"}),200))})),u.insertButton.parentNode.appendChild(r),t=c.data.subscribe((function(){c.data.select("core/block-editor").getBlocks().filter((function(t){return"gravityforms/form"===t.name&&void 0===t.originalContent})).length&&(t(),f())}))),l.ready&&clearInterval(e)}),500)}(),window.addEventListener("beforeunload",f),(0,o.consoleInfo)("Gravity Forms Admin: Initialized block editor insert form scripts."))},g=function(){if(p(),void 0!==r(6132)){var t=r(7667);(0,n.registerPlugin)("gravityforms",{render:t.default}),(0,o.consoleInfo)("Gravity Forms Admin: Initialized all block editor scripts.")}}}}]);
//# sourceMappingURL=scripts-admin.block-editor.f6faf5a46ff0e6e79de3.js.map