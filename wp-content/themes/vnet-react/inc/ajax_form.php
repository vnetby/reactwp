<?php
add_action('wp_ajax_ajax_form', 'vnet_ajax_form');
add_action('wp_ajax_nopriv_ajax_form', 'vnet_ajax_form');


function vnet_ajax_form()
{
  $fn = $_GET['fn'];
  $fn = 'af_' . $fn;
  if (!function_exists($fn)) {
    echo $fn;
    exit;
  }
  call_user_func($fn);
}








function af_back_request()
{
  $catLabels = [
    'diler' => 'Связаться с дилером',
    'credit' => 'Кредит',
    'leasing' => 'Лизинг',
    'trade_in' => 'Trade-in',
    'test_drive' => 'Тест-драйв'
  ];

  $cat = get_from_array($_POST, 'category');
  $email = get_from_array($_POST, 'userEmail');
  $name = get_from_array($_POST, 'userName');
  $phone = get_from_array($_POST, 'userPhone');
  $dilerId = get_from_array($_POST, 'dilerId');

  $model = get_from_array($_POST, 'model');
  $model = $model ? (int) $model : 0;

  $userInfo = get_from_array($_POST, 'userInfo');

  $modal = get_field('modal_back_request', (int) $dilerId);


  $adminEmails = get_array_from_array($modal, 'emails');
  $testModels = get_array_from_array($modal, 'test_drive_models');

  $html = '<h2>Заявка с сайта</h2>';

  $html .= the_contact_mail_form('Категория', $catLabels[$cat]);
  $html .= the_contact_mail_form('ФИО', $name);
  $html .= the_contact_mail_form('Телефон', $phone);
  $html .= the_contact_mail_form('E-mail', $email);

  if ($model === 'test_drive') {
    $html .= the_contact_mail_form('Модель', $testModels[$model]['model']);
  }

  $html .= '<hr>';

  $html .= $userInfo;

  $adminEmail = $adminEmails[$cat];

  $headers = [
    'From: Автодилеры <' . FROM_EMAIL . '>',
    'content-type: text/html'
  ];

  $subject = 'Заявка с сайта';

  $res = wp_mail($adminEmail, $subject, $html, $headers);

  if (!$res) {
    write_log('send_email', 'FATAL', 'can not send email @from ' . $email . ' @to ' . $adminEmail . ';');
  } else {
    write_log('send_email', 'SUCCESS', 'email has been sended @from ' . $email . ' @to ' . $adminEmail . ';');
  }

  _af_response(['msg' => _af_msg('request_is_sended'), 'cleareInputs' => true], 'success');
}







/**
 * @param type string error/success
 * @param sets array response settings
 * @param sets string key of message:
 * 
 * - fill_all_fields
 * - some_wrong
 * - wrong_login
 * - email_exist
 * - user_exist
 * - invalid_username_chars
 * - tmp_login_error_pass
 * - lat_and_num_cars
 * - error_format_email
 * - dates_updated
 * - tmp_login_reseted
 * - request_is_sended
 *
 * @return null output json response and exit
 */

function _af_response($sets, $type = 'error')
{
  $res = is_array($sets) ? $sets : [];
  if (is_string($sets)) $res['msg'] = _af_msg($sets);

  $res['type'] = $type;
  echo json_encode($res);
  exit;
}




/**
 * @param key string key of message:
 * 
 * - fill_all_fields
 * - some_wrong
 * - wrong_login
 * - email_exist
 * - user_exist
 * - invalid_username_chars
 * - tmp_login_error_pass
 * - lat_and_num_cars
 * - error_format_email
 * - dates_updated
 * - tmp_login_reseted
 * - request_is_sended
 *
 * @return string
 */

function _af_msg($key)
{
  $msg = [
    'fill_all_fields' => 'Заполните все поля',

    'some_wrong' => 'Что-то пошло не так, повторите попытку',

    'wrong_login' => 'Ошибка. Проверьте правильность введенных данных',

    'email_exist' => 'Пользователь с таким e-mail уже зарегестрирован',

    'user_exist' => 'Пользователь с таким именем уже зарегестрирован',

    'invalid_username_chars' => 'Имя пользователя может содержать латинские символы и цифры',

    'success_register' => 'На Ваш адрес электронной почты был отправлен e-mail с дальнейшими инструкциями для регистрации',

    'tmp_login_error_pass' => '
    В системе обнаружена Ваша заявка на регистрацию, но введенный Вами пароль не верный. 
    <br>Вы можете повторить регистрацию перейдя та страницу регистрации',

    'dates_saved' => 'Данные успешно сохранены',

    'password_compare' => 'Пароли не совпадают',

    'lat_and_num_chars' => 'Допустимы только латинские символы и цифры',

    'error_format_email' => 'Не верный ормат e-mail',

    'dates_updated' => 'Данные успешно обновлены',

    'tmp_login_just_send' => 'На данный e-mail уже выслана инструкция для регистрации. 
    <br><a href="#" class="send-register-instruction">Выслать инструкцию заново.</a>',

    'tmp_login_reseted' => 'Инструкция для регистрации успешно выслана',

    'request_is_sended' => 'Ваша заявка успешно отправлена'
  ];

  return isset($msg[$key]) ? $msg[$key] : $key;
}
