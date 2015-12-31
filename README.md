# Be Relative WordPress Plugin for [BeTheme](http://themeforest.net/item/betheme-responsive-multipurpose-wordpress-theme/7758048?ref=pingram3541)

Modifies betheme upload fields to provide relative urls instead of absolute urls

Why use this plugin?
---------

BeTheme is a wonderful multi-purpose WordPress theme built by muffingroup.  The theme provides many options in which you can upload custom logo's, favicon's and even images within the page builder however all of these fields store absolute values into the database.

This is not helpful when building out the website in a development environment and later migrating the website, most of the common tools used to convert the database will not anticipate the custom database areas that BeTheme uses and the live site will still reference the development site's absolute paths.  Use this override to change BeTheme's upload fields to store relative paths

---------
> **One step only:**

> 1. Simply upload the plugin and activate

> **Note:** This override DOES NOT change any existing paths already stored in the database.  This mod is intended to be used BEFORE building out your website with BeTheme so that the paths will be relative from the start.  Leaving the plugin active only executes on admin pages that inlcude betheme upload dialogs so it is very efficient on resources.  It literally swaps one file without being destructive to core bethem files.

#### <i class="icon-file"></i> [Get BeTheme Here!](http://themeforest.net/item/betheme-responsive-multipurpose-wordpress-theme/7758048?ref=pingram3541)
