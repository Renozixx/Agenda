<?php
var_dump($_POST);
require_once "./autoloader.php";
use app\Controllers\MonthController;
$month = new MonthController;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grupo 4A</title>
    <link rel="stylesheet" href="/public/css/index.css">
    <link rel="stylesheet" href="/public/css/site.css">
</head>
<?php require_once "./resources/views/components/headers/header.php"; ?>
<body class="bg-slate-950 text-white">
    <main>
        <div class="content w-max h-full m-auto">
            <?php echo $month->genElements(); ?>
        </div>
    </main>
</body>
</html>