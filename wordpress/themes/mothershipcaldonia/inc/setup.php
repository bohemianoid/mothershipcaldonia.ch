<?php
/**
 * Mothership Caldonia theme setup.
 *
 * @link https://github.com/roots/sage/blob/master/lib/setup.php
 * @link https://github.com/Automattic/_s/blob/master/functions.php
 *
 * @package Mothership_Caldonia
 */

if (!function_exists('mc_setup')) :
  /**
   * Sets up theme defaults and registers support for various
   * WordPress features.
   */
  function mc_setup() {
    /*
     * Let WordPress manage the document title.
     */
    add_theme_support('title-tag');

    /*
     * Enable support for Post Thumbnails on posts and pages.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');
  }
endif;
add_action('after_setup_theme', 'mc_setup');
