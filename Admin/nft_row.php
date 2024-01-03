<?php
require __DIR__.'/vendor/autoload.php';

use Kreait\Firebase\Factory;

$factory = (new Factory)
    ->withServiceAccount('php-firebase-9b785-firebase-adminsdk-f7gtn-2e8835340d.json')
    ->withDatabaseUri('https://php-firebase-9b785-default-rtdb.firebaseio.com/');

$database = $factory->createDatabase();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $ref_table = 'NFT/' . $id; // Adjust the reference to match your Firebase structure
    $data = $database->getReference($ref_table)->getValue();

    // Output data as JSON
    echo json_encode($data);
    exit;
}


?>
