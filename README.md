# Caveat: This is not a Craft Plugin
Because Composer doesn't let you install to a folder of your choice, at the current time we are hijacking the [composer/installers](https://github.com/composer/installers) package for 'Craft Plugins'. This means you must add an item to your composer.json to place it in a folder of your choice.

This will only negatively affect users who use Craft CMS. And as this is a package designed for a Wordpress project, that shouldn't be a problem... right?

# Install
Include it in your composer:

```
"require": {
  "wearebase/web-wordpress" : "*"
}
```

And specify a version or minimum version.

# Configure where you want the package to go
In your `composer.json`, add the following:

```
"extra": {
  "installer-paths": {
    "src/components/{$name}": ["type:craft-plugin"]
  }
}
```

This plugin identifies itself as a `craft-plugin`. The addition above will send all `craft-plugin` to a directory you specify. I recommend to send it to your src directory in a third-party folder you can easily access with Sass, Twig, etc. If using Wordpress, send it to a theme/third-party directory and gitignore that folder.

If you do not specify this item in `composer.json` this utility will install to `craft/plugins/{$name}` as that is the default from `composer/installer` package.

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