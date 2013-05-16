<?php

/*
 * Creates the customizer icon on the bottom-left corner of our site
 * (visible only by admins)
 */
function footer_icon() { ?>
  <?php if (current_user_can( 'edit_theme_options' )){ ?>
    <style>
    </style>
    <div id="shoestrap_icon">
      <?php
      $current_url = ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
      $href = add_query_arg( 'url', urlencode( $current_url ), wp_customize_url() ); ?>
      <a href="<?php echo $href; ?>"><i class="glyphicon-cogs"></i></a>
    </div>
  <?php } ?>
  </div>
<?php }
add_action( 'shoestrap_after_footer', 'footer_icon' );
