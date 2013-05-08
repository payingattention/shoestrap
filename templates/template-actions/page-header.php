<?php

function shoestrap_page_header_action() { ?>
  <div class="page-header">
    <h1><?php echo shoestrap_title(); ?></h1>
  </div>
  <?php
}
add_action( 'shoestrap_page_header', 'shoestrap_page_header_action', 10 );