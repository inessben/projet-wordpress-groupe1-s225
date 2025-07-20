<?php
/*
Template Name: Services
*/
get_header(); ?>

<section class="services-page">
  <div class="container">
    <h1><?php echo get_theme_mod('accueil_services_titre'); ?></h1>

    <div class="services-gallery">
      <?php for ($i = 1; $i <= 4; $i++): ?>
        <div class="service-box">
          <?php if (get_theme_mod("accueil_service_{$i}_image")) : ?>
            <img src="<?php echo esc_url(get_theme_mod("accueil_service_{$i}_image")); ?>" alt="Service <?php echo $i; ?>">
          <?php endif; ?>
          <p><?php echo get_theme_mod("accueil_service_{$i}_texte"); ?></p>
        </div>
      <?php endfor; ?>
    </div>

  <div class="services-description">
    <h2><?php echo get_theme_mod('services_description_titre'); ?></h2>
    <p><?php echo get_theme_mod('services_description_texte'); ?></p>
  </div>


    <div class="services-banner">
      <img src="<?php echo get_theme_mod('services_banner_image'); ?>" alt="Big Event Image">
    </div>
  </div>
</section>

<?php get_footer(); ?>
