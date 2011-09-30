=== Development Site Bouncer ===
Contributors: truthmedia
Donate link: http://truthmedia.com/engage/giving/
Tags: development, developer, private, protect, redirect
Requires at least: 2.8
Tested up to: 3.2.1
Stable tag: trunk

Allows developers to run secondary copies of WordPress sites that redirect non-developers to the main site. 

== Description ==
Allows developers to run secondary copies of WordPress sites that redirect non-developers to the main site. 

Useful for creating and managing development environments where regular visitors should not have access to 
the site, but the developer would like the ability to see theme or plugin changes before going live with them.
Also prevents development sites from being seen and spidered by search engines.

Created by [TruthMedia](http://truthmedia.com)
Programming and Design by [James Warkentin](http://www.warkensoft.com/about-me/)

= Features: =

* Prevent unwanted visitors from coming to development sites.
* Prevent search engines from spidering and listing development sites.

== Installation ==

= Plugin Requirements: =

* WordPress 2.8 or higher
* PHP 4 or higher

= Instructions: =

1. Step 1
- Download plugin file from WordPress.org.

2. Upload the Plugin Files
- Unzip and upload to your WordPress plugins folder, located in your WordPress install under /wp-content/plugins/
- If you regularly sync your live DB to a testing DB, you will want to install and activate the plugin on your live server.  That way db syncs will keep track of the saved settings on live, and will always redirect users back to the live.

3. Activate the Plugin
- Browse in the WordPress admin interface to the plugin activation page and activate the plugin.

4. Configure Live Hostname
- The plugin will add a new WordPress menu item under Tools called Development Site.  Go there and configure the Live Hostname. 

== Changelog ==

= 1.00 =
* Initial release of the plugin after in-house development, testing and use.

== LICENSE ==
This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; version 3 of the License.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA

== BETA SOFTWARE WARNING==
Please be aware as you use this software that it is still considered to be
BETA SOFTWARE and as such may function in unexpected ways.  Of course, we
do try our best to make sure it is as stable as possible and try to address
problems as quickly as possible when they come up, but just be aware that
there may still be bugs.