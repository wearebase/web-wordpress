# Info
This project is a collection of useful utilities, applicable to Wordpress (and Timber) projects.

# Install
In your `composer.json`, add a new section for repositories:

```
"repositories": [
  { "type": "vcs", "url": "GIT-URL" }
]
```

And add the url of this repository.

Then include it in your composer:

```
"require": {
  "wearebase/web-front-end-wordpress" : "*"
}
```

And specify a version or minimum version.

As this repo is private on BitBucket, your development machine *and* your servers will need authorised keys on bitbucket to pull this repo.

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