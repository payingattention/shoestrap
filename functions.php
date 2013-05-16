<?php
/**
 * Shoestrap includes.
 */

$advanced_builder = get_option('shoestrap_advanced_compiler');

$files    = array();
// Utility functions
$files[]  = array( 'filename' => '/lib/utils.php' );
// Initial theme setup and constants
$files[]  = array( 'filename' => '/lib/init.php' );
// Sidebar class
$files[]  = array( 'filename' => '/lib/sidebar.php' );
// Configuration
$files[]  = array( 'filename' => '/lib/config.php' );
// Theme activation
$files[]  = array( 'filename' => '/lib/activation.php' );
// Cleanup
$files[]  = array( 'filename' => '/lib/cleanup.php' );
// Custom nav modifications
$files[]  = array( 'filename' => '/lib/nav.php' );
// Custom comments modifications
$files[]  = array( 'filename' => '/lib/comments.php' );
// Rewrites
$files[]  = array( 'filename' => '/lib/rewrites.php' );
// Sidebars and widgets
$files[]  = array( 'filename' => '/lib/widgets.php' );
// Scripts and stylesheets
$files[]  = array( 'filename' => '/lib/scripts.php' );
// Image resizing script
$files[]  = array( 'filename' => '/lib/resize.php' );
// Slide-down widget area functions
$files[]  = array( 'filename' => '/lib/slide-down.php' );
// Custom template actions
$files[]  = array( 'filename' => '/templates/template-actions/content-page.php' );
$files[]  = array( 'filename' => '/templates/template-actions/content-single.php' );
$files[]  = array( 'filename' => '/templates/template-actions/content.php' );
$files[]  = array( 'filename' => '/templates/template-actions/header.php' );
$files[]  = array( 'filename' => '/templates/template-actions/metadata.php' );
$files[]  = array( 'filename' => '/templates/template-actions/page-header.php' );
$files[]  = array( 'filename' => '/templates/template-actions/the-excerpt.php' );

// Load the following options only on single-site installations
// OR on multisite when the user is super-admin.
if ( ( is_multisite() && is_super_admin() ) || !is_multisite() ) {
  require_once locate_template( '/lib/admin/advanced_options.php' );        // Theme Advanced Options
}

// Customizer functions
$files[]  = array( 'filename' => '/lib/customizer/customizer.php' );

// Custom functions
$files[]  = array( 'filename' => '/lib/custom.php' );

// Admin page
$files[]  = array( 'filename' => '/lib/admin/admin.php' );
// Licencing to allow auto-updates
$files[]  = array( 'filename' => '/lib/admin/licencing.php' );

foreach( $files as $file ) {
  if ( file_exists( locate_template( $file ) ) ) {
    require_once locate_template( $file );
  }
}
