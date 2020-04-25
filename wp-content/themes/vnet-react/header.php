<!DOCTYPE html>
<html lang="<?= LANG; ?>">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <?php
  wp_head();
  ?>
  <link rel="stylesheet" href="<?= CURRENT_SRC; ?>css/head.min.css">
  <link rel="stylesheet" href="<?= CURRENT_SRC; ?>assets/assets.min.css">
  <link rel="stylesheet" href="<?= CURRENT_SRC; ?>css/main.min.css">

  <link rel="stylesheet" href="<?= CURRENT_SRC; ?>style.css">
  <?php
  $pageType = false;
  $pageData = false;

  if (is_front_page()) {
    $pageType = 'home';
  } else if (is_single()) {
    $pageType = 'single';
  } else if (is_archive()) {
    $pageType = 'archive';
  } else if (is_page()) {
    $pageType = 'page';
  }

  if ($pageType === 'home' || $pageType === 'page')

  ?>
  <script>
    window.back_dates = '<?= file_get_contents(rest_url()); ?>';
  </script>
</head>


<body class="responsive-layout <?= implode(' ', get_body_class()); ?>">
  <script src="<?= CURRENT_SRC; ?>js/head.min.js"></script>
  <div id="app"></div>
  <?php
  pre($pageType);
  ?>