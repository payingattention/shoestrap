<?php

/*
 * Applies the background color to the page.
 */
function shoestrap_background_css() {
  $color = get_theme_mod( 'shoestrap_background_color' );
  
  // Make sure colors are properly formatted
  $color = '#' . str_replace( '#', '', $color );

  $styles = '<style>';
  $styles .= 'body.custom-background, body{ background-color: ' . $color . '; }';
  $styles .= '#wrap{ background: ' . $color . '; }';
  $styles .= '</style>';

  return $styles;
}
