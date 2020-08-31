<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Colorthunder
 * @since 1.0.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		if ( is_sticky() && is_home() && ! is_paged() ) {
			printf( '<span class="sticky-post">%s</span>', _x( 'Featured', 'post', 'colorthunder' ) );
		}
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
		endif;
		?>
	</header><!-- .entry-header -->

	<?php colorthunder_post_thumbnail(); ?>

	<?php
	if ( is_singular() ) :
		?>

		<div class="entry-meta">

			<span class="author-item"><?php the_author_link(); ?></span>

			<span class="date-item"><?php the_date(); ?></span>

		</div>

		<?php
	endif;
	?>

	<div class="entry-content">
		<?php
		if ( is_singular() ) :

			the_content(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'colorthunder' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);

			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'colorthunder' ),
					'after'  => '</div>',
				)
			);

		else :
 
			echo wp_trim_words( get_the_content(), 10, '...' );

		endif;

		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php colorthunder_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
