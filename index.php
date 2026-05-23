<?php
$base = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
$baseHref = $base === '' ? '' : $base;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="<?= $baseHref === '' ? '/' : $baseHref . '/' ?>">

    <!-- tailwind css -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Koulen&family=Siemreap&display=swap" rel="stylesheet">

    <!-- flowbite css -->
    <link href="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.css" rel="stylesheet" />
    <!-- flowbite script -->
    <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>

    <!-- boostrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">


    <style>
        .koulen-regular {
            font-family: "Koulen", sans-serif;
            font-weight: 400;
            font-style: normal;
        }

        .siemreap-regular {
            font-family: "Siemreap", sans-serif;
            font-weight: 400;
            font-style: normal;
        }
    </style>
</head>
<body class="bg-slate-50">
    <?php
    require "src/components/navbar.php";
    require "src/pages/all.php";
    require "src/pages/detail.php";
    require "Router.php";
    require "src/components/footer.php";
    require "src/pages/search.php";


    $router = new Router;

    renderNavbar($_SERVER['REQUEST_URI']);

    $router->add('/', function() use ($baseHref) {
        // renderHome($baseHref);
        require "src/pages/home.php";
    });

    $router->add('/all/{category}', function($category) use ($baseHref) {
        renderAll($category, $baseHref);
    });

    $router->add('/detail/{id}', function($id) use ($baseHref) {
        renderDetail($id);
    });

    $router->add('/search?search=', function() use ($baseHref) {
        renderSearchPage();
    });


    $router->dispatch($_SERVER['REQUEST_URI']);

    renderFooter();
    ?>

    
</body>
</html>