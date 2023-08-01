<?php

// REQUIRE IMPORTANT FILES
require_once '../config/db.php';
require_once '../models/users.php';

//INITIALIZE DATABASE
$db = new Database();
$db = $db->connect();

//INITIALIZE USER MODEL
$user = new User($db);


?>