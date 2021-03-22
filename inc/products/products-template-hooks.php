<?php
/**
 * Hooks to modify templates for products.
 *
 * @package child_theme
 */

/**
 * Add product youtube to product single post content.
 *
 * @param string $content original post content.
 * @return string modified content.
 */
function add_youtube_to_product_singular_content( $content ) {

	global $post;

	if ( is_singular() && 'product' === get_post_type( $post ) ) {
		return wp_kses_post( get_product_youtube( $post->ID ) . $content );
	}

	return $content;
}
add_filter( 'the_content', 'add_youtube_to_product_singular_content', 1, 1 );

/**
 * This adds the products list to homepage.
 * Not sure if this is what you meant guys for me to do.
 *
 * @return string
 */
function add_products_loop_to_homepage( $content ) {

	if ( is_front_page() ) {

		ob_start();

			// Query posts with the same 'product_cat' term id.
		query_posts(
			array(
				'post_type'   => 'product',
				'post_status' => 'publish',
				'limit'       => 20,
			)
		);

		// Output loop.
		get_template_part( 'template-parts/the-loop' );
		$html = ob_get_contents();
		ob_end_clean();
		wp_reset_query();

		$content .= $html;
	}

	return $content;
}

add_filter( 'the_content', 'add_products_loop_to_homepage', 1, 1 );
