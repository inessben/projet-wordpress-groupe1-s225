<?php get_header(); ?>

<main class="single-post-page container">
  <aside class="sidebar">
    <?php get_sidebar(); ?>
  </aside>

  <article class="single-post">
    <h1><?php the_title(); ?></h1>

    <?php if (has_post_thumbnail()) : ?>
      <div class="single-thumb"> <?php the_post_thumbnail('large'); ?> </div>
    <?php endif; ?>

    <div class="post-meta">
      <span><?php the_category(', '); ?> - <?php the_date(); ?></span>
    </div>

    <div class="post-content">
      <?php the_content(); ?>
    </div>

    <div class="post-tags">
      <?php the_tags('', '', ''); ?>
    </div>

    <section class="comments-section">
      <?php comments_template(); ?>
    </section>
  </article>
</main>

<?php get_footer(); ?>
