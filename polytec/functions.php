<?php
/**
 * polytec_college functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package polytec_college
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function polytec_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on polytec_college, use a find and replace
		* to change 'polytec' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'polytec', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
		
	add_theme_support( 'post-thumbnails' );

	

	
	//custom crop sizes
	add_image_size( 'student-image', 200, 300, true);
	add_image_size( 'student-single-image', 300, 300, true);


	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'header' => esc_html__('Header Menu Location', 'ptc'),
 			'footer' => esc_html__('Footer', 'ptc'),
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
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'polytec_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);
	

	// Change 'Add Title' placeholder text to 'Add Student Name'
	function ptc_change_student_title_text($title, $post_type) {
		if ('ptc-student' === get_post_type() ) {
			return __('Add Student Name', 'textdomain');
		}
		return $title;
	}
	add_filter('enter_title_here', 'ptc_change_student_title_text', 10, 2);

	// Change 'Add Title' placeholder text to 'Add Staff Name
	function ptc_change_staff_title_text($title, $post_type) {
		if ('ptc-staff' === get_post_type() ) {
			return __('Add Staff Name', 'textdomain');
		}
		return $title;
	}
	add_filter('enter_title_here', 'ptc_change_staff_title_text', 10, 2);



	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'polytec_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function polytec_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'polytec_content_width', 640 );
}
add_action( 'after_setup_theme', 'polytec_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function polytec_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'polytec' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'polytec' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'polytec_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function polytec_scripts() {
	wp_enqueue_style( 'polytec-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'polytec-style', 'rtl', 'replace' );

	wp_enqueue_script( 'polytec-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'polytec_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';


/**
 * Custom post types and taxonomies.
 */
require get_template_directory() . '/inc/cpt-taxonomy.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Filter the "read more" excerpt string link to the post.
 *
 */
function my_custom_excerpt_more( $more ) {
	if ( ! is_single() ) {
		$more = sprintf( ' <a class="read-more" href="%1$s">%2$s</a>',
			get_permalink( get_the_ID() ),
			__( 'Read More', 'textdomain' )
		);
	}

	return $more;
}
add_filter( 'excerpt_more', 'my_custom_excerpt_more' );


//Adjust excerpt length
function custom_excerpt_length( $length ) {
    // Check if the current page is using a specific template
    if ( ! is_single( ) ) {
        return 25; // Change this number to the desired excerpt length in words.
    }

    // For other pages, use the default excerpt length
    return $length;
}

add_filter( 'excerpt_length', 'custom_excerpt_length' );





	






  


