<?php get_header(); ?>

<main class="blog-archive">
  <div class="container">
    <h1 class="page-title">Blog.</h1>
    <div class="blog-content">
      <aside class="sidebar">
        <?php get_sidebar(); ?>
      </aside>

      <section class="posts">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
          <article class="post-card">
            <a href="<?php the_permalink(); ?>">
              <?php if ( has_post_thumbnail() ) : ?>
                <div class="thumb"> <?php the_post_thumbnail(); ?> </div>
              <?php endif; ?>
              <div class="post-info">
                <span class="category"> <?php the_category(', '); ?> </span>
                <h2 class="post-title"> <?php the_title(); ?> </h2>
                <p class="excerpt"> <?php echo get_the_excerpt(); ?> </p>
              </div>
            </a>
          </article>
        <?php endwhile; endif; ?>

        <div class="pagination"> <?php the_posts_pagination(); ?> </div>
      </section>
    </div>
  </div>
</main>

<?php get_footer(); ?>
