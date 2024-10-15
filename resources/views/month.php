<?php
require_once "./autoloader.php";
use app\Controllers\MonthController;
use app\Controllers\DatesController;

$datesController = new DatesController();
$month = new MonthController($datesController);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grupo 4A</title>
    <link rel="stylesheet" href="/public/css/index.css">
    <link rel="stylesheet" href="/public/css/site.css">
    <script src="/public/js/index.js"></script>
</head>
<?php require_once "./resources/views/components/headers/header.php"; ?>
<script>
    const redirect = new Redirect();
</script>
<body class="flex flex-col h-screen bg-slate-950 text-white">
    <main class="h-full">
        <div class="content h-full m-auto">
            <?php echo $month->genElement(); ?>
        </div>
    </main>
</body>
</html>