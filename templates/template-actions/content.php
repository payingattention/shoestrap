<?php

/*
 * The main content template for posts
 */
function shoestrap_article_content_action() { ?>
  <article <?php post_class(); ?>>
    <header>
      <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
      <?php get_template_part('templates/entry-meta'); ?>
    </header>
    <div class="entry-summary">
      <?php do_action( 'shoestrap_entry_summary_begin' ); ?>
      <?php do_action( 'shoestrap_the_excerpt' ); ?>
      <?php do_action( 'shoestrap_entry_summary_end' ); ?>
    </div>
    <footer>
      <?php do_action( 'shoestrap_post_footer' ); ?>
    </footer>
  </article>
  <?php
}
add_action( 'shoestrap_article_content', 'shoestrap_article_content_action', 10 );

