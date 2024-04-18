<?php
/**
 * The Template for displaying Social Icons.
 */
 ?>
<?php if( get_theme_mod('vw_podcast_pro_headertwitter') != '' || get_theme_mod('vw_podcast_pro_headerinstagram') != '' || get_theme_mod('vw_podcast_pro_headerfacebook') != '' || get_theme_mod('vw_podcast_pro_headeryoutube') != '' || get_theme_mod('vw_podcast_pro_headerpinterest') != '' || get_theme_mod('vw_podcast_pro_headerlinkedin') != '' || get_theme_mod('vw_podcast_pro_headertumblric') != '' || get_theme_mod('vw_podcast_pro_headergoogleplus') != '' || get_theme_mod('vw_podcast_pro_headerflickr') != '' || get_theme_mod('vw_podcast_pro_headervk') != ''){ ?>
  <div class="top_social">
    <div class="socialbox">
    <?php if( get_theme_mod('vw_podcast_pro_headerfacebook') != '' ){ ?>
      <a class="facebook" href="<?php echo esc_url( get_theme_mod( 'vw_podcast_pro_headerfacebook' ) ); ?>" target="_blank"><i class="fab fa-facebook-f align-middle " aria-hidden="true"></i></a>
    <?php } ?>
      <?php if( get_theme_mod('vw_podcast_pro_headertwitter') != '' ){ ?>
        <a class="twitter" href="<?php echo esc_url( get_theme_mod( 'vw_podcast_pro_headertwitter' ) ); ?>" target="_blank"><i class="fab fa-twitter align-middle" aria-hidden="true"></i></a>
      <?php } ?>
      <?php if( get_theme_mod('vw_podcast_pro_headerinstagram') != '' ){ ?>
        <a class="insta" href="<?php echo esc_url( get_theme_mod( 'vw_podcast_pro_headerinstagram' ) ); ?>" target="_blank"><i class="fab fa-instagram align-middle" aria-hidden="true"></i></a>
      <?php } ?>
      <?php if( get_theme_mod('vw_podcast_pro_headerlinkedin') != '' ){ ?>
        <a class="linkedin" href="<?php echo esc_url( get_theme_mod( 'vw_podcast_pro_headerlinkedin' ) ); ?>" target="_blank"><i class="fab fa-linkedin-in align-middle" aria-hidden="true"></i></a>
      <?php } ?>
      <?php if( get_theme_mod('vw_podcast_pro_headerpinterest') != '' ){ ?>
        <a class="pintrest" href="<?php echo esc_url( get_theme_mod( 'vw_podcast_pro_headerpinterest' ) ); ?>" target="_blank"><i class="fab fa-pinterest-p align-middle " aria-hidden="true"></i></a>
      <?php } ?>
      <?php if( get_theme_mod('vw_podcast_pro_headeryoutube') != '' ){ ?>
        <a class="youtube" href="<?php echo esc_url( get_theme_mod( 'vw_podcast_pro_headeryoutube','https://www.youtube.com' ) ); ?>" target="_blank"><i class="fab fa-youtube align-middle" aria-hidden="true"></i></a>
      <?php } ?>
      <?php if( get_theme_mod('vw_podcast_pro_headertumblric') != '' ){ ?>
        <a class="tumbler" href="<?php echo esc_url( get_theme_mod( 'vw_podcast_pro_headertumblric' ) ); ?>" target="_blank"><i class="fab fa-tumblr align-middle" aria-hidden="true"></i></a>
      <?php } ?>
      <?php if( get_theme_mod('vw_podcast_pro_headerflickr') != '' ){ ?>
        <a class="flicker" href="<?php echo esc_url( get_theme_mod( 'vw_podcast_pro_headerflickr') ); ?>" target="_blank"><i class="fab fa-flickr align-middle " aria-hidden="true"></i></a>
      <?php } ?>
      <?php if( get_theme_mod('vw_podcast_pro_headervk') != '' ){ ?>
        <a class="vk" href="<?php echo esc_url( get_theme_mod( 'vw_podcast_pro_headervk') ); ?>" target="_blank"><i class="fab fa-vk align-middle " aria-hidden="true"></i></a>
      <?php } ?>
    </div>
  </div>
<?php } ?>
