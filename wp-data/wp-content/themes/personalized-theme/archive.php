<?php get_header(); ?>

<main class="blog-page">
  <div class="container">
    <div class="blog-layout">
      <aside class="blog-sidebar">
        <?php get_sidebar(); ?>
      </aside>

      <section class="blog-content">
        <h1 class="page-title">Blog.</h1>
        
        <div class="posts-grid">
          <?php if (have_posts()) :
            while (have_posts()) : the_post(); ?>
              <article class="post-card">
                <a href="<?php the_permalink(); ?>">
                  <?php if (has_post_thumbnail()) : ?>
                    <div class="post-thumbnail">
                      <?php the_post_thumbnail('medium'); ?>
                      <span class="category-tag"><?php $categories = get_the_category(); if (!empty($categories)) echo esc_html($categories[0]->name); ?></span>
                    </div>
                  <?php endif; ?>
                  <div class="post-info">
                    <h2><?php the_title(); ?></h2>
                    <p><?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?></p>
                  </div>
                </a>
              </article>
            <?php endwhile;
          else : ?>
            <p>No posts found.</p>
          <?php endif; ?>
        </div>

        <div class="blog-pagination">
          <?php 
            $pagination = paginate_links(array(
              'prev_text' => '‹',
              'next_text' => '›',
              'type' => 'array'
            ));
            if ($pagination) {
              echo '<div class="pagination-wrapper">';
              foreach ($pagination as $page) {
                echo $page;
              }
              echo '</div>';
            }
          ?>
        </div>
      </section>
    </div>
  </div>
</main>

<?php get_footer(); ?>
