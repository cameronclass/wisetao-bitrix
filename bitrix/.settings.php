<?php
return array(
  'session' => array(
    'value' =>
      array(
        'mode' => 'default',
        'expire' => 7200,
      ),
    'readonly' => true,
  ),
  'utf_mode' =>
    array(
      'value' => true,
      'readonly' => true,
    ),
  'cache_flags' =>
    array(
      'value' =>
        array(
          'config_options' => 3600,
          'site_domain' => 3600,
        ),
      'readonly' => false,
    ),
  'cookies' =>
    array(
      'value' =>
        array(
          'secure' => false,
          'http_only' => true,
        ),
      'readonly' => false,
    ),
  'exception_handling' =>
    array(
      'value' =>
        array(
          'debug' => false,
          'handled_errors_types' => 4437,
          'exception_errors_types' => 4437,
          'ignore_silence' => false,
          'assertion_throws_exception' => true,
          'assertion_error_type' => 256,
          'log' => NULL,
        ),
      'readonly' => false,
    ),
  'connections' =>
    array(
      'value' =>
        array(
          'default' =>
            array(
              'className' => '\\Bitrix\\Main\\DB\\MysqliConnection',
              'host' => 'localhost',
              'database' => 'bitrix_local',
              'login' => 'root',
              'password' => '',
              'options' => 2,
            ),

        ),
      'readonly' => true,
    ),
  'smtp' =>
    array(
      'value' =>
        array(
          'enabled' => true,
          'debug' => false,
          'log_file' => '/var/mailer.log',
        ),
    ),
);