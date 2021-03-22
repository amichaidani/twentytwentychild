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

/**
 * Get the singleton instance of the whole thing.
 */
function init_child_theme() {
	$child_theme = Child_Theme::get_instance();
}

init_child_theme();
