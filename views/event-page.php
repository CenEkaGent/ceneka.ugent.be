<?php include_once 'layouts/main/header.php'; ?>

<?php
$startTime = DateTime::createFromFormat('Y-m-d H:i:s', $event->startTime);
$endTime = DateTime::createFromFormat('Y-m-d H:i:s', $event->endTime);

$time = $startTime->format('l d F Y H:i');
if ($startTime->format('Y-m-d') == $endTime->format('Y-m-d')) {
    $time = $time . " - " . $endTime->format('H:i');
} else {
    $time = $time . " - " . $endTime->format('l d F Y H:i');
}
?>

<div id="event" class="columns">
    <article class="is-10 is-offset-1 column">
        <h1 class="title is-1"><?php print $event->name; ?></h1>
        <p class="subtitle"><?php print $event->description; ?></p>
        <ul class="fa-ul">
            <li><i class="fa fa-clock-o fa-li"></i><?php print $time ?></li>
            <?php if (!empty($event->location)) { ?>
                <li><i class="fa fa-map-marker fa-li"></i><?php print $event->location; ?></li>
            <?php } ?>
        </ul>
        <br>
        <div class="is-10 is-offset-1 column content has-text-justified">
            <?php print $event->longDescription; ?>
            <?php if (!empty($event->locationUrl)) { ?>
                <iframe src="<?php print $event->locationUrl; ?>" style="height: 400px; width: 100%;"></iframe>
            <?php } ?>
        </div>
    </article>
</div>
<?php include_once 'layouts/main/footer.php'; ?>