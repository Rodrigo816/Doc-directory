<?php
/*
Plugin Name:       Ciro Doc Directory
Description:       Descrição
Plugin URI:        https://profiles.wordpress.org/
Contributors:      (list of wordpress.org usernames)
Author:            Ciro
Author URI:        https://example.com/author/
Donate link:       https://example.com/donate/
Tags:              example, boilerplate
Version:           1.0
Stable tag:        1.0
Requires at least: 4.5
Tested up to:      4.8
Text Domain:       ciroDocDirectory
Domain Path:       /languages
License:           GPL v2 or later
License URI:       https://www.gnu.org/licenses/gpl-2.0.txt

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 
2 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
with this program. If not, visit: https://www.gnu.org/licenses/
*/


// disable direct file access
if ( ! defined( 'ABSPATH' ) ) {

	exit;

}

class CiroDocDirectory {

	function activate() {
		// generated a CPT
		// flush rewrite rules
	}

	function deactivate() {
		// flush rewrite rules
	}

	function uninstall() {
		// delete CPT
		// delete all the plugin data from the DB
	}
}

if ( class_exists( 'CiroDocDirectory' ) ) {
	$ciroDocDirectory = new CiroDocDirectory();
}

// activation hook
register_activation_hook( __FILE__, array( $ciroDocDirectory, 'activate' ) );

// deactivation hook
register_deactivation_hook( __FILE__, array( $ciroDocDirectory, 'deactivate' ) );

// uninstall hook
//register_uninstall_hook( __FILE__, 'myplugin_on_uninstall' );