<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since 1.0.0
 */

get_header();
?>

<section id="primary" class="content-area">
	<main id="main" class="site-main">
		<div class="blog-container">

			<div class="blog-posts">
				<?php
				if ( have_posts() ) {

					?>

					<header class="page-header">
						<h1 class="page-title">
							<?php _e( 'Search results for:', 'colorthunder' ); ?> "<?php echo get_search_query(); ?>"
						</h1>
					</header><!-- .page-header -->

					<?php

					// Load posts loop.
					while ( have_posts() ) {
						the_post();
						get_template_part( 'template-parts/content/content' );
					}

					// Previous/next page navigation.
				//	twentynineteen_the_posts_navigation();

				} else {

					// If no content, include the "No posts found" template.
					get_template_part( 'template-parts/content/content', 'none' );

				}
				?>
			</div>

			<div class="right-sidebar"><?php dynamic_sidebar('sidebar-right'); ?>
			</div>

		</div>
	</main><!-- .site-main -->
</section><!-- .content-area -->

<?php
get_footer();
