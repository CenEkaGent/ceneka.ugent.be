<?php
// Neccessary for the redirect in case of error
ob_start();
include_once 'layouts/main/header.php';
?>

<?php
// Include Event model for easier access
include_once 'models/event.php';

try {
    //Note similiarity with try catch block in home.php, merge into function possible

    //Fetch events newer as current date from DB
    $query = 'SELECT * FROM events WHERE endTime > :currentTime ORDER BY :orderColumn';
    $swap = array(':orderColumn' => 'startTime', ':currentTime' => date('Y-m-d H:i:s'));
    $type = 'Event';
    $futureEvents = getDBObjects($query, $swap, $type);

    //Fetch events older as current date from DB
    $query = 'SELECT * FROM events WHERE endTime < :currentTime ORDER BY endTime DESC';
    $swap = array(':currentTime' => date('Y-m-d H:i:s'));
    $type = 'Event';
    $pastEvents = getDBObjects($query, $swap, $type);

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
