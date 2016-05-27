<?php

if (!class_exists('Timber')) {
    add_action('admin_notices', function () {
            echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="'.esc_url(admin_url('plugins.php#timber')).'">'.esc_url(admin_url('plugins.php')).'</a></p></div>';
        });

    return;
}

function base_getBreadcrumbs() {

  if (is_404()) {
    return false;
  }

  // Hack to fix breadcrumbs when you're viewing the news home
  if (is_home()) {
    $post = new \Timber\TimberPost(get_option( 'page_for_posts' ));
  } else {
    global $post;
  }

  $breadcrumbs = [];

  if($post->post_parent) {
    $parent_id = $post->post_parent;

    while ($parent_id) {
      $page = get_page($parent_id);
      $breadcrumbs[] = new \Timber\TimberPost($page->ID);
      $parent_id = $page->post_parent;
    }

    $breadcrumbs = array_reverse($breadcrumbs);
  }

  // Add 'Blog Home' to breadcrumbs if you're on a news post or archive
  if ((is_single() || is_archive()) && !is_search()) {
    $breadcrumbs[] = new \Timber\TimberPost(get_option( 'page_for_posts' ));
  }

  return $breadcrumbs;

}
