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
    $sql = 'SELECT * FROM events WHERE endTime = (SELECT min(endTime) FROM events WHERE endTime > :currentTime) ORDER BY :orderColumn';
    $statement = $db->prepare($sql);
    if (!$statement)
        throw new Exception("Database error.");

    $statement->execute(array(':orderColumn' => 'startTime', ':currentTime' => date('Y-m-d H:i:s')));
    $next_event = $statement->fetchAll(PDO::FETCH_CLASS, 'Event')[0];
    
    // Fetch previous event from database using SQL
    $sql = 'SELECT * FROM events WHERE endTime = (SELECT max(endTime) FROM events WHERE endTime < :currentTime) ORDER BY :orderColumn';
    $statement = $db->prepare($sql);
    if (!$statement)
        throw new Exception("Database error.");

    $statement->execute(array(':orderColumn' => 'startTime', ':currentTime' => date('Y-m-d H:i:s')));
    $previous_event = $statement->fetchAll(PDO::FETCH_CLASS, 'Event')[0];

    // Close DB connection
    $db = null;
} catch (Exception $e) {
    exit(header("Location: /500/"));
}
?>

<div id="homepage">
    <div class="tile is-vertical is-ancestor">
        <div class="tile is-parent is-12">
            <div id="next-ev" class="tile is-child box columns ceneka-red is-paddingless fixed-height300">
                <img id="next-ev-img" class="column is-narrow is-full-mobile" src="http://via.placeholder.com/400x300" alt="">
                <article class="content column">
                    <h1 id="next-ev-title" class="has-text-centered-mobile"><?php echo $next_event->name?></h1>
                    <div id="next-ev-description" class="description">
                        <?php echo $next_event->description?>
                    </div>
                    <div id="next-ev-teaser" class="teaser">
                        <?php echo $next_event->teaser?>
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
                <article class="tile is-child box content ceneka-grey">
                    <h1 class="has-text-centered-mobile"><?php echo $previous_event->name?></h1>
                    <div class="description">
                        <?php echo $previous_event->description?>
                    </div>
                    <div class="teaser">
                    <?php echo $previous_event->teaser?>
                    </div>
                </article>
                <article class="tile is-child box content bordeaux">
                    <h1 class="has-text-centered-mobile">Sponsor</h1>
                    <div class="description">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Obcaecati, voluptatum!
                    </div>
                    <div class="teaser">
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Culpa quos quas numquam tempora a! Magnam rem fugiat aliquam, blanditiis asperiores voluptatibus debitis deserunt laborum cum quibusdam hic cupiditate fugit! Commodi sequi molestiae ex non officia veritatis corrupti consequatur necessitatibus nostrum laudantium, illum corporis fuga adipisci doloribus atque molestias. Reiciendis, minima.
                    </div>
                </article>
            </div>
        </div>
        <div class="tile is-12">
            <div class="tile is-parent">
                <article class="tile is-child box content ceneka-red">
                    <h1 class="has-text-centered-mobile">Ander volgend event</h1>
                    <div class="description">
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Porro, ratione?
                    </div>
                    <div class="teaser">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugiat nobis quia assumenda ipsa autem, voluptate inventore accusantium omnis consequatur facilis rerum. Dolore laborum vero nihil quaerat amet, vitae nisi voluptates commodi! Voluptate fugiat soluta error sed tenetur praesentium iure quam. Laudantium laboriosam reiciendis ratione odit cupiditate, fugit nesciunt alias nostrum!
                    </div>
                </article>
            </div>
            <div class="tile is-parent">
                <article class="tile is-child box content white">
                    <h1 class="has-text-centered-mobile">Blogpost?</h1>
                    <div class="description">
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Porro, ratione?
                    </div>
                    <div class="teaser">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugiat nobis quia assumenda ipsa autem, voluptate inventore accusantium omnis consequatur facilis rerum. Dolore laborum vero nihil quaerat amet, vitae nisi voluptates commodi! Voluptate fugiat soluta error sed tenetur praesentium iure quam. Laudantium laboriosam reiciendis ratione odit cupiditate, fugit nesciunt alias nostrum!
                    </div>
                </article>
            </div>
            <div class="tile is-parent">
                <article class="tile is-child box content ceneka-grey">
                    <h1 class="has-text-centered-mobile">Een leuk weetje</h1>
                        <div class="teaser">
                            <?php
                            $trivia = file_get_contents("http://numbersapi.com/random/trivia");
                            echo $trivia
                            ?>
                        <br>
                        <br>
                        <br>
                        <div class="has-text-right">
                            <small><i><a href="http://numbersapi.com/">~numbersapi</a></i></small>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </div>
</div>
<?php include_once 'layouts/main/footer.php' ?>