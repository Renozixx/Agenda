<?php
require_once "./autoloader.php";
use app\Controllers\HomePageController;

$homepage = new HomePageController;
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="/public/css/index.css">
    <link rel="stylesheet" href="/public/css/site.css">
    <script src="/public/js/index.js"></script>
</head>
<?php require_once "./resources/views/components/headers/header.php"; ?>
<script>
    const redirect = new Redirect();
</script>
<body class="bg-slate-950 text-white">
    <main>
        <div class="year grid gap-3 w-max p-3 m-auto">
            <?php
                echo $homepage->genElements();
            ?>
        </div>
    </main>
</body>
</html>