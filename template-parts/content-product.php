
<?php
/**
 * Template file of single product item in loop.
 * 
 * @package child_theme
 */
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<?php
	echo '<a href="' . esc_url( get_permalink() ) . '" class="loop-product-title-link">';
	echo wp_kses_post( the_product_main_image() );
	the_title( '<h2 class="loop-product-title">', '</h2>' );
	echo '</a>';
	?>

</article><!-- .post -->

<?php