<?php
/**
 * Product class file.
 *
 * @package child_theme
 */
/**
 * This class is responsible for abstract product functions.
 */
class Product {
	/**
	 * This instance product (post) id.
	 *
	 * @var int
	 */
	private $id;

	/**
	 * Default product data.
	 *
	 * @var array
	 */
	private $data = array(
		'title'          => '',
		'image'          => null,
		'images_gallery' => array(),
		'description'    => '',
		'price'          => 0,
		'sale_price'     => 0,
		'is_on_sale'     => false,
		'youtube'        => '',
		'categories'     => array(),
	);

	/**
	 * Constructor
	 *
	 * @param int $product_id product id.
	 * @return boolean false if no product id or not the post type, true if success.
	 */
	public function __construct( $product_id = null ) {

		if ( ! isset( $product_id ) || 'product' !== get_post_type( $product_id ) ) {
			return false;
		}

		$this->id = $product_id;

		$this->init_data();

		return true;
	}

		/**
		 * Get data of product for this instance.
		 */
	private function init_data() {

		$fields = array();

		foreach ( $this->data as $data_key => $data_value ) {
			array_push( $fields, $data_key );
		}

		$data_from_store = $this->get_data_from_store( $fields );

		if ( is_array( $data_from_store ) ) {

			foreach ( $data_from_store as $_data_key => $data_value ) {

				if ( array_key_exists( $_data_key, $this->data ) ) {
					$this->data[ $_data_key ] = $data_value;
				}
			}
		}
	}

	/**
	 * Get data from store by fields.
	 *
	 * @param array $fields fields to get.
	 * @return array|false array if got data.
	 */
	private function get_data_from_store( $fields = null ) {
		if ( ! is_array( $fields ) || empty( $fields ) ) {
			return false;
		}

		$data_store      = new Product_Data_Store( $this->id );
		$data_from_store = $data_store->get_data( $fields );

		if ( ! is_array( $data_from_store ) || empty( $data_from_store ) ) {
			return false;
		} else {
			return $data_from_store;
		}
	}

	/**
	 * Save data to store.
	 *
	 * @return boolean true if updated, false if not.
	 */
	private function save_data_to_store() {

		$data_store = new Product_Data_Store( $this->id );

		if ( ! $data_store ) {
			return false;
		}

		return $data_store->save_data( $this->data );
	}

	/**
	 * Get all product data.
	 *
	 * @return array
	 */
	public function get_all_data() {
		return $this->data;
	}

	/**
	 * Create new product.
	 *
	 * @param array $product_args product args to register.
	 * @return boolean true if success, false if not.
	 */
	public function set_fields( $product_args = null ) {

		$_id = $this->id;

		if ( ! isset( $_id ) ) {
			return false;
		}

		if ( is_array( $product_args ) && ! empty( $product_args ) ) {

			foreach ( $product_args as $arg_key => $value ) {

				if ( array_key_exists( $arg_key, $this->data ) ) {
					$this->data[ $arg_key ] = $value;
				}
			}
		}

		$is_saved = $this->save_data_to_store();

		return $is_saved;
	}

	/**
	 * Get product title.
	 *
	 * @return string
	 */
	public function get_title() {
		return $this->data['title'];
	}

	/**
	 * Get if product is on sale.
	 *
	 * @return boolean is on sale.
	 */
	public function is_on_sale() {
		return $this->data['is_on_sale'];
	}

	/**
	 * Get product regular price.
	 *
	 * @return int the product regular price.
	 */
	public function get_price() {
		return $this->data['price'];
	}

	/**
	 * Get product sale price.
	 *
	 * @return int the product sale price.
	 */
	public function get_sale_price() {
		return $this->data['sale_price'];
	}

	/**
	 * Get product gallery images ids..
	 *
	 * @return array the images ids.
	 */
	public function get_gallery() {
		return $this->data['images_gallery'];
	}

	/**
	 * Get product gallery images ids..
	 *
	 * @return array the images ids.
	 */
	public function get_youtube() {
		return $this->data['youtube'];
	}
	/**
	 * Get product gallery images ids..
	 *
	 * @return array the images ids.
	 */
	public function get_categories() {
		return $this->data['categories'];
	}
}
