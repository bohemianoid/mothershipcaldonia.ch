<?php
/**
 * @package Mothership Caldonia
 */

?><!doctype html>
<html class="no-js" lang="de">
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="Erfrischender Sound aus Zug &ndash; mal groovy und funky, mal soulful und deep.">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?>>
    <header>
      <button class="header__button button--link" id="js-open-overlay" type="button"><span class="fa fa-angle-double-down icon-push"></span>Menu</button>
      <h1 class="header__band-name"><span class="band-name__block band-name__block--left-aligned">Mother</span><span class="band-name__block band-name__block--centered"><?php echo !is_404() ? ( !get_query_var( 'easter', false ) ? 'Ship' : '5hip' ) : '404' ?></span> <span class="band-name__block band-name__block--right-aligned">Caldonia</span></h1>
    </header>
    <div class="overlay overlay--slidedown" id="js-overlay">
      <div class="overlay__main">
        <button class="overlay__button button--link" id="js-close-overlay" type="button"><span class="fa fa-angle-double-up"></span><span class="visuallyhidden">Schliessen</span></button>
        <nav class="overlay__nav">
          <ul>
            <?php wp_nav_menu( array(
              'theme_location' => 'primary',
              'container'      => false,
              'items_wrap'     => '%3$s'
            ) ); ?>
          </ul>
        </nav>
      </div>
      <footer class="overlay__footer">
        <ul class="social social--horizontal">
          <li><a href="http://facebook.com/mothershipcaldonia">Facebook</a></li>
        </ul>
      </footer>
    </div>
