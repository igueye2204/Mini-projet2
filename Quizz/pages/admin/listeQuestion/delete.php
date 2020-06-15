<?php
require 'Quizz/data/databaseQuiz.php';
$connection = Database::connect();
$id = $_GET['id'];
$sql = 'DELETE FROM tabquestion WHERE id=:id';
$statement = $connection->prepare($sql);
if ($statement->execute([':id' => $id])) {
  header("Location: /");
}