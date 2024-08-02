<?php
header('Content-type: application/json');
require_once(__DIR__ . '/../../shared/isLoggedin.php');
require_once(__DIR__ . '/../../database/index.php');

$data = ["errors" => []];

$required = ['id'];

foreach ($required as $field) {
  if (!isset($_GET[$field]) || !$_GET[$field]) {
    array_push($data['errors'], $field . ' is required.');
  }
}

if (!count($data['errors'])) {
  $sql = "SELECT * FROM transactions WHERE id = ? AND userId = ?;";
  $stmt = mysqli_prepare($connect, $sql);

  mysqli_stmt_bind_param(
    $stmt,
    "ss",
    $_GET['id'],
    $_SESSION['user']['id']
  );
  mysqli_stmt_execute($stmt);

  $result = mysqli_stmt_get_result($stmt);
  $row = mysqli_fetch_assoc($result);

  if (!$row) {
    http_response_code(404);
  } else {
    $data['data'] = $row;
  }
}

if (count($data['errors'])) {
  http_response_code(400);
}

echo json_encode($data);

?>