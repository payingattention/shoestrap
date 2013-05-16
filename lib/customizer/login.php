<?php
/*
Description: Customize WordPress Login Screen with options made in customizer.
*/
function shoestrap_login_scripts() { 
  if ( get_theme_mod( 'shoestrap_logo' ) )              $login_logo = get_theme_mod( 'shoestrap_logo' );
  if ( get_theme_mod( 'shoestrap_background_color' ) )  $background_color = get_theme_mod( 'shoestrap_background_color', '#FFFFFF' );
  if ( get_theme_mod( 'shoestrap_text_color' ) )        $textcolor = get_theme_mod( 'shoestrap_text_color', '#333333' );
  if ( get_theme_mod( 'shoestrap_buttons_color' ) )     $btn_color = get_theme_mod( 'shoestrap_buttons_color', '#0066CC' );
  if ( get_theme_mod( 'shoestrap_link_color' ) )        $link_color = get_theme_mod( 'shoestrap_link_color', '#0088CC' );
  if ( get_theme_mod( 'shoestrap_google_webfonts' ) )   $google_webfonts = get_theme_mod( 'shoestrap_google_webfonts' );


  // Make sure colors are properly formatted
  $btn_color              = '#' . str_replace( '#', '', $btn_color );
  $background_color       = '#' . str_replace( '#', '', $background_color );
  $textcolor              = '#' . str_replace( '#', '', $textcolor );
  $link_color             = '#' . str_replace( '#', '', $link_color );

  // Flat buttons handling
  if ( get_theme_mod( 'shoestrap_flat_buttons' ) == 1 || get_theme_mod( 'shoestrap_general_no_gradients' ) == 1 ) {
    $btnColorHighlight = $btn_color;
  } else {
    // calcutate button colors
    if ( shoestrap_get_brightness( $btn_color ) <= 60) {
      $btnColorHighlight = shoestrap_adjust_brightness( $btn_color, 63 );
    } else {
      $btnColorHighlight = shoestrap_adjust_brightness( $btn_color, -63 );
    }
  }

  // Button text color depending on the button background color
  if ( shoestrap_get_brightness( $btn_color ) <= 160) {
    $textColor = '#ffffff';
  } else {
    $textColor = '#333333';
  }
  $startColor = $btn_color;
  $endColor   = $btnColorHighlight;

  // the styles that will be applied to the login screen
  $styles = '';
  $styles .= '<style type="text/css">';

  $styles .= 'body.login {';
  $styles .= 'background: ' . $background_color . ';';
  $styles .= 'background-size: contain;';
  $styles .= 'font-family: ' . $google_webfonts . ';';
  $styles .= '}';

  $styles .= 'body.login div#login h1 a {';
  $styles .= 'background-image: url(' . $login_logo . ');';
  $styles .= 'background-color: none;';
  $styles .= 'background-color: transparent;';
  $styles .= 'background-size: contain !important;';
  $styles .= 'padding-bottom: 30px;';
  $styles .= 'margin: 0 auto;';
  $styles .= 'width: 100% !important;';
  $styles .= '}';

  $styles .= 'body.login div#login form#loginform, .login label, .login .message {';
  if ( shoestrap_get_brightness( $background_color ) >= 160 ) $styles .= 'background:' . shoestrap_adjust_brightness( $background_color, -15 ) . ';';
  else $styles .= 'background:' . shoestrap_adjust_brightness( $background_color, 15 ) . ';';
  $styles .= 'color:' . $textcolor . ';';
  $styles .= 'border: 0px;';
  $styles .= 'border-width: 0px;';
  $styles .= 'border-style: none;';
  $styles .= '-ms-box-shadow: none;';
  $styles .= '-webkit-box-shadow: none;';
  $styles .= '-o-box-shadow: none;';
  $styles .= '-moz-box-shadow: none;';
  $styles .= 'box-shadow: none;';
  $styles .= '-ms-border-radius: 0px;';
  $styles .= '-webkit-border-radius: 0px;';
  $styles .= '-o-border-radius: 0px;';
  $styles .= '-moz-border-radius: 0px;';
  $styles .= 'border-radius: 0px;';
  $styles .= '}';

  $styles .= '.login #nav a, .login #backtoblog a, a, a.active, a:hover, a.hover, a.visited, a:visited, a.link, a:link {';
  $styles .= 'color:' . $link_color . ';';
  $styles .= 'text-decoration: none;';
  $styles .= '}';

  $styles .= '#wp-submit.button-primary {';
  $styles .= 'color:' . $textColor . ';';
  $styles .= 'background-color:' . shoestrap_mix_colors( $startColor, $endColor, 60 ) . ';';
  $styles .= 'background-image:-moz-linear-gradient(top, ' . $startColor . ', ' . $endColor . ');';
  $styles .= 'background-image: -webkit-gradient(linear, 0 0, 0 100%, from(' . $startColor . '), to(' . $endColor . '));';
  $styles .= 'background-image: -webkit-linear-gradient(top, ' . $startColor . ', ' . $endColor . ');';
  $styles .= 'background-image: -o-linear-gradient(top, ' . $startColor . ', ' . $endColor . ');';
  $styles .= 'background-image: linear-gradient(to bottom, ' . $startColor . ', ' . $endColor . ');';
  $styles .= 'background-repeat: repeat-x;';
  $styles .= '*background-color:' . $endColor . ';';
  $styles .= '}';

  $styles .= '#wp-submit.button-primary:hover, #wp-submit.button-primary:active {';
  $styles .= 'color:' . $textColor . ';';
  $styles .= 'background-color:' . $endColor . ';';
  $styles .= '*background-color:' . shoestrap_adjust_brightness( $endColor, -12 ) . ';';
  $styles .= '}';

  $styles .= '</style>';

  return $styles;

}

/* Login Links */
function shoestrap_login_logo_url() {
    return get_bloginfo( 'url' );
}
add_filter( 'login_headerurl', 'shoestrap_login_logo_url' );

function shoestrap_login_logo_url_title() {
    return get_bloginfo( 'name' );
}
add_filter( 'login_headertitle', 'shoestrap_login_logo_url_title' );

/*
 * Set cache for 24 hours
 */
function shoestrap_login_scripts_cache() {
  $data = get_transient( 'shoestrap_login_scripts' );
  if ( $data === false ) {
    $data = shoestrap_login_scripts();
    set_transient( 'shoestrap_login_scripts', $data, 3600 * 24 );
  }
  echo $data;
}
add_action( 'login_enqueue_scripts', 'shoestrap_login_scripts_cache' );

/*
 * Reset cache when in customizer
 */
function shoestrap_login_scripts_cache_reset() {
  delete_transient( 'shoestrap_login_scripts' );
  shoestrap_login_scripts_cache();
}
add_action( 'customize_preview_init', 'shoestrap_login_scripts_cache_reset' );