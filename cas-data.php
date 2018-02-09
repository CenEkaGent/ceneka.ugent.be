<?php 
$CASPATH = 'CAS/CAS-1.3.3/CAS.php';  
include_once($CASPATH);
phpCAS::client(SAML_VERSION_1_1,'login.ugent.be',443,'', true, 'saml');
phpCAS::handleLogoutRequests(true, array('cas1.ugent.be','cas2.ugent.be','cas3.ugent.be','cas4.ugent.be','cas5.ugent.be','cas6.ugent.be'));
phpCAS::setCasServerCACert('/etc/ssl/certs/ca-certificates.crt');
phpCAS::setFixedServiceURL 	('http://ceneka.ugent.be/');

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


?>
