<?php
/**
 * Product_CPT class.
 *
 * @package twentytwentychild
 */

/**
 * This class functions initialize the 'product' CPT and taxonomies.
*/
class Product_CPT {

	/** Constructor. */
	public function __construct() {
		add_action( 'init', array( $this, 'register_product_cpt' ), 10 );
		add_action( 'init', array( $this, 'register_product_cat_taxonomy' ), 11 );
		add_action( 'init', array( $this, 'maybe_flush_rewrite_rules' ), 12 );
	}

	/**
	 * Register new post type 'product'.
	 */
	public function register_product_cpt() {

		if ( ! post_type_exists( 'product' ) ) {

			$labels = array(
				'name'                  => _x( 'Products', 'Post Type General Name', 'child_theme' ),
				'singular_name'         => _x( 'Product', 'Post Type Singular Name', 'child_theme' ),
				'menu_name'             => __( 'Products', 'child_theme' ),
				'name_admin_bar'        => __( 'Product', 'child_theme' ),
				'archives'              => __( 'Product Archives', 'child_theme' ),
				'attributes'            => __( 'Product Attributes', 'child_theme' ),
				'parent_item_colon'     => __( 'Parent Product:', 'child_theme' ),
				'all_items'             => __( 'All Products', 'child_theme' ),
				'add_new_item'          => __( 'Add New Product', 'child_theme' ),
				'add_new'               => __( 'Add New', 'child_theme' ),
				'new_item'              => __( 'New Product', 'child_theme' ),
				'edit_item'             => __( 'Edit Product', 'child_theme' ),
				'update_item'           => __( 'Update Product', 'child_theme' ),
				'view_item'             => __( 'View Product', 'child_theme' ),
				'view_items'            => __( 'View Products', 'child_theme' ),
				'search_items'          => __( 'Search Product', 'child_theme' ),
				'not_found'             => __( 'Not found', 'child_theme' ),
				'not_found_in_trash'    => __( 'Not found in Trash', 'child_theme' ),
				'featured_image'        => __( 'Featured Image', 'child_theme' ),
				'set_featured_image'    => __( 'Set featured image', 'child_theme' ),
				'remove_featured_image' => __( 'Remove featured image', 'child_theme' ),
				'use_featured_image'    => __( 'Use as featured image', 'child_theme' ),
				'insert_into_item'      => __( 'Insert into Product', 'child_theme' ),
				'uploaded_to_this_item' => __( 'Uploaded to this product', 'child_theme' ),
				'items_list'            => __( 'Products list', 'child_theme' ),
				'items_list_navigation' => __( 'Products list navigation', 'child_theme' ),
				'filter_items_list'     => __( 'Products items list', 'child_theme' ),
			);
			$args   = array(
				'label'               => __( 'Product', 'child_theme' ),
				'description'         => __( 'Products', 'child_theme' ),
				'labels'              => $labels,
				'supports'            => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
				'public'              => true,
				'show_ui'             => true,
				'show_in_menu'        => true,
				'menu_position'       => 50,
				'menu_icon'           => 'dashicons-cart',
				'show_in_admin_bar'   => true,
				'show_in_nav_menus'   => true,
				'can_export'          => true,
				'has_archive'         => true,
				'exclude_from_search' => false,
				'publicly_queryable'  => true,
				'capability_type'     => 'post',
				'show_in_rest'        => false,
			);

			register_post_type( 'product', $args );

		}
	}

	/**
	 * Register custom 'product_cat' taxonomy.
	 *
	 * @return void
	 */
	public function register_product_cat_taxonomy() {

				$labels = array(
					'name'                       => _x( 'Product Categories', 'Taxonomy General Name', 'child_theme' ),
					'singular_name'              => _x( 'Product Category', 'Taxonomy Singular Name', 'child_theme' ),
					'menu_name'                  => __( 'Categories', 'child_theme' ),
					'all_items'                  => __( 'All Categories', 'child_theme' ),
					'parent_item'                => __( 'Parent Category', 'child_theme' ),
					'parent_item_colon'          => __( 'Parent Category:', 'child_theme' ),
					'new_item_name'              => __( 'New Category Name', 'child_theme' ),
					'add_new_item'               => __( 'Add New Category', 'child_theme' ),
					'edit_item'                  => __( 'Edit Category', 'child_theme' ),
					'update_item'                => __( 'Update Category', 'child_theme' ),
					'view_item'                  => __( 'View Category', 'child_theme' ),
					'separate_items_with_commas' => __( 'Separate categories with commas', 'child_theme' ),
					'add_or_remove_items'        => __( 'Add or remove categories', 'child_theme' ),
					'choose_from_most_used'      => __( 'Choose from the most used', 'child_theme' ),
					'popular_items'              => __( 'Popular Categories', 'child_theme' ),
					'search_items'               => __( 'Search Categories', 'child_theme' ),
					'not_found'                  => __( 'Not Found', 'child_theme' ),
					'no_terms'                   => __( 'No Categories', 'child_theme' ),
					'items_list'                 => __( 'Categories list', 'child_theme' ),
					'items_list_navigation'      => __( 'Categories list navigation', 'child_theme' ),
				);
				$args   = array(
					'labels'            => $labels,
					'hierarchical'      => true,
					'public'            => true,
					'show_ui'           => true,
					'show_admin_column' => true,
					'show_in_nav_menus' => true,
					'show_tagcloud'     => true,
					'show_in_rest'      => false,
				);

				register_taxonomy( 'product_cat', array( 'product' ), $args );
	}

	/**
	 * Flush rewrite rules for the first time.
	 */
	public function maybe_flush_rewrite_rules() {

		$is_registerd_option = 'is_product_cpt_first_register';

		if ( ! get_option( $is_registerd_option ) ) {

			flush_rewrite_rules();
			update_option( $is_registerd_option, true );

		}
	}
}


