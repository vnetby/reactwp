<?php



function write_log($name, $type, $content)
{
  $path = CURRENT_PATH . 'logs';
  if (!file_exists($path)) mkdir($path);

  $file = $path . '/' . $name . '.log';

  if (file_exists($file)) {
    $size = filesize($file);
    if ((int) $size >= (int) MAX_LOG_SIZE) {
      unlink($file);
    }
  }

  $data = date('d-m-Y H:m:i');
  $content = strtoupper($type) . ' ' . $data . ' - ' . $content . "\r\n";

  file_put_contents($file, $content, FILE_APPEND);
}







function _debug($var, $name = '__DEBUG__')
{
  $path = CURRENT_PATH . 'debug';
  if (!file_exists($path)) mkdir($path);
  $file = $path . '/' . $name;

  ob_start();
  print_r($var);
  $res = ob_get_clean();

  file_put_contents($file, $res);
}





function _echo($item)
{
  if (gettype($item) === 'array' || gettype($item) === 'object') {

    if (gettype($item) === 'array') echo 'Array:<br><br>';

    if (gettype($item) === 'object') echo 'Object:<br><br>';

    foreach ($item as $key => $str) {
      echo $key . ' => ';
      print_r($str);
      echo '<hr>';
    }
    return;
  }
  print_r($item);
  echo '<hr>';
}





function strip_text($post, $num)
{
  if ($num > 0) {
    $post = strip_tags($post);
    $ex_post = explode(' ', $post);
    if (count($ex_post) > $num) {
      $max = $num;
    } else {
      $max = count($ex_post);
    }
    $res = '';
    for ($i = 0; $i < $max; $i++) {
      $res .= $ex_post[$i] . ' ';
    }
    if ($max === $num) {
      return $res . '...';
    } else {
      return $res;
    }
  } else {
    return $post;
  }
}








function random_str($length = 10)
{
  $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $charactersLength = strlen($characters);
  $randomString = '';
  for ($i = 0; $i < $length; $i++) {
    $randomString .= $characters[rand(0, $charactersLength - 1)];
  }
  return $randomString;
}






function vn_translit($s)
{
  $s = (string) $s; // преобразуем в строковое значение
  $s = strip_tags($s); // убираем HTML-теги
  $s = str_replace(array("\n", "\r"), " ", $s); // убираем перевод каретки
  $s = preg_replace("/\s+/", ' ', $s); // удаляем повторяющие пробелы
  $s = trim($s); // убираем пробелы в начале и конце строки
  $s = function_exists('mb_strtolower') ? mb_strtolower($s) : strtolower($s); // переводим строку в нижний регистр (иногда надо задать локаль)
  $s = strtr($s, array('а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'e', 'ж' => 'j', 'з' => 'z', 'и' => 'i', 'й' => 'y', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c', 'ч' => 'ch', 'ш' => 'sh', 'щ' => 'shch', 'ы' => 'y', 'э' => 'e', 'ю' => 'yu', 'я' => 'ya', 'ъ' => '', 'ь' => ''));
  $s = preg_replace("/[^0-9a-z-_ ]/i", "", $s); // очищаем строку от недопустимых символов
  $s = str_replace(" ", "-", $s); // заменяем пробелы знаком минус
  return $s; // возвращаем результат
}






function print_filters_for($hook = '')
{
  global $wp_filter;
  if (empty($hook) || !isset($wp_filter[$hook]))
    return;
  print '<pre>';
  print_r($wp_filter[$hook]);
  print '</pre>';
}








function hr($str = '')
{
  print_r($str);
  echo '<hr>';
}

function pre($str = '')
{
  echo '<pre class="php-code-display">';
?>
  <style>
    .php-code-display {
      background-color: #4d535c;
      color: #fff;
      overflow: auto;
    }
  </style>
<?php
  print_r($str);
  echo '</pre>';
}

function br()
{
  echo '<br>';
}

function rn()
{
  echo "\r\n";
}





function array_shift_before(&$arr, $beforeIndex, $val)
{
  $before = array_slice($arr, 0, $beforeIndex);
  $after  = array_slice($arr, $beforeIndex);
  array_push($before, $val);
  $arr = array_merge($before, $after);
}





function alert(&$var)
{
  $id = random_str();
?>
  <div id="<?= $id; ?>">
    <?php
    print_r($var);
    ?>
  </div>
  <script>
    let div = document.querySelector('#' + '<?= $id; ?>');
    alert(div.textContent);
  </script>
  <?php
}






function strip_tag($str, $tag)
{
  $str = preg_replace("/<[\w]*" . $tag . "[^>]*>/", '', $str);
  $str = preg_replace("/<[\w]*\/[\w]*" . $tag . "[\w]*>/", '', $str);
  return $str;
}



function strip_editor($str = false)
{
  if (!$str) return false;
  $str = preg_replace("/<[\w]*p[^>]*>/", '', $str);
  $str = preg_replace("/<[\w]*\/[\w]*p[\w]*>/", '<br>', $str);
  $str = preg_replace("/(<br>)(?!.*\1)/su", '', $str);
  return $str;
}





function get_acf_img_src($img = false)
{
  if (!$img) return false;
  if (is_string($img)) return $img;
  if (is_array($img)) {
    if (isset($img['url'])) return $img['url'];
  }
  return false;
}



function vnet_get_template($name)
{
  $path = CURRENT_PATH . 'template-parts/' . $name . '.php';
  if (!file_exists($path)) {
  ?>
    <span style="color: brown; font-weight: bold">[template]</span><?= $path; ?><span style="color: brown; font-weight: bold">[/template]</span>
  <?php
    return;
  }
  require($path);
}



function vnet_get_sub_template($templateName, $partName)
{
  $path = CURRENT_PATH . 'template-parts/' . $templateName . '/' . $partName . '.php';
  if (!file_exists($path)) {
  ?>
    <span style="color: brown; font-weight: bold">[sub_template]</span><?= $path; ?><span style="color: brown; font-weight: bold">[/sub_template]</span>
  <?php
    return;
  }
  require($path);
}

function the_img_by_id($id, $size = 'medium')
{
  ob_start();
  ?>
  <img src="<?php echo wp_get_attachment_image_url($id, $size) ?>" srcset="<?php echo wp_get_attachment_image_srcset($id, $size) ?>" sizes="<?php echo wp_get_attachment_image_sizes($id, $size) ?>">
<?php
  return ob_get_clean();
}








function replace_textares_tags($content = '')
{
  $regex = [
    ["/\[[\s]*b[\s]*\](.*?)\[[\s]*\/[\s]*b[\s]*\]/su", "<span class='tag-b'>$1</span>"]
  ];

  foreach ($regex as &$reg) {
    $content = preg_replace($reg[0], $reg[1], $content);
  }

  return $content;
}




function get_from_object(&$obj, $key, $def = false, $callback = false, $callBackArgs = false)
{
  if (!is_object($obj)) return $def;
  if (!property_exists($obj, $key)) return $def;
  if (!$obj->$key) return $def;
  if (!$callback) return $obj->$key;
  return call_user_func($callback, $obj->$key, $callBackArgs);
}

function get_from_array(&$arr = false, $key, $def = false, $callback = false, $callBackArgs = false)
{
  if (!is_array($arr)) return $def;
  if (!isset($arr[$key])) return $def;
  if (!$arr[$key]) return $def;
  if (!$callback) return $arr[$key];
  return call_user_func($callback, $arr[$key], $callBackArgs);
}


function get_array_from_array(&$arr, $key, $def = false)
{
  return get_from_array($arr, $key, $def, function ($item) {
    return is_array($item) ? $item : false;
  });
}


function get_srcset_from_array(&$arr, $key, $size = 'medium', $def = false)
{
  return get_from_array($arr, $key, $def, function ($imgId, $size) {
    return the_img_by_id($imgId, $size);
  }, $size);
}
