<?php

class DevSiteBouncer extends Object {
	
	var $path = '';
	var $url = '';
	var $prefix = 'wp_';
	
	/**
	 * Main Bounce Handling Code
	 * This is where the magic happens.  Bounce the user 
	 * to the live site if they're not logged in as a 
	 * contributor or higher.
	 */
	function init()
	{
		
	}
	
	/**
	 * Tie into the admin section to show admin related navigation.
	 */
	function wp_admin_init()
	{
		$this->plugin_page = basename(__FILE__);
		add_management_page(
			__('Development Site'), 
			__('Development Site'), 
			'edit_pages', 
			$this->plugin_page, 
			array(&$this, 'wp_admin_options')
		);
		add_action( 'admin_head', array($this, 'wp_admin_css') );
	}
	
	/**
	 * Link To Admin CSS
	 */
	function wp_admin_css()
	{
		if(isset($_GET['page']) AND $_GET['page'] == $this->plugin_page)
			echo ( '<link rel="stylesheet" type="text/css" href="'. $this->url . 'css/styles.css" />' );
	}
	
	/**
	 * Main Admin Screen Code
	 * Here's where we can adjust plugin settings in the admin side of things.
	 */
	function wp_admin_options()
	{
		global $wpdb;
		
		// Shorten the get variable.
		$q = $_GET;
		
		// Get URL
		$url = $this->build_url(array(), array('page'));
		
		// Limit the permitted actions to the following:
		$permitted_actions = array(
			'settings'		=>true,
		);
		if(!isset($q['action']) OR !$permitted_actions[$q['action']]) 
		{
			reset($permitted_actions);
			$action = current($permitted_actions);
		}
		else 
			$action = $q['action'];
		
		// Load a set of stats to display depending on the units selected.
		switch($action)
		{
			case 'settings':
			default:
				include($this->path . "/html/settings.phtml");
				break;
		}
		
	}
	
	/**
	 * Get a paginated navigation bar
	 *
	 * This function will create and return the HTML for a paginated navigation bar
	 * based on the total number of results passed in $num_results, and the value
	 * found in $_GET['pageNumber'].  The programmer simply needs to call this function
	 * with the appropriate value in $num_results, and use the value in $_GET['pageNumber']
	 * to determine which results should be shown.
	 * Creates a list of pages in the form of:
	 * 1 .. 5 6 7 .. 50 51 .. 100
	 * (in this case, you would be viewing page 6)
	 * 
	 * Code taken from http://www.warkensoft.com/2009/12/paginated-navigation-bar/
	 *
	 * @global    int        $_GET['pageNumber'] is the current page of results being displayed.
	 * @param    int     $num_results is the total number of results to be paged through.
	 * @param    int     $num_per_page is the number of results to be shown per page.
	 * @param    bool    $show set to true to write output to browser.
	 *
	 * @return    string    Returns the HTML code to display the nav bar.
	 *
	 */
	function get_paged_nav($num_results, $num_per_page=10, $show=false)
	{
		// Set this value to true if you want all pages to be shown,
		// otherwise the page list will be shortened.
		$full_page_list = false; 
		
		// Initialize the output string.
		$output = '';
		
		// Shorten the get variable.
		$q = $_GET;
		
		// Determine which page we're on, or set to the first page.
		if(isset($q['pageNumber']) AND is_numeric($q['pageNumber'])) $page = $q['pageNumber'];
		else $page = 1;
		
		// Determine the total number of pages to be shown.
		$total_pages = ceil($num_results / $num_per_page);
		
		// Begin to loop through the pages creating the HTML code.
		for($i=1; $i<=$total_pages; $i++)
		{
			// Assign a new page number value to the pageNumber query variable.
			$q['pageNumber'] = $i;
			
			$new_url = $this->build_url($q);
			
			// Determine whether or not we're looking at this page.
			if($i != $page)
			{
				// Determine whether or not the page is worth showing a link for.
				// Allows us to shorten the list of pages.
				if($full_page_list == true
				OR $i == $page-1
				OR $i == $page+1
				OR $i == 1
				OR $i == $total_pages
				OR $i == floor($total_pages/2)
				OR $i == floor($total_pages/2)+1
				)
				{
					$output .= "<a href='$new_url'>$i</a> ";
				}
				else
				{
					$output .= '. ';
				}
			}
			else
			{
				// This is the page we're looking at.
				$output .= "<strong>$i</strong> ";
			}
		}
		
		// Remove extra dots from the list of pages, allowing it to be shortened.
		$output = ereg_replace('(\. ){2,}', ' .. ', $output);
		
		// Determine whether to show the HTML, or just return it.
		if($show) echo $output;
		
		return($output);
	}
	
	/**
	 * Build a url based on permitted query vars passed to the function.
	 * 
	 * @param $add array containing query vars to add to the query request.
	 * @param $qvars array containing query vars to keep from the old query request.
	 * 
	 * @return string containing the new URL
	 */
	function build_url($add = array(), $qvars = array())
	{
		// Get the original URL from the server.
		$url = $_SERVER['REQUEST_URI'];
		
		// Remove query vars from the original URL.
		if(preg_match('#^([^\?]+)(.*)$#isu', $url, $regs))
		$url = $regs[1];
		
		// Shorten the get variable.
		$q = $_GET;
		
		// Initialize a new array for storage of the query variables.
		$tmp = array();
		foreach($qvars as $key)
			$tmp[] = "$key=" . urlencode($q[$key]);
		
		foreach($add as $key=>$value)
			$tmp[] = "$key=" . urlencode($value);
		
		// Create a new query string for the URL of the page to look at.
		$qvars = implode("&amp;", $tmp);
		
		// Create the new URL for this page.
		$new_url = $url . '?' . $qvars;
		
		return($new_url);
	}
}

?>