<?php
include "./functions/classAutoLoader.php";
spl_autoload_register('classAutoLoader');
?>
<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="utf-8" />
    <title>CESI AP - Blog/e-commerce</title>
    <link rel="stylesheet" href="./assets/css/style.css" />
</head>
<body>
<div id="container">

<?php
include "./includes/header.php";

$test = new Queries();
var_dump($test);


$page = $_GET['page'] ?? "";
$page = "./includes/" . $page . ".inc.php";

$files = glob("./includes/*.inc.php");

if (in_array($page, $files))
    include $page;
else
    include "./includes/home.inc.php";



include "./includes/footer.php";
?>
</div>
</body>
</html>
