<?php 
require 'config/database.php';
session_destroy();
header('Location:' .ROOT_URL);
die(0);