<?php

/**
 * Colorthunder functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @since 1.0.0
 */

if ( ! function_exists( 'colorthunder_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function colorthunder_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Twenty Nineteen, use a find and replace
		 * to change 'colorthunder' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'colorthunder', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		add_theme_support('widgets');

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 150, 150, true );

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus(
			array(
				'menu-1' => __( 'Primary', 'colorthunder' ),
				'footer' => __( 'Footer Menu', 'colorthunder' ),
				'social' => __( 'Social Links Menu', 'colorthunder' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 190,
				'width'       => 190,
				'flex-width'  => false,
				'flex-height' => false,
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		// Enqueue editor styles.
		add_editor_style( 'style-editor.css' );

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );
	}
endif;
add_action( 'after_setup_theme', 'colorthunder_setup' );

function colorthunder_enqueue_scripts() {

  wp_register_style( 'colorthunder', get_stylesheet_uri(), array(), wp_get_theme()->get( 'Version' ) );

  wp_enqueue_style( 'colorthunder' );

  wp_style_add_data( 'colorthunder-style', 'rtl', 'replace' );

	wp_enqueue_style( 'google-fonts', '<link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;700&display=swap" rel="stylesheet">', array(), wp_get_theme()->get( 'Version' ) );

	wp_enqueue_script( 'font-awesome', 'https://kit.fontawesome.com/978d7e86d8.js', array(), true );

}
add_action( 'wp_enqueue_scripts', 'colorthunder_enqueue_scripts' );

function colorthunder_post_thumbnail() {

	if( is_singular() ) :

			echo '<div class="thumbnail">' . get_the_post_thumbnail( '', 'large' ) . '</div>';

		else :

			echo '<div class="thumbnail">' . get_the_post_thumbnail( '', 'thumbnail' ) . '</div>';

	endif;

}

function colorthunder_entry_footer() {

	if( is_singular() ) :

	$post_tags = get_the_tags();

	if( ! empty( $post_tags ) ) {
		?>
		<ul class="entry-tags">
		<?php
		foreach( $post_tags as $tag ) {
			?>
			<li class="entry-tag"><a href="<?php echo get_tag_link( $tag ); ?>" title="<?php echo esc_attr( $tag->name ); ?>"><?php echo esc_attr( $tag->name ); ?></a></li>
			<?php
		}
		?>
		</ul>
		<?php
	}

	?>

	<div class="author-meta">
		<span class="author-item"><span><?php echo __( 'Written by', 'colorthunder' ); ?></span><h2 class="author-cred"><?php the_author_link(); ?></h2></span>
	</div>

	<?php

	else :

	?>

	<div class="author-meta">
		<span class="author-item"><span><span class="author-cred"><?php the_author_link(); ?></span></span><br />
		<span class="date-item"><?php the_date(); ?></span>
	</div>

	<?php

	endif;

}

function colorthunder_unautop_4_img( $content ) {
    $content = preg_replace(
        '/<p>\\s*?(<a rel=\"attachment.*?><img.*?><\\/a>|<img.*?>)?\\s*<\\/p>/s',
        '<figure class="post-image">$1</figure>',
        $content
    );
    return $content;
}
add_filter( 'the_content', 'colorthunder_unautop_4_img', 99 );

function colorthunder_excerpt_length( $length ){

	if( $length > 10 )
		return 10;

}
add_filter( 'excerpt_length', 'colorthunder_excerpt_length' );

function colorthunder_the_posts_navigation() {

}

add_action( 'widgets_init', 'colorthunder_register_widgets' );
function colorthunder_register_widgets(){
	register_sidebar( array(
		'name'          => sprintf(__('Sidebar %s'), 'right' ),
		'id'            => "sidebar-right",
		'description'   => '',
		'class'         => '',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => "</div>\n",
		'before_title'  => '<h2 class="widgettitle">',
		'after_title'   => "</h2>\n",
	) );
}

/**
 * Returns information about the current post's discussion, with cache support.
 */
function colorthunder_get_discussion_data() {
	static $discussion, $post_id;

	$current_post_id = get_the_ID();
	if ( $current_post_id === $post_id ) {
		return $discussion; /* If we have discussion information for post ID, return cached object */
	} else {
		$post_id = $current_post_id;
	}

	$comments = get_comments(
		array(
			'post_id' => $current_post_id,
			'orderby' => 'comment_date_gmt',
			'order'   => get_option( 'comment_order', 'asc' ), /* Respect comment order from Settings » Discussion. */
			'status'  => 'approve',
			'number'  => 20, /* Only retrieve the last 20 comments, as the end goal is just 6 unique authors */
		)
	);

	$authors = array();
	foreach ( $comments as $comment ) {
		$authors[] = ( (int) $comment->user_id > 0 ) ? (int) $comment->user_id : $comment->comment_author_email;
	}

	$authors    = array_unique( $authors );
	$discussion = (object) array(
		'authors'   => array_slice( $authors, 0, 6 ),           /* Six unique authors commenting on the post. */
		'responses' => get_comments_number( $current_post_id ), /* Number of responses. */
	);

	return $discussion;
}

function colorthunder_comment_form( $order ) {
	if ( true === $order || strtolower( $order ) === strtolower( get_option( 'comment_order', 'asc' ) ) ) {

		comment_form(
			array(
				'logged_in_as' => null,
				'title_reply'  => null,
				'comment_notes_before' => null,
				'comment_field' => '<textarea name="comment" id="comment" rows="8" required></textarea>',
				'cancel_reply_before' => null,
				'cancel_reply_after' => null
			)
		);
	}
}

function colorthunder_is_comment_by_post_author( $comment = null ) {
	if ( is_object( $comment ) && $comment->user_id > 0 ) {
		$user = get_userdata( $comment->user_id );
		$post = get_post( $comment->comment_post_ID );
		if ( ! empty( $user ) && ! empty( $post ) ) {
			return $comment->user_id === $post->post_author;
		}
	}
	return false;
}

require get_template_directory() . '/inc/classes/class-colorthunder-walker-comments.php';

?>
