<?php get_header(); ?>

<main class="project-container">
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      
      <h1 class="project-title"><?php the_title(); ?></h1>

      <?php if ( has_post_thumbnail() ) : ?>
        <div class="project-thumbnail">
          <?php the_post_thumbnail('large'); ?>
        </div>
      <?php endif; ?>

      <div class="project-content">
        <?php the_content(); ?>
      </div>

    </article>

  <?php endwhile; endif; ?>
</main>

<?php get_footer(); ?>