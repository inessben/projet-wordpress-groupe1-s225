<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php bloginfo('name'); ?> | <?php wp_title(); ?></title>
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header class="site-header">
  <div class="container">
    <div class="logo">
      <a href="<?php echo esc_url(home_url('/')); ?>">
        ESGI<span class="dot">.</span>
      </a>
    </div>

    <div class="burger-menu" id="burger-btn" aria-label="Ouvrir le menu">
      <span></span>
      <span></span>
    </div>
  </div>

  <nav class="mobile-nav" id="mobile-nav">
    <button class="close-menu" id="close-btn" aria-label="Fermer">&times;</button>
    <div class="menu-content">
      <div class="left">
          <div class="logo">
            <a href="<?php echo esc_url(home_url('/')); ?>">
              ESGI<span class="dot">.</span>
            </a>
          </div>
        <span class="search-hint">Or try Search</span>
      </div>
      <ul class="right">
        <li>
          <a href="<?php echo esc_url(home_url('/')); ?>" class="<?php if (is_front_page()) echo 'active'; ?>">Home</a>
        </li>
        <li>
          <a href="<?php echo esc_url(home_url('/a-propos')); ?>" class="<?php if (is_page('a-propos')) echo 'active'; ?>">About Us</a>
        </li>
        <li>
          <a href="<?php echo esc_url(home_url('/services')); ?>" class="<?php if (is_page('services')) echo 'active'; ?>">Services</a>
        </li>
        <li>
          <a href="<?php echo esc_url(home_url('/partenaire')); ?>" class="<?php if (is_page('partenaire')) echo 'active'; ?>">Partners</a>
        </li>
        <li>
          <a href="<?php echo esc_url(get_post_type_archive_link('post')); ?>" class="<?php if (is_home() || is_archive()) echo 'active'; ?>">Blog</a>
        </li>
        <li>
          <a href="<?php echo esc_url(home_url('/contact')); ?>" class="<?php if (is_page('contact')) echo 'active'; ?>">Contacts</a>
        </li>
      </ul>
    </div>
  </nav>
</header>
<?php wp_footer(); ?>
</body>
</html>