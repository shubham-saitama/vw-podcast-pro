<?php
/**
 * Template Name: Home Page
 */
get_header();
?>

<div class="body-wrapper">
  <?php get_template_part('/template-parts/header/sidebar-header'); ?>

  <div class="main-pageWrap">
    <?php
    $section_order = '';
    $section_order = explode(',', get_theme_mod('vw_podcast_pro_section_ordering_settings_repeater'));
    foreach ($section_order as $key => $value) {
      if ($value != '') {
        get_template_part('template-parts/home/' . $value);
      }
    }
    ?>
    <?php get_footer(); ?>
  </div>
</div>