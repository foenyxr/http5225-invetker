<?php
session_start();
if (!isset($_SESSION['user']['email']) || empty($_SESSION['user']['email'])) {
  header("Location: ../index.php");
  exit();
}
?>