!function(){"use strict";var t=window.wp.i18n,e=window.wp.hooks;const l=t=>"#"===t[0]?document.getElementById(t.slice(1)):document.querySelectorAll(t);(0,e.addAction)("tablepress.optionsCheckDependencies","tp/datatables-columnfilterwidgets/handle-options-check-dependencies",(()=>{const t=tp.table.options.use_datatables&&tp.table.options.table_head&&tp.table.options.datatables_filter;l("#option-datatables_columnfilterwidgets").disabled=!t,l("#option-datatables_columnfilterwidgets_exclude_columns").disabled=!t||!tp.table.options.datatables_columnfilterwidgets,l("#option-datatables_columnfilterwidgets_separator").disabled=!t||!tp.table.options.datatables_columnfilterwidgets,l("#option-datatables_columnfilterwidgets_max_selections").disabled=!t||!tp.table.options.datatables_columnfilterwidgets,l("#option-datatables_columnfilterwidgets_group_terms").disabled=!t||!tp.table.options.datatables_columnfilterwidgets,l("#notice-datatables-columnfilterwidgets-requirements").style.display=t?"none":"block"})),(0,e.addFilter)("tablepress.optionsMetaBoxes","tp/datatables-columnfilterwidgets/add-meta-box",(t=>(t.push("#tablepress_edit-datatables-columnfilterwidgets"),t))),(0,e.addFilter)("tablepress.optionsValidateFields","tp/datatables-columnfilterwidgets/validate-fields",(e=>{if(/[^a-z,]/.test(tp.table.options.datatables_columnfilterwidgets)){window.alert((0,t.sprintf)((0,t.__)("The entered value in the “%1$s” field is invalid.","tablepress"),(0,t.__)("Column Filter Dropdowns","tablepress")));const a=l("#option-datatables_columnfilterwidgets");a.focus(),a.select(),e=!1}return e}))}();