<?php

namespace VNET;

add_action('wp_ajax_vnet_get_menu', 'VNET\ajax_get_menu');
add_action('wp_ajax_nopriv_vnet_get_menu', 'VNET\ajax_get_menu');

add_action('wp_ajax_vnet_get_page_data', 'VNET\ajax_get_page_data');
add_action('wp_ajax_nopriv_vnet_get_page_data', 'VNET\ajax_get_page_data');



function ajax_get_menu()
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





function ajax_get_page_data()
{
  $url = get_from_array($_POST, 'page');
  $data = get_page_data($url);

  if (!$data) {
    echo json_encode(['status' => 'error']);
    exit;
  }

  $data['status'] = 'success';

  echo json_encode($data);
  exit;

  // $url = explode("/", $url);
  // $url = array_values(array_filter($url));

  // $countUrl = count($url);

  // $data = false;

  // if (!$countUrl) {
  //   $data = get_home_page_data();
  // }

  // if ($countUrl === 1) {
  //   $data = get_single_url_data($url[0]);
  // }

  // if ($countUrl === 2) {
  //   $data = get_double_url_data($url);
  // }

  // if ($data) {
  //   $data['status'] = 'success';
  // } else {
  //   $data = ['status' => 'error'];
  // }

  // echo json_encode($data);
  // exit;
}














// function get_single_url_data($url)
// {
//   $id = (int) url_to_postid($url);

//   if ($id !== 0) {
//     $data = get_single_post_data($id);
//     return [
//       'type' => 'page',
//       'data' => $data,
//       'page_title' => $data->post_title
//     ];
//   } else {
//     if (post_type_exists($url)) {
//       return get_archive_data($url);
//     }
//   }
// }





// function get_double_url_data($url)
// {
//   $first = $url[0];
//   $second = $url[1];
//   $isArchive = post_type_exists($first);

//   if ($isArchive && preg_match("/[\d]+/", $second)) {
//     return get_archive_data($first, $second);
//   }

//   if ($isArchive) {
//     $data = get_page_by_path($second, 'OBJECT', $first);
//     return [
//       'type' => 'page',
//       'data' => $data,
//       'page_title' => $data ? $data->post_title : false
//     ];
//   }
// }
