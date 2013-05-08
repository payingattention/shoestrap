<?php

/*
 * The single-post content template
 */
function shoestrap_single_page_content_template() { ?>
  <?php while ( have_posts() ) : the_post(); ?>
    <?php do_action( 'shoestrap_before_the_content' ); ?>
    <?php the_content(); ?>
    <?php do_action( 'shoestrap_after_the_content' ); ?>
    <?php wp_link_pages( array( 'before' => '<nav class="pagination">', 'after' => '</nav>' ) ); ?>
  <?php endwhile;
}
add_action( 'shoestrap_single_page_content', 'shoestrap_single_page_content_template', 10 );