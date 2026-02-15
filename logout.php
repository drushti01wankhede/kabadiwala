<?php
require_once 'auth.php';

logoutUser();
$_SESSION['success'] = 'Logged out successfully';
header('Location: index.php');
exit();
?>
