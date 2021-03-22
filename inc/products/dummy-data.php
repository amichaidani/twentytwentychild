<?php
/**
 * This file has the dummy data functions.
 *
 * @package child_theme
 */

/**
 * Time for some dummy data!
 */
function products_add_dummy_data() {

	if ( get_option( 'dummy_data_exists' ) ) {
		return;
	}

	$dream_term_id = wp_insert_term( 'Dream', 'product_cat' )['term_id'];
	$trap_term_id  = wp_insert_term( 'Trap', 'product_cat' )['term_id'];
	$house_term_id = wp_insert_term( 'House', 'product_cat' )['term_id'];

	if ( ! post_type_exists( 'product' ) ) {
		return;
	}

	$product_data = array(
		array(
			'title'          => 'Cashmere Cat - Mirror Maru',
			'image'          => 'https://i.pinimg.com/originals/68/e5/52/68e552fba82511cf641172e4e70ea05d.jpg',
			'images_gallery' => array(
				'https://upload.wikimedia.org/wikipedia/commons/0/09/Cashmere_Cat.jpg',
				'https://d3vhc53cl8e8km.cloudfront.net/artists/1609/spcatTjzPjsnaPEsTAE8FAHgXIC5gfsPWp2opgQo.jpeg',
				'https://edmidentity.com/wp-content/uploads/2020/02/67958533_2379123845496936_3364706057183035392_o.v1-e1581982087648.jpg',
			),
			'description'    => 'Song by the wonderful wonderful Cashmere Cat. He kinda LOOK like the way his music sounds.',
			'price'          => 69,
			'sale_price'     => 49,
			'is_on_sale'     => true,
			'youtube'        => 'https://youtu.be/5PAij_DsXrU',
			'categories'     => array( $dream_term_id, $trap_term_id ),
		),
		array(
			'title'          => 'Sinjin Hawke - VClipse',
			'image'          => 'https://assets.boomkat.com/spree/products/422878/large/First_Opus.jpg',
			'images_gallery' => array(
				'https://www.thebeijinger.com/sites/default/files/thebeijinger/blog-images/345221/20120830_6389.jpeg',
			),
			'description'    => '',
			'price'          => 49,
			'sale_price'     => 39,
			'is_on_sale'     => true,
			'youtube'        => 'https://www.youtube.com/watch?v=iqnPOT0HDKs&ab_channel=FRACTALFANTASY',
			'categories'     => array( $dream_term_id ),
		),
		array(
			'title'          => 'Daft Punk - Around The World',
			'image'          => 'https://static2.raru.co.za/cover/2014/05/03/135502-l.jpg',
			'images_gallery' => array(
				'https://see.news/wp-content/uploads/2021/02/Daft-Punk.jpg',
				'https://upload.wikimedia.org/wikipedia/commons/4/41/Daftpunklapremiere2010.jpg',
				'https://ichef.bbci.co.uk/news/976/cpsprodpb/15F89/production/_117139998_gettyimages-465276903.jpg',
				'https://static.dw.com/image/17388618_401.jpg',
			),
			'description'    => 'The duo that changed the world with their french touch.',
			'price'          => 79,
			'sale_price'     => null,
			'is_on_sale'     => false,
			'youtube'        => 'https://www.youtube.com/watch?v=dwDns8x3Jb4',
			'categories'     => array( $house_term_id ),
		),
		array(
			'title'          => 'Wave Racer - Flash Drive',
			'image'          => 'https://i1.sndcdn.com/artworks-000132851381-hlvbkn-t500x500.jpg',
			'images_gallery' => array(
				'https://cdns-images.dzcdn.net/images/artist/22b56f3baa587d6523b02922a51a38a5/264x264.jpg',
				'http://pilerats.com/assets/Uploads/wave-racer-flash-drive-track-by-track.jpg',
				'https://ichef.bbci.co.uk/news/976/cpsprodpb/15F89/production/_117139998_gettyimages-465276903.jpg',
				'https://i.ytimg.com/vi/vgCiQKYgdTM/maxresdefault.jpg',
				'http://pilerats.com/assets/Uploads/wave-racer-flash-drive-track-by-track.jpg',

			),
			'description'    => 'Wave racer, the one and only australian to be so sweet.',
			'price'          => 109,
			'sale_price'     => 24,
			'is_on_sale'     => false,
			'youtube'        => 'https://www.youtube.com/watch?v=-Js_-DtskxM',
			'categories'     => array( $trap_term_id ),
		),
		array(
			'title'          => 'Justice - D.A.N.C.E',
			'image'          => 'https://i.pinimg.com/originals/2c/a2/31/2ca2313e2dc582148efff6e0446196d4.jpg',
			'images_gallery' => array(
				'https://s6056.pcdn.co/wp-content/uploads/2013/01/8004672295_132eec87be_b.jpg',
				'https://cdn-0.enacademic.com/pictures/enwiki/74/Justice2.jpg',
				'https://nbhap.com/wp-content/uploads//2016/09/Justice-2016-770x549.jpg',

			),
			'description'    => 'The mighty french duo Justice. 2007 was great.',
			'price'          => 59,
			'sale_price'     => 24,
			'is_on_sale'     => true,
			'youtube'        => 'https://www.youtube.com/watch?v=sy1dYFGkPUE',
			'categories'     => array( $house_term_id ),
		),

		array(
			'title'          => 'Baauer - Temple',
			'image'          => 'https://i1.sndcdn.com/artworks-000151519034-y1ncyk-t500x500.jpg',
			'images_gallery' => array(
				'https://weraveyou.com/wp-content/uploads/2021/03/main.jpeg',
				'https://i1.sndcdn.com/artworks-000125215391-2uvgqk-t500x500.jpg',
				'https://hype.my/wp-content/uploads/2016/03/Temple-Baauer-M.I.A.-G-Dragon.png',

			),
			'description'    => 'Do you rememeber baauer? :)',
			'price'          => 29,
			'sale_price'     => 0,
			'is_on_sale'     => false,
			'youtube'        => 'https://youtu.be/9fGoOEGojY0',
			'categories'     => array( $trap_term_id ),
		),
	);

	foreach ( $product_data as $item_args ) {

		$img_id = add_dummy_data_upload_image( $item_args['image'] );

		if ( $img_id ) {
			$item_args['image'] = $img_id;
		}

		$gallery_ids = array();

		foreach ( $item_args['images_gallery'] as $gallery_img_url ) {

			$gallery_img_id = add_dummy_data_upload_image( $gallery_img_url );

			if ( $gallery_img_id ) {
				array_push( $gallery_ids, $gallery_img_id );
			}
		}

		$item_args['images_gallery'] = $gallery_ids;
		create_new_product( $item_args );
	}

	update_option( 'dummy_data_exists', true );
};
add_action( 'after_switch_theme', 'products_add_dummy_data' );

/**
 * Upload images to media library.
 *
 * @param string $image_url the image url.
 * @return int|boolean the attachment id if success, false if not.
 */
function add_dummy_data_upload_image( $image_url = null ) {

	if ( ! isset( $image_url ) ) {
		return false;
	}

	$upload_dir = wp_upload_dir();

	$image_data = file_get_contents( $image_url );

	$filename = basename( $image_url );

	if ( wp_mkdir_p( $upload_dir['path'] ) ) {
		$file = $upload_dir['path'] . '/' . $filename;
	} else {
		$file = $upload_dir['basedir'] . '/' . $filename;
	}

	file_put_contents( $file, $image_data );

	$wp_filetype = wp_check_filetype( $filename, null );

	$attachment = array(
		'post_mime_type' => $wp_filetype['type'],
		'post_title'     => sanitize_file_name( $filename ),
		'post_content'   => '',
		'post_status'    => 'inherit',
	);

	$attach_id = wp_insert_attachment( $attachment, $file );

	require_once ABSPATH . 'wp-admin/includes/image.php';

	$attach_data = wp_generate_attachment_metadata( $attach_id, $file );

	wp_update_attachment_metadata( $attach_id, $attach_data );

	if ( is_int( $attach_id ) ) {
		return $attach_id;
	} else {
		return false;
	}
}
