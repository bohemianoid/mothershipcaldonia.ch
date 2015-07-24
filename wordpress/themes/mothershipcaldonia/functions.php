<?php
/**
 * @package Mothership Caldonia
 */

if ( ! function_exists( 'mc_setup' ) ) :
function mc_setup() {
  /*
   * Let WordPress manage the document title.
   * By adding theme support, we declare that this theme does not use a
   * hard-coded <title> tag in the document head, and expect WordPress to
   * provide it for us.
   */
  add_theme_support( 'title-tag' );
}
endif; // mc_setup
add_action( 'after_setup_theme', 'mc_setup' );

/**
 * Font URLs function.
 */
function mc_fonts_url() {
  $font_families[] = 'Oswald:700';
  $font_families[] = 'Open Sans:600,400';
  $font_families[] = 'PT Mono';

  $query_args = array(
    'family' => urlencode( implode( '|', $font_families ) ),
    'subset' => urlencode( 'latin' )
  );

  $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
  return esc_url_raw( $fonts_url );
}

/**
 * Enqueue scripts and styles.
 */
function mc_scripts() {
  wp_enqueue_style( 'mc-fonts', mc_fonts_url(), array(), null );

  wp_enqueue_style( 'mc-icons', '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css', array(), null );

  wp_enqueue_style( 'mc-style', get_stylesheet_uri(), array(), null );
}
add_action( 'wp_enqueue_scripts', 'mc_scripts' );

/*
 * Easter egg
 */
