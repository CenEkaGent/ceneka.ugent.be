<?php include_once 'layouts/main/header.php'?>
<?php
try {
    // Open DB connection
    $db = new PDO('sqlite:.events.sqlite');

    // Fetch data from database using SQL
    $sql = 'SELECT * FROM events';
    $statement = $db->query($sql);
    var_dump($statement->fetchAll());

    // Close DB connection
    $db = null;
} catch (PDOException $e) {
    header('HTTP/1.1 500 Internal Server Error');
    print 'Exception : '.$e->getMessage();    
}
?>
<?php include_once 'layouts/main/footer.php' ?>