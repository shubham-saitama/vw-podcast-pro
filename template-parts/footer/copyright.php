<section class="footer-copyright">
	<div class="copyright-outer">
		<div class="copyright">
			<div class="container">
				<div class="row justify-content-between">

					<div class="footersocial col-lg-12 col-md-12 col-sm-12 col-12">
						<div class="socialbox">
							<?php
							for ($i = 1; $i <= 5; $i++) {
								$social_iconClass = get_theme_mod('vw_podcast_pro_vision_footer_social_icons' . $i);
								$social_link = get_theme_mod('vw_podcast_pro_footer_social_icons_image_link' . $i);
								if (!empty($social_iconClass)) {
									echo '<li><a target="_blank" href="' . esc_attr($social_link) . '"><i class="' . esc_attr($social_iconClass) . '" aria-hidden="true"></i></a></li>';
								}
							}
							?>
						</div>
					</div>
					<div class="col-lg-12 col-md-12 col-sm-12 col-12">
						<?php if (get_theme_mod('vw_podcast_pro_footer_copyright_text') != ''): ?>
							<p class=" copyright-text">
								<i class="fa fa-copyright m-2"></i>
								<a target="_blank" href="https://www.vwthemes.com/">
									<?php echo esc_html(get_theme_mod('vw_podcast_pro_footer_copyright_text')); ?>
								</a>
							</p>
						<?php endif; ?>
					</div>
					<?php if (get_theme_mod('vw_podcast_pro_genral_section_show_scroll_top', true) == "1") { ?>
						<a href="javascript:" id="return-to-top"><i
								class="<?php echo esc_html(get_theme_mod('vw_podcast_pro_genral_section_show_scroll_top_icon')); ?>"></i><span
								class="screen-reader-text">
								<?php esc_html_e('Return To Top Button', 'vw-podcast-pro') ?>
							</span></a>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</section>