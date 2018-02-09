<?php
// Neccessary for the redirect in case of error
ob_start();
include_once 'layouts/main/header.php';
?>

<?php
// Include Event model for easier access
include_once 'models/event.php';
include_once 'models/application.php';

try {
    $host = "localhost";
    $db = "ceneka";
    // Open DB connection
    $db = new PDO('mysql:dbname=ceneka;host=localhost',$username, $password);
    # $db = new PDO('sqlite:.events.sqlite'); // For development purposes
    /*
    // Fetch next event from database using SQL
    $sql = 'SELECT * FROM events WHERE endTime > :currentTime ORDER BY :orderColumn LIMIT 2';
    $statement = $db->prepare($sql);
    if (!$statement)
        throw new Exception("Database error.");

    $statement->execute(array(':orderColumn' => 'startTime', ':currentTime' => date('Y-m-d H:i:s')));
    //$statement->execute(array(':orderColumn' => 'startTime', ':currentTime' => now()));
    $next_events = $statement->fetchAll(PDO::FETCH_CLASS, 'Event');*/

    $query = 'SELECT * FROM events WHERE endTime > :currentTime ORDER BY :orderColumn LIMIT 2';
    $swap = array(':orderColumn' => 'startTime', ':currentTime' => date('Y-m-d H:i:s'));
    $type = 'Event';
    $next_events = getDBObjects($query, $swap, $type);
     
    // Fetch previous event from database using SQL
    /*$sql = 'SELECT * FROM events WHERE endTime < :currentTime ORDER BY endTime DESC';

    $statement = $db->prepare($sql);
    if (!$statement)
        throw new Exception("Database error.");

    $statement->execute(array(':currentTime' => date('Y-m-d H:i:s')));
    $previous_events = $statement->fetchAll(PDO::FETCH_CLASS, 'Event');*/
    $query = 'SELECT * FROM events WHERE endTime < :currentTime ORDER BY endTime DESC';
    $swap = array(':currentTime' => date('Y-m-d H:i:s'));
    $type = 'Event';
    $previous_events = getDBObjects($query, $swap, $type);

    /*
    // Fetch data from database using SQL
    $sql = 'SELECT * FROM applications ORDER BY :orderColumn';
    $statement = $db->prepare($sql);
    if (!$statement)
        throw new Exception("Database error.");
    $statement->execute(array(':orderColumn' => 'priority'));
    $applications = $statement->fetchAll(PDO::FETCH_CLASS, 'Application');*/

    $query = 'SELECT * FROM applications ORDER BY :orderColumn';
    $swap = array(':orderColumn' => 'priority');
    $type = 'Application';
    $applications = getDBObjects($query, $swap, $type);

    // Display previous event when no future events are present
    if (sizeof($next_events) == 0)
        $next_events = [array_shift($previous_events)];

    // Close DB connection
    $db = null;
} catch (Exception $e) {
    echo $e->getMessage();
    // exit(header("Location: /500/"));
}
?>

<div id="homepage">
    <div class="tile is-vertical is-ancestor">
        <div class="tile is-parent is-12">
            <div id="next-ev" class="tile is-child box columns ceneka-red is-paddingless fixed-height265 event" onclick="location.href='/events/<?php print $next_events[0]->shortName ?>/'">
                <img id="next-ev-img" class="column is-narrow is-full-mobile is-4by3" src="<?php echo $next_events[0]->images[0]; ?>" alt="">
                <article class="content column">
                    <h1 id="next-ev-title" class="has-text-centered-mobile"><?php echo $next_events[0]->name?></h1>
                    <div id="next-ev-description" class="description">
                        <?php echo $next_events[0]->description?>
                    </div>
                    <div id="next-ev-teaser" class="teaser">
                        <?php echo $next_events[0]->teaser?>
                    </div>
                    <div>
                        <ul class="fa-ul" style="list-style: none;">
                            <li><i class="fa fa-clock-o fa-li"></i><?php print $next_events[0]->startTime; ?></li>
                            <?php if (!empty($next_events[0]->location)) { ?>
                                <li><i class="fa fa-map-marker fa-li"></i><?php print $next_events[0]->location; ?></li>
                            <?php } if (!empty($next_events[0]->facebookUrl)) { ?>
                            <li><i class="fa fa-li fa-facebook"></i>
                                <a href="<?php print $next_events[0]->facebookUrl; ?>" style="color: #dadada;">Facebook</a>
                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                </article>
            </div>
        </div>
        <div class="tile is-12">
            <div class="tile is-parent">
                <article class="tile is-child box content white">
                    <h1 class="has-text-centered">
                        <a href="applications/">Jobaanbiedingen</a>
                    </h1>
                    <div class="teaser has-text-centered">
                        <?php $application = $applications[0];?>
                        <div class="card">
                            <div class="card-content">
                                <div class="media">
                                    <div class="media-left">
                                        <figure class="image is-48x48 is-marginless">
                                            <img src="<?php print $application->logo; ?>" alt="Company logo">
                                        </figure>
                                    </div>
                                    <div class="media-content">
                                        <p class="title is-4"><?php print $application->title; ?></p>
                                        <p class="subtitle is-6"><?php print $application->company; ?></p>
                                    </div>
                                </div>
                                <div class="content">
                                    <?php print $application->description; ?>
                                    <?php print $application->topics; ?>
                                    <br>
                                    <b>Locatie: <?php print $application->location; ?></b>
                                </div>
                            </div>
                        </div>
                        <?php $application = $applications[1];?>
                        <div class="card">
                            <div class="card-content">
                                <div class="media">
                                    <div class="media-left">
                                        <figure class="image is-48x48 is-marginless">
                                            <img src="<?php print $application->logo; ?>" alt="Company logo">
                                        </figure>
                                    </div>
                                    <div class="media-content">
                                        <p class="title is-4"><?php print $application->title; ?></p>
                                        <p class="subtitle is-6"><?php print $application->company; ?></p>
                                    </div>
                                </div>
                                <div class="content">
                                    <?php print $application->description; ?>
                                    <?php print $application->topics; ?>
                                    <br>
                                    <b>Locatie: <?php print $application->location; ?></b>
                                </div>
                            </div>
                        </div>
                        <!--<?php $application = $applications[2];?>
                        <div class="card">
                            <div class="card-content">
                                <div class="media">
                                    <div class="media-left">
                                        <figure class="image is-48x48 is-marginless">
                                            <img src="<?php print $application->logo; ?>" alt="Company logo">
                                        </figure>
                                    </div>
                                    <div class="media-content">
                                        <p class="title is-4"><?php print $application->title; ?></p>
                                        <p class="subtitle is-6"><?php print $application->company; ?></p>
                                    </div>
                                </div>
                                <div class="content">
                                    <?php print $application->description; ?>
                                    <?php print $application->topics; ?>
                                    <br>
                                    <b>Locatie: <?php print $application->location; ?></b>
                                </div>
                            </div>
                        </div>
                        -->
                    </div>
                    <br>
                    <div class="has-text-right">
                        <small><i><a href="applications/">Meer weten...</a></i></small>
                    </div>
                </article>
            </div>
            <div class="tile is-parent is-vertical">
                <?php if (sizeof($previous_events) > 0) { ?>
                <article class="tile is-child box content ceneka-grey event" onclick="location.href='/events/<?php print $previous_events[0]->shortName ?>/'">
                    <h1 class="has-text-centered-mobile">Vorig evenement: <?php echo $previous_events[0]->name?></h1>
                    <div class="description">
                        <?php echo $previous_events[0]->description?>
                    </div>
                    <div class="teaser">
                        <?php echo $previous_events[0]->teaser; ?>
                    </div>
                    <div>
                        <ul class="fa-ul" style="list-style: none;">
                            <li><i class="fa fa-clock-o fa-li"></i><?php print $previous_events[0]->startTime; ?></li>
                            <?php if (!empty($previous_events[0]->location)) { ?>
                                <li><i class="fa fa-map-marker fa-li"></i><?php print $previous_events[0]->location; ?></li>
                            <?php } if (!empty($previous_events[0]->facebookUrl)) { ?>
                            <li><i class="fa fa-li fa-facebook"></i>
                                <a href="<?php print $previous_events[0]->facebookUrl; ?>">Facebook</a>
                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                </article>
                <?php } ?>
                <article class="tile is-child box content bordeaux card" onclick="location.href='/companies/'">
                    <h1 class="has-text-centered-mobile">Sponsors</h1>
                    <div class="description">
                        You know we love them!
                    </div>
                    <div class="teaser">
                        <p>
                            Zonder sponsors zouden velen van onze evenementen gelimiteerd zijn.
                            Door een nauwe samenwerking met bedrijven en personen kunnen wij de studenten beter voorzien
                            en de studenten bekend laten maken met het bedrijfsleven.
                        </p>
                        <p>
                            Wij bij CenEka geven bedrijven de kans om een nauwe samenwerking aan te gaan.
                            Dit door sponsors de kans te geven voorstellen voor evenementen te doen en deze
                            samen te organiseren. In ruil voor deze bijdrage, helpen wij bedrijven beter in
                            contact te komen met de studenten en het juiste doelpubliek te vinden.
                        </p>
                    </div>
                </article>
            </div>
        </div>
        <div class="tile is-12">
            <?php if(sizeof($next_events) >= 2) { ?>
            <div class="tile is-parent">
                <article class="tile is-child box content ceneka-red event" onclick="location.href='/events/<?php print $next_events[1]->shortName ?>/'">
                    <h1 class="has-text-centered-mobile"><?php echo $next_events[1]->name?></h1>
                    <div class="description"><?php echo $next_events[1]->description?></div>
                    <div class="teaser"><?php echo $next_events[1]->teaser?></div>
                    <?php if (isset($next_events[1]->images[1])) { ?>
                        <br><img src="<?php echo $next_events[1]->images[1]; ?>" alt="">
                    <?php } ?>
                    <div>
                        <ul class="fa-ul" style="list-style: none;">
                            <li><i class="fa fa-clock-o fa-li"></i><?php print $next_events[1]->startTime; ?></li>
                            <?php if (!empty($next_events[1]->location)) { ?>
                                <li><i class="fa fa-map-marker fa-li"></i><?php print $next_events[1]->location; ?></li>
                            <?php } if (!empty($next_events[1]->facebookUrl)) { ?>
                            <li><i class="fa fa-li fa-facebook"></i>
                                <a href="<?php print $next_events[1]->facebookUrl; ?>">Facebook</a>
                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                </article>
            </div>
            <?php } ?>
            <div class="tile is-parent is-narrow">
                <article class="tile is-child">
                    <img src="assets/images/schild.png" alt="">
                </article>
            </div>
            <div class="tile is-parent">
                <article class="tile is-child box content ceneka-grey columns is-vertical">
                    <h1 class="has-text-centered-mobile column is-narrow title">Een leuk weetje</h1>
                    <div class="teaser column">
                        <?php
                        $trivia = file_get_contents("http://numbersapi.com/random/trivia");
                        echo $trivia
                        ?>
                    </div>
                    <div class="has-text-right column is-narrow">
                        <small><i><a href="http://numbersapi.com/">~numbersapi</a></i></small>
                    </div>
                </article>
            </div>
        </div>
    </div>
</div>
<?php include_once 'layouts/main/footer.php' ?>
