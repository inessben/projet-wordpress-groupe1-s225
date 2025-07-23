<?php get_header(); ?>

<main class="single-post-page">
  <div class="container">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <div class="single-layout">
      <article class="single-post-content">
        <h1 class="post-title"><?php the_title(); ?></h1>

        <?php if (has_post_thumbnail()) : ?>
          <div class="featured-image">
            <?php the_post_thumbnail('large'); ?>
          </div>
        <?php endif; ?>

        <div class="post-meta">
          <span class="post-date"><?php echo get_the_date('F j, Y'); ?></span>
          <?php $categories = get_the_category(); 
          if (!empty($categories)) : ?>
            <span class="category-tag"><?php echo esc_html($categories[0]->name); ?></span>
          <?php endif; ?>
        </div>

        <div class="post-content">
          <?php the_content(); ?>
        </div>

        <?php if (get_the_tags()) : ?>
          <div class="post-tags">
            <?php the_tags('<span class="tags-label">Tags:</span> ', ' ', ''); ?>
          </div>
        <?php endif; ?>

        <section class="comments-section">
          <?php if (have_comments()) : ?>
            <div class="comment-list">
              <ol class="comment-list">
                <?php wp_list_comments(array('avatar_size' => 32)); ?>
              </ol>
            </div>
          <?php endif; ?>
          
          <?php if (comments_open()) : ?>
            <div class="comment-form-section">
              <h3>Leave a reply</h3>
              <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" class="comment-form">
                
                <div class="form-field">
                  <input type="text" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" placeholder="" required />
                  <label for="author">Full name</label>
                </div>

                <div class="form-field">
                  <input type="email" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" placeholder="" required />
                  <label for="email">Email</label>
                </div>

                <div class="form-field">
                  <textarea name="comment" id="comment" placeholder="" required></textarea>
                  <label for="comment">Message</label>
                </div>

                <div class="form-submit">
                  <input type="submit" name="submit" class="submit" value="Submit" />
                  <input type="hidden" name="comment_post_ID" value="<?php echo get_the_ID(); ?>" />
                </div>
                
                <?php comment_id_fields(); ?>
              </form>
            </div>
          <?php endif; ?>
        </section>
      </article>
      
      <aside class="blog-sidebar">
        <?php get_sidebar(); ?>
      </aside>
    </div>
    <?php endwhile; else : ?>
      <div class="single-layout">
        <article class="single-post-content">
          <h1 class="post-title">Article non trouvé</h1>
          <div class="post-content">
            <p>Désolé, cet article n'existe pas ou n'est plus disponible.</p>
          </div>
        </article>
      </div>
    <?php endif; ?>
  </div>
</main>

<?php get_footer(); ?>