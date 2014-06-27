<?php

/**
 * Plugin Name: BP Update Profile Example
 * Plugin URI:  http://buddypress.org
 * Description: Just a very simple example of how to add/update user profile information using Google Geo API
 * Author:      David Bisset
 * Author URI:  http://davidbisset.com
 * Version:     1.0
 * Text Domain: buddypress
 * License:     GPLv2 or later (license.txt)
 */
 
 
/**
 * Load only when BuddyPress is present.
 */
function bpupex_include() {
	require( dirname( __FILE__ ) . '/bp-update-profiles-example.php' );
}

add_action( 'bp_include', 'bpupex_include' );

/* WordPress stuff can go here below */