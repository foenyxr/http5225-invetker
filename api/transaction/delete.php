<?php

header('Content-type: application/json');

include '../../shared/isLoggedin.php';
include '../../database/index.php';

$data = [ "errors" => [] ];

$requiredFields = ['id'];

foreach ($requiredFields as $field) {
  if (empty($_GET[$field])) {
      $data['errors'][] = $field. ' is required.';
  }
}

if (empty($data['errors'])) {
  $userId = $_SESSION['user']['id']; 

  
  $query = "DELETE FROM transactions WHERE id = ? AND userId = ?;";
  $stmt = mysqli_prepare($connect, $query);
  mysqli_stmt_bind_param($stmt, "ss", $_GET['id'], $userId);

  if (!mysqli_stmt_execute($stmt)) {
      $data['errors'][] = mysqli_stmt_error($stmt);
  }
}

if (count($data['errors'])) {
  http_response_code(400);
}

echo json_encode($data);

?>