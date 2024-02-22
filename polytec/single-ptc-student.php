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

    <?php
    if (function_exists('get_field')) {
        if (get_field('the_title')) {
            the_title('<h1>', '</h1>');
        }

        if (get_field('student_portfolio_link')) {
            $portfolio_link = esc_url(get_field('student_portfolio_link'));
            echo '<a href="' . $portfolio_link . '" target="_blank">' . $portfolio_link . '</a>';
        }
    }

    while (have_posts()) :
        the_post();

        get_template_part('template-parts/content', get_post_type());

        // If comments are open or we have at least one comment, load up the comment template.
        if (comments_open() || get_comments_number()) :
            comments_template();
        endif;

        $taxonomy = 'ptc-student-category';

        // Get the terms for the current post
        $post_terms = get_the_terms(get_the_ID(), $taxonomy);

        if ($post_terms && !is_wp_error($post_terms)) {
            foreach ($post_terms as $post_term) {
                echo '<h3>Meet other ' . $post_term->name . 's</h3>';
            }
        }

        // Create a new query to get all posts in the same taxonomy term
        $args = array(
            'post_type' => 'ptc-student', // Replace with your actual post type
            'tax_query' => array(
                array(
                    'taxonomy' => $taxonomy,
                    'field'    => 'id',
                    'terms'    => $post_term->term_id,
                ),
            ),
			'post__not_in'   => array(get_the_ID()), // Exclude the current post
            'posts_per_page' => -1, // Display all posts
        );

        $related_posts_query = new WP_Query($args);

        // Output the list of related posts
        if ($related_posts_query->have_posts()) {
            echo '<ul>';
            while ($related_posts_query->have_posts()) {
                $related_posts_query->the_post();
                echo '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
            }
            echo '</ul>';
            wp_reset_postdata(); // Reset post data to restore the original query
        }

    endwhile; // End of the loop.
    ?>

</main><!-- #main -->

<?php
get_sidebar();
get_footer();
