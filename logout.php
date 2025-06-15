<?php 
require 'config/consts.php';

//destroy all sesstion
session_destroy();
header('location: ' . ROOT_URL);
die();