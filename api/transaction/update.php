<?php
header('Content-type: application/json');

require_once(__DIR__ . '/../../shared/isLoggedin.php');
require_once(__DIR__ . '/../../database/index.php');

$data = [
  "errors" => [],
];

$requiredFields = ['quantity', 'action', 'price', 'fee', 'datetime'];

foreach ($requiredFields as $field) {
  if (empty($_POST[$field])) {
      $errors[] = $field . ' is required.';
  }
}

if (empty($errors)) {
  
  $query = "UPDATE transactions SET quantity = ?, action = ?, price = ?, fee = ?, datetime = ? WHERE id = ? AND userId = ?;";
  $stmt = mysqli_prepare($connect, $query);

  mysqli_stmt_bind_param($stmt, 'sssssss', $_POST['quantity'], $_POST['action'], $_POST['price'], $_POST['fee'], $_POST['datetime'], $_GET['id'], $_SESSION['user']['id']);

  if (!mysqli_stmt_execute($stmt)) {
      $errors[] = mysqli_stmt_error($stmt);
  }
}

if (count($data['errors'])) {
  http_response_code(400);
}

echo json_encode($data);

?>