<?php
/**
 * This file stores shortcodes functions.
 *
 * @package child_theme
 */

/**
 * Output product box shortcode.
 *
 * @param array $atts the shortcodes attributes.
 */
function get_product_box( $atts = array() ) {
	$product_id = ( isset( $atts['id'] ) ) ? intval( $atts['id'] ) : null;
	$bg_color   = ( isset( $atts['bg'] ) ) ? sanitize_text_field( $atts['bg'] ) : null;

	if ( 0 === $product_id ) {
		return;
	}

	$product = get_product_by_id( $product_id );

	if ( ! $product ) {
		return;
	}

	$style_string = '';

	$hex_regex_pattern = "/#([a-f]|[A-F]|[0-9]){3}(([a-f]|[A-F]|[0-9]){3})?\b/";

	if ( isset( $bg_color ) && 1 === preg_match( $hex_regex_pattern, $bg_color ) ) {
		$style_string = 'style="background-color:' . esc_attr( $bg_color ) . '"';
	}

	$output_html  = '<div class="product-box-custom" ' . $style_string . '>';
	$output_html .= get_the_product_main_image( $product_id );
	$output_html .= '<h2>' . esc_html( $product->get_title() ) . '</h2>';
	$output_html .= get_product_price_html( $product_id );
	$output_html .= '</div>';

	echo wp_kses_post( apply_filters( 'product_box_shortcode_output', $output_html ) );
}
add_shortcode( 'product-box', 'get_product_box' );