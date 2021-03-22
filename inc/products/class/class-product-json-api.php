<?php
/**
 * Product JSON api class.
 *
 * @package child_theme
 */

/**
 * This class responsible for json api endpoints.
 */
class Product_Json_Api {

	/**
	 * Constructor.
	 */
	public function __construct() {
		add_action( 'rest_api_init', array( $this, 'register_api_endpoint_get_products_by_category' ) );

	}

	/**
	 * Register '/products/category' api endpoint.
	 */
	public function register_api_endpoint_get_products_by_category() {
		register_rest_route(
			'products',
			'/category',
			array(
				'methods'             => 'GET',
				'callback'            => array( $this, 'api_route_callback' ),
				'permission_callback' => '__return_true',
			)
		);
	}

	/**
	 * The category api endpoint callback.
	 * This function will return response with found products.
	 * You may query by 2 GET params: 'id' or 'name'.
	 *
	 * @return WP_REST_Response response object.
	 */
	public function api_route_callback() {

		$category_id   = ( isset( $_GET['id'] ) ) ? intval( $_GET['id'] ) : null;
		$category_name = ( isset( $_GET['name'] ) ) ? sanitize_text_field( $_GET['name'] ) : null;

		$get_by    = null;
		$get_value = null;

		if ( isset( $category_id ) && 0 < $category_id ) {
			$get_by   = 'term_id';
			$get_term = $category_id;
		}

		if ( isset( $category_name ) && ! empty( $category_name ) && ! isset( $get_by ) ) {
			$get_by   = 'name';
			$get_term = $category_name;
		}

		if ( ! isset( $get_by ) ) {
			return new WP_REST_Response( 'Please provide product category ID or name', 400 );
		}

		$term = get_term_by( $get_by, $get_term, 'product_cat' );

		if ( ! $term ) {
			return new WP_REST_Response( 'No such category found.', 400 );
		}

		if ( 'term_id' === $get_by ) {
			$get_term = array( $get_term );
		}

		$query = new WP_Query(
			array(
				'post_type'   => 'product',
				'post_status' => 'publish',
				'limit'       => 99,
				'fields'      => 'ids',
				'tax_query'   => array(
					array(
						'taxonomy' => 'product_cat',
						'field'    => $get_by,
						'terms'    => $get_term,
					),
				),
			)
		);

		$products_ids = $query->get_posts();

		$products_response = array();

		foreach ( $products_ids as $product_id ) {

			$product = new Product( $product_id );

			if ( ! $product ) {
				continue;
			}

			$product_data = $product->get_all_data();

			$image_id    = $product_data['image'];
			$gallery_ids = $product_data['images_gallery'];

			if ( isset( $image_id ) && is_int( $image_id ) && 0 < $image_id ) {
				$product_data['image_url'] = wp_get_attachment_url( $image_id );
			}

			if ( isset( $gallery_ids ) && is_array( $gallery_ids ) && ! empty( $gallery_ids ) ) {

				$product_data['images_gallery_urls'] = array();

				foreach ( $gallery_ids as $gallery_id ) {
					$img_url = wp_get_attachment_url( $gallery_id );

					if ( $img_url ) {
						array_push( $product_data['images_gallery_urls'], $img_url );
					}
				}
			}

			array_push( $products_response, $product_data );
		}

		return new WP_REST_Response( $products_response, 200 );
	}
}
