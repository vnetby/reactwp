<?php





add_action ('init', 'vnet_register_taxonomies');







function vnet_register_taxonomies () {


return;
  register_taxonomy('art_cat', ['articles'], [

		'label'  => 'Тип статьи',

		'labels' => [

			'name'              => 'Категории статей',

			'singular_name'     => 'Категории',

			'search_items'      => 'Найти категорию',

			'all_items'         => 'Все категории',

			'view_item '        => 'Открыть категорию',

			'edit_item'         => 'Изменить категорию',

			'update_item'       => 'Обновить категорию',

			'add_new_item'      => 'Добавить категорию',

			'new_item_name'     => 'Новая категория',

			'menu_name'         => 'Категории',

		],

		'description'             => 'Категории статей',

		'public'                  => true,

    'show_ui'                 => true,

    'show_in_menu'            => 'articles',

    'show_in_nav_menus'       => true,

    'show_tagcloud'           => true,

    'show_in_rest'            => null,

    'rest_base'               => null,

		'publicly_queryable'      => false,

		'hierarchical'            => false,

		'rewrite'                 => true,

		'meta_box_cb'             => 'post_categories_meta_box',

		'show_admin_column'       => true,

		'_builtin'                => false,

		'show_in_quick_edit'      => null,

    'sort'                    => true

	] );

  //

  //

  //

  // register_taxonomy('min_order', ['product'], [

  //   'label'  => 'Минимальный заказ',

  //   'labels' => [

  //     'name'          => 'Минимальный заказ',

  //     'singular_name' => 'Минимальный заказ',

  //     'menu_name'     => 'Минимальный заказ',

  //   ],

  //   'description'             => 'Минимальный заказ',

  //   'public'                  => true,

  //   'show_ui'                 => true,

  //   'show_in_menu'            => false,

  //   'show_in_nav_menus'       => false,

  //   'show_tagcloud'           => true,

  //   'show_in_rest'            => null,

  //   'rest_base'               => null,

  //   'publicly_queryable'      => false,

  //   'hierarchical'            => false,

  //   'rewrite'                 => true,

  //   'meta_box_cb'             => null,

  //   'show_admin_column'       => true,

  //   '_builtin'                => false,

  //   'show_in_quick_edit'      => null,

  //   'sort'                    => true

  // ] );





}

