<?php
/*
Template Name: À propos
*/
get_header(); ?>

<!-- TITRE + IMAGE PRINCIPALE -->
<section class="apropos-hero">
  <div class="container">
    <h1><?php echo get_theme_mod('apropos_titre'); ?></h1>
    <?php if (get_theme_mod('apropos_image')) : ?>
      <img src="<?php echo esc_url(get_theme_mod('apropos_image')); ?>" class="apropos-image" alt="About us image">
    <?php endif; ?>
  </div>
</section>

<!-- SOUS-TITRE + INTRO -->
<section class="apropos-intro">
  <div class="container">
    <h2><?php echo get_theme_mod('apropos_soustitre'); ?></h2>
    <p><?php echo get_theme_mod('apropos_intro'); ?></p>
  </div>
</section>
<!-- 3 COLONNES -->
<section class="apropos-columns">
  <div class="container">
    <div class="columns-wrapper">
      <?php if (get_theme_mod('apropos_bloc_image')) : ?>
        <div class="left-image">
          <img src="<?php echo esc_url(get_theme_mod('apropos_bloc_image')); ?>" alt="Image section">
        </div>
      <?php endif; ?>

      <div class="columns">
        <?php foreach (['who', 'vision', 'mission'] as $key): ?>
          <div class="column">
            <h3><?php echo get_theme_mod("apropos_bloc_{$key}_titre"); ?></h3>
            <p><?php echo get_theme_mod("apropos_bloc_{$key}_texte"); ?></p>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>

<!-- ÉQUIPE -->
<section class="apropos-team">
  <div class="container">
    <h2><?php echo get_theme_mod('apropos_team_titre'); ?></h2>
    <div class="team-members">
      <?php for ($i = 1; $i <= 4; $i++): ?>
        <div class="member">
          <?php if (get_theme_mod("apropos_team_{$i}_image")) : ?>
            <img src="<?php echo esc_url(get_theme_mod("apropos_team_{$i}_image")); ?>" alt="Membre <?php echo $i; ?>">
          <?php endif; ?>
          <p class="poste"><?php echo get_theme_mod("apropos_team_{$i}_poste"); ?></p>
          <p class="tel"><?php echo get_theme_mod("apropos_team_{$i}_tel"); ?></p>
          <p class="mail"><?php echo get_theme_mod("apropos_team_{$i}_mail"); ?></p>
        </div>
      <?php endfor; ?>
    </div>
  </div>
</section>

<?php get_footer(); ?>
