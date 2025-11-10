<?php get_header(); ?>

<section class="single-post container mx-auto">
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <article <?php post_class(); ?>>
      <h1 class="post-title"><?php the_title(); ?></h1>
      <div class="post-meta">
        <span>By <?php the_author(); ?></span> |
        <span><?php the_time(get_option('date_format')); ?></span>
      </div>

      <?php if (has_post_thumbnail()) : ?>
        <div class="post-thumbnail">
          <?php the_post_thumbnail('large'); ?>
        </div>
      <?php endif; ?>

      <div class="post-content">
        <?php the_content(); ?>
      </div>

      <div class="post-navigation">
        <div class="prev"><?php previous_post_link('%link', '&laquo; %title'); ?></div>
        <div class="next"><?php next_post_link('%link', '%title &raquo;'); ?></div>
      </div>
    </article>

    <?php comments_template(); ?>

  <?php endwhile; endif; ?>
</section>

<?php get_footer(); ?>
