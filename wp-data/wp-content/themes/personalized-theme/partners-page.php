<?php
/* 
Template Name: Partenaires
*/
get_header(); ?>

<section class="partners-section">
  <div class="container">
    <h2><?php echo esc_html(get_theme_mod('accueil_partners_titre', 'Our Partners')); ?></h2>
    <div class="partners-logos">
      <?php for ($i = 1; $i <= 6; $i++) : 
        $logo = get_theme_mod("accueil_partenaire_logo_{$i}");
        if ($logo): ?>
          <img src="<?php echo esc_url($logo); ?>" alt="Logo Partenaire <?php echo $i; ?>">
        <?php endif;
      endfor; ?>
    </div>
  </div>
</section>


<?php get_footer(); ?>
