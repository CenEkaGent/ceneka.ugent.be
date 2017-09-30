<?php
// Neccessary for the redirect in case of error
ob_start();
include_once 'layouts/main/header.php';
?>

<?php
// Include Event model for easier access
include_once 'models/event.php';

try {
    // Open DB connection
    $db = new PDO('sqlite:.events.sqlite');

    // Fetch next event from database using SQL
    $sql = 'SELECT * FROM events WHERE endTime > :currentTime ORDER BY :orderColumn LIMIT 2';
    $statement = $db->prepare($sql);
    if (!$statement)
        throw new Exception("Database error.");

    $statement->execute(array(':orderColumn' => 'startTime', ':currentTime' => date('Y-m-d H:i:s')));
    $next_events = $statement->fetchAll(PDO::FETCH_CLASS, 'Event');
    
    // Fetch previous event from database using SQL
    $sql = 'SELECT * FROM events WHERE endTime <= :currentTime ORDER BY :orderColumn LIMIT 2';
    $statement = $db->prepare($sql);
    if (!$statement)
        throw new Exception("Database error.");

    $statement->execute(array(':orderColumn' => 'startTime', ':currentTime' => date('Y-m-d H:i:s')));
    $previous_events = $statement->fetchAll(PDO::FETCH_CLASS, 'Event');

    // Display previous event when no future events are present
    if (sizeof($next_events) == 0)
        $next_events = [array_shift($previous_events)];

    // Close DB connection
    $db = null;
} catch (Exception $e) {
    exit(header("Location: /500/"));
}
?>

<div id="homepage">
    <div class="tile is-vertical is-ancestor">
        <div class="tile is-parent is-12">
            <div id="next-ev" class="tile is-child box columns ceneka-red is-paddingless fixed-height300 event" onclick="location.href='/events/<?php print $next_events[0]->shortName ?>/'">
                <img id="next-ev-img" class="column is-narrow is-full-mobile" src="http://via.placeholder.com/400x300" alt="">
                <article class="content column">
                    <h1 id="next-ev-title" class="has-text-centered-mobile"><?php echo $next_events[0]->name?></h1>
                    <div id="next-ev-description" class="description">
                        <?php echo $next_events[0]->description?>
                    </div>
                    <div id="next-ev-teaser" class="teaser">
                        <?php echo $next_events[0]->teaser?>
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
                    <div class="teaser">
                        <div class="card">
                            <div class="card-content">
                                <div class="media">
                                    <div class="media-left">
                                        <figure class="image is-48x48 is-marginless">
                                            <img src="http://via.placeholder.com/48x48" alt="Company logo">
                                        </figure>
                                    </div>
                                    <div class="media-content">
                                        <p class="title is-4">Job title</p>
                                        <p class="subtitle is-6">Company</p>
                                    </div>
                                </div>
                                <div class="content">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem, adipisci. Aperiam optio officiis accusantium atque?
                                    <a>#keyword1</a> <a>#keyword2</a>
                                    <br>
                                    <small>Time of creation</small>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-content">
                                <div class="media">
                                    <div class="media-left">
                                        <figure class="image is-48x48 is-marginless">
                                            <img src="http://via.placeholder.com/48x48" alt="Company logo">
                                        </figure>
                                    </div>
                                    <div class="media-content">
                                        <p class="title is-4">Job title</p>
                                        <p class="subtitle is-6">Company</p>
                                    </div>
                                </div>
                                <div class="content">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem, adipisci. Aperiam optio officiis accusantium atque?
                                    <a>#keyword1</a> <a>#keyword2</a>
                                    <br>
                                    <small>Time of creation</small>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-content">
                                <div class="media">
                                    <div class="media-left">
                                        <figure class="image is-48x48 is-marginless">
                                            <img src="http://via.placeholder.com/48x48" alt="Company logo">
                                        </figure>
                                    </div>
                                    <div class="media-content">
                                        <p class="title is-4">Job title</p>
                                        <p class="subtitle is-6">Company</p>
                                    </div>
                                </div>
                                <div class="content">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem, adipisci. Aperiam optio officiis accusantium atque?
                                    <a>#keyword1</a> <a>#keyword2</a>
                                    <br>
                                    <small>Time of creation</small>
                                </div>
                            </div>
                        </div>
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
                    <?php echo $previous_events[0]->teaser?>
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
                    <div class="description"><?php echo $next_events[1]->name?></div>
                    <div class="teaser"><?php echo $next_events[1]->name?></div>
                </article>
            </div>
            <?php } ?>
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