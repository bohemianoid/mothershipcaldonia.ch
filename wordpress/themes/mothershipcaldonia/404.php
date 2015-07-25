<?php
/**
 * @package Mothership Caldonia
 */

?>

<!doctype html>
<html class="no-js" lang="de">
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?>>
    <button class="overlay__button overlay__button--open" id="js-overlay-open" type="button">Menu</button>
    <header>
      <h1 class="band-name"><span class="band-name__block band-name__block--left-aligned band-name__block--hyphenated">Mother</span><span class="band-name__block band-name__block--centered">404</span> <span class="band-name__block band-name__block--right-aligned">Caldonia</span></h1>
    </header>
    <div class="overlay overlay--slidedown" id="js-overlay">
      <button class="overlay__button overlay__button--close" id="js-overlay-close" type="button">Schliessen</button>
      <?php wp_nav_menu( array(
        'theme_location' => 'primary',
        'container' => 'nav',
        'container_class' => 'nav-primary',
        'menu_class' => 'nav-primary__menu',
        'menu_id' => 'primary'
      ) ); ?>
    </div>
    <main>
      <section>
        <article>
          <h2>Nicht gefunden</h2>
          <p>Die angeforderte Seite existiert nicht. Weiter zur <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">Startseite</a>.</p>
        </article>
      </section>
    </main>
  <?php wp_footer(); ?>
  </body>
</html>
