<?php

/*
 * Apply any css needed for the social sharing buttons.
 */
function shoestrap_social_share_styles() {
  $btn_color = get_theme_mod( 'shoestrap_buttons_color', '#0066CC' );
  $background_color = get_theme_mod( 'background_color' );

  $googleplus   = get_theme_mod( 'shoestrap_gplus_on_posts' );
  $facebook     = get_theme_mod( 'shoestrap_facebook_on_posts' );
  $twitter      = get_theme_mod( 'shoestrap_twitter_on_posts' );
  $linkedin     = get_theme_mod( 'shoestrap_linkedin_on_posts' );
  $pinterest    = get_theme_mod( 'shoestrap_pinterest_on_posts' );
  $digg         = get_theme_mod( 'shoestrap_digg_on_posts' );

  $networks_number = ( $googleplus + $facebook + $twitter + $linkedin + $pinterest + $digg );


  // Make sure colors are properly formatted
  $btn_color        = '#' . str_replace( '#', '', $btn_color );
  $background_color = '#' . str_replace( '#', '', $background_color );
  
  $styles = '<style type="text/css">';
  $styles .= '#social-sharing .shareme .box {';
  $styles .= 'background: ' . $btn_color . ';';
  if ( shoestrap_get_brightness( $btn_color ) >= 160 ) $styles .= 'color: #333;';
  else $styles .= 'color: #fff;';
  $styles .= '}';

  $styles .= '#social-sharing .shareme .middle { background: ' . $btn_color . '; }';
  $styles .= '#social-sharing .shareme .box:hover { width: ' . ( ( ( $networks_number + 1 ) * 30 ) + 10 ) . 'px; }';
  $styles .= '#social-sharing .shareme .box:hover .middle { width: ' . ( $networks_number * 30 ) . 'px; }';

  $styles .= '#social-sharing .shareme .box .middle a , #social-sharing .shareme .box:hover .middle a {';
  if ( shoestrap_get_brightness( $btn_color ) >= 160 ) $styles .= 'color: #333;';
  else $styles .= 'color: #fff;';


  $styles .= '#social-sharing .shareme .right {';
  $styles .= 'border: 1px solid ' . $btn_color . ';';
  if ( shoestrap_get_brightness( $background_color ) >= 160 )
    $styles .= 'background: ' . $background_color . '; color: #333;';
  else
    $styles .= 'background: ' . $background_color . '; color: #fff;';
  $styles .= '}';

  $styles .= '</style>';
  
  return $styles;
}
