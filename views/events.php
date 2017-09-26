<?php include_once 'layouts/main/header.php' ?>
<?php
include_once 'models/event.php';

try {
    // Open DB connection
    $db = new PDO('sqlite:.events.sqlite');

    // Fetch data from database using SQL
    $sql = 'SELECT * FROM events ORDER BY :order_column';
    $statement = $db->prepare($sql);
    $statement->execute(array(':order_column' => 'start-time'));
    var_dump($statement->fetchAll(PDO::FETCH_CLASS, 'Event'));

    // Close DB connection
    $db = null;
} catch (PDOException $e) {
    header('HTTP/1.1 500 Internal Server Error');
    print 'Exception : '.$e->getMessage();    
}
?>
<?php include_once 'layouts/main/footer.php' ?>