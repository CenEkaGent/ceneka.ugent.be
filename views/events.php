<?php include_once 'layouts/main/header.php' ?>
<?php
include_once 'models/event.php';

try {
    // Open DB connection
    $db = new PDO('sqlite:.events.sqlite');

    // Fetch data from database using SQL
    $sql = 'SELECT * FROM events WHERE endTime > :currentTime ORDER BY :orderColumn';
    $statement = $db->prepare($sql);
    $statement->execute(array(':orderColumn' => 'startTime', ':currentTime' => date('Y-m-d H:i:s')));
    var_dump($statement->fetchAll(PDO::FETCH_CLASS, 'Event'));

    // Close DB connection
    $db = null;
} catch (PDOException $e) {
    header('HTTP/1.1 500 Internal Server Error');
    print 'Exception : '.$e->getMessage();    
}
?>
<?php include_once 'layouts/main/footer.php' ?>