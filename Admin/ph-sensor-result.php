<?php
require __DIR__.'/vendor/autoload.php';

use Kreait\Firebase\Factory;
use Kreait\Firebase\Auth;

$factory = (new Factory)
    ->withServiceAccount('php-firebase-9b785-firebase-adminsdk-f7gtn-2e8835340d.json')
    ->withDatabaseUri('https://php-firebase-9b785-default-rtdb.firebaseio.com/');

    $database = $factory->createDatabase();
    $auth = $factory->createAuth();

    $reference = $database->getReference('/phSensorData');
    $snapshot = $reference->getSnapshot();
    $phSensorData = $snapshot->getValue();

// Return the data as JSON
header('Content-Type: application/json');
echo json_encode($phSensorData);

?>
