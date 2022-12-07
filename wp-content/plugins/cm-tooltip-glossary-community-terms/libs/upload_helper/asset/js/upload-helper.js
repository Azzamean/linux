function CM_UploadHelper_init() {

    var $ = jQuery;
    var container = $( this );

    CM_UploadHelper_Images_delete_init( container.find( 'li' ) );

    $( '.cm-upload-helper-attachments-upload', container ).change( function () {

        if ( this.files.length == 0 )
            return;

        var input = $( this );
        var container = input.parents( '.cm-upload-helper-attachments' ).first();
        var fileList = container.find( '.cm-upload-helper-attachments-list' );
        var idsInput = container.find( 'input[type=hidden]' );

        var data = new FormData();
        data.append( 'action', CM_UploadHelper_Settings.action );
        data.append( 'nonce', CM_UploadHelper_Settings.nonce );
        for ( var i = 0; i < this.files.length; i++ ) {
            data.append( 'file_' + i, this.files[i] );
        }

        $.ajax( {
            url: CM_UploadHelper_Settings.ajaxurl,
            data: data,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function ( response ) {
                console.log( response );
                input[0].value = '';
                if ( response.success ) {
                    for ( var i = 0; i < response.files.length; i++ ) {
                        var file = response.files[i];
                        CM_UploadHelper_Images_add( idsInput, fileList, file.id, file.thumb, file.url );
                    }
                }
            }
        } );

    } );

}

function CM_UploadHelper_Images_add( fileInput, fileList, id, thumb, url ) {
    fileInput.val( fileInput.val() + ',' + id );

    var item = fileList.find( 'li[data-id=0]' ).first().clone();
    item.data( 'id', id );
    item.attr( 'data-id', id );
    item.find( 'img' ).first().attr( 'src', thumb );
    item.find( 'a' ).first().attr( 'href', url );
    fileList.append( item );
    item.fadeIn( 'slow', function () {
        CM_UploadHelper_Images_delete_init( item );
    } );
    fileList.parents( '.cm-upload-helper-attachments' ).first().find( '.cm-upload-helper-field-desc' ).show();
}

function CM_UploadHelper_Images_delete_init( items ) {
    jQuery( '.cm-upload-helper-attachment-delete', items ).click( function ( ev ) {
        ev.preventDefault();
        ev.stopPropagation();
        var obj = jQuery( this );
        var item = obj.parents( 'li' ).first();
        var id = item.data( 'id' );
        var container = items.first().parents( '.cm-upload-helper-attachments' ).first();
        var fileInput = container.find( 'input[type=hidden]' );
//		console.log(fileInput.val());
        var val = fileInput.val().split( ',' );
        for ( var i = 0; i < val.length; i++ ) {
            if ( val[i] == id ) {
                val.splice( i, 1 );
                break;
            }
        }
        fileInput.val( val.join( ',' ) );
        console.log( fileInput.val() );
        item.fadeOut( 'slow', function () {
            item.remove();
        } );
    } );
}