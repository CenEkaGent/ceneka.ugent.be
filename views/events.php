<?php
// Neccessary for the redirect in case of error
ob_start();
include_once 'layouts/main/header.php';
?>

<?php
// Include Event model for easier access
include_once 'models/event.php';

$handle = fopen(".secret", "r");
if ($handle){
    if(($username = fgets($handle)) == false){
        exit(header("Location: /500/"));
    }
    if(($password = fgets($handle)) == false){
        exit(header("Location: /500/"));
    }
    $username=str_replace("\n","",$username);
    $password=str_replace("\n","",$password);
}
try {
    $host = "localhost";
    $db = "ceneka";
    // Open DB connection
    $db = new PDO('mysql:dbname=ceneka;host=localhost',$username, $password);
    
    // Fetch data from database using SQL
    $sql = 'SELECT * FROM events WHERE endTime > :currentTime ORDER BY :orderColumn';
    $statement = $db->prepare($sql);
    if (!$statement)
        throw new Exception("Database error.");
    $statement->execute(array(':orderColumn' => 'startTime', ':currentTime' => date('Y-m-d H:i:s')));
    $futureEvents = $statement->fetchAll(PDO::FETCH_CLASS, 'Event');

    $sql = 'SELECT * FROM events WHERE endTime <= :currentTime ORDER BY :orderColumn';
    $statement = $db->prepare($sql);
    if (!$statement)
        throw new Exception("Database error.");
    $statement->execute(array(':orderColumn' => 'startTime', ':currentTime' => date('Y-m-d H:i:s')));
    $pastEvents = $statement->fetchAll(PDO::FETCH_CLASS, 'Event');
    // Close DB connection
    $db = null;
} catch (Exception $e) {
    echo $e->getTraceAsString();
    //exit(header("Location: /500/"));
}

$classes = ["", " ceneka-red", " ceneka-grey", ""];

?>

<div id="events">
    <div class="columns">
        <div class="column is-2 is-narrow">
            <aside class="menu">
                <p class="menu-label">Academiejaar</p>
                <ul class="menu-list">
                    <li>
                        <a href="" class="is-active">'17 - '18</a>
                    </li>
                </ul>
            </aside>
        </div>
        <div class="column">
            <?php
            if (!empty($futureEvents)) {
            ?>
            <div class="content"><h1>Toekomstige evenementen</h1></div>
            <?php
            }
            for ($i = 0; $i < sizeof($futureEvents); $i++) {
                $event = $futureEvents[$i];
                if ($i % 3 == 0) {
                    ?><div class="tile is-ancestor"><?php
                }
                ?>
                <div class="tile is-parent">
                    <div class="tile is-child box<?php print $classes[$i % 4]; ?>" onclick="location.href='/events/<?php print $event->shortName; ?>'" style="cursor: pointer;">
                        <article class="content">
                            <h1 class="title"><?php print $event->name; ?></h1>
                            <p class="subtitle"><?php print $event->description; ?></p>
                            <p><?php print $event->teaser; ?></p>
                        </article>
                    </div>
                </div>
                <?php
                if ($i % 3 == 2) {
                    ?></div><?php
                }
            }
            if (sizeof($futureEvents) % 3 != 0) {
                print "</div>";
            }
            if (!empty($pastEvents)) {
            ?>
            <div class="content"><h1>Verleden evenementen</h1></div>
            <?php
            }
            for ($i = 0; $i < sizeof($pastEvents); $i++) {
                $event = $pastEvents[$i];
                if ($i % 3 == 0) {
                    ?><div class="tile is-ancestor"><?php
                }
                ?>
                <div class="tile is-parent">
                    <div class="tile is-child box<?php print $classes[$i % 4]; ?>" onclick="location.href='/events/<?php print $event->shortName; ?>'" style="cursor: pointer;">
                        <article class="content">
                            <h1 class="title"><?php print $event->name; ?></h1>
                            <p class="subtitle"><?php print $event->description; ?></p>
                            <p><?php print $event->teaser; ?></p>
                        </article>
                    </div>
                </div>
                <?php
                if ($i % 3 == 2) {
                    ?></div><?php
                }
            }
            if (sizeof($pastEvents) % 3 != 0) {
                print "</div>";
            }
            ?>
        </div>
    </div>
</div>

<?php include_once 'layouts/main/footer.php' ?>
