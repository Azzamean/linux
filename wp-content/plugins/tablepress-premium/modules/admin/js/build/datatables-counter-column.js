(()=>{"use strict";const e=window.wp.hooks,t=e=>"#"===e[0]?document.getElementById(e.slice(1)):document.querySelectorAll(e);(0,e.addAction)("tablepress.optionsCheckDependencies","tp/datatables-counter-column/handle-options-check-dependencies",(()=>{const e=tp.table.options.use_datatables&&tp.table.options.table_head;t("#option-datatables_counter_column").disabled=!e,t("#notice-datatables-counter-column-requirements").style.display=e?"none":"block"})),(0,e.addFilter)("tablepress.optionsMetaBoxes","tp/datatables-counter-column/add-meta-box",(e=>(e.push("#tablepress_edit-datatables-counter-column"),e)))})();