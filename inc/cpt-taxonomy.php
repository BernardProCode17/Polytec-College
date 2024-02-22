<?php
function ptc_register_custom_post_types()
{

    // Register Staff
    $labels = array(
        'name'                  => _x('Staff', 'post type general name'),
        'singular_name'         => _x('Staff', 'post type singular name'),
        'menu_name'             => _x('Staff', 'admin menu'),
        'name_admin_bar'        => _x('Staff', 'add new on admin bar'),
        'add_new'               => _x('Add New', 'staff'),
        'add_new_item'          => __('Add New Staff'),
        'new_item'              => __('New Staff'),
        'edit_item'             => __('Edit Staff'),
        'view_item'             => __('View Staff'),
        'all_items'             => __('All Staff'),
        'search_items'          => __('Search Staff'),
        'parent_item_colon'     => __('Parent Staff:'),
        'not_found'             => __('No staff found.'),
        'not_found_in_trash'    => __('No staff found in Trash.'),
        'archives'              => __('Staff Archives'),
        'insert_into_item'      => __('Insert into staff'),
        'uploaded_to_this_item' => __('Uploaded to this staff'),
        'filter_item_list'      => __('Filter staffs list'),
        'items_list_navigation' => __('Staff list navigation'),
        'items_list'            => __('Staff list'),
        'featured_image'        => __('Staff featured image'),
        'set_featured_image'    => __('Set staff featured image'),
        'remove_featured_image' => __('Remove staff featured image'),
        'use_featured_image'    => __('Use as featured image'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_nav_menus'  => true,
        'show_in_admin_bar'  => true,
        'show_in_rest'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'staff'),
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-groups',
        'supports'           => array('title'),
        
    );
    register_post_type('ptc-staff', $args);


    // Students
    $labels = array(
        'name'                  => _x('Students', 'post type general name'),
        'singular_name'         => _x('Student', 'post type singular name'),
        'menu_name'             => _x('Students', 'admin menu'),
        'name_admin_bar'        => _x('Student', 'add new on admin bar'),
        'add_new'               => _x('Add New', 'Student'),
        'add_new_item'          => __('Add New Student'),
        'new_item'              => __('New Student'),
        'edit_item'             => __('Edit Student'),
        'view_item'             => __('View Student'),
        'all_items'             => __('All Students'),
        'search_items'          => __('Search Students'),
        'parent_item_colon'     => __('Parent Students:'),
        'not_found'             => __('No Students found.'),
        'not_found_in_trash'    => __('No Students found in Trash.'),
        'archives'              => __('Student Archives'),
        'insert_into_item'      => __('Insert into student'),
        'uploaded_to_this_item' => __('Uploaded to this student'),
        'filter_item_list'      => __('Filter student list'),
        'items_list_navigation' => __('Student list navigation'),
        'items_list'            => __('Student list'),
        'featured_image'        => __('Student featured image'),
        'set_featured_image'    => __('Set student featured image'),
        'remove_featured_image' => __('Remove student featured image'),
        'use_featured_image'    => __('Use as featured image'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_rest'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'student'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 7,
        'menu_icon'          => 'dashicons-businessperson',
        'supports'           => array('title', 'thumbnail', 'editor'),
        'template'           => array(
                                        array('core/paragraph'),
                                        array('core/button'),
                                    ), 

        'template_lock'      => 'all',
    );

    register_post_type('ptc-student', $args);

    // Job Posts
    

    // Staff
    
}
add_action('init', 'ptc_register_custom_post_types');

function ptc_register_taxonomies() {
    // Add Staff Category taxonomy
    

    // Add Staff CPT Taxonomy
    $labels = array(
        'name'              => _x( 'Staff Categories', 'taxonomy general name' ),
        'singular_name'     => _x( 'Staff Category', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Staff Categories' ),
        'all_items'         => __( 'All Staff Category' ),
        'parent_item'       => __( 'Parent Staff Category' ),
        'parent_item_colon' => __( 'Parent Staff Category:' ),
        'edit_item'         => __( 'Edit Staff Category' ),
        'view_item'         => __( 'View Staff Category' ),
        'update_item'       => __( 'Update Staff Category' ),
        'add_new_item'      => __( 'Add New Staff Category' ),
        'new_item_name'     => __( 'New Staff Category Name' ),
        'menu_name'         => __( 'Staff Category' ),
    );
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_in_menu'      => true,
        'show_in_nav_menu'  => true,
        'show_in_rest'      => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'staff-categories' ),
    );
    register_taxonomy( 'ptc-staff-category', array( 'ptc-staff' ), $args );

    $labels = array(
        'name'              => _x( 'Student Categories', 'taxonomy general name' ),
        'singular_name'     => _x( 'Student Category', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Student Categories' ),
        'all_items'         => __( 'All Student Categories' ),
        'parent_item'       => __( 'Parent Student Category' ),
        'parent_item_colon' => __( 'Parent Student Category:' ),
        'edit_item'         => __( 'Edit Student Category' ),
        'view_item'         => __( 'View Staff Category' ),
        'update_item'       => __( 'Update Student Category' ),
        'add_new_item'      => __( 'Add New Student Category' ),
        'new_item_name'     => __( 'New Student Category' ),
        'menu_name'         => __( 'Student Category' ),
    );
    
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_in_menu'      => true,
        'show_in_nav_menu'  => true,
        'show_in_rest'      => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'student-categories' ),
    );
    
    register_taxonomy( 'ptc-student-category', array( 'ptc-student' ), $args );
}
add_action( 'init', 'ptc_register_taxonomies');

function ptc_rewrite_flush() {
    ptc_register_custom_post_types();
    flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'ptc_rewrite_flush' );