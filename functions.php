<?php
/**
 * Main functions.php file.
 *
 * @package child_theme
 */

define( 'PARENT_THEME_NAME', 'twentytwenty' );
define( 'CHILD_THEME_NAME', 'twentytwentychild' );

define( 'PARENT_THEME_PATH', get_template_directory() );
define( 'PARENT_THEME_URI', get_template_directory_uri() );

define( 'CHILD_THEME_PATH', get_stylesheet_directory() );
define( 'CHILD_THEME_URI', get_stylesheet_directory_uri() );

require_once CHILD_THEME_PATH . '/inc/class-child-theme.php';
require_once CHILD_THEME_PATH . '/inc/class-child-theme-admin.php';

require_once CHILD_THEME_PATH . '/inc/products/products.php';

/**
 * Start the engines!
 */
function twentytwenty_child_init() {
	new Child_Theme();
	new Child_Theme_Admin();
}

twentytwenty_child_init();