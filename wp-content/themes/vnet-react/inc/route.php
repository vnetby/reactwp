<?php

namespace VNET;



function get_page_data($url)
{
  $url = explode("/", $url);
  $url = array_values(array_filter($url));

  $paged = 1;
  $perPage = get_option('posts_per_page');


  $numPage = array_search('page', $url);

  if ($numPage) {
    if (isset($url[$numPage + 1])) {
      $paged = $url[$numPage + 1];
    } else {
      return false;
    }
    if (isset($url[$numPage + 2])) return false;

    $url = array_slice($url, 0, $numPage);
  }


  $totalPaths = count($url);


  if (!$totalPaths) {
    $id = get_option('page_on_front');
    $data = get_single_post_data($id);
    $data['isFrontPage'] = true;
    return $data;
  }


  if ($totalPaths === 1) {
    $post = get_page_by_path($url[0]);
    $post = $post ? $post : get_page_by_path($url[0], 'OBJECT', 'post');

    if ($post) {
      return [
        'type' => 'page',
        'data' => add_single_post_data($post),
        'page_title' => $post->post_title
      ];
    }

    if (post_type_exists($url[0])) {
      return get_archive_data($url[0], $paged);
    }

    return false;
  }




  if ($totalPaths === 2) {
    global $wp_taxonomies;
    $taxId = preg_replace("/[-]{1}/", "_", $url[0]);

    $tax = get_from_array($wp_taxonomies, $taxId);

    if ($tax) {
      $taxName = $tax->name;
      $term = get_term_by('slug', $url[1], $taxName);

      if (!$term) return false;

      $posts = get_posts([
        'post_type' => 'any',
        'numberposts' => $perPage,
        'paged' => $paged,
        $taxName => $term->slug
      ]);

      foreach ($posts as &$post) {
        $post = add_single_post_data($post);
      }

      return [
        'type' => 'term',
        'taxonomy' => $tax,
        'term' => $term,
        'page_title' => $term->name,
        'posts' => $posts
      ];
    }


    $post = get_page_by_path($url[1], 'OBJECT', $url[0]);

    if ($post) {
      return [
        'type' => 'page',
        'data' => add_single_post_data($post),
        'page_title' => $post->post_title
      ];
    }

    return false;
  }
}






function get_single_post_data($id)
{
  $data = get_post($id);
  $data = add_single_post_data($data);
  return [
    'type' => 'page',
    'data' => $data,
    'page_title' => $data->post_title
  ];
}





function add_single_post_data(&$post)
{

  $post->thumb = get_the_post_thumbnail_url($post->ID);
  $post->permalink = get_permalink($post->ID);

  $post->template = false;
  $post->fields = false;

  $fields = get_fields($post->ID);
  if (!is_array($fields)) return $post;

  if (isset($fields['page_block_template'])) {
    if (is_array($fields['page_block_template'])) {
      $post->template = get_page_template($fields['page_block_template']);
      unset($fields['page_block_template']);
    }
  }

  $post->fields = $fields;

  return $post;
}






function get_archive_data($slug, $paged = 1)
{
  $perPage = get_option('posts_per_page');

  $posts = get_posts([
    'post_type' => $slug,
    'numberposts' => $perPage,
    'paged' => $paged
  ]);

  if (!count($posts)) return false;

  $data = get_post_type_object($slug);

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








function get_page_template($template)
{
  // $template = get_field('page_block_template', $id);
  // if (!is_array($template)) return false;

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
