<?php get_header(); ?>

<section class="archive container mx-auto">
  <header class="archive-header">
    <h1 class="archive-title">
      <?php the_archive_title(); ?>
    </h1>
    <?php if (get_the_archive_description()) : ?>
      <div class="archive-description">
        <?php the_archive_description(); ?>
      </div>
    <?php endif; ?>
  </header>

  <?php if (have_posts()) : ?>
    <div class="archive-posts">
      <?php while (have_posts()) : the_post(); ?>
        <article <?php post_class('archive-post-card'); ?>>
          <h2>
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
          </h2>
          <div class="post-meta">
            <span><?php the_time(get_option('date_format')); ?></span>
          </div>

          <div class="excerpt">
            <?php the_excerpt(); ?>
          </div>
        </article>
      <?php endwhile; ?>
    </div>

    <div class="pagination">
      <?php
      the_posts_pagination([
        'mid_size'  => 2,
        'prev_text' => __('&laquo; Previous', 'mytheme'),
        'next_text' => __('Next &raquo;', 'mytheme'),
      ]);
      ?>
    </div>

  <?php else : ?>
    <p><?php esc_html_e('No posts found in this archive.', 'mytheme'); ?></p>
  <?php endif; ?>
</section>

<?php get_footer(); ?>
