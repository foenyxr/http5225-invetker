<?php
header('Content-type: application/json');
session_start();

require_once(__DIR__ . '/../../database/index.php');

$data = [
  "errors" => [],
];

$required = ['email', 'password'];

foreach ($required as $field) {
  if (!isset($_POST[$field]) || !$_POST[$field]) {
    array_push($data['errors'], $field . ' is required.');
  }
}

if (!count($data['errors'])) {
  $sql = "SELECT id, name, password, role FROM users WHERE email = ?";
  $stmt = mysqli_prepare($connect, $sql);

  mysqli_stmt_bind_param($stmt, "s", $_POST['email']);
  mysqli_stmt_execute($stmt);

  $result = mysqli_stmt_get_result($stmt);
  $row = mysqli_fetch_assoc($result);

  if (!$row || !password_verify($_POST['password'], $row['password'])) {
    array_push($data['errors'], 'Invalid email or password.');
  } else {
    $_SESSION["user"] = [
      "id" => $row["id"],
      "name" => $row["name"],
      "email" => $_POST['email'],
      "role" => $row["role"]
    ];
  }
}

if (count($data['errors'])) {
  http_response_code(400);
}

echo json_encode($data);

?>