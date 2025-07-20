<?php
// TOUTE LA LOGIQUE DU THEME //

// Enregistrer les emplacements de menu
add_action('after_setup_theme', 'tp_register_nav_menu', 0);
function tp_register_nav_menu()
{
    register_nav_menus(array(
        'primary_menu' => __('Primary Menu', 'TP'),
        'footer_menu'  => __('Footer Menu', 'TP'),
    ));
}

add_action('wp_enqueue_scripts', 'tp_enqueue_assets', 10);
function tp_enqueue_assets()
{
    wp_enqueue_style('main', get_stylesheet_uri());
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css');
    wp_enqueue_script('main-script', get_template_directory_uri() . '/script.js', [], false, true);
}

add_action('after_setup_theme', 'tp_add_theme_support', 0);
function tp_add_theme_support()
{
    add_theme_support('custom-logo');
    add_theme_support('post-thumbnails');
}

// Fonction helper pour l'affichage des svg
function tp_getIcon($name)
{
    $markups = [
        'twitter' => '<svg width="18" height="15" ...></svg>',
        'facebook' => '<svg width="12" height="18" ...></svg>',
        'google' => '<svg width="18" height="18" ...></svg>',
        'linkedin' => '<svg width="19" height="18" ...></svg>'
    ];
    return $markups[$name] ?? '';
}

// Paramètres custom du thème (via le custom manager de WP)
add_action('customize_register', 'tp_customize_register');
function tp_customize_register($wp_customize)
{
    // Ajout d'une section
    $wp_customize->add_section('tp_param', [
        'title' => __('Réglages TP', 'TP'),
        'description' => __('Faites-vous plaisir !'),
        'priority' => 1,
        'capability' => 'edit_theme_options',
    ]);

    // Couleur principale
    $wp_customize->add_setting('main_color', [
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'default' => '#3f51b5',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'main_color', [
        'label' => __('Couleur principale', 'TP'),
        'section' => 'tp_param',
        'priority' => 1,
    ]));

    // Dark mode
    $wp_customize->add_setting('dark_mode', [
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'default' => false,
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_bool_value',
    ]);
    $wp_customize->add_control('dark_mode', [
        'type' => 'checkbox',
        'priority' => 2,
        'section' => 'tp_param',
        'label' => __('Dark mode', 'TP'),
        'description' => __('Black is beautiful :)', 'TP'),
    ]);

    // Afficher la recherche dans le footer
    $wp_customize->add_setting('has_footer_search', [
        'default' => false,
        'type' => 'theme_mod'
    ]);
    $wp_customize->add_control('has_footer_search', [
        'label' => 'Afficher la recherche dans le footer',
        'section' => 'title_tagline',
        'type' => 'checkbox'
    ]);

    // Réseaux sociaux
    $socials = ['twitter', 'facebook', 'google', 'linkedin'];
    foreach ($socials as $social) {
        $wp_customize->add_setting("url_$social", [
            'default' => '',
            'type' => 'theme_mod'
        ]);
        $wp_customize->add_control("url_$social", [
            'label' => "URL de $social",
            'section' => 'title_tagline',
            'type' => 'url'
        ]);
    }

    // Titres en majuscules
    $wp_customize->add_setting('uppercase_title', [
        'default' => false,
        'type' => 'theme_mod'
    ]);
    $wp_customize->add_control('uppercase_title', [
        'label' => 'Afficher tous les titres en MAJUSCULES',
        'section' => 'title_tagline',
        'type' => 'checkbox'
    ]);
}

function sanitize_bool_value($value)
{
    return is_bool($value) ? $value : false;
}

// Ajout d'un emplacement du menu supplémentaire
function tp_register_menus() {
    register_nav_menu('post-footer-menu', 'Menu sous les articles');
}
add_action('after_setup_theme', 'tp_register_menus');

// Custom Post Type Projet
function tp_register_project_post_type() {
    $labels = array(
        'name'               => 'Projets',
        'singular_name'      => 'Projet',
        'menu_name'          => 'Projets',
        'name_admin_bar'     => 'Projet',
        'add_new'            => 'Ajouter un projet',
        'add_new_item'       => 'Ajouter un nouveau projet',
        'new_item'           => 'Nouveau projet',
        'edit_item'          => 'Modifier le projet',
        'view_item'          => 'Voir le projet',
        'all_items'          => 'Tous les projets',
        'search_items'       => 'Rechercher des projets',
        'not_found'          => 'Aucun projet trouvé.',
        'not_found_in_trash' => 'Aucun projet dans la corbeille.',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'project' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-portfolio',
        'supports'           => array( 'title', 'editor', 'thumbnail' ),
        'show_in_rest'       => true
    );

    register_post_type( 'project', $args );
}
add_action( 'init', 'tp_register_project_post_type' );

// Prise en compte de la couleur principale custom
add_action('wp_head', 'tp_wp_head', 99);
function tp_wp_head()
{
    $main_color = get_theme_mod('main_color', '#3f51b5');
    echo '<style>:root{ --main-color: ' . $main_color . '}</style>';
}

// Prise en compte du mode dark
add_filter('body_class', 'tp_body_class');
function tp_body_class($classes)
{
    if (get_theme_mod('dark_mode', false)) {
        $classes[] = 'dark';
    }
    return $classes;
}

// ========================
// CONTENUS ÉDITABLES WP CUSTOMIZER
// ========================
function personalized_theme_customize_register($wp_customize) {

    // ========================
    // Section : PAGE ACCUEIL
    // ========================
    $wp_customize->add_section('accueil_section', [
        'title' => 'Page Accueil',
        'priority' => 30,
    ]);

    // Hero
    $wp_customize->add_setting('accueil_hero_titre', ['default' => 'A really professional structure for all your events!', 'sanitize_callback' => 'sanitize_text_field']);
    $wp_customize->add_control('accueil_hero_titre', ['label' => 'Titre Hero', 'section' => 'accueil_section', 'type' => 'text']);

    $wp_customize->add_setting('accueil_hero_image');
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'accueil_hero_image', ['label' => 'Image Hero', 'section' => 'accueil_section']));

    // About Us
    $wp_customize->add_setting('accueil_about_titre', ['default' => 'About Us', 'sanitize_callback' => 'sanitize_text_field']);
    $wp_customize->add_control('accueil_about_titre', ['label' => 'Titre About Us', 'section' => 'accueil_section', 'type' => 'text']);

    $wp_customize->add_setting('accueil_about_texte', ['sanitize_callback' => 'sanitize_textarea_field']);
    $wp_customize->add_control('accueil_about_texte', ['label' => 'Texte About Us', 'section' => 'accueil_section', 'type' => 'textarea']);

    // Bloc 3 colonnes
    $wp_customize->add_setting('accueil_bloc_image');
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'accueil_bloc_image', [
        'label' => 'Image à gauche des blocs (Accueil)',
        'section' => 'accueil_section',
    ]));

    foreach (['who' => 'Who are we?', 'vision' => 'Our vision', 'mission' => 'Our mission'] as $key => $label) {
        $wp_customize->add_setting("accueil_bloc_{$key}_titre", ['default' => $label, 'sanitize_callback' => 'sanitize_text_field']);
        $wp_customize->add_control("accueil_bloc_{$key}_titre", ['label' => "Titre $label", 'section' => 'accueil_section', 'type' => 'text']);

        $wp_customize->add_setting("accueil_bloc_{$key}_texte", ['sanitize_callback' => 'sanitize_textarea_field']);
        $wp_customize->add_control("accueil_bloc_{$key}_texte", ['label' => "Texte $label", 'section' => 'accueil_section', 'type' => 'textarea']);
    }

    // Our Services
    $wp_customize->add_setting('accueil_services_titre', ['default' => 'Our Services', 'sanitize_callback' => 'sanitize_text_field']);
    $wp_customize->add_control('accueil_services_titre', ['label' => 'Titre Services', 'section' => 'accueil_section', 'type' => 'text']);

    for ($i = 1; $i <= 4; $i++) {
        $wp_customize->add_setting("accueil_service_{$i}_image");
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, "accueil_service_{$i}_image", ['label' => "Image Service $i", 'section' => 'accueil_section']));
        $wp_customize->add_setting("accueil_service_{$i}_texte", ['sanitize_callback' => 'sanitize_text_field']);
        $wp_customize->add_control("accueil_service_{$i}_texte", ['label' => "Texte Service $i", 'section' => 'accueil_section', 'type' => 'text']);
    }

    // Our Partners
    $wp_customize->add_setting('accueil_partners_titre', ['default' => 'Our Partners', 'sanitize_callback' => 'sanitize_text_field']);
    $wp_customize->add_control('accueil_partners_titre', ['label' => 'Titre Partenaires', 'section' => 'accueil_section', 'type' => 'text']);

    for ($i = 1; $i <= 6; $i++) {
        $wp_customize->add_setting("accueil_partenaire_logo_{$i}");
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, "accueil_partenaire_logo_{$i}", ['label' => "Logo Partenaire $i", 'section' => 'accueil_section']));
    }

    // ========================
    // Section : PAGE À PROPOS
    // ========================
$wp_customize->add_section('apropos_section', [
  'title' => 'Page À propos',
  'priority' => 31,
]);

// Titre principal et image
$wp_customize->add_setting('apropos_titre', ['default' => 'About us.', 'sanitize_callback' => 'sanitize_text_field']);
$wp_customize->add_control('apropos_titre', ['label' => 'Titre principal', 'section' => 'apropos_section', 'type' => 'text']);

$wp_customize->add_setting('apropos_image');
$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'apropos_image', ['label' => 'Image principale', 'section' => 'apropos_section']));

// Sous-titre + intro
$wp_customize->add_setting('apropos_soustitre', ['default' => 'Sky’s the limit', 'sanitize_callback' => 'sanitize_text_field']);
$wp_customize->add_control('apropos_soustitre', ['label' => 'Sous-titre', 'section' => 'apropos_section', 'type' => 'text']);

$wp_customize->add_setting('apropos_intro', ['sanitize_callback' => 'sanitize_textarea_field']);
$wp_customize->add_control('apropos_intro', ['label' => 'Texte introductif', 'section' => 'apropos_section', 'type' => 'textarea']);

$wp_customize->add_setting('apropos_bloc_image');
$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'apropos_bloc_image', [
  'label' => 'Image à gauche des blocs 3 colonnes',
  'section' => 'apropos_section',
]));

// Bloc 3 colonnes
foreach (['who' => 'Who are we?', 'vision' => 'Our vision', 'mission' => 'Our mission'] as $key => $label) {
  $wp_customize->add_setting("apropos_bloc_{$key}_titre", ['default' => $label, 'sanitize_callback' => 'sanitize_text_field']);
  $wp_customize->add_control("apropos_bloc_{$key}_titre", ['label' => "Titre $label", 'section' => 'apropos_section', 'type' => 'text']);

  $wp_customize->add_setting("apropos_bloc_{$key}_texte", ['sanitize_callback' => 'sanitize_textarea_field']);
  $wp_customize->add_control("apropos_bloc_{$key}_texte", ['label' => "Texte $label", 'section' => 'apropos_section', 'type' => 'textarea']);
}

// Bloc Équipe
$wp_customize->add_setting('apropos_team_titre', ['default' => 'Our Team', 'sanitize_callback' => 'sanitize_text_field']);
$wp_customize->add_control('apropos_team_titre', ['label' => 'Titre Équipe', 'section' => 'apropos_section', 'type' => 'text']);

for ($i = 1; $i <= 4; $i++) {
  $wp_customize->add_setting("apropos_team_{$i}_image");
  $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, "apropos_team_{$i}_image", ['label' => "Image Membre $i", 'section' => 'apropos_section']));

  $wp_customize->add_setting("apropos_team_{$i}_poste", ['sanitize_callback' => 'sanitize_text_field']);
  $wp_customize->add_control("apropos_team_{$i}_poste", ['label' => "Poste Membre $i", 'section' => 'apropos_section', 'type' => 'text']);

  $wp_customize->add_setting("apropos_team_{$i}_tel", ['sanitize_callback' => 'sanitize_text_field']);
  $wp_customize->add_control("apropos_team_{$i}_tel", ['label' => "Téléphone Membre $i", 'section' => 'apropos_section', 'type' => 'text']);

  $wp_customize->add_setting("apropos_team_{$i}_mail", ['sanitize_callback' => 'sanitize_email']);
  $wp_customize->add_control("apropos_team_{$i}_mail", ['label' => "Email Membre $i", 'section' => 'apropos_section', 'type' => 'email']);
}

  // ========================
  // Section : PAGE BLOG
  // ========================
  $wp_customize->add_section('blog_section', [
    'title' => 'Page Blog',
    'priority' => 32,
  ]);

  $wp_customize->add_setting('texte_intro_blog', [
    'default' => 'Bienvenue sur le blog.',
    'sanitize_callback' => 'sanitize_textarea_field',
  ]);
  $wp_customize->add_control('texte_intro_blog', [
    'label' => 'Texte introductif du blog',
    'section' => 'blog_section',
    'type' => 'textarea',
  ]);


// ========================
// Section : PAGE SERVICES
// ========================
$wp_customize->add_section('services_section', [
  'title' => 'Page Services',
  'priority' => 35,
]);

// Titre de section 
$wp_customize->add_setting('accueil_services_titre', [
  'default' => 'Our Services',
  'sanitize_callback' => 'sanitize_text_field'
]);
$wp_customize->add_control('accueil_services_titre', [
  'label' => 'Titre Principal de la page Services',
  'section' => 'services_section',
  'type' => 'text'
]);

// Services (image + texte)
for ($i = 1; $i <= 4; $i++) {
  $wp_customize->add_setting("accueil_service_{$i}_image");
  $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, "accueil_service_{$i}_image", [
    'label' => "Image Service $i",
    'section' => 'services_section',
  ]));

  $wp_customize->add_setting("accueil_service_{$i}_texte", [
    'sanitize_callback' => 'sanitize_text_field'
  ]);
  $wp_customize->add_control("accueil_service_{$i}_texte", [
    'label' => "Texte Service $i",
    'section' => 'services_section',
    'type' => 'text'
  ]);
}

// Description 
$wp_customize->add_setting('services_description_titre', [
  'default' => 'Corp. Parties',
  'sanitize_callback' => 'sanitize_text_field'
]);
$wp_customize->add_control('services_description_titre', [
  'label' => 'Titre (Corp. Parties)',
  'section' => 'services_section',
  'type' => 'text'
]);

$wp_customize->add_setting('services_description_texte', [
  'sanitize_callback' => 'sanitize_textarea_field'
]);
$wp_customize->add_control('services_description_texte', [
  'label' => 'Texte descriptif (Corp. Parties)',
  'section' => 'services_section',
  'type' => 'textarea'
]);

// Image bannière (footer visuel)
$wp_customize->add_setting('services_banner_image');
$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'services_banner_image', [
  'label' => 'Image bannière en bas de page',
  'section' => 'services_section',
]));

  // ========================
  // Section : PAGE PARTENAIRES
  // ========================
$wp_customize->add_section('partenaire_section', [
  'title' => 'Page Partenaire',
  'priority' => 35,
]);

$wp_customize->add_setting('partenaire_titre', [
  'default' => 'Our Partners',
  'sanitize_callback' => 'sanitize_text_field',
]);

$wp_customize->add_control('partenaire_titre', [
  'label' => 'Titre',
  'section' => 'partenaire_section',
  'type' => 'text',
]);

for ($i = 1; $i <= 6; $i++) {
  $wp_customize->add_setting("partenaire_logo_{$i}");
  $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, "partenaire_logo_{$i}", [
    'label' => "Logo Partenaire $i",
    'section' => 'partenaire_section',
  ]));
}


  // ========================
  // Section : PAGE 404
  // ========================
  $wp_customize->add_section('error404_section', [
    'title' => 'Page 404',
    'priority' => 35,
  ]);

  $wp_customize->add_setting('texte_404', [
    'default' => 'Oups, cette page est introuvable.',
    'sanitize_callback' => 'sanitize_textarea_field',
  ]);
  $wp_customize->add_control('texte_404', [
    'label' => 'Texte d’erreur',
    'section' => 'error404_section',
    'type' => 'textarea',
  ]);

  // ========================
  // Section : PAGE RECHERCHE
  // ========================
  $wp_customize->add_section('recherche_section', [
    'title' => 'Page de recherche',
    'priority' => 36,
  ]);

  $wp_customize->add_setting('titre_recherche', [
    'default' => 'Résultats de recherche',
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('titre_recherche', [
    'label' => 'Titre de la page',
    'section' => 'recherche_section',
    'type' => 'text',
  ]);

// ========================
// Section : PAGE CONTACT
// ========================
$wp_customize->add_section('page_contact', [
  'title' => 'Page Contact',
  'priority' => 60,
]);

// Titre principal
$wp_customize->add_setting('contact_title', ['default' => 'Contacts.']);
$wp_customize->add_control('contact_title', [
  'label' => 'Titre principal',
  'section' => 'page_contact',
  'type' => 'text'
]);

// Description introductive
$wp_customize->add_setting('contact_intro', ['default' => 'A desire for a big big party or a very select congress? Contact us.']);
$wp_customize->add_control('contact_intro', [
  'label' => 'Texte d’introduction',
  'section' => 'page_contact',
  'type' => 'textarea'
]);

// Adresse
$wp_customize->add_setting('contact_location', ['default' => '242 Rue du Faubourg Saint-Antoine<br>75020 Paris FRANCE']);
$wp_customize->add_control('contact_location', [
  'label' => 'Adresse (Location)',
  'section' => 'page_contact',
  'type' => 'textarea'
]);

// Manager - Téléphone
$wp_customize->add_setting('contact_manager_phone', ['default' => '+33 1 53 31 25 23']);
$wp_customize->add_control('contact_manager_phone', [
  'label' => 'Téléphone Manager',
  'section' => 'page_contact',
  'type' => 'text'
]);

// Manager - Email
$wp_customize->add_setting('contact_manager_email', ['default' => 'info@company.com']);
$wp_customize->add_control('contact_manager_email', [
  'label' => 'Email Manager',
  'section' => 'page_contact',
  'type' => 'text'
]);

// CEO - Téléphone
$wp_customize->add_setting('contact_ceo_phone', ['default' => '+33 1 53 31 25 25']);
$wp_customize->add_control('contact_ceo_phone', [
  'label' => 'Téléphone CEO',
  'section' => 'page_contact',
  'type' => 'text'
]);

// CEO - Email
$wp_customize->add_setting('contact_ceo_email', ['default' => 'ceo@company.com']);
$wp_customize->add_control('contact_ceo_email', [
  'label' => 'Email CEO',
  'section' => 'page_contact',
  'type' => 'text'
]);

// Image
$wp_customize->add_setting('contact_image');
$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'contact_image', [
  'label' => 'Image de la section contact',
  'section' => 'page_contact',
  'settings' => 'contact_image'
]));

// Titre formulaire
$wp_customize->add_setting('contact_form_title', ['default' => 'Write us here']);
$wp_customize->add_control('contact_form_title', [
  'label' => 'Titre du formulaire',
  'section' => 'page_contact',
  'type' => 'text'
]);

// Description formulaire
$wp_customize->add_setting('contact_form_desc', ['default' => "Go! Don’t be shy."]);
$wp_customize->add_control('contact_form_desc', [
  'label' => 'Description du formulaire',
  'section' => 'page_contact',
  'type' => 'text'
]);


}
add_action('customize_register', 'personalized_theme_customize_register', 20);

function theme_custom_setup() {
    // Support des images à la une
    add_theme_support('post-thumbnails');

    // Enregistrement de la sidebar principale
    register_sidebar([
        'name'          => __('Sidebar principale', 'textdomain'),
        'id'            => 'sidebar-1',
        'description'   => __('Ajoutez ici vos widgets pour la sidebar.', 'textdomain'),
        'before_widget' => '<div class="widget %2$s" id="%1$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
    ]);
}

add_action('after_setup_theme', 'theme_custom_setup');

function custom_search_form($form) {
  $form = '
    <form role="search" method="get" class="search-form" action="' . home_url('/') . '">
      <label>
        <input type="search" class="search-field" placeholder="Type to search" value="' . get_search_query() . '" name="s" />
      </label>
      <button type="submit"><span class="dashicons dashicons-search"></span></button>
    </form>';
  return $form;
}
add_filter('get_search_form', 'custom_search_form');


// Ajout des icones
function theme_enqueue_styles() {
  wp_enqueue_style('theme-style', get_stylesheet_uri());
  wp_enqueue_style('fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css', [], null);
}
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');

// Gestion de l'envoi du formulaire de contact
function handle_contact_form() {
  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'send_contact_form') {
    $to = get_option('admin_email'); // ou une autre adresse si besoin
    $subject = sanitize_text_field($_POST['subject']);
    $email = sanitize_email($_POST['email']);
    $phone = sanitize_text_field($_POST['phone']);
    $message = sanitize_textarea_field($_POST['message']);

    $body = "Email: $email\nPhone: $phone\n\nMessage:\n$message";
    $headers = ["Reply-To: $email"];

    wp_mail($to, $subject, $body, $headers);

    wp_redirect(home_url('/contact?sent=1'));
    exit;
  }
}
add_action('template_redirect', 'handle_contact_form');
