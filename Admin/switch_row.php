<?php
require __DIR__.'/vendor/autoload.php';

use Kreait\Firebase\Factory;

$factory = (new Factory)
    ->withServiceAccount('ph-sensor-web-app-firebase-adminsdk-1ed6k-fefcd2b805.json')
    ->withDatabaseUri('https://ph-sensor-web-app-default-rtdb.firebaseio.com/');

$database = $factory->createDatabase();

// Function to check pH level and control switches
function checkAndUpdateSwitches($database) {
    // Get current pH level data from Firebase
    $phSensorData = $database->getReference('/phSensorData')->getValue();
    $latestPhValue = end($phSensorData);

    // Get plant pH level range from Firebase or any other source
    $plantId = isset($_GET['id']) ? $_GET['id'] : null;
    $plantInfo = $database->getReference("/plants/$plantId")->getValue();

    // Check if plant information is available and keys exist
    if ($plantInfo && isset($plantInfo['ph_lvl_low']) && isset($plantInfo['ph_lvl_high'])) {
        $requiredLowPhLevel = $plantInfo['ph_lvl_low'];
        $requiredHighPhLevel = $plantInfo['ph_lvl_high'];

        // Get the previous pH level from Firebase or any other source
        $previousPhLevel = $database->getReference("/plants/$plantId/previousPhLevel")->getValue();

        // Determine if pH level is within the acceptable range
        if ($latestPhValue >= $requiredLowPhLevel && $latestPhValue <= $requiredHighPhLevel) {
            // pH level is within the acceptable range
            if ($previousPhLevel < $requiredLowPhLevel || $previousPhLevel > $requiredHighPhLevel) {
                // The previous pH level was outside the acceptable range, update the switches
                $database->getReference('/relay/1/switch')->set('off');
                $database->getReference('/relay/2/switch')->set('off');
                $database->getReference('/relay/1/disabled')->set(true);
                $database->getReference('/relay/2/disabled')->set(true);
            }
        } else {
            // pH level is outside the acceptable range
            if ($previousPhLevel >= $requiredLowPhLevel && $previousPhLevel <= $requiredHighPhLevel) {
                // The previous pH level was within the acceptable range, update the switches
                $database->getReference('/relay/1/switch')->set('off');
                $database->getReference('/relay/2/switch')->set('off');
                $database->getReference('/relay/1/disabled')->set(false);
                $database->getReference('/relay/2/disabled')->set(false);
            }
        }

        // Update the previous pH level
        $database->getReference("/plants/$plantId/previousPhLevel")->set($latestPhValue);
    } else {
        // Plant information not found or keys are not defined
        echo 'Plant information not found or incomplete.' . PHP_EOL;
    }
}

// Call the function to check pH level and control switches
checkAndUpdateSwitches($database);
?>
