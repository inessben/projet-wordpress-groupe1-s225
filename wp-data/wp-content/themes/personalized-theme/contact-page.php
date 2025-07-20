<?php
/*
Template Name: Contact
*/
get_header(); ?>

<?php if (isset($_GET['sent']) && $_GET['sent'] == '1') : ?>
  <div class="form-success">
    ✔ Your message has been sent successfully.
  </div>
<?php endif; ?>

<section class="contact-page">

  <!-- Bloc Intro -->
  <div class="contact-intro container">
    <h1><?php echo get_theme_mod('contact_title'); ?></h1>
    <p class="intro-sub"><?php echo get_theme_mod('contact_intro'); ?></p>
  </div>

  <!-- Infos : Location - Manager - CEO -->
  <div class="contact-infos container">
    <div class="info-block">
      <h4>Location</h4>
      <p><?php echo get_theme_mod('contact_location'); ?></p>
    </div>
    <div class="info-block">
      <h4>Manager</h4>
      <p><?php echo get_theme_mod('contact_manager_phone'); ?></p>
      <p><?php echo get_theme_mod('contact_manager_email'); ?></p>
    </div>
    <div class="info-block">
      <h4>CEO</h4>
      <p><?php echo get_theme_mod('contact_ceo_phone'); ?></p>
      <p><?php echo get_theme_mod('contact_ceo_email'); ?></p>
    </div>
  </div>

  <!-- Image plein écran -->
  <div class="contact-image-full">
    <?php if(get_theme_mod('contact_image')): ?>
      <img src="<?php echo esc_url(get_theme_mod('contact_image')); ?>" alt="Contact">
    <?php endif; ?>
  </div>

  <!-- Formulaire -->
  <div class="contact-form container">
    <h2><?php echo get_theme_mod('contact_form_title'); ?></h2>
    <p class="form-sub"><?php echo get_theme_mod('contact_form_desc'); ?></p>

    <form method="post" action="">
      <input type="hidden" name="action" value="send_contact_form">
      <input type="text" name="subject" placeholder="Subject" required>

      <div class="form-flex">
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="phone" placeholder="Phone no.">
      </div>

      <textarea name="message" placeholder="Message" required></textarea>

      <button type="submit">Submit</button>
    </form>
  </div>

</section>

<?php get_footer(); ?>
