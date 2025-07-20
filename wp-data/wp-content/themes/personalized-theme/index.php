<?php get_header(); ?>

<main class="blog-main container">
  <aside class="sidebar">
    <?php get_sidebar(); ?>
  </aside>

  <section class="blog-posts-grid">
    <h1 class="blog-title">Blog.</h1>
    <div class="posts-wrapper">
      <?php if (have_posts()) :
        while (have_posts()) : the_post(); ?>
          <article class="post-card">
            <a href="<?php the_permalink(); ?>">
              <?php if (has_post_thumbnail()) : ?>
                <div class="thumb"><?php the_post_thumbnail('medium'); ?></div>
              <?php endif; ?>
              <span class="category"><?php the_category(', '); ?></span>
              <h2><?php the_title(); ?></h2>
              <p><?php echo get_the_excerpt(); ?></p>
            </a>
          </article>
        <?php endwhile;
      else : ?>
        <p>No posts found.</p>
      <?php endif; ?>
    </div>

    <div class="pagination">
      <?php the_posts_pagination(); ?>
    </div>
  </section>
</main>

<?php get_footer(); ?>
