<?php

/*
 * THIS FILE REQUIRES TIMBER
 */

/**
 * latestPosts
 *
 * Retrieves $num latest news posts that are published
 *
 * @param int       $num  number of posts you'd like
 * @param int       $exclude  id of post to exclude
 * @return array    WP_Query
 */
function base_latestPosts($num, $exclude = false) {
    $args = array (
        'post_type'              => array( 'post' ),
        'post_status'            => array( 'publish' ),
        'pagination'             => false,
        'exclude'                => $exclude,
        'post__not_in'           => array($exclude),
        'posts_per_page'         => $num,
        'order'                  => 'DESC'
    );

    $query = Timber::get_posts( $args );
    return $query;
}

// Get the post object of the parent of this page
function base_getParent () {
    $parent = Timber::get_post(base_return_id());

    return $parent;
}

// Get the post objects of the siblings of this page
function base_getSiblings () {
    $id = base_return_id();

    $args = array(
        'sort_order' => 'asc',
        'sort_column' => 'post_title',
        'hierarchical' => 1,
        'child_of' => $id,
        'parent' => $id,
        'post_type' => 'page',
        'sort_column'  => 'menu_order, post_title',
        'post_status' => 'publish'
    );

    $pages = Timber::get_posts($args); 

    return $pages;
}

function base_getPageChildren () {
    global $post;
    $children_args = array (
      'post_parent' => $post->ID,
      'pagination' => false,
      'posts_per_page' => '-1',
      'order' => 'ASC',
      'post_type' => 'page',
      'orderby' => 'menu_order'
    );
    return Timber::get_posts($children_args);
}

function base_getPage($id) {
    return Timber::get_post($id);
}

function base_randomItem($type = 'page') {
    $args = array( 'post_type' => $type, 'numberposts' => 1, 'orderby' => 'rand' );
    $rand_posts = Timber::get_posts( $args );

    return $rand_posts[0];
}