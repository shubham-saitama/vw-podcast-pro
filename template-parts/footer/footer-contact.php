<?php
/*
	$address_section = get_theme_mod( 'vw_podcast_pro_footer_contact_enable' );
	if ( 'Disable' == $address_section ) {
		return;
	}
	// $img_bg = get_theme_mod('vw_podcast_pro_custom_footer_image_bg');
	if( get_theme_mod('vw_podcast_pro_custom_footer_section_bgcolor') ) {
	  $about_backg = 'background-color:'.esc_attr(get_theme_mod('vw_podcast_pro_custom_footer_section_bgcolor')).'!important;';
	}elseif( get_theme_mod('vw_podcast_pro_custom_footer_section_bgimage') ){
	  $about_backg = 'background-image:url(\''.esc_url(get_theme_mod('vw_podcast_pro_custom_footer_section_bgimage')).'\')';
	}else{
	  $about_backg = '';
	}
?>
<section class="footer-contact <?php echo esc_attr($about_backg); ?>" style="<?php echo $about_backg; ?>">
<div class="container">
	<div class="row">
    <div class="col-md-6">
			<div class="footer-contact-detail">
				<?php if(get_theme_mod('vw_podcast_pro_custom_footer_heading') != ''){ ?>
				 <h2 class="animated lightSpeedIn delay-1s mb-2"><?php echo esc_html(get_theme_mod('vw_podcast_pro_custom_footer_heading')); ?></h2>
			 <?php } ?>
			 <?php if(get_theme_mod('vw_podcast_pro_custom_footer_para') != ''){ ?>
				<p class="para animated lightSpeedIn delay-1s mb-3"><?php echo get_theme_mod('vw_podcast_pro_custom_footer_para'); ?></p>
			<?php } ?>
			<div class="news_content">
				<?php echo do_shortcode(get_theme_mod('vw_podcast_pro_newsletter_shortcode','[contact-form-7 id="64" title="Newsletter"]','vw-podcast-pro')); ?>
			</div>
			</div>
    </div>
		<div class="col-md-6">
   <img class="footer-contact-img" src="<?php echo esc_url(get_theme_mod('vw_podcast_pro_custom_footer_img')) ?>" alt="">
		</div>
	</div>
</div>
</section>
*/ ?>
