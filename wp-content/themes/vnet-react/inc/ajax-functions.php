<?php

namespace VNET;

add_action('wp_ajax_vnet_get_menu', 'VNET\get_menu');
add_action('wp_ajax_nopriv_vnet_get_menu', 'VNET\get_menu');

add_action('wp_ajax_vnet_get_page_data', 'VNET\get_page_data');
add_action('wp_ajax_nopriv_vnet_get_page_data', 'VNET\get_page_data');



function get_menu()
{
  $loc = get_from_array($_POST, 'location');

  $locations = get_nav_menu_locations();
  $res = [];

  foreach ($locations as $slug => $id) {
    if (!$loc || $slug === $loc) {
      $menu = wp_get_nav_menu_items($id);
      if (!$menu) continue;

      foreach ($menu as &$item) {
        if (!$item->menu_item_parent) continue;
        addToParentObject($menu, $item);
        $item = null;
      }

      $menu = array_values(array_filter($menu));
      $res[$slug] = $menu;
    }
  }

  echo json_encode($res);
  exit;
}





function addToParentObject(&$menu, $item)
{

  $parentId = (int) $item->menu_item_parent;

  foreach ($menu as &$currentItem) {

    if (!is_object($currentItem)) continue;

    $id = (int) $currentItem->ID;
    if ($id === $parentId) {
      if (!property_exists($currentItem, 'childs')) $currentItem->childs = [];
      $currentItem->childs[] = $item;
      return;
    }
    if (property_exists($currentItem, 'childs')) {
      return addToParentObject($currentItem->childs, $item);
    }
  }
}





function get_page_data()
{
  $url = get_from_array($_POST, 'page');

  $url = explode("/", $url);
  $url = array_values(array_filter($url));

  $countUrl = count($url);

  $data = false;

  if (!$countUrl) {
    $data = get_home_page_data();
  }

  if ($countUrl === 1) {
    $data = get_single_url_data($url[0]);
  }

  if ($countUrl === 2) {
    $data = get_double_url_data($url);
  }

  if ($data) {
    $data['status'] = 'success';
  } else {
    $data = ['status' => 'error'];
  }

  echo json_encode($data);
  exit;
}



function get_home_page_data()
{
  $id = get_option('page_on_front');
  $data = get_single_post_data($id);

  return [
    'type' => 'page',
    'data' => $data,
    'page_title' => $data->post_title
  ];
}






function get_single_post_data($id)
{
  $data = get_post($id);
  $data = add_single_post_data($data);
  return $data;
}


function add_single_post_data(&$post)
{
  $post->thumb = get_the_post_thumbnail_url($post->ID);
  $post->permalink = get_permalink($post->ID);
  $post->template = get_page_template($post->ID);
  return $post;
}




function get_single_url_data($url)
{
  $id = (int) url_to_postid($url);

  if ($id !== 0) {
    $data = get_single_post_data($id);
    return [
      'type' => 'page',
      'data' => $data,
      'page_title' => $data->post_title
    ];
  } else {
    if (post_type_exists($url)) {
      return get_archive_data($url);
    }
  }
}





function get_double_url_data($url)
{
  $first = $url[0];
  $second = $url[1];
  $isArchive = post_type_exists($first);

  if ($isArchive && preg_match("/[\d]+/", $second)) {
    return get_archive_data($first, $second);
  }

  if ($isArchive) {
    $data = get_page_by_path($second, 'OBJECT', $first);
    return [
      'type' => 'page',
      'data' => $data,
      'page_title' => $data ? $data->post_title : false
    ];
  }
}





function get_archive_data($slug, $page = 1)
{
  $data = get_post_type_object($slug);
  $posts = get_posts([
    'post_type' => $slug,
    'numberposts' => get_option('posts_per_page'),
    'page' => $page
  ]);
  foreach ($posts as &$post) {
    $post = add_single_post_data($post);
  }
  return [
    'type' => 'archive',
    'data' => $data,
    'page_title' => $data ? $data->label : false,
    'posts' => $posts
  ];
}




function get_page_template($id)
{
  $template = get_field('page_block_template', $id);
  if (!is_array($template)) return false;

  foreach ($template as &$item) {
    $key = get_from_array($item, 'acf_fc_layout');
    if ($key === 'template_block') {
      $key = get_from_array($item, 'block');
      $postId = (int) preg_replace("/block_/", "", $key);
      $item = get_field($key, $postId);
    }
    $item['key'] = $key;
  }
  return $template;
}
