<div id="footer-wrapper" class="container">
  <footer id="content-info" class="container" role="contentinfo">
    <div class="row">
      <div class="col col-lg-4"><?php dynamic_sidebar( 'sidebar-footer-left' ); ?></div>
      <div class="col col-lg-4"><?php dynamic_sidebar( 'sidebar-footer-center' ); ?></div>
      <div class="col col-lg-4"><?php dynamic_sidebar( 'sidebar-footer-right' ); ?></div>
    </div>
    <p><?php if ( get_theme_mod( 'footer_text' ) ) { echo get_theme_mod( 'footer_text' ); } else { echo '&copy; ' . date( 'Y' ); ?> <?php bloginfo( 'name' ); } ?></p>
  </footer>
</div>
<?php wp_footer(); ?>
<?php if ( get_option( 'shoestrap_load_scripts_on_footer' ) == 1 && is_single() && comments_open() && get_option( 'thread_comments' ) ) wp_print_scripts( 'comment-reply' ); ?>
<?php do_action( 'shoestrap_after_footer' ); ?>