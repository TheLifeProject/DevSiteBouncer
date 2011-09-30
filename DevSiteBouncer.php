<?php
/*
Plugin Name: Development Site Bouncer
Plugin URI: http://www.truthmedia.com/wordpress/
Description: Allows developers to run secondary copies of WordPress sites that redirect non-developers to the main site.
Version: 1.00
Author: TruthMedia Internet Group
Author URI: http://truthmedia.com/
Requires: WordPress Version 2.8 and PHP 4.3

Allows developers to run secondary copies of WordPress sites that redirect non-developers to the main site.


*/
	
	$DevSiteBouncerVersion = '1.00';

	/**
	 * Test and see if we have loaded the class objects.  Include the files if we haven't.
	 */	 
	
	if(!class_exists("Object"))	include_once("class/Object.class.php");
	if(!class_exists("DevSiteBouncer"))	include_once("class/DevSiteBouncer.class.php");


	/**
	 * If we are able to, create a new instance of the plugin object now.
	 */
	if(!isset($wp_devSiteBouncer)) {
		global $table_prefix;
		$wp_devSiteBouncer = new DevSiteBouncer();
		$wp_devSiteBouncer->version = $DevSiteBouncerVersion;
		
		$wp_devSiteBouncer->path = dirname(__FILE__);
		$wp_devSiteBouncer->prefix = $table_prefix;
		$wp_devSiteBouncer->url = WP_PLUGIN_URL.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__)); 

		// Add hooks as necessary to connect to WordPress
		add_action('admin_menu', array(&$wp_devSiteBouncer, 'wp_admin_init'));
		add_action('init', array(&$wp_devSiteBouncer, 'init'));
	}
	
?>