<?php

/*
 * The content of the hero region
 * according to what we've entered in the customizer
 */
function jumbotron_content() {
  $hero = false;
    if ( ( get_theme_mod( 'jumbotron_visibility' ) == 1 && is_front_page() ) || get_theme_mod( 'jumbotron_visibility' ) != 1 ) {
      $hero = true;
    }

  if ( $hero == true ) :
    echo '<div class="jumbotron">';

    if ( get_theme_mod( 'jumbotron_nocontainer' ) != 1 )
      echo '<div class="container">';

    dynamic_sidebar('hero-area');

    if ( get_theme_mod( 'jumbotron_nocontainer' ) != 1 )
      echo '</div>';

    echo '</div>';

  endif;
}
add_action( 'shoestrap_below_top_navbar', 'jumbotron_content', 10 );

function shoestrap_jumbotron_css() {
  $center = get_theme_mod( 'jumbotron_center' );

  if ( $center == 1 )
    echo '<style>.jumbotron{text-align: center;}</style>';
}
add_action( 'wp_head', 'shoestrap_jumbotron_css' );