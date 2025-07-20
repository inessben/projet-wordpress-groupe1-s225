<?php
/* 
Template Name: Résultats de recherche personnalisés
*/
get_header(); ?>

<section class="search-results">
  <div class="container">
    <h1>Search results for: <span><?php echo get_search_query(); ?></span></h1>

    <?php if (have_posts()) : ?>
      <div class="search-grid">
        <?php while (have_posts()) : the_post(); ?>
          <article class="search-item">
            <h2><?php the_title(); ?></h2>
            <p class="meta">
              <?php the_category(', '); ?>, <?php echo get_the_date(); ?>
            </p>
            <p><?php the_excerpt(); ?></p>
          </article>
        <?php endwhile; ?>
      </div>
    <?php else : ?>
      <p>No results found.</p>
    <?php endif; ?>
  </div>
</section>

<?php get_footer(); ?>