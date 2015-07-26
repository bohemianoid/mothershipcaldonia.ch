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
    <header>
      <button class="header__button button--link" id="js-open-overlay" type="button"><span class="fa fa-angle-double-down"></span>Menu</button>
      <h1 class="band-name"><span class="band-name__block band-name__block--left-aligned">Mother</span><span class="band-name__block band-name__block--centered">404</span> <span class="band-name__block band-name__block--right-aligned">Caldonia</span></h1>
    </header>
    <div class="overlay overlay--slidedown" id="js-overlay">
      <button class="overlay__button button--link" id="js-close-overlay" type="button"><span class="fa fa-angle-double-up"></span>Schliessen</button>
      <?php wp_nav_menu( array(
        'theme_location' => 'primary',
        'container' => 'nav',
        'container_class' => 'overlay__nav',
        'menu_class' => 'nav-primary__menu',
        'menu_id' => 'primary'
      ) ); ?>
      <footer class="overlay__footer">
        <ul class="social social--horizontal">
          <li><a href="#">Facebook</a></li>
        </ul>
      </footer>
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
