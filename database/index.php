<?php
require_once(__DIR__ . '/../env.php');

$connect = mysqli_connect(
  $DB_HOST . ':' . $DB_PORT,
  $DB_USERNAME,
  $DB_PASSWORD,
  $DB_DATABASE
);

if (!$connect) {
  echo 'Connection Failed' . '-' . $DB_DATABASE . '-' . mysqli_connect_error();
  exit;
}
