<?php
require '../components/header.php';

//check login status
if(!isset($_SESSION['user-id']))
{
    header('location: ' . ROOT_URL . 'login.php');
}
?>
