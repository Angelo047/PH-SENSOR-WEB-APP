<?php
session_start(); // Start the session

require __DIR__.'/vendor/autoload.php';
use Kreait\Firebase\Factory;
use Kreait\Firebase\Auth;


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';




$factory = (new Factory)
    ->withServiceAccount('php-firebase-9b785-firebase-adminsdk-f7gtn-2e8835340d.json')
    ->withDatabaseUri('https://php-firebase-9b785-default-rtdb.firebaseio.com/');

$database = $factory->createDatabase();
$auth = $factory->createAuth();

$toEmail = ''; // Initialize the variable

// Check if the user is authenticated and has a valid session
if (isset($_SESSION['verified_user_id'])) {
    $uid = $_SESSION['verified_user_id'];

    // Get the user using Firebase Auth
    $user = $auth->getUser($uid);

    $toEmail = $user->email;

    // Rest of your code remains unchanged...
    $plantId = isset($_GET['id']) ? $_GET['id'] : null;

if ($plantId) {
    $plantInfoRef = $database->getReference('/plants')->getChild($plantId);
    $plantInfo = $plantInfoRef->getValue();

    if ($plantInfo) {
        $requiredLowPhLevel = $plantInfo['ph_lvl_low'];
        $requiredHighPhLevel = $plantInfo['ph_lvl_high'];
        $plantName = $plantInfo['plant_name'];

        date_default_timezone_set('Asia/Manila'); // Set the timezone to Philippines

        // Perform the pH level check and notification creation
        function checkPhLevel($requiredLowPhLevel, $requiredHighPhLevel, $plantName, $database, $plantInfo, $toEmail) {
            $phSensorDataRef = $database->getReference('/phSensorData');
            $latestPhSensorData = $phSensorDataRef->orderByKey()->limitToLast(1)->getSnapshot()->getValue();
            $latestPhValue = reset($latestPhSensorData);

            if ($latestPhValue > $requiredHighPhLevel || $latestPhValue < $requiredLowPhLevel) {
                $notificationsRef = $database->getReference('/notifications')->push();
                $notificationsRef->set([
                    'plant_name' => $plantInfo['plant_name'],
                    'plant_photo' => $plantInfo['plant_photo'],
                    'message' => "pH Level: $latestPhValue is outside the acceptable range",
                    'current_date' => date('H:i A, M j, Y'),
                    'isRead' => 0,
                ]);

                // Send email notification using PHPMailer
                sendEmailNotification($toEmail, $latestPhValue, $plantName, $requiredLowPhLevel, $requiredHighPhLevel);

                echo 'Notification created: ' . $notificationsRef->getKey() . PHP_EOL;
            } else {
                echo 'pH value is within the acceptable range for ' . $plantInfo['plant_name'] . '.' . PHP_EOL;
            }
        }

        // Function to send email notification using PHPMailer
        function sendEmailNotification($toEmail, $latestPhValue, $plantName, $requiredLowPhLevel, $requiredHighPhLevel) {
            $mail = new PHPMailer();

            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'guiltiasin941@gmail.com'; // Replace with your Gmail email
            $mail->Password = 'uuwooyibwcicnpqx'; // Replace with your Gmail password
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('guiltiasin941@gmail.com', 'PH WATER');
            $mail->addAddress($toEmail);
            $mail->isHTML(true);
            $mail->Subject = 'pH Level Notification';
            $mail->Body = "The pH level of your $plantName is outside the acceptable range of $requiredLowPhLevel to $requiredHighPhLevel" . "<br>" .
            "The current pH level is: $latestPhValue";

            if (!$mail->send()) {
                echo 'Email could not be sent. Mailer Error: ' . $mail->ErrorInfo;
            } else {
                echo 'Email sent successfully';
            }
        }

        // Call the pH level check function
        checkPhLevel($requiredLowPhLevel, $requiredHighPhLevel, $plantName, $database, $plantInfo, $toEmail);
    } else {
        echo 'Plant information not found.' . PHP_EOL;
    }
} else {
    echo 'Invalid plant ID.' . PHP_EOL;
}
} else {
    echo 'User not authenticated.' . PHP_EOL;
}
?>
