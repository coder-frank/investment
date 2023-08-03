<?php

// REQUIRE IMPORTANT FILES
require_once './config/db.php';
require_once './models/admin.php';

//INITIALIZE DATABASE
$db = new Database();
$db = $db->connect();

//INITIALIZE USER MODEL
$admin = new Admin($db);


?>