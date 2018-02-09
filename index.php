<?php
// $attr['ugentStudentID'] is het studentennummer
// Include Event model for easier access
include_once 'cas-data.php';
include_once 'views/models/event.php';
if (phpCAS::isAuthenticated()){
    $user = phpCAS::getUser();
    $attr = phpCAS::getAttributes();
}
else{
 $user= Null;
 $attr= Null;
}
$path = ltrim($_SERVER['REQUEST_URI'], '/');
$path = rtrim($path, '/');
$elements = explode('/', $path);
function go_to_event($elements, $attr = Null) {
    global $username, $password;
    if (sizeof($elements) == 1) {
        
        try {

            //Get events where name is the same as shortname used in url
            $query = 'SELECT * FROM events WHERE shortName = :shortName';
            $swap = array(':shortName' => $elements[0]);
            $type = 'Event';
            $data = getDBObjects($query, $swap, $type);
        
            if (!is_null($attr) && sizeof($data == 1)){
                
                //Get members with current studentnumber
                $query = 'SELECT * FROM leden WHERE studentennummer = :studnummer';
                $swap = array(':studnummer' => $attr['ugentStudentID']);
                $type = 'Lid';
                $info = getDBObjects($query, $swap, $type);

                if (sizeof($info) != 1){
                    print $databaseerrorshouldnthappen;
                    $status = Null;
                }
                else {
                    //check if person registered
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
            }
            else {
                $status = Null;
            }
            if (sizeof($data) != 1) {
                $descriptor = "404 Not Found";
                header('HTTP/1.1 404 Not Found');
                include 'views/404.php';
            } else {
                $event = $data[0];
                $descriptor = $event->name;
                include 'views/event-page.php';
            }
        } catch (Exception $e) {            
            exit(header("Location: /500/"));
        }
    } else {
        $descriptor = "404 Not Found";
        header('HTTP/1.1 404 Not Found');
        include 'views/404.php';
    }
}
if (empty($elements[0])) {
    include 'views/home.php';
} else if (sizeof($elements) == 1) {
    switch (array_shift($elements)) {
        case 'about':
            $descriptor = 'About';
            include 'views/contact.php';
            break;
        case 'bestuur':
            $descriptor = 'Bestuur';
            include 'views/bestuur.php';
            break;
        case 'companies':
            $descriptor = 'Companies';
            include 'views/companies.php';
            break;
        case 'statuten':
            $descriptor = 'Statuten';
            include 'views/statuten.php';
            break;
        case 'applications':
            $descriptor = 'Aanbiedingen';
            include 'views/applications.php';
            break;
        case 'events':
            $descriptor = 'Evenementen';
            include 'views/events.php';
            break;
        case 'lid':
            $descriptor = 'Nieuw Lid';
            include 'views/lid.php';
            break;
        case '500':
            $descriptor = "500 Internal Server Error";
            header('HTTP/1.1 500 Internal Server Error');
            include 'views/500.php';
            break;
        default:
            $descriptor = "404 Not Found";
            header('HTTP/1.1 404 Not Found');
            include 'views/404.php';
    }
} else if (sizeof($elements) == 2) {
    switch (array_shift($elements)) {
        case 'events':
            go_to_event($elements, $attr);
            break;
        default:
            $descriptor = "404 Not Found";
            header('HTTP/1.1 404 Not Found');
            include 'views/404.php';
    }
} else {
    $descriptor = "404 Not Found";
    header('HTTP/1.1 404 Not Found');
    include 'views/404.php';
}
?>