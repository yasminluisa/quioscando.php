<?php
$host = 'localhost';
$db = 'quioscando';
$user = 'root';
$pass = '38286680yas.';

$conn = new mysqli($host, $user, $pass, $db);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>
