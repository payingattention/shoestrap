<?php

/*
 * Use an action for the_excerpt to make the system more modular
 */
function shoestrap_do_the_excerpt() {
  the_excerpt();
}
add_action( 'shoestrap_the_excerpt', 'shoestrap_do_the_excerpt' );
