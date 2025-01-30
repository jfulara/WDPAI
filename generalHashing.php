<?php

$sensitiveData = 'example';

$salt = bin2hex(random_bytes(16)); //Stored in database
$pepper = 'WDPAI'; //Stored in code

$dataToHash = $sensitiveData . $salt . $pepper;
$hash = hash('sha256', $dataToHash); //Stored in database

/*----*/

$sensitiveData = 'example';

$storedSalt = $salt; //Stored in database
$storedHash = $hash;
$pepper = 'WDPAI'; //Stored in code

$dataToHash = $sensitiveData . $salt . $pepper;

$verificationHash = hash('sha256', $dataToHash);