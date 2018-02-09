<?php include_once 'layouts/main/header.php'; ?>

<?php 
// db connection
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    
    $query = 'SELECT * FROM leden WHERE studentennummer = :studnummer';
    $swap = array(':studnummer' => $attr['ugentStudentID']);
    $type = 'Event';
    $info = getDBObjects($query, $swap, $type);

    if (sizeof($info)==1){

        if (is_null($status)){
            echo('Something went wrong');
        }
        elseif ($status == 0){
            /*$sql = 'INSERT INTO registraties VALUES (:event, :user)';
            $statement = $db->prepare($sql);
            if (!$statement)
                throw new Exception("Database error.");
            $statement->execute(array(':event' => $event->id, ':user'=>$info[0]->id));*/
            
            $query = 'INSERT INTO registraties VALUES (:event, :user)';
            $swap = array(':event' => $event->id, ':user'=>$info[0]->id);
            $type = 'Registration';
            $discard = getDBObjects($query, $swap, $type);            

        }
        elseif($status == 1) {
            /*$sql = 'DELETE FROM registraties WHERE event_id = :event AND leden_id = :user';
            $statement = $db->prepare($sql);
            if (!$statement)
                throw new Exception("Database error.");
            $statement->execute(array(':event' => $event->id, ':user'=>$info[0]->id)); */ 
            
            $query = 'DELETE FROM registraties WHERE event_id = :event AND leden_id = :user';
            $swap = array(':event' => $event->id, ':user'=>$info[0]->id);
            $type = 'Registration';
            $discard = getDBObjects($query, $swap, $type);    
        }
        
    }
    
}

/*$sql = 'SELECT * FROM events WHERE id = :eventID';
$statement = $db->prepare($sql);
if (!$statement)
    throw new Exception("Database error.");
$statement->execute(array(':eventID'=>$data[0]->id));
$registerable = $statement->fetchAll(PDO::FETCH_CLASS, 'Event');*/

$query = 'SELECT * FROM events WHERE id = :eventID';
$swap = array(':eventID'=>$data[0]->id);
$type = 'Event';
$registerable = getDBObjects($query, $swap, $type);

if (sizeof($registerable) == 1 && $registerable[0]->canSubscribe == 1){
    /*$sql = 'SELECT IF (registraties.event_id IS NULL, FALSE, TRUE) AS aanwezig FROM registraties 
    WHERE registraties.event_id = :eventID AND registraties.leden_id = :ledenID';
    $statement = $db->prepare($sql);
    if (!$statement)
        throw new Exception("Database error.");
    $statement->execute(array(':eventID'=>$data[0]->id, ':ledenID'=>$info[0]->id));
    $status_t = $statement->fetchAll(PDO::FETCH_CLASS, 'Event');*/

    $query = 'SELECT IF (registraties.event_id IS NULL, FALSE, TRUE) AS aanwezig FROM registraties 
    WHERE registraties.event_id = :eventID AND registraties.leden_id = :ledenID';
    $swap = array(':eventID'=>$data[0]->id, ':ledenID'=>$info[0]->id);
    $type = 'Event';
    $status_t = getDBObjects($query, $swap, $type);

    if (sizeof($status_t)==1){
        $status = True;
    }
    else{
        $status = False;
    }
}
else {
    $status = Null;
}
?>


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
            <?php } if (!empty($event->facebookUrl)) { ?>
            <li><i class="fa fa-li fa-facebook"></i>
                <a href="<?php print $event->facebookUrl; ?>">Facebook</a>
            </li>
            <?php } ?>
        </ul>
        <br>
        <?php if (is_null($status) or is_null($user)):?>
        <?php else :?>
        <form method="post" action="<?php $_SERVER['REQUEST_URI']?>" form="form1">
            <button type="submit" value="Submit">                
                <?php if ($status == 1):?>
                    Uitschrijven
                <?php else:?>
                    Inschrijven
                <?php endif?>
            </button>
        </form>
        <?php endif ?>
        <div class="is-10 is-offset-1 column content has-text-justified">
            <p><?php print $event->longDescription; ?></p>
            <?php if (!empty($event->info)) { ?>
            <p>
                Meer info op: <a href="<?php echo $event->info; ?>" target="_blank"><?php echo $event->info; ?></a>
            </p>
            <?php } ?>
            <?php if (!empty($event->locationUrl)) { ?>
                <iframe src="<?php print $event->locationUrl; ?>" style="height: 400px; width: 100%;"></iframe>
            <?php } ?>
        </div>
    </article>
</div>
<?php include_once 'layouts/main/footer.php'; ?>