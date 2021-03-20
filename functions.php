<?php
/**
 * Main functions.php file.
 *
 * @package twentytwentychild
 */

define( 'PARENT_THEME_NAME', 'twentytwenty' );
define( 'CHILD_THEME_NAME', 'twentytwentychild' );

define( 'PARENT_THEME_PATH', get_template_directory_uri() );
define( 'CHILD_THEME_PATH', get_stylesheet_directory() );

require_once CHILD_THEME_PATH . '/inc/class-child_theme.php';
require_once CHILD_THEME_PATH . '/inc/class-child_theme_admin.php';

/**
 * Start the engines!
 *
 * @since 1.0.0
 */
function init() {
	new Child_Theme();
	new Child_Theme_Admin();
}

init();


