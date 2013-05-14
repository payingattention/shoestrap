<?php

/*
 * The metadata template
 */
function shoestrap_article_metadata() { ?>
  <div class="row">
    <div class="col col-lg-3">
      <div class="byline author vcard">
        <i class="glyphicon glyphicon-torso"></i>
        <?php echo __( 'By', 'shoestrap' ); ?>
        <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" rel="author" class="fn"><?php echo get_the_author(); ?></a>
      </div>
    </div>
    <div class="col col-lg-3">
      <i class="glyphicon time-icon glyphicon-time-alt"></i>
      <time class="updated" datetime="<?php echo get_the_time( 'c' ); ?>" pubdate><?php echo get_the_date(); ?></time>
    </div>
    <div class="col col-lg-3">
      <?php if ( has_tag() ) { ?>
        <i class="glyphicon glyphicon-tags"></i>
        <?php the_tags(''); ?>
      <?php } ?>
    </div>
    <div class="col col-lg-3">
      <?php if ( get_comments_number() >= 1 ) { ?>
        <i class="glyphicon glyphicon-comment"></i>
        <?php comments_number(); ?>
      <?php } ?>
    </div>
  </div>
  <?php
}
add_action( 'shoestrap_do_metadata', 'shoestrap_article_metadata', 10 );