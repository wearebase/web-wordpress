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
  "wearebase/web-front-end-utilities" : "*"
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
* Add the Sass to your build path