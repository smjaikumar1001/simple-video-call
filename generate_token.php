<?php
require __DIR__ . '/vendor/autoload.php';  // Include Twilio SDK

use Twilio\Jwt\AccessToken;
use Twilio\Jwt\Grants\VideoGrant;

// Twilio Credentials from the console
$accountSid = 'YOUR_TWILIO_ACCOUNT_SID';
$apiKey = 'YOUR_TWILIO_API_KEY';
$apiSecret = 'YOUR_TWILIO_API_SECRET';
$roomName = 'TestRoom';  // Name of the video room

// Generate an Access Token
$identity = 'user_' . uniqid();  // Generate a unique identity for the user
$token = new AccessToken($accountSid, $apiKey, $apiSecret, 3600, $identity);

// Grant access to the video room
$videoGrant = new VideoGrant();
$videoGrant->setRoom($roomName);
$token->addGrant($videoGrant);

// Output the token as JSON
header('Content-Type: application/json');
echo json_encode(['token' => $token->toJWT()]);
?>
