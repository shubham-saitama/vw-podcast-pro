<?php
/**
 * Template Name:About Us Template
 *
 *
 */

get_header();
?>

<div class="body-wrapper">

  <?php get_template_part('/template-parts/header/sidebar-header'); ?>
  <div class="main-pageWrap">
    <?php get_template_part('template-parts/home/section-header'); ?>
    <?php get_template_part('template-parts/banner'); ?>
    <section>
      <?php the_content(); ?>
    </section>
    <?php get_footer(); ?>
  </div>
</div>