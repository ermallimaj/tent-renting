<?php

// Update the path below to your autoload.php,
// see https://getcomposer.org/doc/01-basic-usage.md
require_once 'vendor/autoload.php'; 

use Twilio\Rest\Client;

// Find your Account SID and Auth Token at twilio.com/console
// and set the environment variables. See http://twil.io/secure
$sid = getenv("ACda71a4205a50191f3f0ff3494a121ab0");
$token = getenv("79cb8927553f1be2ed6d520a64fdd210");
$twilio = new Client($sid, $token);

$message = $twilio->messages
                  ->create("+15558675310", // to
                           ["body" => "Congratulations Endrit Gjokaj! You have been invited to apply for a full scholarship at Harvard for Fall studies. This is an incredible opportunity to pursue your academic dreams. Please visit https://ischoolconnect.com/blog/scholarships-offered-by-harvard-university-how-to-apply/\n to apply now. Don't wait, the deadline is approaching soon. Good luck! - Harvard Scholarship Committee", "from" => "+15017122661"]
                  );

print($message->sid);