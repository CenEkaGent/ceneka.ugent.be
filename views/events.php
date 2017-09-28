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

    // Fetch data from database using SQL
    $sql = 'SELECT * FROM events WHERE endTime > :currentTime ORDER BY :orderColumn';
    $statement = $db->prepare($sql);
    if (!$statement)
        throw new Exception("Database error.");
    $statement->execute(array(':orderColumn' => 'startTime', ':currentTime' => date('Y-m-d H:i:s')));
    $events = $statement->fetchAll(PDO::FETCH_CLASS, 'Event');

    // Close DB connection
    $db = null;
} catch (Exception $e) {
    exit(header("Location: /500/"));
}
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
            <div class="content"><h1>Toekomstige evenementen</h1></div>
            <div class="tile is-ancestor">
                <div class="tile is-parent">
                    <div class="tile is-child box">
                        <article class="content">
                            <h1 class="title">Title</h1>
                            <p class="subtitle">Subtitle</p>
                            <p>Teaser</p>
                        </article>
                    </div>
                </div>
                <div class="tile is-parent">
                    <div class="tile is-child box ceneka-red">
                        <article class="content">
                            <h1 class="title">Title</h1>
                            <p class="subtitle">Subtitle</p>
                            <p>Teaser</p>
                        </article>
                    </div>
                </div>
            </div>
            <div class="tile is-ancestor">
                <div class="tile is-parent">
                    <div class="tile is-child box ceneka-texture">
                        <article class="content">
                            <h1 class="title">Title</h1>
                            <p class="subtitle">Subtitle</p>
                            <p>Teaser</p>
                        </article>
                    </div>
                </div>
                <div class="tile is-parent">
                    <div class="tile is-child box ceneka-grey">
                        <article class="content">
                            <h1 class="title">Title</h1>
                            <p class="subtitle">Subtitle</p>
                            <p>Teaser</p>
                        </article>
                    </div>
                </div>
            </div>
            <div class="content"><h1>Verleden evenementen</h1></div>
            <div class="tile is-ancestor">
                <div class="tile is-parent">
                    <div class="tile is-child box">
                        <article class="content">
                            <h1 class="title">Title</h1>
                            <p class="subtitle">Subtitle</p>
                            <p>Teaser</p>
                        </article>
                    </div>
                </div>
                <div class="tile is-parent">
                    <div class="tile is-child box ceneka-red">
                        <article class="content">
                            <h1 class="title">Title</h1>
                            <p class="subtitle">Subtitle</p>
                            <p>Teaser</p>
                        </article>
                    </div>
                </div>
            </div>
            <div class="tile is-ancestor">
                <div class="tile is-parent">
                    <div class="tile is-child box ceneka-texture">
                        <article class="content">
                            <h1 class="title">Title</h1>
                            <p class="subtitle">Subtitle</p>
                            <p>Teaser</p>
                        </article>
                    </div>
                </div>
                <div class="tile is-parent">
                    <div class="tile is-child box ceneka-grey">
                        <article class="content">
                            <h1 class="title">Title</h1>
                            <p class="subtitle">Subtitle</p>
                            <p>Teaser</p>
                        </article>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once 'layouts/main/footer.php' ?>