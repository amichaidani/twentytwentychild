<?php
/**
 * Product CPT data store class.
 *
 * @package child_theme
 */

/**
 * This class responsible for getting and setting data in database.
 */
class Product_Data_Store {

	/**
	 * Product id for this instance.
	 *
	 * @var int
	 */
	private $product_id;

	/**
	 * Constructor.

	 * @param int $product_id the product id to update.
	 */
	public function __construct( $product_id = null ) {

		if ( ! isset( $product_id ) || 'product' !== get_post_type( $product_id ) ) {
			return false;
		}

		$this->product_id = $product_id;
	}

	/**
	 * Save data to database.
	 *
	 * @param array $data data to submit.
	 * @return boolean success or failure.
	 */
	public function save_data( $data = null ) {

		$_product_id = $this->product_id;

		if ( ! isset( $_product_id ) ) {
			return false;
		}

		if ( ! isset( $data ) || ! is_array( $data ) || empty( $data ) ) {
			return false;
		}

		$wp_update_post_args = array( 'ID' => $_product_id );

		foreach ( $data as $data_key => $data_value ) {

			if ( isset( $data_value ) && ! is_bool( $data_value ) && ! is_numeric( $data_value ) && ! is_array( $data_value ) ) {
				$data_value = sanitize_text_field( $data_value );
			}

			// TODO: Validate data for each field.
			switch ( $data_key ) {
				case 'title':
					$wp_update_post_args['post_title'] = $data_value;
					break;
				case 'description':
					$wp_update_post_args['post_content'] = $data_value;
					break;
				case 'image':
					set_post_thumbnail( $_product_id, intval( $data_value ) );
					break;
				case 'categories':
					if ( ! is_array( $data_value ) || empty( $data_value ) ) {
					} else {
						$data_value = array_filter(
							$data_value,
							function( $term_id ) {
								return is_int( $term_id );
							}
						);

						error_log( print_r( $data_value, true ) );
						wp_set_post_terms( $_product_id, $data_value, 'product_cat' );
					}
					break;
				case 'images_gallery':
					if ( ! empty( $data_value ) ) {
						$updated_meta = update_post_meta( $_product_id, 'product_' . $data_key, $data_value );
					}
					break;
				default:
					$updated_meta = update_post_meta( $_product_id, 'product_' . $data_key, $data_value );
					break;
			}
		}

		$is_updated = wp_update_post( $wp_update_post_args );

		return $is_updated;
	}

	/**
	 * Get data by fields.
	 *
	 * @param array $fields fields names.
	 * @return array
	 */
	public function get_data( $fields = null ) {

		if ( ! is_array( $fields ) || empty( $fields ) ) {
			return false;
		}

		$data = array();

		$_product_id = $this->product_id;

		foreach ( $fields as $field ) {
			switch ( $field ) {
				case 'title':
					$data[ $field ] = get_the_title( $_product_id );
					break;
				case 'description':
					$data[ $field ] = get_the_content( $_product_id );
					break;
				case 'image':
					$data[ $field ] = get_post_thumbnail_id();
					break;
				case 'categories':
					$terms = get_the_terms( $_product_id, 'product_cat' );

					if ( is_array( $terms ) && ! empty( $terms ) ) {
						$data[ $field ] = wp_list_pluck( $terms, 'term_id' );
					} else {
						$data[ $field ] = array();
					}

					break;
				default:
					$data[ $field ] = get_post_meta( $_product_id, 'product_' . $field, true );
					break;
			}
		}

		return $data;
	}
}
