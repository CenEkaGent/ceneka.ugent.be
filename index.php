<?php

$path = ltrim($_SERVER['REQUEST_URI'], '/');
$path = rtrim($path, '/');
$elements = explode('/', $path);

if (empty($elements[0])) {
    include 'views/home.php';
} else if (sizeof($elements) == 1) {
    switch (array_shift($elements)) {
        case 'about':
            $descriptor = 'About';
            include 'views/contact.php';
            break;
        case 'bestuur':
            $descriptor = 'Bestuur';
            include 'views/bestuur.php';
            break;
        case 'companies':
            $descriptor = 'Companies';
            include 'views/companies.php';
            break;
        case 'applications':
            $descriptor = 'Aanbiedingen';
            include 'views/applications.php';
            break;
        case 'events':
            $descriptor = 'Evenementen';
            include 'views/events.php';
            break;
        default:
            $descriptor = "404 Not Found";
            header('HTTP/1.1 404 Not Found');
            include 'views/404.php';
    }
} else {
    $descriptor = "404 Not Found";
    header('HTTP/1.1 404 Not Found');
    include 'views/404.php';
}

?>