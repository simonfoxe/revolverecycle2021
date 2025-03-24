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

					<?php if ( have_posts() ) : ?>

						<header class="page-header">

							<h1 class="page-title">
								<?php
								printf(
									/* translators: %s: query term */
									esc_html__( 'Search Results for: %s', 'gutenflow' ),
									'<span>' . get_search_query() . '</span>'
								);
								?>
							</h1>

						</header><!-- .page-header -->

						<?php /* Start the Loop */ ?>
						<div class="loop-content">
						<?php while ( have_posts() ) : the_post(); ?>

							<?php
							/**
							 * Run the loop for the search to output the results.
							 * If you want to overload this in a child theme then include a file
							 * called content-search.php and that will be used instead.
							 */
							get_template_part( 'views/post-types/excerpt', get_post_type() );
							?>

						<?php endwhile; ?>
						</div>

					<?php else : ?>

						<?php get_template_part( 'views/post-types/content', 'none' ); ?>

					<?php endif; ?>

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
