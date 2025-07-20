<div class="blog-sidebar">
  <?php get_search_form(); ?>

  <div class="widget">
    <h3>Recent posts</h3>
    <ul>
      <?php
      $recent = wp_get_recent_posts(['numberposts' => 5]);
      foreach ($recent as $post) : ?>
        <li>
          <a href="<?php echo get_permalink($post['ID']); ?>">
            <?php echo get_the_post_thumbnail($post['ID'], 'thumbnail'); ?>
            <?php echo $post['post_title']; ?>
          </a>
          <span class="date"><?php echo get_the_date('j M, Y', $post['ID']); ?></span>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>

  <?php dynamic_sidebar('sidebar-1'); ?>
</div>
