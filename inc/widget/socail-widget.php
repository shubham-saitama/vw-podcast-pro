<?php
//custom socila icons
class wpb_social_widget extends WP_Widget {
	function __construct() {
		parent::__construct(
		// Base ID of your widget
			'wpb_social_widget',
			// Widget name will appear in UI
			__('Social Icon', 'vw-podcast-pro'),
			// Widget description
			array( 'description' => __( 'Widget for Social icons section', 'vw-podcast-pro' ), )
		);
	}
	// Creating widget front-end
	// This is where the action happens
	public function widget( $args, $instance ) {
		?>
		<div class="social_widget">
			<?php
				$facebook = '';
				$twitter = '';
				$linkedin = '';
				$pinterest = '';
				$gitlab = '';
				$instagram = '';
				$youtube = '';

				$title = apply_filters('widget_title', esc_html($instance['title']));
				$facebook = $instance['facebook'];
		        $twitter = $instance['twitter'];
		        $linkedin = $instance['linkedin'];
		        $pinterest = $instance['pinterest'];
		        $gitlab = $instance['gitlab'];
		        $instagram = $instance['instagram'];
		        $youtube = $instance['youtube'];

				// social profile link
		        $facebook_profile = '<a class="custom_facebook" target="_blank" href="' . esc_url($facebook) . '"><i class="fab fa-facebook-f"></i><span>'.esc_html('Facebook', 'vw-podcast-pro').'</span></a>';
		        $twitter_profile ='<a class="custom_twitter" target="_blank" href="' . esc_url($twitter) . '"><i class="fa-brands fa-x-twitter"></i><span>'.esc_html('Twitter', 'vw-podcast-pro').'</span></a>';
		        $linkedin_profile = '<a class="custom_linkedin" target="_blank" href="' . esc_url($linkedin) . '"><i class="fab fa-linkedin-in"></i><span>'.esc_html('Linkedin', 'vw-podcast-pro').'</span></a>';
		        $pinterest_profile = '<a class="custom_pinterest" target="_blank" href="' . esc_url($pinterest) . '"><i class="fab fa-pinterest-p"></i><span>'.esc_html('Pinterest', 'vw-podcast-pro').'</span></a>';
		        $gitlab_profile = '<a class="custom_tumblr" target="_blank" href="' . esc_url($gitlab) . '"><i class="fa-brands fa-github"></i><span>'.esc_html('gitlab', 'vw-podcast-pro').'</span></a>';
		        $instagram_profile = '<a class="custom_instagram" target="_blank" href="' . esc_url($instagram) . '"><i class="fab fa-instagram"></i><span>'.esc_html('Instagram', 'vw-podcast-pro').'</span></a>';
		         $youtube_profile = '<a class="custom_youtube" target="_blank" href="' . esc_url($youtube) . '"><i class="fab fa-youtube"></i><span>'.esc_html('Youtube', 'vw-podcast-pro').'</span></a>';

				echo $args['before_widget'];

				if (!empty($title)) {
					echo $args['before_title'] . esc_html($title) . $args['after_title'];
				}

		        echo '<div class="custom-social-icons">';
			        echo (!empty($facebook) ) ? $facebook_profile : null;
			        echo (!empty($twitter) ) ? $twitter_profile : null;
					echo (!empty($gitlab) ) ? $gitlab_profile : null;
			        echo (!empty($linkedin) ) ? $linkedin_profile : null;
			        echo (!empty($pinterest) ) ? $pinterest_profile : null;
			        echo (!empty($instagram) ) ? $instagram_profile : null;
			        echo (!empty($youtube) ) ? $youtube_profile : null;
		        echo '</div>';
		        echo $args['after_widget'];
			?>
		</div>
		<?php
	}

	// Widget Backend
	public function form( $instance ) {

		isset($instance['title']) ? $title = $instance['title'] : '';
        empty($instance['title']) ? $title = 'My Social Profile' : null;

		isset($instance['facebook']) ? $facebook = $instance['facebook'] : null;
        empty($instance['facebook']) ? $facebook = '' : '';

		isset($instance['twitter']) ? $twitter = $instance['twitter'] : null;
        empty($instance['twitter']) ? $twitter = '' : '';

		isset($instance['gitlab']) ? $gitlab = $instance['gitlab'] : null;
        empty($instance['gitlab']) ? $gitlab = '' : '';

		isset($instance['instagram']) ? $instagram = $instance['instagram'] : null;
        empty($instance['instagram']) ? $instagram = '' : '';


        isset($instance['linkedin']) ? $linkedin = $instance['linkedin'] : null;
        empty($instance['linkedin']) ? $linkedin = '' : '';

        isset($instance['pinterest']) ? $pinterest = $instance['pinterest'] : null;
        empty($instance['pinterest']) ? $pinterest = '' : '';

       

        isset($instance['youtube']) ? $youtube = $instance['youtube'] : null;
        empty($instance['youtube']) ? $youtube = '' : '';

		?>
		<p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php echo esc_html('Title:','vw-podcast-pro'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('facebook')); ?>"><?php echo esc_html('Facebook:','vw-podcast-pro'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('facebook')); ?>" name="<?php echo esc_attr($this->get_field_name('facebook')); ?>" type="text" value="<?php echo esc_attr($facebook); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('twitter')); ?>"><?php echo esc_html('Twitter:','vw-podcast-pro'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('twitter')); ?>" name="<?php echo esc_attr($this->get_field_name('twitter')); ?>" type="text" value="<?php echo esc_attr($twitter); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('gitlab')); ?>"><?php echo esc_html('gitlab:','vw-podcast-pro'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('gitlab')); ?>" name="<?php echo esc_attr($this->get_field_name('gitlab')); ?>" type="text" value="<?php echo esc_attr($gitlab); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('linkedin')); ?>"><?php echo esc_html('Linkedin:','vw-podcast-pro'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('linkedin')); ?>" name="<?php echo esc_attr($this->get_field_name('linkedin')); ?>" type="text" value="<?php echo esc_attr($linkedin); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('instagram')); ?>"><?php echo esc_html('Instagram:','vw-podcast-pro'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('instagram')); ?>" name="<?php echo esc_attr($this->get_field_name('instagram')); ?>" type="text" value="<?php echo esc_attr($instagram); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('pinterest')); ?>"><?php echo esc_html('Pinterest:','vw-podcast-pro'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('pinterest')); ?>" name="<?php echo esc_attr($this->get_field_name('pinterest')); ?>" type="text" value="<?php echo esc_attr($pinterest); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('youtube')); ?>"><?php echo esc_html('Youtube:','vw-podcast-pro'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('youtube')); ?>" name="<?php echo esc_attr($this->get_field_name('youtube')); ?>" type="text" value="<?php echo esc_attr($youtube); ?>">
		</p>
		<?php
	}

	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = (!empty($new_instance['title']) ) ? strip_tags($new_instance['title']) : '';
        $instance['facebook'] = (!empty($new_instance['facebook']) ) ? strip_tags($new_instance['facebook']) : '';
        $instance['twitter'] = (!empty($new_instance['twitter']) ) ? strip_tags($new_instance['twitter']) : '';
		$instance['gitlab'] = (!empty($new_instance['gitlab']) ) ? strip_tags($new_instance['gitlab']) : '';
        $instance['instagram'] = (!empty($new_instance['instagram']) ) ? strip_tags($new_instance['instagram']) : '';
        $instance['linkedin'] = (!empty($new_instance['linkedin']) ) ? strip_tags($new_instance['linkedin']) : '';
        $instance['pinterest'] = (!empty($new_instance['pinterest']) ) ? strip_tags($new_instance['pinterest']) : '';
        $instance['youtube'] = (!empty($new_instance['youtube']) ) ? strip_tags($new_instance['youtube']) : '';
		return $instance;
	}
}


// Register and load the widget
function wpb_custom_load_widget() {
	register_widget( 'wpb_social_widget' );
}
add_action( 'widgets_init', 'wpb_custom_load_widget' );
