<?php



add_action('init', 'vnet_register_post_types');



function vnet_register_post_types()
{
  register_post_type('articles', [
    'labels' => [
      'name'               => 'Статьи',
      'singular_name'      => 'Статья',
      'add_new'            => 'Написать статью',
      'add_new_item'       => 'Написать новую статью',
      'edit_item'          => 'Редактировать статью',
      'new_item'           => 'Новая статья',
      'view_item'          => 'Открыть статью',
      'search_items'       => 'Поиск',
      'not_found'          => 'Не найдено',
      'not_found_in_trash' => 'Не найдено',
      'parent_item_colon'  => '',
      'menu_name'          => 'Статьи'
    ],
    'description'           => '',
    'public'                => true,
    'publicly_queryable'    => true,
    'exclude_from_searc'    => false,
    'show_u'                => true,
    'show_in_menu'          => true,
    'show_in_admin_bar'     => true,
    'show_in_nav_menus'     => true,
    'show_in_res'           => true,
    // 'rest_base'             => 'articles',
    'rest_controller_class' => 'WP_REST_Posts_Controller',
    'menu_position'         => 21,
    'menu_icon'             => 'dashicons-media-spreadsheet',
    'capability_type'       => 'post',
    'map_meta_cap'          => true,
    'hierarchica'           => false,
    'supports'              => ['title', 'editor', 'author', 'thumbnail', 'custom-fields', 'comments', 'page-attributes'],
    'taxonomies'            => ['art_cat'],
    'has_archive'           => true,
    'rewrite'               => true,
    'can_export'            => true,
    'delete_with_use'       => false,
    'query_var'             => true,
    '_builtin'              => false,
    '_edit_link'            => 'post.php?post=%d'
  ]);


  register_post_type('the_blocks', [
    'labels' => [
      'name'              => 'Блоки',
      'singular_name'     => 'Блоки',
      'edit_item'         => 'Редактировать блоки',
      'parent_item_colon' => '',
      'menu_name'         => 'Блоки'
    ],
    'description'           => '',
    'public'                => true,
    'publicly_queryable'    => true,
    'exclude_from_search'   => false,
    'show_u'                => false,
    'show_in_menu'          => false,
    'show_in_menu'       => true,
    // 'show_in_menu'       => 'the_blocks_page',
    // 'show_in_admin_bar'  => false,
    'show_in_nav_menus'     => true,
    'show_in_res'           => true,
    'rest_base'             => 'the_blocks',
    'rest_controller_class' => 'WP_REST_Posts_Controller',
    'menu_position'         => 21,
    'menu_icon'             => 'dashicons-align-left',
    'capability_type'       => 'post',
    'map_meta_cap'          => true,
    'hierarchica'           => false,
    'supports'              => [],
    // 'capabilities'          => ['create_posts' => 'do_not_allow'],
    // 'taxonomies'         => ['news_cat'],
    'has_archive'           => true,
    'rewrite'               => true,
    'can_export'            => true,
    'delete_with_use'       => false,
    'query_var'             => false,
    // 'query_var'             => '/?{query_var_string}={post_slug}',
    '_builtin'              => false,
    '_edit_link'            => 'post.php?post=%d'
  ]);



  register_post_type('about_company', [
    'labels' => [
      'name'              => 'О компании',
      'singular_name'     => 'О компании',
      'edit_item'         => 'Редактировать информацию о компании',
      'parent_item_colon' => '',
      'menu_name'         => 'О компании'
    ],
    'description'           => '',
    'public'                => true,
    'publicly_queryable'    => true,
    'exclude_from_searc'    => false,
    'show_u'                => false,
    'show_in_menu'          => true,
    'show_in_nav_menus'     => true,
    'show_in_res'           => true,
    'rest_base'             => 'about_company',
    'rest_controller_class' => 'WP_REST_Posts_Controller',
    'menu_position'         => 21,
    'menu_icon'             => 'dashicons-building',
    'capability_type'       => 'post',
    'map_meta_cap'          => true,
    'hierarchica'           => false,
    'supports'              => [],
    'capabilities'          => ['create_posts' => 'do_not_allow'],
    'has_archive'           => true,
    'rewrite'               => true,
    'can_export'            => true,
    'delete_with_use'       => false,
    'query_var'             => '/?{query_var_string}={post_slug}',
    '_builtin'              => false,
    '_edit_link'            => 'post.php?post=%d'
  ]);
}
