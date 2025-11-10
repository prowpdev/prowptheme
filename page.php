<?php get_header(); ?>

<section class="page">
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <article <?php post_class(); ?>>
      <?php if (has_post_thumbnail()) : ?>
        <div class="page-thumbnail">
          <?php the_post_thumbnail('large'); ?>
        </div>
      <?php endif; ?>

      <div class="page-content">
        <?php the_content(); ?>
      </div>
    </article>
  <?php endwhile; else : ?>
    <p><?php esc_html_e('Sorry, this page could not be found.', 'mytheme'); ?></p>
  <?php endif; ?>
</section>

<?php get_footer(); ?>
