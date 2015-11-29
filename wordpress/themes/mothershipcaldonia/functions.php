<?php
/**
 * Mothership Caldonia functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @link https://github.com/roots/sage/blob/master/functions.php
 *
 * @package Mothership_Caldonia
 */

$mc_includes = [
  'inc/admin.php',       // Admin dashboard
  'inc/setup.php',       // Theme setup
  'post-types/event.php' // Event post type
];

foreach ($mc_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'mc'), $file),
                  E_USER_ERROR);
  }
  require_once $filepath;
}
unset($file, $filepath);
