<?php
/**
 * Displays header site branding
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since 1.0.0
 */
?>
<div class="site-branding">

	<div class="top-header">

		<?php if ( has_custom_logo() ) : ?>
			<div class="site-logo"><?php the_custom_logo(); ?></div>
		<?php endif; ?>

		<?php $blog_info = get_bloginfo( 'name' ); ?>

		<?php if ( ! empty( $blog_info ) ) : ?>
			<?php if ( is_front_page() && is_home() ) : ?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php else : ?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php endif; ?>
		<?php endif; ?>

		<?php
		$description = get_bloginfo( 'description', 'display' );
		if ( $description || is_customize_preview() ) :
			?>
				<p class="site-description">
					<?php echo $description; ?>
				</p>
		<?php endif; ?>

		<?php get_search_form(); ?>

		<?php if ( has_nav_menu( 'social' ) ) : ?>
			<nav class="social-navigation" aria-label="<?php esc_attr_e( 'Social Links Menu', 'colorthunder' ); ?>">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'social',
						'menu_class'     => 'social-links-menu',
						'link_before'    => '<span class="social-link">',
						'link_after'     => '</span>',
						'depth'          => 1,
					)
				);
				?>
			</nav><!-- .social-navigation -->
		<?php endif; ?>

	</div>

	<?php if ( has_nav_menu( 'menu-1' ) ) : ?>
		<nav id="site-navigation" class="main-navigation" aria-label="<?php esc_attr_e( 'Top Menu', 'colorthunder' ); ?>"><div id="navLeft" class="nav-left fas fa-chevron-left"></div>
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'menu-1',
					'menu_class'     => 'main-menu',
					'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
				)
			);
			?>
		<div id="navRight" class="nav-right fas fa-chevron-right"></div></nav><!-- #site-navigation -->
	<?php endif; ?>

</div><!-- .site-branding -->
