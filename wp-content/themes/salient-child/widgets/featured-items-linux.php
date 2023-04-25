<?php
class featuredItems_widget extends WP_Widget
{
    function __construct()
    {
        parent::__construct(
            "featuredItems_widget",
            __(
                "Linux Foundation Featured Items",
                "featuredItems_widget_domain"
            ),
            [
                "description" => __(
                    "Widget for featured item.",
                    "featuredItems_widget_domain"
                ),
            ]
        );
    }

    public function widget($args, $instance)
    {
        $category = apply_filters("widget_category", $instance["category"]);
        $category_url = apply_filters(
            "widget_category_url",
            $instance["category_url"]
        );
        $title = apply_filters("widget_title", $instance["title"]);
        $date = apply_filters("widget_date", $instance["date"]);
        $date = date_create($date);
        $title_url = apply_filters("widget_title_url", $instance["title_url"]);
        $image_url = apply_filters("widget_image_url", $instance["image_url"]);

        $output .= '<div class="list-design outer widget">';
        $output .= '<div class="list-design flex">';

        $output .= '<div class="list-design left">';
        $output .= '<img src="' . $image_url . '"/>';
        $output .= "</div>";

        $output .= '<div class="list-design right">';
        $output .=
            '<a href="' .
            $category_url .
            '"><p class="widget-category">' .
            $category .
            "</p></a>";
        $output .=
            '<a href="' .
            $title_url .
            '"><h3 class="widget-title">' .
            $title .
            "</h3></a>";
        $output .=
            '<p class="widget-date">' . date_format($date, "F j, Y") . "</p>";
        $output .= "</div>";

        $output .= "</div>";
        $output .= "</div>";

        echo __($output, "featuredItems_widget_domain");
    }

    public function form($instance)
    {
        if (isset($instance["category"])) {
            $category = $instance["category"];
        }
        if (isset($instance["category_url"])) {
            $category_url = $instance["category_url"];
        }
        if (isset($instance["title"])) {
            $title = $instance["title"];
        }
        if (isset($instance["title_url"])) {
            $title_url = $instance["title_url"];
        }
        if (isset($instance["image_url"])) {
            $image_url = $instance["image_url"];
        }
        if (isset($instance["date"])) {
            $date = $instance["date"];
        }
        ?>	
			<p>
			<label for="<?php echo $this->get_field_id(
       "category"
   ); ?>"><?php _e("Category"); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id(
       "category"
   ); ?>" name="<?php echo $this->get_field_name("category"); ?>" type="text" value="<?php echo esc_attr($category); ?>" />
			</p>
			
			<p>
			<label for="<?php echo $this->get_field_id(
       "category_url"
   ); ?>"><?php _e("Category URL"); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id(
       "category_url"
   ); ?>" name="<?php echo $this->get_field_name("category_url"); ?>" type="text" value="<?php echo esc_attr($category_url); ?>" />
			</p>
						
			<p>
			<label for="<?php echo $this->get_field_id(
       "title"
   ); ?>"><?php _e("Title"); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id(
       "title"
   ); ?>" name="<?php echo $this->get_field_name("title"); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
			</p>	
			
			<p>
			<label for="<?php echo $this->get_field_id(
       "title_url"
   ); ?>"><?php _e("Title URL"); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id(
       "title_url"
   ); ?>" name="<?php echo $this->get_field_name("title_url"); ?>" type="text" value="<?php echo esc_attr($title_url); ?>" />
			</p>	
			
			<p>
			<label for="<?php echo $this->get_field_id(
       "date"
   ); ?>"><?php _e("Date"); ?></label>
			<input type="date" class="widefat" id="<?php echo $this->get_field_id(
       "date"
   ); ?>" name="<?php echo $this->get_field_name("date"); ?>" type="text" value="<?php echo esc_attr($date); ?>" />
			</p>		
					
			<label class="widg-label widg-img-label" for="<?php echo $this->get_field_id(
       "image_url"
   ); ?>">Image</label>
			<div class="widg-img" >
				<img class="<?php echo $this->get_field_id(
        "image_id"
    ); ?>_media_image custom_media_image" src="<?php if (
    !empty($instance["image_url"])
) {
    echo $instance["image_url"];
} ?>" />
				<input input type="hidden" type="text" class="<?php echo $this->get_field_id(
        "image_id"
    ); ?>_media_id custom_media_id" name="<?php echo $this->get_field_name("image_id"); ?>" id="<?php echo $this->get_field_id("image_id"); ?>" value="<?php echo $instance["image_id"]; ?>" />
				<input type="text" class="<?php echo $this->get_field_id(
        "image_id"
    ); ?>_media_url custom_media_url" name="<?php echo $this->get_field_name("image_url"); ?>" id="<?php echo $this->get_field_id("image_url"); ?>" value="<?php echo $instance["image_url"]; ?>" >
				<input type="button" value="Upload Image" class="button custom_media_upload" id="<?php echo $this->get_field_id(
        "image_id"
    ); ?>"/>
			</div>
			
		<?php
    }

    public function update($new_instance, $old_instance)
    {
        $instance = [];
        $instance["title"] = !empty($new_instance["title"])
            ? strip_tags($new_instance["title"])
            : "";
        $instance["category"] = !empty($new_instance["category"])
            ? strip_tags($new_instance["category"])
            : "";
        $instance["category_url"] = !empty($new_instance["category_url"])
            ? strip_tags($new_instance["category_url"])
            : "";
        $instance["title_url"] = !empty($new_instance["title_url"])
            ? strip_tags($new_instance["title_url"])
            : "";
        $instance["date"] = !empty($new_instance["date"])
            ? strip_tags($new_instance["date"])
            : "";
        $instance["image_id"] = strip_tags($new_instance["image_id"]);
        $instance["image_url"] = strip_tags($new_instance["image_url"]);
        return $instance;
    }
}

function featuredItems_load_widget()
{
    register_widget("featuredItems_widget");
}
add_action("widgets_init", "featuredItems_load_widget");

add_action("admin_footer", "featuredItems_js"); // For back-end
// Function to render LiveChat JS code
function featuredItems_js()
{
    ?>
<script>
jQuery(document ).ready( function(){
    function media_upload( button_class ) {
        var _custom_media = true,
            _orig_send_attachment = wp.media.editor.send.attachment;
         jQuery('body').on('click','.custom_media_upload',function(e) {
            var button_id ='#'+jQuery(this).attr( 'id' );
            var button_id_s = jQuery(this).attr( 'id' ); 
            console.log(button_id); 
            var self = jQuery(button_id);
            var send_attachment_bkp = wp.media.editor.send.attachment;
            var button = jQuery(button_id);
            var id = button.attr( 'id' ).replace( '_button', '' );
            _custom_media = true;

            wp.media.editor.send.attachment = function(props, attachment ){
                if ( _custom_media ) {
                    jQuery( '.' + button_id_s + '_media_url' ).val(attachment.url);
                    jQuery( '.' + button_id_s + '_media_image' ).attr( 'src',attachment.url).css( 'display','block' ); 
					jQuery( '.' + button_id_s + '_media_image' ).attr( 'src',attachment.url).css( 'max-height','300px' );
					jQuery( '.' + button_id_s + '_media_image' ).attr( 'src',attachment.url).css( 'max-width','300px' ); 
					jQuery( '.' + button_id_s + '_media_url' ).val(attachment.url).trigger('change');
                } else {
                    return _orig_send_attachment.apply( button_id, [props, attachment] );
                }
            }
            wp.media.editor.open(button);
            return false;
        });
    }
    media_upload( '.custom_media_upload' );

});
</script>
<?php
}
