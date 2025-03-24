<?php
/**
 * Partial template for content in page.php
 *
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>
<article <?php post_class(); ?> id="<?php get_post_type(); ?>-<?php the_ID(); ?>">

	<header class="entry-header">

		<?php if ( function_exists('dms_show_page_title') && dms_show_page_title() == false ): ?>
		<?php else: ?>
			<a href="<?php the_permalink(); ?>">
			<?php the_title( '<h2 class="entry-title excerpt-title">', '</h2>' ); ?>
			</a>
		<?php endif; ?>

	</header><!-- .entry-header -->

	<div class="entry-excerpt clearfix">

		<?php the_excerpt(); ?>

	</div><!-- .entry-content -->

	<footer class="entry-footer">
	</footer><!-- .entry-footer -->

</article><!-- #post-<?php the_ID(); ?> -->