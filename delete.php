<?php
require 'config.php';

print_r($_GET['id']);
$pdo_statement =$pdo->prepare("DELETE FROM posts WHERE id=".$_GET['id']);
$pdo_statement->execute();

header('Location: index.php');
?>



