<?php
/**
 * Product_Events class.
 * 
 * @package child_theme
 */

/**
 * This class responsible for all events related to save and update of 'product' cpt.
 */
class Product_Events {

	/**
	 * Constructor.
	 */
	public function __construct() {
		// add_action( 'save_post_product', array( $this, 'init_data_for_new_product_post' ), 999, 1 );
	}

	/**
	 * Init a 'product' cpt post that being added on admin.
	 *
	 * @param int $post_id the post id.
	 * @return void
	 */
	public function init_data_for_new_product_post( $post_id ) {

		// If calling save_post_product, unhook this function so it doesn't loop infinitely.
		remove_action( 'save_post_product', array( $this, 'init_data_for_new_product_post' ), 999 );

		// Check if not AJAX or admin.
		if ( wp_doing_ajax() || ! is_admin() ) {
			return;
		}

		// Check it's not an auto save routine.
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		// Check for only newly added post.
		if ( 'Auto Draft' !== get_the_title( $post_id ) ) {
			return;
		}

		// Lets create new product class for this post.
		$product = new Product( $post_id );

		// Init default data.
		if ( $product ) {
			$product->set_fields();
		}
	}
}
