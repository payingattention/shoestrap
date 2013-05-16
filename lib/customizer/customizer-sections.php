<?php

function shoestrap_customizer_sections( $wp_customize ){

  $sections   = array();
  $sections[] = array( 'slug' => 'general',         'title' => __( 'General', 'shoestrap' ),          'priority' => 1 );
  $sections[] = array( 'slug' => 'logo',            'title' => __( 'Logo', 'shoestrap' ),             'priority' => 2 );
  $sections[] = array( 'slug' => 'layout',          'title' => __( 'Layout', 'shoestrap' ),           'priority' => 3 );
  $sections[] = array( 'slug' => 'navbar',          'title' => __( 'Navbar', 'shoestrap' ),           'priority' => 4 );
  $sections[] = array( 'slug' => 'typography',      'title' => __( 'Typography', 'shoestrap' ),       'priority' => 5 );
  $sections[] = array( 'slug' => 'featured_image',  'title' => __( 'Featured Image', 'shoestrap' ),   'priority' => 6 );
  $sections[] = array( 'slug' => 'jumbotron',       'title' => __( 'Jumbotron (Hero)', 'shoestrap' ), 'priority' => 7 );
  $sections[] = array( 'slug' => 'footer',          'title' => __( 'Footer', 'shoestrap' ),           'priority' => 8 );
  $sections[] = array( 'slug' => 'advanced',        'title' => __( 'Advanced', 'shoestrap' ),         'priority' => 9 );

  foreach( $sections as $section ){
    $wp_customize->add_section( $section['slug'], array( 'title' => $section['title'], 'priority' => $section['priority'] ) );
  }
}
add_action( 'customize_register', 'shoestrap_customizer_sections' );
