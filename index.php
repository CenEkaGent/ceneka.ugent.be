<?php
// Include Event model for easier access
include_once 'views/models/event.php';

$path = ltrim($_SERVER['REQUEST_URI'], '/');
$path = rtrim($path, '/');
$elements = explode('/', $path);

function go_to_event($elements) {
    if (sizeof($elements) == 1) {
        
        $handle = fopen(".secret", "r");
        if ($handle){
            if(($username = fgets($handle)) == false){
                exit(header("Location: /500/"));
            }
            if(($password = fgets($handle)) == false){
                exit(header("Location: /500/"));
            }
        }
        try {
	    $host = "localhost";
	    $db = "ceneka";
            // Open DB connection
            $db = new PDO('mysql:dbname=ceneka;host=localhost',$username, $password);
	     
            // Fetch data from database using SQL
            $sql = 'SELECT * FROM events WHERE shortName = :shortName';
            $statement = $db->prepare($sql);
            if (!$statement)
                throw new Exception("Database error.");
            $statement->execute(array(':shortName' => $elements[0]));
            $data = $statement->fetchAll(PDO::FETCH_CLASS, 'Event');

            if (sizeof($data) != 1) {
                $descriptor = "404 Not Found";
                header('HTTP/1.1 404 Not Found');
                include 'views/404.php';
            } else {
                $event = $data[0];
                $descriptor = $event->name;
                include 'views/event-page.php';
            }

            // Close DB connection
            $db = null;
        } catch (Exception $e) {
 	    exit(header("Location: /500/"));
        }
    } else {
        $descriptor = "404 Not Found";
        header('HTTP/1.1 404 Not Found');
        include 'views/404.php';
    }
}

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
        case 'statuten':
            $descriptor = 'Statuten';
            include 'views/statuten.php';
            break;
        case 'applications':
            $descriptor = 'Aanbiedingen';
            include 'views/applications.php';
            break;
        case 'events':
            $descriptor = 'Evenementen';
            include 'views/events.php';
            break;
        case '500':
            $descriptor = "500 Internal Server Error";
            header('HTTP/1.1 500 Internal Server Error');
            include 'views/500.php';
            break;
        default:
            $descriptor = "404 Not Found";
            header('HTTP/1.1 404 Not Found');
            include 'views/404.php';
    }
} else if (sizeof($elements) == 2) {
    switch (array_shift($elements)) {
        case 'events':
            go_to_event($elements);
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
