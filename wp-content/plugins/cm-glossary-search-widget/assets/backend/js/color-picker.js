(function ($) {
    $(function () {
        $('.cmsw-input-color').wpColorPicker();
    
        // Media Uploader
        $( '.CM_Media_Uploader .upload_image_button' ).click( function () {
            var $container = $( this ).closest( '.CM_Media_Uploader' );
            var $inputStorage = $container.find( '.cmtt_Media_Storage' );
            var $imageHolder = $container.find( '.cmtt_Media_Image' );
            wp.media.editor.send.attachment = function ( props, attachment ) {
                $inputStorage.val( attachment.id );
                $imageHolder.css( { 'background-image': 'url(' + attachment.url + ')' } ).addClass( 'cmtt_hasThumb' );
            }
            wp.media.editor.open( this );
            return false;
        } );
        $( '.cmtt_Media_Image' ).click( function () {
            var $t = $( this );
            var $container = $t.closest( '.CM_Media_Uploader' );
            var $inputStorage = $container.find( '.cmtt_Media_Storage' );
            if ( $t.hasClass( 'cmtt_hasThumb' ) ) {
                $t.css( { 'background-image': '' } ).removeClass( 'cmtt_hasThumb' )
                    .next( 'input[type="hidden"]' ).val( '' );
                $inputStorage.val( '' );
            }
        } ); // End
    
        $( '.remove_image_button.cminds_link' ).on( 'click', function (e) {
            var input_name = $(e.target).data('input');
            $('.' + input_name).val('');
            $('#' + input_name + '-preview').css('background-image', 'none');
        } );
    });
}(jQuery));