<?php get_header(); ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<?php endwhile; endif; ?>

      <?php include "inc/top_block.php"; ?>
      <div class="all-whiteBlock">
        <?php include "inc/menu.php"; ?>
        <?php include "inc/inner_blocks.php"; ?>
      </div>

<?php get_footer(); ?>