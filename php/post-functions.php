<?php

/*
 * THIS FILE REQUIRES TIMBER
 */

/**
 * latestPosts
 *
 * Retrieves $num latest posts that are published
 *
 * @param int       $num  number of posts you'd like
 * @param array     $exclude  array of ids of post to exclude
 * @return array    Array of TimberPosts
 */
function base_latestPosts($num, $exclude = array()) {
    return base_latestX($num, 'post', $exclude);
}

/**
 * latestX
 *
 * Retrieves $num latest news posts that are published
 *
 * @param int       $num        number of posts you'd like
 * @param int       $post_type  post type to retrieve
 * @param array     $exclude    array of ids of post to exclude
 * @return array    Array of TimberPosts
 */
function base_latestX($num, $post_type = 'post', $exclude = array()) {
    $args = array (
        'post_type'              => array( $post_type ),
        'post_status'            => array( 'publish' ),
        'pagination'             => false,
        'post__not_in'           => $exclude,
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