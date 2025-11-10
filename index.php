<?php get_header(); ?>

<section class="content-area container mx-auto">
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <article <?php post_class('post-card'); ?>>
      <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
      <div class="post-meta">
        <span>By <?php the_author(); ?></span> |
        <span><?php the_time(get_option('date_format')); ?></span>
      </div>
      <div class="excerpt">
        <?php the_excerpt(); ?>
      </div>
    </article>
  <?php endwhile; else : ?>
    <p><?php esc_html_e('No posts found.', 'mytheme'); ?></p>
  <?php endif; ?>
</section>

<?php get_footer(); ?>
