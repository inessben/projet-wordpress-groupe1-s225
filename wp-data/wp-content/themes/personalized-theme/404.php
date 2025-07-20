<?php get_header();
/* 
Template Name: 404
*/
?>

<main class="page-404">
  <section class="container">
    <h1>404 Error.</h1>
    <p>The page you were looking for couldn’t be found.</p>
    <p>Maybe try a search?</p>

    <form class="search-form" method="get" action="<?php echo esc_url(home_url('/')); ?>">
      <input type="search" name="s" placeholder="Type something to search..." />
      <button type="submit">
        <span class="dashicons dashicons-search"></span>
      </button>
    </form>
  </section>
</main>

<?php get_footer(); ?>