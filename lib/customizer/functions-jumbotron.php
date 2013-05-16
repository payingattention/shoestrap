<?php

/*
 * The content of the hero region
 * according to what we've entered in the customizer
 */
function jumbotron_content() {
  $hero = false;
  if ( get_theme_mod( 'jumbotron_visibility' ) == 'front' && is_front_page() && has_action( 'jumbotron_inside' ) )
    $hero = true;
  elseif ( has_action( 'jumbotron_inside' ) )
    $hero = true;

  if ( $hero == true ) : ?>
    <div class="jumbotron">
      <div class="container">
        <?php do_action('jumbotron_inside'); ?>
      </div>
    </div>
  <?php endif;
}
add_action( 'shoestrap_below_top_navbar', 'jumbotron_content', 10 );