!function(){"use strict";var t=window.wp.i18n,e=window.wp.hooks;const l=t=>"#"===t[0]?document.getElementById(t.slice(1)):document.querySelectorAll(t);(0,e.addAction)("tablepress.optionsCheckDependencies","tp/datatables-column-filter/handle-options-check-dependencies",(()=>{const t=tp.table.options.table_head&&tp.table.options.use_datatables&&tp.table.options.datatables_filter,e=l("#notice-datatables-column-filter-requirements");e.style.display=t?"none":"block",document.querySelectorAll("#option-datatables_column_filter-select,#option-datatables_column_filter-input").forEach((l=>{l.disabled=!t,l.nextElementSibling.title=t?"":e.textContent}));const o=t&&""!==tp.table.options.datatables_column_filter;l("#option-datatables_column_filter_position").disabled=!o;const a=tp.table.options.table_foot,i=l("#option-datatables_column_filter_position-table_foot");i.disabled=!a;const s=l("#notice-datatables-column-filter-position-requirements");i.title=a?"":s.textContent,s.style.display=a?"none":"inline"})),(0,e.addFilter)("tablepress.optionsMetaBoxes","tp/datatables-column-filter/add-meta-box",(t=>(t.push("#tablepress_edit-datatables-column-filter"),t))),(0,e.addFilter)("tablepress.optionsValidateFields","tp/responsive-tables/validate-fields",(e=>{if(""!==tp.table.options.datatables_column_filter&&!(tp.table.options.use_datatables&&tp.table.options.table_head&&tp.table.options.datatables_filter)){window.alert((0,t.sprintf)((0,t.__)("The entered value in the “%1$s” field is invalid.","tablepress"),(0,t.__)("Form element","tablepress")));const o=l("#option-datatables_column_filter-");o.focus(),o.select(),e=!1}if("table_foot"===tp.table.options.datatables_column_filter_position&&""!==tp.table.options.datatables_column_filter&&!tp.table.options.table_foot){window.alert((0,t.sprintf)((0,t.__)("The entered value in the “%1$s” field is invalid.","tablepress"),(0,t.__)("Position","tablepress")));const o=l("#option-datatables_column_filter_position");o.focus(),o.select(),e=!1}return e}))}();