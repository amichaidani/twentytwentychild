<?php
/**
 * Template tag for products.
 *
 * @package child_theme
 */

/**
 * Output the product main image.
 *
 * @return void
 */
function the_product_main_image() {

	global $post;

	echo wp_kses_post( get_the_product_main_image( $post->ID ) );
}

/**
 * Output the product gallery markup.
 */
function the_product_gallery() {
	global $post;

	$product = get_product_by_id( $post->ID );

	if ( ! $product ) {
		return '';
	}

	$gallery_img_ids = $product->get_gallery();

	if ( ! is_array( $gallery_img_ids ) || empty( $gallery_img_ids ) ) {
		return '';
	}
	$output_html = '<div class="single-product-gallery">';

	foreach ( $gallery_img_ids as $img_id ) {

		if ( ! is_int( $img_id ) ) {
			continue;
		}

		$image_html = wp_get_attachment_image( $img_id, 'medium' );

		if ( ! empty( $image_html ) ) {
			$output_html .= $image_html;
		}
	}

	$output_html .= '</div>';

	echo wp_kses_post( $output_html );
}

/**
 * Output the markup of a product price.
 */
function the_product_price() {

	global $post;

	echo wp_kses_post( get_product_price_html( $post->ID ) );
}

/**
 * Output the product youtube embed.
 */
function the_product_youtube() {

	global $post;

	echo wp_kses_post( $output_html );
}

/**
 * Output related products list, from the same category.
 */
function the_product_related_products_loop() {

	global $post;

	$product = get_product_by_id( $post->ID );

	if ( ! $product ) {
		return '';
	}

	$categories_ids = $product->get_categories();

	if ( ! is_array( $categories_ids ) || empty( $categories_ids ) ) {
		return '';
	}

	$category_id = $categories_ids[0];

	echo '<section class="related-products">';

	printf( '<h2>%s</h2>', __( 'Related Products', 'child_theme' ) );

	// Query posts with the same 'product_cat' term id.
	query_posts(
		array(
			'post_type'   => 'product',
			'post_status' => 'publish',
			'limit'       => 6,
			'tax_query'   => array(
				array(
					'taxonomy' => 'product_cat',
					'field'    => 'term_id',
					'terms'    => $category_id,
				),
			),
		)
	);

	// Output loop.
	get_template_part( 'template-parts/the-loop' );

	echo '</section>';

	wp_reset_postdata();
}

/**
 * Output the product categories list.
 */
function the_product_categories_list() {

	global $post;

	$product = get_product_by_id( $post->ID );

	if ( ! $product ) {
		return '';
	}

	$categories_ids = $product->get_categories();

	if ( ! is_array( $categories_ids ) || empty( $categories_ids ) ) {
		return '';
	}

	$output_html = '<ul class="product-categories-list">';

	foreach ( $categories_ids as $category_id ) {

		$term = get_term( $category_id, 'product_cat' );

		if ( $term ) {
			$output_html .= '<li class="product-category-name"><a href="' . esc_url( get_term_link( $term ) ) . '">' . esc_html( $term->name ) . '</a></li>';
		}
	}

	echo wp_kses_post( $output_html );
}
