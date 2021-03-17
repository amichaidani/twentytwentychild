<?php
/**
 * Twenty Twenty Child theme functions.
 *
 * @package twentytwentychild
 */

/**
 * The child theme functions.
 */
class Twentytwentychild_Theme {
	/**
	 * Constructor.
	 */
	public function __construct() {
		// Enqueue parent & child themes styles.
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );
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
}

