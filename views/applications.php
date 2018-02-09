<?php 
ob_start();
include_once 'layouts/main/header.php' 
?>

<?php
// Include Event model for easier access
include_once 'models/application.php';

try {

    //Fetch all applications from DB
    $query = 'SELECT * FROM applications ORDER BY :orderColumn';
    $swap = array(':orderColumn' => 'priority');
    $type = 'Application';
    $applications = getDBObjects($query, $swap, $type);

} catch (Exception $e) {
    exit(header("Location: /500/"));
}

$classes = ["", " ceneka-red", " ceneka-grey", ""];
?>
<!--This could be added as a template when DB is added -->
<div id="applications">
    <?php if(empty($applications)){?>
    <div class="tile is-vertical is-ancestor">
        <div class="tile is-parent is-12">
            <div class="tile is-child content">
                <h1 class="title has-text-centered">Stay tuned for more!</h1>
                <h1 class="title has-text-centered">.</h1>
                <h1 class="title has-text-centered">.</h1>
                <h1 class="title has-text-centered">.</h1>
            </div>
        </div>
    </div>
    <?php
    }
    else{
        for ($i = 0; $i < sizeof($applications); $i++) {
            $application = $applications[$i];
            if($i % 2 == 0){?>
                <div class="tile is-vertical is-ancestor">
                    <div class="tile is-parent is-12">
                        <div class="tile is-child box columns is-paddingless fixed-height300">
                            <img class="column is-narrow is-full-mobile fixed-height300" src="<?php print $application->logo; ?>" alt="">
                            <article class="content column">
                                <h1 class="has-text-centered-mobile title is-8"><?php print $application->title; ?></h1>
                                <div class="has-text-centered-mobile subtitle is-4 description"><?php print $application->company; ?></div>
                                <div class="teaser">
                                    <?php print $application->description; ?>
                                </div><br>
                                <p>
                                    <b>Locatie: <?php print $application->location; ?></b>
                                    <br>
                                    <i>Tags: <?php print $application->topics; ?></i>
                                </p>
                            </article>
                        </div>
                    </div>
                </div>
            <?php 
            }
            else{ ?>
                <div class="tile is-vertical is-ancestor">
                    <div class="tile is-parent is-12">
                        <div class="tile is-child box columns is-paddingless fixed-height300">
                            <article class="content column">
                                <h1 class="has-text-centered-mobile title is-8"><?php print $application->title; ?></h1>
                                <div class="has-text-centered-mobile subtitle is-4 description"><?php print $application->company; ?></div>
                                <div class="teaser">
                                    <?php print $application->description; ?>
                                </div><br>
                                <p>
                                    <b>Locatie: <?php print $application->location; ?></b>
                                    <br>
                                    <i>Tags: <?php print $application->topics; ?></i>
                                </p>
                            </article>
                            <img class="column is-narrow is-full-mobile fixed-height300" src="<?php print $application->logo; ?>" alt="">
                        </div>
                    </div>
                </div>
            <?php
            }
        } ?>
    
    <?php }
    include_once 'layouts/main/footer.php' ?>