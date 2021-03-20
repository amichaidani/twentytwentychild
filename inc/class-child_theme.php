<?php
/**
 * Twenty Twenty Child theme functions.
 *
 * @package twentytwentychild
 */

/**
 * The child theme general functions.
 */
class Child_Theme {

	/**
	 * Constructor.
	 */
	public function __construct() {
		// Enqueue parent & child themes styles.
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );
		// Register new user after theme setup.
		add_action( 'after_setup_theme', array( $this, 'register_wp_test_user' ) );
	}

	/**
	 * Enqeueu parent theme & child theme styles.
	 *
	 * @since 1.0.0
	 */
	public function enqueue_styles() {

		$parenthandle = PARENT_THEME_NAME . '-style';
		$theme        = wp_get_theme();

		// TODO: Check if should check for deps of parent.
		wp_enqueue_style(
			$parenthandle,
			PARENT_THEME_PATH . '/style.css',
			array(),
			$theme->parent()->get( 'Version' )
		);
		wp_enqueue_style(
			CHILD_THEME_NAME . '-style',
			CHILD_THEME_PATH,
			array( $parenthandle ),
			$theme->get( 'Version' )
		);
	}

	/**
	 * Register new editor role user: 'wp-test', and disable admin bar for this user.
	 *
	 * @since 1.0.0
	 */
	public function register_wp_test_user() {

		if ( wp_doing_ajax() ) {
			return;
		}

		$wp_test_user_id = intval( get_option( 'wp_test_user_id' ) );

		if ( ! isset( $wp_test_user_id ) || 0 === $wp_test_user_id ) {

			$created_user_id = wp_create_user( 'wp-test', '123456789', 'wptest@elementor.com' );

			if ( ! is_wp_error( $created_user_id ) ) {

				// Set role to 'editor'.
				$created_user = get_user_by( 'id', $created_user_id );
				$created_user->set_role( 'editor' );

				// Save the user id as WordPress option.
				update_option( 'wp_test_user_id', $created_user_id );
			}
		}

	}

}

