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

  <script>
    window.back_dates = {
      ajaxurl: '<?= admin_url('admin-ajax.php'); ?>',
      src: '<?= CURRENT_SRC; ?>'
    }
  </script>
</head>


<body class="responsive-layout <?= implode(' ', get_body_class()); ?>">
  <script src="<?= CURRENT_SRC; ?>js/head.min.js"></script>
  <div id="app"></div>