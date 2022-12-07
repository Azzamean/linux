jQuery(document).ready(function () {

    jQuery('#communityTerms_form').on('submit', function (event) {
        event.preventDefault();
        if (typeof (tinyMCE) !== 'undefined') {
            tinyMCE.triggerSave();
        }
        var data = {};

        if (typeof (cmttct_data) !== 'undefined') {

            jQuery('#communityTerms_overlay').show();
            data['action'] = 'cmtt_handle_post';
            data['term_id'] = jQuery('input#cmtct_term_id').val();
            data['title'] = jQuery('#communityTerms_title input').val();
            data['description'] = jQuery('#communityTerms_description textarea').val();
            data['email'] = jQuery('#communityTerms_email input').val();
            data['logged_in'] = jQuery('#communityTerms_logged_in input').val();
            data['user_id'] = jQuery('input#cmtct_user_id').val();
            data['recaptcha_response_field'] = jQuery('#g-recaptcha-response').val();
            /*
             * New fields
             */
            data['excerpt'] = jQuery('#communityTerms_excerpt textarea').val();
            data['categories'] = jQuery('select#communityTerms_categories').val();
            data['tags'] = jQuery('select#communityTerms_tags').val();
            data['image'] = jQuery('input[name="communityTerms_image"]').val();
            data['synonyms'] = jQuery('#communityTerms_synonyms textarea').val();
            data['variations'] = jQuery('#communityTerms_variations textarea').val();
            data['abbreviations'] = jQuery('#communityTerms_abbreviations textarea').val();
            
            let private = jQuery('#communityTerms_private input[type="checkbox"]').is(':checked') || jQuery('#communityTerms_private input[type="hidden"]').val();
            data['private'] = private ? '1' : '0';

            jQuery.ajax({
                url: cmttct_data['ajaxurl'],
                data: {
                    'action': 'cmtt_handle_post',
                    'cmtct': data
                },
                type: 'POST',
                success: function (response) {
                    jQuery('#communityTerms_overlay').hide();
                    jQuery('#communityTerms_msg').html('<div class="alert alert-' + response.status + '">' + response.msg + '</div>');
                    jQuery('#communityTerms_msg').show();

                    if (response.status == 'success') {
                        var tinyMCEeditor = tinyMCE.get('communityTerms_description_area');
                        jQuery("input[type=text], input[type=email], textarea").val("");
                        if (tinyMCEeditor)
                        {
                            tinyMCEeditor.setContent('');
                        }
                        if (typeof Recaptcha !== 'undefined') {
                            Recaptcha.reload();
                        }
                    }

                    jQuery('html, body').animate({
                        scrollTop: jQuery("#communityTerms_wrapper").offset().top - 100
                    }, 1000);

                    return true;
                },
                complete: function () {
                    jQuery('#communityTerms_overlay').hide();
                },
            });
        }
        return false;
    });

});