<?php
/**
 * Products extension main file.
 *
 * @package child_theme
 */

define( 'PRODUCTS_DIR_PATH', CHILD_THEME_PATH . '/inc/products' );

// Classes.
require_once PRODUCTS_DIR_PATH . '/class/class-product-cpt.php';
require_once PRODUCTS_DIR_PATH . '/class/class-product.php';
require_once PRODUCTS_DIR_PATH . '/class/class-product-data-store.php';
require_once PRODUCTS_DIR_PATH . '/class/class-product-events.php';
require_once PRODUCTS_DIR_PATH . '/class/class-product-json-api.php';
require_once PRODUCTS_DIR_PATH . '/dummy-data.php';

// Functions.
require_once PRODUCTS_DIR_PATH . '/products-functions.php';

// Template tags.
require_once PRODUCTS_DIR_PATH . '/products-template-tags.php';

// Template hooks.
require_once PRODUCTS_DIR_PATH . '/products-template-hooks.php';

// Shortcodes.
require_once PRODUCTS_DIR_PATH . '/shortcode/shortcode.php';

/**
 * Start the products extension engines!
 * Well, it's a plugin, but let's call it an extension.
 */
function products_extension_init() {
	new Product_CPT();
	new Product_Events();
	new Product_Json_Api();
}

products_extension_init();

