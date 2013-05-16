<?php

add_theme_support( 'custom-background' );

$files    = array();
$files[]  = array( 'filename' => '/lib/customizer/misc-color-functions.php' );
$files[]  = array( 'filename' => '/lib/customizer/custom-controls.php' );

$files[]  = array( 'filename' => '/lib/customizer/customizer-sections.php' );
$files[]  = array( 'filename' => '/lib/customizer/customizer-settings.php' );
$files[]  = array( 'filename' => '/lib/customizer/customizer-controls.php' );

$files[]  = array( 'filename' => '/lib/customizer/functions-advanced.php' );
$files[]  = array( 'filename' => '/lib/customizer/functions-featured-image.php' );
$files[]  = array( 'filename' => '/lib/customizer/functions-footer.php' );
$files[]  = array( 'filename' => '/lib/customizer/functions-jumbotron.php' );
$files[]  = array( 'filename' => '/lib/customizer/functions-layout.php' );
$files[]  = array( 'filename' => '/lib/customizer/functions-logo.php' );
$files[]  = array( 'filename' => '/lib/customizer/functions-navbar.php' );
$files[]  = array( 'filename' => '/lib/customizer/functions-typography.php' );

$files[]  = array( 'filename' => '/lib/customizer/compiler.php' );

foreach( $files as $file ) {
  if ( file_exists( locate_template( $file ) ) ) {
    require_once locate_template( $file );
  }
}

