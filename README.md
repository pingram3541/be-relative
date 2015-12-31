# Be Relative WordPress Plugin for [BeTheme](http://themeforest.net/item/betheme-responsive-multipurpose-wordpress-theme/7758048?ref=pingram3541)

Modifies betheme upload fields to provide relative urls instead of absolute urls

----------

Detailed Description

-------------

BeTheme is a wonderful multi-purpose WordPress theme built by muffingroup.  The theme provides many options in which you can upload custom logo's, favicon's and even images within the page builder however all of these fields store absolute values into the database.

This is not helpful when building out the website in a development environment and later migrating the website, most of the common tools used to convert the database will not anticipate the custom database areas that BeTheme uses and the live site will still reference the development site's absolute paths.  Use this override to change BeTheme's upload fields to store relative paths

> **One step only:**

> 1. Simply upload the plugin and activate

> **Note:** This override DOES NOT change any existing paths already stored in the database.  This mod is intended to be used BEFORE building out your website with BeTheme so that the paths will be relative from the start.  Leaving the plugin active only executes on admin pages that inlcude betheme upload dialogs so it is very efficient on resources.  It literally swaps one file without being destructive to core bethem files.

#### <i class="icon-file"></i> [Get BeTheme Here!](http://themeforest.net/item/betheme-responsive-multipurpose-wordpress-theme/7758048?ref=pingram3541)

```
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Be_Relative_URL_Helper.
 */
class Be_Relative_URL_Helper {

	/**
	 * Add hooks for plugin.
	 */
	function __construct() {
        $this->setup_globals();
        $this->setup_hooks();
    }
    
    function setup_globals() {
        // define some globals to easily build the url to new script
        $this->version      = '1.0.0';
        $this->file         = __FILE__;
 
        // url to this plugin dir : site.url/wp-content/plugins/be-relative/
        $this->plugin_url   = plugin_dir_url( $this->file );
 
        // url to this plugin's js dir : site.url/wp-content/plugins/be-relative/js/
        $this->plugin_js    = trailingslashit( $this->plugin_url . 'js' );
 
        $this->component_id   = 'berelative';
        $this->component_slug = 'berelative';
    }
    
    function setup_hooks() {
        add_action( 'admin_enqueue_scripts', array( $this, 'be_admin_scripts' ), 101 );
    }
    
    public function be_admin_scripts() {
        // New script file is reachable at site.url/wp-content/plugins/be-relative/js/field_upload.js
        $handle = 'mfn-opts-field-upload-js';
        $src = $this->plugin_js.'field_upload.js';
		$deps = array( 'jquery' );
		$ver =$this->version.'-'.time();
		$in_footer = true;
		
		// As soon as WordPress meets this hook, the be_admin_scripts function will be called
        global $pagenow;
        if (
            $pagenow == 'post.php' && ($_GET['action'] == 'edit') ||
            $pagenow == 'post-new.php' ||
            //$pagenow == 'edit.php' ||
            $pagenow == 'themes.php' && ($_GET['page'] == 'muffin_options') )
        {
            wp_dequeue_script( $handle );
            wp_enqueue_script( $handle, $src, $deps, $ver, $in_footer );
        }
    }
    
}
$be_relative_url_helper = new Be_Relative_URL_Helper;
```
