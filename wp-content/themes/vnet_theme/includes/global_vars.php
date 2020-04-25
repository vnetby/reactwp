<?php

define('JQUERY', true);


define('LANG', get_locale() === 'en_US' ? 'en' : 'ru');
define('DEF_LANG', 'ru');

define('HIDE_EMPTY', true);

define('THEME_NAME', 'vnet-theme');

define('SRC', '/wp-content/themes/' . 'vnet_theme' . '/');

define('THEME_PATH', ABSPATH . 'wp-content/themes/' . 'vnet_theme' . '/');

define('INCLUDE_PATH', ABSPATH . 'wp-content/themes/' . 'vnet_theme' . '/includes/');


$theme = wp_get_theme();
if (file_exists(ABSPATH . 'wp-content/themes/' . $theme->name)) {
  define('CURRENT_PATH', ABSPATH . 'wp-content/themes/' . $theme->name . '/');
  define('CURRENT_SRC', '/wp-content/themes/' . $theme->name . '/');
} else {
  $l = dirname(__FILE__) . ' => ::' . __LINE__  . ' => theme does not exist';
  pre($theme->name);
  pre($l);
}
