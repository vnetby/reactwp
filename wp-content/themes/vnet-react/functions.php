<?php

require(realpath(dirname(__FILE__) . '/../vnet_theme/includes/global_vars.php'));

require(realpath(dirname(__FILE__) . '/../vnet_theme/functions-global.php'));

require(CURRENT_PATH . 'inc/ajax-functions.php');

add_action('admin_init', 'remove_blocks_post_type_support');



function remove_blocks_post_type_support()
{
  remove_post_type_support('the_blocks', 'editor');
  // remove_post_type_support('the_blocks', 'title');
  remove_post_type_support('the_blocks', 'author');
  remove_post_type_support('the_blocks', 'trackbacks');
  remove_post_type_support('the_blocks', 'excerpt');
  remove_post_type_support('the_blocks', 'comments');
  remove_post_type_support('the_blocks', 'revisions');
  remove_post_type_support('the_blocks', 'page-attributes');
  remove_post_type_support('the_blocks', 'post-formats');

  remove_post_type_support('articles', 'editor');
  remove_post_type_support('articles', 'trackbacks');
  remove_post_type_support('articles', 'excerpt');
  remove_post_type_support('articles', 'comments');
  remove_post_type_support('articles', 'revisions');
}
