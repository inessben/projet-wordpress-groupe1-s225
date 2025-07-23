<div class="blog-sidebar">
  <div class="search-form">
    <h3>Search</h3>
    <?php get_search_form(); ?>
  </div>

  <div class="widget">
    <h3>Recent posts</h3>
    <ul>
      <?php
      $recent = wp_get_recent_posts(['numberposts' => 5]);
      foreach ($recent as $post) : ?>
        <li>
          <?php if (get_the_post_thumbnail($post['ID'], 'thumbnail')) : ?>
            <?php echo get_the_post_thumbnail($post['ID'], 'thumbnail'); ?>
          <?php endif; ?>
          <div class="post-info">
            <a href="<?php echo get_permalink($post['ID']); ?>">
              <?php echo $post['post_title']; ?>
            </a>
            <span class="date"><?php echo get_the_date('j M, Y', $post['ID']); ?></span>
          </div>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>

  <div class="widget widget_categories">
    <h3>Archives</h3>
    <ul>
      <?php wp_get_archives(['type' => 'monthly', 'limit' => 12]); ?>
    </ul>
  </div>

  <div class="widget widget_categories">
    <h3>Categories</h3>
    <ul>
      <?php 
      $categories = get_categories(array(
        'orderby' => 'name',
        'order' => 'ASC',
        'hide_empty' => false
      ));
      
      if (!empty($categories)) {
        foreach ($categories as $category) {
          $count = $category->count > 0 ? ' (' . $category->count . ')' : '';
          echo '<li><a href="' . get_category_link($category->term_id) . '">' . $category->name . $count . '</a></li>';
        }
      } else {
        echo '<li>No categories found</li>';
      }
      ?>
    </ul>
  </div>

  <div class="widget widget_tag_cloud">
    <h3>Tags</h3>
    <div class="tagcloud">
      <?php 
      $tags = get_tags(array(
        'orderby' => 'name',
        'order' => 'ASC',
        'hide_empty' => false
      ));
      
      if (!empty($tags)) {
        foreach ($tags as $tag) {
          echo '<a href="' . get_tag_link($tag->term_id) . '" class="tag-link">' . $tag->name . '</a> ';
        }
      } else {
        echo 'No tags found';
      }
      ?>
    </div>
  </div>

  <?php dynamic_sidebar('sidebar-1'); ?>
</div>