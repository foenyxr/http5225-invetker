<?php
header('Content-type: application/json');

require_once(__DIR__ . '/../../database/index.php');

$data = [
  "errors" => [],
];

$required = ['name', 'email', 'password', 'confirm-password'];

foreach ($required as $field) {
  if (!isset($_POST[$field]) || !$_POST[$field]) {
    array_push($data['errors'], $field . ' is required.');
  }
}

if (!count($data['errors'])) {
  $sql = "INSERT INTO users (name, email, password) VALUES (?, ? ,?)";
  $stmt = mysqli_prepare($connect, $sql);
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

  try {
    mysqli_stmt_bind_param(
      $stmt,
      "sss",
      $_POST['name'],
      $_POST['email'],
      $password
    );
    if (!mysqli_stmt_execute($stmt)) {
      array_push($data['errors'], mysqli_stmt_error($stmt));
    }
  } catch (mysqli_sql_exception $e) {
    array_push($data['errors'], $e->getMessage());
  }
}

if (count($data['errors'])) {
  http_response_code(400);
}

echo json_encode($data);

?>