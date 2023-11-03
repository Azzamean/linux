!function(){"use strict";var e={n:function(t){var r=t&&t.__esModule?function(){return t.default}:function(){return t};return e.d(r,{a:r}),r},d:function(t,r){for(var a in r)e.o(r,a)&&!e.o(t,a)&&Object.defineProperty(t,a,{enumerable:!0,get:r[a]})},o:function(e,t){return Object.prototype.hasOwnProperty.call(e,t)}},t=window.React,r=window.wp.i18n,a=window.wp.hooks,n=window.wp.compose,l=window.wp.blockEditor,s=window.wp.components,o=window.wp.shortcode,i=e.n(o),c=JSON.parse('{"u2":"tablepress/table"}');const p=function(e){const{tableOption:r,shortcodeAttrs:a,setAttributes:n,...l}=e;return(0,t.createElement)(s.TextControl,{value:a.named[r]||tp.table.template[r],onChange:e=>{tp.table.template[r]===e?delete a.named[r]:a.named[r]=e;const t=(e=>{let t=Object.entries(e.named).map((([e,t])=>{let r="";return t=t.replace(/“([^”]*)”/g,"$1"),(/\s/.test(t)||""===t)&&(r='"'),t.includes('"')&&(r="'"),`${e}=${r}${t}${r}`})).join(" ");return e.numeric.forEach((e=>{/\s/.test(e)?t+=' "'+e+'"':t+=" "+e})),t})(a);n({parameters:t})},...l})},d=(0,n.createHigherOrderComponent)((e=>a=>{if(c.u2!==a.name)return(0,t.createElement)(e,{...a});const{attributes:n,setAttributes:o}=a;if(!n.id||!tp.tables.hasOwnProperty(n.id))return(0,t.createElement)(e,{...a});let d=i().attrs(n.parameters);d={named:{...d.named},numeric:[...d.numeric]};const b={shortcodeAttrs:d,setAttributes:o};return(0,t.createElement)(t.Fragment,null,(0,t.createElement)(e,{...a}),(0,t.createElement)(l.InspectorControls,null,(0,t.createElement)(s.PanelBody,{title:(0,r.__)("Automatic Filtering","tablepress"),initialOpen:!1,className:"wp-block-tablepress-table-inspector-panel"},(0,t.createElement)(p,{label:(0,r.__)("Search term:","tablepress"),help:(0,r.__)("The table will be automatically filtered for this search term.","tablepress")+" "+(0,r.sprintf)((0,r.__)("This feature is only available when the “%1$s”, “%2$s”, and “%3$s” checkboxes in the “%4$s” and “%5$s” sections are checked.","tablepress"),(0,r.__)("Table Head Row","tablepress"),(0,r.__)("Enable Visitor Features","tablepress"),(0,r.__)("Search/Filtering","tablepress"),(0,r.__)("Table Options","tablepress"),(0,r.__)("Table Features for Site Visitors","tablepress")),tableOption:"datatables_auto_filter",...b}),(0,t.createElement)(p,{label:(0,r.__)("Search term URL parameter:","tablepress"),help:(0,r.__)("Instead, or in addition, of using a pre-defined search term, a URL parameter like “table_filter” can be used.","tablepress"),tableOption:"datatables_auto_filter_url_parameter",...b}))))}),"addTableBlockSidebarControls");(0,a.addFilter)("editor.BlockEdit","tp/datatables-auto-filter/add-table-block-sidebar-controls",d)}();