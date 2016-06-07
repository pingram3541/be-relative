<?php
/**
 * Plugin Name: Be Relative
 * Plugin URI: http://themeforest.net/item/betheme-responsive-multipurpose-wordpress-theme/7758048?ref=pingram3541
 * Description: Modifies betheme upload fields to provide relative urls instead of absolute urls
 * Version: 1.0
 * Author:  Philip Ingram
 * Author URI: http://www.tellatek.com/
 * License: GPLv2+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * GitHub Plugin URI: https://github.com/pingram3541/be-relative
 * GitHub Branch:     master
 *
 * Copyright (c) 2015 tellatek.com (http://www.tellatek.com/)
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 2 or, at
 * your discretion, any later version, as published by the Free
 * Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
 *
 * @package berelative
 */

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
