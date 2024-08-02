<?php

print_r($_POST);

require_once(__DIR__ . '/../../shared/isLoggedin.php');
require_once(__DIR__ . '/../../database/index.php');

$data = [ "errors" => [] ];

$requiredFields = ['ticker', 'quantity', 'action', 'price', 'fee', 'datetime'];

foreach ($requiredFields as $field) {
  if (empty($_POST[$field])) {
    $data['errors'][] = $field . ' is required.';
  }
}

if (!count($data['errors'])) {
  $userId = $_SESSION['user']['id']; 
  $note = $_POST['note'] ?? '';

  $sql = "INSERT INTO transactions 
            (userId, ticker, quantity, action, price, fee, datetime, note) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($connect, $sql);
    mysqli_stmt_bind_param($stmt, "ssssssss", $userId, $_POST['ticker'], $_POST['quantity'], $_POST['action'], $_POST['price'], $_POST['fee'], $_POST['datetime'], $note);

    if (!mysqli_stmt_execute($stmt)) {
        $data['errors'][] = mysqli_stmt_error($stmt);
    }
}

if (count($data['errors'])) {
  http_response_code(400);
}

echo json_encode($data);

?>