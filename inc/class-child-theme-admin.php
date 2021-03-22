<?php
/**
 * Child theme admin class.
 * 
 * @package child_theme
 */

/**
 * Child theme admin functions.
 */
class Child_Theme_Admin {

	/**
	 * Constructor.
	 */
	public function __construct() {
		// Disable admin bar for 'wp-test' user.
		add_filter( 'show_admin_bar', array( $this, 'disable_admin_bar_for_wp_test_user' ), 999, 1 );
	}

	/**
	 * Disable admin bar for 'wp_test' user.
	 *
	 * @param boolean $show_admin_bar is showing admin bar for user.
	 * @return boolean
	 */
	public function disable_admin_bar_for_wp_test_user( $show_admin_bar ) {

		$current_user_id = get_current_user_id();
		$wp_test_user_id = intval( get_option( 'wp_test_user_id' ) );

		if ( $wp_test_user_id === $current_user_id ) {
			$show_admin_bar = false;
		}

		return $show_admin_bar;
	}
}
