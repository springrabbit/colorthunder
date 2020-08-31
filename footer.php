<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Colorthunder
 * @since 1.0.0
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<?php //get_template_part( 'template-parts/footer/footer', 'widgets' ); ?>
		<div class="site-info">
			<?php $blog_info = get_bloginfo( 'name' ); ?>
			<?php if ( ! empty( $blog_info ) ) : ?>
				<a class="site-name" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>,
			<?php endif; ?>
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'colorthunder' ) ); ?>" class="imprint">
				<?php
				/* translators: %s: WordPress. */
				printf( __( 'Proudly powered by %s.', 'colorthunder' ), 'WordPress' );
				?>
			</a>
			<?php
			if ( function_exists( 'the_privacy_policy_link' ) ) {
				the_privacy_policy_link( '', '<span role="separator" aria-hidden="true"></span>' );
			}
			?>
			<?php if ( has_nav_menu( 'footer' ) ) : ?>
				<nav class="footer-navigation" aria-label="<?php esc_attr_e( 'Footer Menu', 'colorthunder' ); ?>">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'footer',
							'menu_class'     => 'footer-menu',
							'depth'          => 1,
						)
					);
					?>
				</nav><!-- .footer-navigation -->
			<?php endif; ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->

</div><!-- #page -->

<script type="text/javascript">

let btnL = document.getElementById("navLeft");
let btnR = document.getElementById("navRight");

let content = document.getElementsByClassName("main-menu")[0];
let wrap = document.getElementsByClassName("main-navigation")[0];

btnR.addEventListener("click", goRight);
btnL.addEventListener("click", goLeft);

let clickedIndex = 0;
let clickNum = (content.scrollWidth - wrap.offsetWidth) / 190;

console.log(clickNum);

function goRight()
{
	if (clickedIndex <= clickNum)
  {
    clickedIndex = clickedIndex +1;
		content.style.webkitTransform = "translateX(" +  (-190*clickedIndex) + "px" + ")";
   	//	content.style.marginLeft = -190*clickedIndex + "px";
  }

}

function goLeft()
{
	if (clickedIndex >0)
  {
    clickedIndex = clickedIndex -1;
		content.style.webkitTransform = "translateX(" +  (-190*clickedIndex) + "px" + ")";
	//content.style.marginLeft = -190*clickedIndex + "px";

  }
}

</script>

<?php wp_footer(); ?>

</body>
</html>
