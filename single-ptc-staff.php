<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package polytec_college
 */

get_header();
?>

<main id="primary" class="site-main">
 
 <?php while ( have_posts() ) : the_post(); ?>

	 <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		 <header class="entry-header">
			 <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		 </header>
		 

		 <div class="entry-content">
    <?php 
    if ( function_exists ( 'get_field' ) ) {

 
        if ( get_field( 'staff_description' ) ) {
            the_field( 'staff_description' );
        }
 
        if ( get_field( 'courses' ) ) {
            echo '<p>Courses: '. get_field( 'courses' ) .'</p>';
        }
            
		$linkUrl = get_field('instructor_url');

		if (has_term('faculty', 'ptc-staff-category', get_the_ID())) {
			// displays the link. Each %s in the string will be replaced with the related argument
			printf("<a href='%s' target='_blank'>Instructor Website</a>",
				esc_url($linkUrl));
		}
 
    } 
    ?>
</div>

	 </article>

 <?php endwhile; // End of the loop. ?>

</main>

<?php
get_sidebar();
get_footer();