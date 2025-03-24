<?php
/**
 * Partial template for the content
 *
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>
<article <?php post_class(); ?> id="<?php get_post_type(); ?>-<?php the_ID(); ?>">

	<header class="entry-header">

		<?php if ( function_exists('dms_show_page_title') && dms_show_page_title() == false ): ?>
		<?php else: ?>
			<?php the_title( '<h1 class="entry-title page-title">', '</h1>' ); ?>
		<?php endif; ?>

	</header><!-- .entry-header -->

	<div class="entry-content clearfix">

		<?php the_content(); ?>

	</div><!-- .entry-content -->

	<footer class="entry-footer">
	</footer><!-- .entry-footer -->

</article><!-- #post-<?php the_ID(); ?> -->