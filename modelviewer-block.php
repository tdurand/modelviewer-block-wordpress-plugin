<?php

/**
 * Plugin Name:       Modelviewer Block
 * Description:       A custom block for displaying 3D models using the model-viewer web component.
 * Requires at least: 6.1
 * Requires PHP:      7.0
 * Version:           0.1.0
 * Author:            TThibault Durand
 * License:           MIT
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       modelviewer-block
 *
 * @package CreateBlock
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

function allow_glb_uploads($mime_types) {
    $mime_types['glb'] = 'model/gltf-binary'; // Add .glb file extension
    return $mime_types;
}

function allow_glb_upload_check($data, $file, $filename, $mimes) {
    // Get the extension of the uploaded file
    $filetype = wp_check_filetype($filename, $mimes);

    // Check if the file has a .glb extension
    if (strpos($filename, '.glb') !== false) {
        $data['ext']  = 'glb';
        $data['type'] = 'model/gltf-binary';
    }

    return $data;
}

// Add filter to modify the script tag to include type="module"
function add_module_type_to_model_viewer($tag, $handle, $src) {
    // Only modify the tag for our specific script handle
    if ('model-viewer-script' === $handle) {
        // Change the script tag to add type="module"
        $tag = '<script type="module" src="' . esc_url($src) . '"></script>';
    }

    return $tag;
}

function enqueue_model_viewer_script_editor() {
	// Enqueue the script
	wp_enqueue_script(
		'model-viewer-editor-script', // Handle for the script
		'https://ajax.googleapis.com/ajax/libs/model-viewer/3.5.0/model-viewer.min.js', // Script URL
		array(), // Dependencies
		null, // Version number (null to avoid cache issues)
		true // Load in the footer (true)
	);
}

function add_module_type_to_model_viewer_editor($tag, $handle, $src) {
    // Check if the handle matches the one used in wp_enqueue_script
    if ('model-viewer-editor-script' === $handle) {
        // Modify the script tag to add type="module"
        $tag = '<script type="module" id="blabla" src="' . esc_url($src) . '"></script>';
    }

    return $tag;
}

function create_block_modelviewer_init() {
	register_block_type( __DIR__ . '/build' );
	// Register and enqueue the script
	add_action('enqueue_block_assets', 'enqueue_model_viewer_script_editor');
	add_filter('script_loader_tag', 'add_module_type_to_model_viewer_editor', 10, 3);
	add_filter('upload_mimes', 'allow_glb_uploads');
	add_filter( 'wp_check_filetype_and_ext', "allow_glb_upload_check", 10, 5 );
}

add_action( 'init', 'create_block_modelviewer_init' );

