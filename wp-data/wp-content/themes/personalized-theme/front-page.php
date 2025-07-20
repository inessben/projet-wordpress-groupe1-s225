<?php
/*
Template Name: Accueil
*/
get_header(); ?>

<!-- HERO -->
<section class="hero">
  <div class="container">
    <h1><?php echo get_theme_mod('accueil_hero_titre'); ?></h1>
    <?php if (get_theme_mod('accueil_hero_image')) : ?>
      <img src="<?php echo esc_url(get_theme_mod('accueil_hero_image')); ?>" alt="Image d’accueil">
    <?php endif; ?>
  </div>
</section>

<!-- ABOUT US -->
<section class="about">
  <div class="container">
    <h2><?php echo get_theme_mod('accueil_about_titre'); ?></h2>
    <p><?php echo get_theme_mod('accueil_about_texte'); ?></p>
  </div>
</section>

<!-- 3 COLONNES -->
<section class="three-columns">
  <div class="container">
    <div class="columns-wrapper">
      <?php if (get_theme_mod('accueil_bloc_image')) : ?>
        <div class="left-image">
          <img src="<?php echo esc_url(get_theme_mod('accueil_bloc_image')); ?>" alt="Image bloc gauche">
        </div>
      <?php endif; ?>
      <div class="columns">
        <?php foreach (['who', 'vision', 'mission'] as $key): ?>
          <div class="column">
            <h3><?php echo get_theme_mod("accueil_bloc_{$key}_titre"); ?></h3>
            <p><?php echo get_theme_mod("accueil_bloc_{$key}_texte"); ?></p>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>

<!-- SERVICES -->
<section class="services">
  <div class="container">
    <h2><?php echo get_theme_mod('accueil_services_titre'); ?></h2>
    <div class="services-list">
      <?php for ($i = 1; $i <= 4; $i++): ?>
        <div class="service">
          <?php if (get_theme_mod("accueil_service_{$i}_image")) : ?>
            <img src="<?php echo esc_url(get_theme_mod("accueil_service_{$i}_image")); ?>" alt="Service <?php echo $i; ?>">
          <?php endif; ?>
          <p><?php echo get_theme_mod("accueil_service_{$i}_texte"); ?></p>
        </div>
      <?php endfor; ?>
    </div>
  </div>
</section>

<!-- PARTNERS -->
<section class="partners">
  <div class="container">
    <h2><?php echo get_theme_mod('accueil_partners_titre'); ?></h2>
    <div class="logos">
      <?php for ($i = 1; $i <= 6; $i++): ?>
        <?php if (get_theme_mod("accueil_partenaire_logo_{$i}")) : ?>
          <img src="<?php echo esc_url(get_theme_mod("accueil_partenaire_logo_{$i}")); ?>" alt="Partenaire <?php echo $i; ?>">
        <?php endif; ?>
      <?php endfor; ?>
    </div>
  </div>
</section>

<?php get_footer(); ?>
