<?php 
$CASPATH = 'CAS/CAS-1.3.3/CAS.php';  
include_once($CASPATH);
phpCAS::client(SAML_VERSION_1_1,'login.ugent.be',443,'', true, 'saml');
phpCAS::handleLogoutRequests(true, array('cas1.ugent.be','cas2.ugent.be','cas3.ugent.be','cas4.ugent.be','cas5.ugent.be','cas6.ugent.be'));
phpCAS::setCasServerCACert('/etc/ssl/certs/ca-certificates.crt');
phpCAS::setFixedServiceURL 	('http://ceneka.ugent.be/')
?>