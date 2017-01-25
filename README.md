# Requirements

This package depends on "wpackagist-plugin/timber-library": "^1"

# Install
Include it in your composer:

```
"require": {
  "wearebase/web-wordpress" : "*"
}
```

And specify a version or minimum version.

# Configure where you want the package to go
If you want to install somewhere other than `vendor`, in your `composer.json` add the following:

```
"extra": {
  "installer-paths": {
    "wp-content/themes/timber/packages/{$name}": ["wearebase/web-wordpress"]
  }
}
```

# Enabling

## Enabling Sass
Add the Sass to your build path:

```
add_import_path "wp-content/themes/timber/packages"
```

# PHP
Simply include each of these files in your `functions.php`, then call the functions at a later time.

`post-functions.php` requires Timber as it uses Timber's get_post functions to return TimberPost objects, not WP Posts.

## What's Included:
* Breadcrumb generator
* Various TimberPost Functions
    * Finding latest posts, post children, post parents etc
* WP Admin Tweaks
    * Disabling Emojis
    * Removing 'h1', 'h2' and 'pre' from the WP Richtext Editor
    * Add Boostrap Responsive Embed to the WP Embedder
    * Removing elements from the WP Admin Quickbar
