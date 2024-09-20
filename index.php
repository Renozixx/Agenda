<?php
require_once "./database/database.php";

$db = new Database();
echo $db->openConnection();