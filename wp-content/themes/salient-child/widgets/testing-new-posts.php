<?php

class testPost_widget extends WP_Widget {
	function __construct() {
	parent::__construct(
		'singlePost_widget', 
		__('Linux Foundation Single Posts Widget', 'singlePost_widget_domain'), 
		array( 'description' => __( 'Widget for a single post.', 'singlePost_widget_domain' ), )
	);
	}
	 
	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );
		$postID = apply_filters( 'widget_postID', $instance['postID'] );
		//echo $args['before_widget'];
		//if ( ! empty( $title ) ) { echo $args['before_title'] . $title . $args['after_title']; }
	 
		$arguments  = array(
			'post_type'=> 'post',
			'order'    => 'ASC',
			'p' => $postID,
		);              

		$the_query = new WP_Query( $arguments  );
		$output = '';	
		if($the_query->have_posts() && !empty($postID)) { 
			while ( $the_query->have_posts() ) : 
				$the_query->the_post(); 
				
					$output .= $imageURI;
					$output .= '<div class="list-design outer">';
					$output .= '<div class="list-design flex">';

					$output .= '<div class="list-design left">';
						$output .= get_the_post_thumbnail( $page->ID, "medium");
					$output .= '</div>';


					$output .= '<div class="list-design right">';
						$output .= '<a href=""><h4>' . $title  . '</h4></a>';
						$output .= '<h5><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></h5>';
						$output .= "<p>" . get_the_date("M j, Y") . "</p>";
                            "</span>";
					$output .= '</div>';

					$output .= '</div>';
					$output .=  '</div>';
								
					echo __($output, 'singlePost_widget_domain');	
			endwhile; 
			wp_reset_postdata(); 
		}
		else {
		}
		//echo $args['after_widget'];
	}
	 
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) { 
			$title = $instance[ 'title' ]; 
		}
		else { 
			$title = __( 'New Title', 'singlePost_widget_domain' ); 
		}
		
		if ( isset( $instance[ 'postID' ] ) ) { 
			$postID = $instance[ 'postID' ]; 
		}
		else { 
			$postID = __( '', 'singlePost_widget_domain' ); 
		}		
		
		
		?>
			<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
			</p>
			
			<p>
			<label for="<?php echo $this->get_field_id( 'postID' ); ?>"><?php _e( 'Post ID' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'postID' ); ?>" name="<?php echo $this->get_field_name( 'postID' ); ?>" type="text" value="<?php echo esc_attr( $postID ); ?>" />
			</p>			
			
		<?php
	}
	 
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['postID'] = ( ! empty( $new_instance['postID'] ) ) ? strip_tags( $new_instance['postID'] ) : '';
		return $instance;
	}
} 

function testPost_load_wdiget() {
    register_widget( 'singlePost_widget' );
}
add_action( 'widgets_init', 'testPost_load_wdiget' );
