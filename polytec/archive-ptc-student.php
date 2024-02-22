<?php
get_header();
?>

<main id="primary" class="site-main">

    <?php if (have_posts()) : ?>

        <header class="page-header">
            <?php
            the_archive_title('<h1 class="page-title">', '</h1>');
            the_archive_description('<div class="archive-description">', '</div>');
            ?>
        </header><!-- .page-header -->

        <?php
        $taxonomy = 'ptc-student-category';
        $terms = get_terms(array(
            'taxonomy'   => $taxonomy,
            'hide_empty' => false,
        ));

        // Check if any terms were found
        if (!empty($terms)) {
            // Loop through each term to display associated posts
            foreach ($terms as $term) {
                $args = array(
                    'post_type'      => 'ptc-student',
                    'posts_per_page' => -1,
                    'orderby'        => 'title',
                    'order'          => 'ASC',
                    'tax_query'      => array(
                        array(
                            'taxonomy' => $taxonomy,
                            'field'    => 'slug',
                            'terms'    => $term->slug,
                        ),
                    ),
                );

                $query = new WP_Query($args);

                while ($query->have_posts()) : $query->the_post();
            ?>
                    <article>
                        <a href="<?php the_permalink(); ?>">
                            <h2><?php the_title(); ?></h2>
                            <?php the_post_thumbnail('student-image'); ?>
                        </a>
                        <?php the_excerpt(); ?>

                        <?php
                        // Get the terms for the current post
                        $post_terms = get_the_terms(get_the_ID(), $taxonomy);

                        if ($post_terms && !is_wp_error($post_terms)) {
                            $term_names = array();
                            foreach ($post_terms as $post_term) {
                                $term_names[] = $post_term->name;
                            }
                            
                            echo '<p>Specialty: <a href="' . esc_url(get_term_link($post_term)) . '">' . $post_term->name . '</a></p>';
                        }
                        ?>
                    </article>

            <?php
                endwhile;

                // Reset post data
                wp_reset_postdata();
            }
        }

        the_posts_navigation();

    else :

        get_template_part('template-parts/content', 'none');

    endif;
    ?>

</main><!-- #main -->

<?php
get_sidebar();
get_footer();
?>
