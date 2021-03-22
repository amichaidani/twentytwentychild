<?php
/**
 * Single product template.
 * 
 * @package child_theme
 */

get_header();

?>

<main id="site-content" role="main">
	<div class="section-inner">
		<div class="single-product">
			<div class="product-entry">	

				<div class="product-main-image-and-gallery">

					<?php
						the_product_main_image();
						the_product_gallery();
					?>
					</div>

				<div class="entry-summary">

					<?php
						the_title( '<h1 class="product-title">', '</h1>' );
						the_product_price();
						the_product_categories_list();
					?>
				</div>

			</div> <!--.product-entry-->
		</div> <!--.single-product-->
	</div>
	<div class="section-inner">

		<div class="post-inner">

			<div class="product-content">

				<?php the_content(); ?>

			</div><!-- .product-content -->

		</div><!-- .post-inner -->

		<?php the_product_related_products_loop(); ?>

	</div><!-- .section-inner -->

</main>

<?php
get_footer();
?>
