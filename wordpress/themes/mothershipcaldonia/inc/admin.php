<?php
/**
 * Mothership Caldonia dashboard functions and definitions.
 *
 * @link https://github.com/eddiemachado/bones/blob/master/library/admin.php
 *
 * @package Mothership_Caldonia
 */

/**
 * ACF symlink fix.
 *
 * @link https://github.com/elliotcondon/acf/issues/124
 */
function mc_acf_symlink_fix() {
  if(function_exists('acf')) {
    acf()->settings['dir'] = WP_CONTENT_URL . '/plugins/advanced-custom-fields/';
  }
}
add_action('init', 'mc_acf_symlink_fix', 0);
