<?php
/**
 * Twenty Twenty Child theme functions.
 *
 * @package child_theme
 */

/**
 * The child theme general functions.
 */
class Child_Theme {

	/**
	 * Constructor.
	 */
	public function __construct() {
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );
		add_action( 'after_switch_theme', array( $this, 'register_wp_test_user' ) );
		add_filter( 'wp_kses_allowed_html', array( $this, 'allow_iframe_for_wp_kses_post' ), 10, 2 );
		add_filter( 'get_the_archive_title', array( $this, 'remove_archive_title_prefix' ), 10, 1 );
		add_action( 'wp_head', array( $this, 'add_custom_address_bar_color' ) );
	}

	/**
	 * Enqeueu parent theme & child theme styles.
	 */
	public function enqueue_styles() {

		$parenthandle = PARENT_THEME_NAME . '-style';
		$theme        = wp_get_theme();

		// TODO: Check if should check for deps of parent.
		wp_enqueue_style(
			$parenthandle,
			PARENT_THEME_URI . '/style.css',
			array(),
			$theme->parent()->get( 'Version' )
		);
		wp_enqueue_style(
			CHILD_THEME_NAME . '-style',
			CHILD_THEME_URI . '/style.css',
			array( $parenthandle ),
			$theme->get( 'Version' )
		);
	}

	/**
	 * Register new editor role user: 'wp-test', and disable admin bar for this user.
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

	/**
	 * Allow wp_kses_post to output Iframes.
	 *
	 * @param array  $tags allowed tags.
	 * @param string $context the context.
	 * @return array the allowed tags modified.
	 */
	public function allow_iframe_for_wp_kses_post( $tags, $context ) {

		if ( 'post' === $context ) {
			$tags['iframe'] = array(
				'src'             => true,
				'height'          => true,
				'width'           => true,
				'frameborder'     => true,
				'allowfullscreen' => true,
			);
		}

		return $tags;
	}

	/**
	 * Remove prefix 'archives' from posts archives.
	 *
	 * @param string $title the original title.
	 * @return string the new foramatted title.
	 */
	public function remove_archive_title_prefix( $title ) {
		$title = post_type_archive_title( '', false );
		return $title;
	}

	/**
	 * Add custom address bar color to <head>.
	 */

	function add_custom_address_bar_color() {
		echo '<meta name="theme-color" content="#cd2653" />';
	}
}




