!function(){"use strict";var e=window.React,t=window.ReactDOM,o=window.wp.components,r=window.wp.primitives,l=(0,e.createElement)(r.SVG,{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24"},(0,e.createElement)(r.Path,{d:"M12 3.2c-4.8 0-8.8 3.9-8.8 8.8 0 4.8 3.9 8.8 8.8 8.8 4.8 0 8.8-3.9 8.8-8.8 0-4.8-4-8.8-8.8-8.8zm0 16c-4 0-7.2-3.3-7.2-7.2C4.8 8 8 4.8 12 4.8s7.2 3.3 7.2 7.2c0 4-3.2 7.2-7.2 7.2zM11 17h2v-6h-2v6zm0-8h2V7h-2v2z"})),a=window.wp.i18n,c=({cssProperty:t,color:r,colorProperties:l,currentValues:c,onChange:n,onClose:s})=>{const d=l.filter((([e])=>e===t))[0][1],i="border"===d.category?d.name:(0,a.sprintf)((0,a.__)("%1$s %2$s color","tablepress"),d.name,d.category),m=l.filter((([e])=>{if(e===t)return!1;let o=c[e];for(;o.startsWith("var(");){const e=(o.match(/var\(([-a-z]+)\)/)?.[1]).trim();if(e===t)return!1;o=c[e]}return!0})).map((([e,t])=>{let o=c[e];for(;o.startsWith("var(");){const e=(o.match(/var\(([-a-z]+)\)/)?.[1]).trim();o=c[e]}let r=t.name;return"border"!==t.category&&(r+=" "+(0,a.sprintf)((0,a.__)("(%s color)","tablepress"),t.category)),{label:r,value:e,itemColor:o}})),v=r.startsWith("var(")?(r.match(/var\(([-a-z]+)\)/)?.[1]).trim():null;return(0,e.createElement)(o.Popover,{onClose:s},(0,e.createElement)("div",{style:{display:"flex",width:"500px"}},(0,e.createElement)("div",{style:{width:"50%"}},(0,e.createElement)(o.ColorPicker,{color:r,copyFormat:"hex",onChange:e=>n(t,e)})),(0,e.createElement)("div",{style:{width:"50%",padding:"20px"}},(0,e.createElement)(o.ComboboxControl,{label:(0,a.__)("Reference an existing color","tablepress"),help:(0,a.__)("Choose your desired color in the color picker on the left.","tablepress")+" "+(0,a.__)("Alternatively, select an existing color above, to create a reference to it.","tablepress")+" "+(0,a.sprintf)((0,a.__)("When that color is changed, the currently edited %s will automatically adapt as well.","tablepress"),i),options:m,value:v,onChange:e=>n(t,e),__experimentalRenderItem:({item:t})=>{const{label:o,itemColor:r}=t,l=(0,e.createElement)("span",{className:"component-color-indicator",style:{width:"14px",height:"14px",background:r,verticalAlign:"bottom"}});return(0,e.createElement)("div",null,(0,e.createElement)("div",{style:{marginBottom:"0.2rem"}},o),(0,e.createElement)("small",null,(0,a.__)("Color:","tablepress")+" ",l," "+r.toUpperCase()))}}))))},n=({cssProperty:t,color:r,name:l,colorProperties:a,currentValues:n,onChange:s})=>{const[d,i]=(0,e.useState)(!1);let m=r;for(;m.startsWith("var(");){const e=(m.match(/var\(([-a-z]+)\)/)?.[1]).trim();m=n[e]}return(0,e.createElement)("div",{style:{display:"flex",height:"36px"}},(0,e.createElement)("div",{style:{width:"50%",fontWeight:"bold"}},`${l}:`),(0,e.createElement)("div",null,(0,e.createElement)(o.ColorIndicator,{colorValue:m,onClick:i}),(0,e.createElement)(o.Button,{variant:"link",onClick:i,style:{verticalAlign:"top",paddingLeft:"8px",paddingTop:"2px",color:"#000000",textDecoration:"none"}},m.toUpperCase()),d&&(0,e.createElement)(c,{cssProperty:t,color:r,colorProperties:a,currentValues:n,onChange:s,onClose:i})))},s=({cssProperty:t,lengthValue:r,name:l,onChange:a})=>(0,e.createElement)(o.__experimentalUnitControl,{label:l,value:r,onChange:e=>a(t,e),style:{width:"120px"}}),d=({variation:t,variationName:r,variationCss:l,activeVariation:a,onChange:c})=>(0,e.createElement)("div",{className:"style-variation"},(0,e.createElement)("input",{type:"radio",name:"style-variation",id:`style-variation-${t}`,checked:t===a,onChange:c}),(0,e.createElement)("label",{htmlFor:`style-variation-${t}`},(0,e.createElement)("div",{className:"style-variation-content"},(0,e.createElement)("h3",null,r),(0,e.createElement)("p",null,["--head-bg-color","--head-active-bg-color","--odd-bg-color","--hover-bg-color","--border-color","--text-color"].map((t=>{let r=l[t];for(;r.startsWith("var(");){const e=(r.match(/var\(([-a-z]+)\)/)?.[1]).trim();r=l[e]}return(0,e.createElement)(o.ColorIndicator,{key:t,colorValue:r})})))))),i={default:{name:(0,a.__)("Blue","tablepress"),css:{"--style-variation":"default","--text-color":"#111111","--head-text-color":"var(--text-color)","--head-active-text-color":"var(--head-text-color)","--head-bg-color":"#d9edf7","--head-active-bg-color":"#049cdb","--odd-text-color":"var(--text-color)","--odd-bg-color":"#f9f9f9","--even-text-color":"var(--text-color)","--even-bg-color":"#ffffff","--hover-text-color":"var(--text-color)","--hover-bg-color":"#f3f3f3","--border-color":"#dddddd","--padding":"0.5rem"}},red:{name:(0,a.__)("Red","tablepress"),css:{"--style-variation":"red","--text-color":"#111111","--head-text-color":"var(--text-color)","--head-active-text-color":"var(--head-text-color)","--head-bg-color":"#fbaeae","--head-active-bg-color":"#dd0000","--odd-text-color":"var(--text-color)","--odd-bg-color":"#fbe7e7","--even-text-color":"var(--text-color)","--even-bg-color":"#ffffff","--hover-text-color":"var(--text-color)","--hover-bg-color":"#f6a1a1","--border-color":"#dddddd","--padding":"0.5rem"}},green:{name:(0,a.__)("Green","tablepress"),css:{"--style-variation":"green","--text-color":"#111111","--head-text-color":"var(--text-color)","--head-active-text-color":"var(--head-text-color)","--head-bg-color":"#c9f3ca","--head-active-bg-color":"#0cad0c","--odd-text-color":"var(--text-color)","--odd-bg-color":"#f2f7f2","--even-text-color":"var(--text-color)","--even-bg-color":"#ffffff","--hover-text-color":"var(--text-color)","--hover-bg-color":"#beeab8","--border-color":"#dddddd","--padding":"0.5rem"}},yellow:{name:(0,a.__)("Yellow","tablepress"),css:{"--style-variation":"yellow","--text-color":"#111111","--head-text-color":"var(--text-color)","--head-active-text-color":"var(--head-text-color)","--head-bg-color":"#fff3cd","--head-active-bg-color":"#f5d772","--odd-text-color":"var(--text-color)","--odd-bg-color":"#fffcf3","--even-text-color":"var(--text-color)","--even-bg-color":"#ffffff","--hover-text-color":"var(--text-color)","--hover-bg-color":"#fff1bf","--border-color":"#e6dbb9","--padding":"0.5rem"}},purple:{name:(0,a.__)("Purple","tablepress"),css:{"--style-variation":"purple","--text-color":"#111111","--head-text-color":"var(--text-color)","--head-active-text-color":"var(--head-text-color)","--head-bg-color":"#fde6fd","--head-active-bg-color":"#9370db","--odd-text-color":"var(--text-color)","--odd-bg-color":"#fff5ff","--even-text-color":"var(--text-color)","--even-bg-color":"#ffffff","--hover-text-color":"var(--text-color)","--hover-bg-color":"#e0b0ff","--border-color":"#dddddd","--padding":"0.5rem"}},dark:{name:(0,a.__)("Dark","tablepress"),css:{"--style-variation":"dark","--text-color":"#ffffff","--head-text-color":"var(--text-color)","--head-active-text-color":"var(--head-text-color)","--head-bg-color":"#101010","--head-active-bg-color":"#000000","--odd-text-color":"var(--text-color)","--odd-bg-color":"#202020","--even-text-color":"var(--text-color)","--even-bg-color":"#303030","--hover-text-color":"var(--text-color)","--hover-bg-color":"#404040","--border-color":"#404040","--padding":"0.5rem"}},light:{name:(0,a.__)("Light","tablepress"),css:{"--style-variation":"light","--text-color":"#111111","--head-text-color":"var(--text-color)","--head-active-text-color":"var(--head-text-color)","--head-bg-color":"#f6f6f6","--head-active-bg-color":"#e6e6e6","--odd-text-color":"var(--text-color)","--odd-bg-color":"#fcfcfc","--even-text-color":"var(--text-color)","--even-bg-color":"#ffffff","--hover-text-color":"var(--text-color)","--hover-bg-color":"#f0f0f0","--border-color":"#dddddd","--padding":"0.5rem"}}};const m=e=>{let t="";return Object.entries(e).forEach((([e,o])=>{o!==i.default.css[e]&&(t+=`\t${e}: ${o};\n`)})),""!==t&&(t=`.tablepress {\n${t}}`),t};var v={"--style-variation":{name:"",type:""},"--text-color":{name:(0,a.__)("Cell content","tablepress"),type:"color",category:"text"},"--head-text-color":{name:(0,a.__)("Head row","tablepress"),type:"color",category:"text"},"--head-active-text-color":{name:(0,a.__)("Active head cells","tablepress"),type:"color",category:"text"},"--head-bg-color":{name:(0,a.__)("Head row","tablepress"),type:"color",category:"background"},"--head-active-bg-color":{name:(0,a.__)("Active head cells","tablepress"),type:"color",category:"background"},"--odd-text-color":{name:(0,a.__)("Odd rows","tablepress"),type:"color",category:"text"},"--odd-bg-color":{name:(0,a.__)("Odd rows","tablepress"),type:"color",category:"background"},"--even-text-color":{name:(0,a.__)("Even rows","tablepress"),type:"color",category:"text"},"--even-bg-color":{name:(0,a.__)("Even rows","tablepress"),type:"color",category:"background"},"--hover-text-color":{name:(0,a.__)("Hovered row","tablepress"),type:"color",category:"text"},"--hover-bg-color":{name:(0,a.__)("Hovered row","tablepress"),type:"color",category:"background"},"--border-color":{name:(0,a.__)("Border color","tablepress"),type:"color",category:"border"},"--padding":{name:(0,a.__)("Cell padding","tablepress"),type:"length",category:"spacing"}};const p=`\n@import "${tablepress_default_style_customizer_settings.defaultCssUrl}";\n\nbody {\n\tfont-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;\n\tfont-size: 14px;\n}`;var b=({cssProperties:t})=>{const r=m(t),l=[p,r],a=`\n\n<div style="overflow-x: auto; overflow-y: hidden; -webkit-overflow-scrolling: touch;">\n<table id="tablepress-sandbox" class="tablepress tablepress-id-sandbox" style="margin-bottom: 0;">\n<thead>\n<tr class="row-1 odd"><th class="column-1 sorting sorting_asc">First Name</th><th class="column-2 sorting">Last Name</th><th class="column-3 sorting">Birthday</th><th class="column-4 sorting">Points</th></tr>\n</thead>\n<tbody class="row-hover">\n<tr class="row-2 even"><td class="column-1">Abra</td><td class="column-2">House</td><td class="column-3">08/10/1980</td><td class="column-4">6</td></tr>\n<tr class="row-3 odd"><td class="column-1">Cameron</td><td class="column-2">Walls</td><td class="column-3">11/20/1981</td><td class="column-4">2</td></tr>\n<tr class="row-4 even"><td class="column-1">Dillon</td><td class="column-2">Bradford</td><td class="column-3">01/20/1985</td><td class="column-4">7</td></tr>\n<tr class="row-5 odd"><td class="column-1">Fillian</td><td class="column-2">Simon</td><td class="column-3">05/12/1988</td><td class="column-4">10</td></tr>\n<tr class="row-6 even"><td class="column-1">Graham</td><td class="column-2">Bonner</td><td class="column-3">12/07/1983</td><td class="column-4">4</td></tr>\n<tr class="row-7 odd"><td class="column-1">Haley</td><td class="column-2">Mcleod</td><td class="column-3">04/12/1980</td><td class="column-4">4</td></tr>\n<tr class="row-8 even"><td class="column-1">Julia</td><td class="column-2">Haupt</td><td class="column-3">03/15/1991</td><td class="column-4">10</td></tr>\n<tr class="row-9 odd"><td class="column-1">Lionel</td><td class="column-2">Barry</td><td class="column-3">02/17/1980</td><td class="column-4">7</td></tr>\n</tbody>\n</table>\n</div>\n\n<pre style="display:none">${r}</pre>\n`;return(0,e.createElement)(o.SandBox,{title:"TablePress",html:a,styles:l})};const u=Object.entries(v).filter((([,e])=>"color"===e.type));((e,o)=>{const r=document.getElementById("tablepress-default-style-customizer-screen");r&&("function"==typeof t.createRoot?(0,t.createRoot)(r).render(o):(0,t.render)(o,r))})(0,(0,e.createElement)((()=>{const[t,r]=(0,e.useState)((()=>{let e=tp.CM_custom_css.getValue();return e=e.match(/\/\* TABLEPRESS DEFAULT STYLING \*\/\n\.tablepress {.*?}/gs)?.[0]||"",function(e){let t={};const o={...i.default.css},r=document.createElement("style");return document.implementation.createHTMLDocument("").body.appendChild(r),r.textContent=e,[...r.sheet.cssRules].forEach((e=>{".tablepress"===e.selectorText&&Object.keys(o).forEach((o=>{const r=e.style.getPropertyValue(o).trim();""!==r&&(t[o]=r)}))})),t={...o,...t},Object.entries(t).forEach((([e,r])=>{for(;r.startsWith("var(");){const l=(r.match(/var\(([-a-z]+)\)/)?.[1]).trim();if(l===e){t[e]=o[e];break}r=t[l]}})),t}(e)})()),[c,p]=(0,e.useState)("custom"!==t["--style-variation"]),h=(e,o)=>{null===o?o=i.default.css[e]:o.startsWith("--")&&(o=`var(${o})`);const l={...t,[e]:o,"--style-variation":"custom"};r(l)},g=[{name:"background",title:(0,a.__)("Background colors","tablepress")},{name:"text",title:(0,a.__)("Text colors","tablepress")},{name:"border",title:(0,a.__)("Border","tablepress")},{name:"spacing",title:(0,a.__)("Spacing","tablepress")}];return(0,e.createElement)("div",null,(0,e.createElement)("p",null,(0,a.__)("To change the default styling of your tables, choose an existing style variation or customize individual colors or properties.","tablepress"),(0,e.createElement)("br",null),(0,a.__)("Click the “Save to ‘Custom CSS’” button below to add the automatically generated code for your styling to the site’s “Custom CSS”.","tablepress")),(0,e.createElement)(o.Panel,null,(0,e.createElement)(o.PanelBody,{title:(0,a.__)("Style Variations","tablepress"),initialOpen:c},(0,e.createElement)(o.PanelRow,null,(0,e.createElement)("div",{className:"style-variation-wrapper"},Object.entries(i).map((([o,l])=>(0,e.createElement)(d,{key:o,variation:o,variationName:l.name,variationCss:l.css,activeVariation:t["--style-variation"],onChange:()=>{r({...l.css})}}))),(0,e.createElement)(d,{variation:"custom",variationName:(0,a.__)("Custom","tablepress"),variationCss:t,activeVariation:t["--style-variation"],onChange:()=>{h("--style-variation","custom"),p(!0)}}))))),(0,e.createElement)("div",{style:{display:"flex"}},(0,e.createElement)("div",{style:{width:"390px",borderLeft:"1px solid #e0e0e0",borderRight:"1px solid #e0e0e0",borderBottom:"1px solid #e0e0e0"}},(0,e.createElement)(o.Card,null,(0,e.createElement)(o.CardBody,{style:{boxShadow:"none"}},(0,e.createElement)("h2",{className:"card-title"},(0,a.__)("Custom style values","tablepress")),(0,e.createElement)(o.TabPanel,{tabs:g},(o=>(0,e.createElement)("div",{style:{paddingTop:"24px"}},Object.entries(v).filter((([,e])=>o.name===e.category)).map((([o,r])=>"color"===r.type?(0,e.createElement)(n,{key:o,cssProperty:o,color:t[o],name:r.name,colorProperties:u,currentValues:t,onChange:h}):"length"===r.type?(0,e.createElement)(s,{key:o,cssProperty:o,lengthValue:t[o],name:r.name,onChange:h}):(0,e.createElement)(e.Fragment,null))))))))),(0,e.createElement)("div",{style:{width:"calc(100% - 390px)",borderRight:"1px solid #e0e0e0",borderBottom:"1px solid #e0e0e0"}},(0,e.createElement)(o.Card,null,(0,e.createElement)(o.CardBody,null,(0,e.createElement)("h2",{className:"card-title"},(0,a.__)("Preview","tablepress")),(0,e.createElement)(b,{cssProperties:t}),(0,e.createElement)("p",{className:"info-text"},(0,e.createElement)(o.Icon,{icon:l}),(0,e.createElement)("span",null,(0,a.__)("Please note your site’s theme and plugins may also influence the table styling.","tablepress")," ",(0,a.__)("Tables on your site might look different!","tablepress"),(0,e.createElement)("br",null),(0,a.__)("To change the styling of individual tables, use “Custom CSS” code below.","tablepress"))))))),(0,e.createElement)(o.Card,null,(0,e.createElement)(o.CardBody,null,(0,e.createElement)(o.Button,{variant:"primary",onClick:()=>{(e=>{const t=m(e);let o=tp.CM_custom_css.getValue();o=o.replace(/\/\* TABLEPRESS DEFAULT STYLING \*\/.*?}/gs,"").trim(),o=`${""!==t?"/* TABLEPRESS DEFAULT STYLING */\n":""}${t}${""!==o&&""!==t?"\n\n":""}${o}`,tp.CM_custom_css.setValue(o)})(t),document.querySelector("#tablepress-page form").submit()}},(0,a.__)("Save to “Custom CSS”","tablepress")))))}),null))}();