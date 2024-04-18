<!-- Template to show the content of page editor -->
<?php while ( have_posts() ) : the_post(); ?>
<div class="container editor_content">
	<?php the_content(); ?>
</div>
<?php endwhile; ?>