<?php
/**
 * The child theme main singleton class.
 *
 * @package child_theme
 */

/**
 * Child theme main singleton.
 */
class Child_Theme {

	/**
	 * The unique instance of the theme.
	 *
	 * @var Child_Theme
	 */
	private static $instance;

	/**
	 * Gets an instance of our theme.
	 *
	 * @return Child_Theme
	 */
	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Constructor.
	 */
	private function __construct() {
		require_once CHILD_THEME_PATH . '/inc/class-child-theme-functions.php';
		require_once CHILD_THEME_PATH . '/inc/class-child-theme-admin.php';

		require_once CHILD_THEME_PATH . '/inc/products/products.php';

		new Child_Theme_Functions();
		new Child_Theme_Admin();
	}
}
