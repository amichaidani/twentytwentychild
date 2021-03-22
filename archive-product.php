<?php
/**
 * Product post type archive template.
 *
 * @package child_theme
 */

get_header();

?>
<main id="site-content" role="main">

	<h1 class="product-archive-title"><?php the_archive_title(); ?></h1>
	
	<div class="section-inner">

		<?php get_template_part( 'template-parts/the-loop' ); ?>

	</div>
</main>

<?php
get_footer();
?>
