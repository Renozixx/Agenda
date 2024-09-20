<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html> -->
<?php
require_once "./database/database.php";

$db = new Database();
$db->connect();
foreach ($db->connect() as $key => $value) {
    echo $key.": ".$value."<br>";
}