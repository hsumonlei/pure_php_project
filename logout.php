//need to destroy session VALUES

<?php
session_start();

session_destroy();

header('Location: login.php');