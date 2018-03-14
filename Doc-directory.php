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

	function __construct() {

		add_action( 'init', array( $this, 'register_docs_post_type' ) );
		add_action( 'init', array( $this, 'register_docs_taxonomies' ) );
		add_action( 'add_meta_boxes', array( $this, 'register_docs_meta_box' ) );

	}

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

	function register_docs_post_type() {

		$args = array(
			'labels'             => array( 'name' => 'Documents' ),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'docs' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'menu_icon'					 => 'dashicons-media-archive',
			'supports'           => array( 'title','thumbnail','custom-fields'),
	    );

		register_post_type( 'docs', $args );
	}

	function register_docs_taxonomies() {

		$labels = array(
			'name'              => _x( 'Categories', 'taxonomy general name', 'ciroDocDirectory' ),
			'singular_name'     => _x( 'Category', 'taxonomy singular name', 'ciroDocDirectory' ),
			'search_items'      => __( 'Search Categories', 'ciroDocDirectory' ),
			'all_items'         => __( 'All Categories', 'ciroDocDirectory' ),
			'parent_item'       => __( 'Parent Category', 'ciroDocDirectory' ),
			'parent_item_colon' => __( 'Parent Category:', 'ciroDocDirectory' ),
			'edit_item'         => __( 'Edit Category', 'ciroDocDirectory' ),
			'update_item'       => __( 'Update Category', 'ciroDocDirectory' ),
			'add_new_item'      => __( 'Add New Category', 'ciroDocDirectory' ),
			'new_item_name'     => __( 'New Category Name', 'ciroDocDirectory' ),
			'menu_name'         => __( 'Category', 'ciroDocDirectory' ),
		);

		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'genre' ),
		);

		register_taxonomy( 'genre', array( 'docs' ), $args );
	}

	// register meta box
	function register_docs_meta_box() {

		$post_types = array( 'post', 'page','genre', 'docs', );

		foreach ( $post_types as $post_type ) {

			add_meta_box(
				'myplugin_meta_box',         // Unique ID of meta box
				'MyPlugin Meta Box',         // Title of meta box
				'myplugin_display_meta_box', // Callback function
				$post_type                   // Post type
			);

		}

	}
	// display meta box
	function myplugin_display_meta_box( $post ) {

		$value = get_post_meta( $post->ID, '_myplugin_meta_key', true );

		wp_nonce_field( basename( __FILE__ ), 'myplugin_meta_box_nonce' );

		?>

		<label for="myplugin-meta-box">Field Description</label>
		<select id="myplugin-meta-box" name="myplugin-meta-box">
			<option value="">Select option...</option>
			<option value="option-1" <?php selected( $value, 'option-1' ); ?>>Option 1</option>
			<option value="option-2" <?php selected( $value, 'option-2' ); ?>>Option 2</option>
			<option value="option-3" <?php selected( $value, 'option-3' ); ?>>Option 3</option>
		</select>

	<?php

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