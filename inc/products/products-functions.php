<?php
/**
 * Products functions.
 *
 * @package child_theme
 */

/**
 * Create new product post.
 *
 * @param array $product_args product fields to set and values.
 * @return int|false product id if success, false if error.
 */
function create_new_product( $product_args = null ) {

	$new_post_id = wp_insert_post(
		array(
			'post_type'   => 'product',
			'post_status' => 'publish',
		),
		true
	);

	if ( ! is_wp_error( $new_post_id ) ) {
		$product = new Product( $new_post_id );

		if ( is_array( $product_args ) && ! empty( $product_args ) ) {
			$product->set_fields( $product_args );
		}

		return $new_post_id;

	} else {
		return false;
	}
}

/**
 * Get product by id.
 *
 * @param int $post_id the product id.
 * @return array|false the product object is exists, false if not.
 */
function get_product_by_id( $product_id = null ) {
	if ( ! isset( $product_id ) || ! is_int( $product_id ) ) {
		return false;
	}

	$product = new Product( $product_id );

	return $product;
}

/**
 * Get product price markup.
 *
 * @param int $product_id the product id.
 * @return string
 */
function get_product_price_html( $product_id = null ) {

	$product = get_product_by_id( $product_id );

	if ( ! $product ) {
		return '';
	}

	$currency      = '$';
	$regular_price = $product->get_price();
	$sale_price    = $product->get_sale_price();
	$is_on_sale    = $product->is_on_sale();

	if ( ! isset( $regular_price ) || ! is_numeric( $regular_price ) || 0 === $regular_price ) {
		return '';
	}

	$regular_price_html = '<span class="product-price-regular">' . $regular_price . $currency . '</span>';
	$sale_price_html    = '';

	if ( $is_on_sale && $sale_price > 0 && $sale_price < $regular_price ) {

		$regular_price_html = '<del>' . $regular_price_html . '</del>';
		$sale_price_html    = '<span class="product-price-sale">' . $sale_price . $currency . '</span>';

	}

	$output_html = '<div class="product-price-wrapper">' . $regular_price_html . $sale_price_html . '</div>';

	return $output_html;
}

/**
 * Get product youtube markup.
 *
 * @param int $product_id the product id.
 * @return string
 */
function get_product_youtube( $product_id = null ) {

	$product = get_product_by_id( $product_id );

	if ( ! $product ) {
		return '';
	}

	$youtube_url = $product->get_youtube();

	if ( ! isset( $youtube_url ) || empty( $youtube_url ) ) {
		return '';
	}

	preg_match( '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $youtube_url, $match );

	if ( ! isset( $match[1] ) ) {
		return '';
	}

	$youtube_id = $match[1];

	$output_html = '<div class="product-youtube-wrapper">';

	$output_html .= '<iframe width="560" height="315" src="https://www.youtube.com/embed/' . $youtube_id . '" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';

	$output_html .= '</div>';

	return $output_html;
}

function get_the_product_main_image( $product_id = null ) {

	$product = get_product_by_id( $product_id );

	if ( ! $product ) {
		return '';
	}

	$output_html  = '<div class="product-main-image-wrapper">';
	$output_html .= '<div class="product-main-image-wrapper-inner">';

	if ( $product && $product->is_on_sale() ) {
		$output_html .= sprintf( '<div class="badge-sale">%s</div>', __( 'Sale!', 'child_theme' ) );
	}

	$output_html .= get_the_post_thumbnail($product_id);

	$output_html .= '</div></div>';

	return $output_html;
}
