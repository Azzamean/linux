<?php

/* PARSE GRAVITY FORM SUBMISSION TO POPULATE METADATA FOR ORGANIZATION */
add_action( 'gform_advancedpostcreation_post_after_creation_2', 'apc_serialize_checkboxes', 10, 4 );
function apc_serialize_checkboxes( $post_id, $feed, $entry, $form ) {
  
    // Checkboxes field id.
    $field_id = 11;
  
    // Get field object.
    $field = GFAPI::get_field( $form, $field_id );
   
    if ( $field->type == 'checkbox' ) {
        // Get a comma separated list of checkboxes checked
        $checked = $field->get_value_export( $entry );
   
        // Convert to array.
        $values = explode( ', ', $checked );
   
    }
  
    update_post_meta( $post_id, 'services_provided', $values );
}