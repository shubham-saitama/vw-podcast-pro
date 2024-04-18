<?php
/**
 * Template Name:Terms & Condition
 */

get_header();

get_template_part('template-parts/banner'); ?>

<?php do_action('vw_podcast_pro_before_page'); ?>
<section id="term_condition">
    <div class="container">
      <div class="middle-align">
          <div class="term_page">
              <?php while ( have_posts() ) : the_post(); ?>
                 <?php the_content();?>
                 <?php
                 //If comments are open or we have at least one comment, load up the comment template
                  if ( comments_open() || '0' != get_comments_number() )
                      comments_template();
                 ?>
               <?php endwhile; // end of the loop. ?>
           </div>
           <div class="clear"></div>
      </div>
    </div>
</section>
<?php do_action('vw_podcast_pro_after_page'); ?>

<?php get_footer(); ?>
