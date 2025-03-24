<?php
/**
 * Singles template
 *
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Get the container class
$container = apply_filters('container_class', "container");;

get_header();
?>
<div id="content-wrapper" class="content-wrapper">

	<?php do_action('content-outside-before'); ?>

	<div id="content" class="<?php echo esc_attr( $container ); ?>" tabindex="-1">

		<?php do_action('content-inside-before'); ?>

		<div class="row">

			<div id="primary" class="col-md content-area">

				<?php do_action('main-outside-before'); ?>

				<main class="site-main" id="main" role="main">

					<?php do_action('main-inside-before'); ?>

					<?php while ( have_posts() ) : the_post(); ?>

						<?php get_template_part( 'views/post-types/content', get_post_type() ); ?>

						<?php
						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;
						?>

					<?php endwhile; // end of the loop. ?>

					<?php do_action('main-inside-after'); ?>

					<div id="main-end"></div>

				</main><!-- #main -->

				<?php do_action('main-outside-after'); ?>

			</div><!-- #primary -->

			<!-- Do the right sidebar check -->
			<?php get_template_part( 'views/sidebar/sidebar', 'right' ); ?>

		</div><!-- .row -->

		<?php do_action('content-inside-after'); ?>

	</div><!-- #content -->

	<?php do_action('content-outside-after'); ?>

</div><!-- #page-wrapper -->

<?php get_footer();
