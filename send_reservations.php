<?php
require __DIR__ . '/vendor/autoload.php'; // Include the Twilio PHP library

// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "reservations";
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Get today's date
$today = date('Y-m-d');

// Get the reservations for today
$sql = "SELECT * FROM Porosia WHERE start_date LIKE '$today%'";
$result = mysqli_query($conn, $sql);

// Build the message
$message = "Reservations for $today:\n";
if (mysqli_num_rows($result) > 0) {
  while($row = mysqli_fetch_assoc($result)) {
    $message .= "Emri: " . $row["emri"] . "\n";
    $message .= "Numri: " . $row["numri"] . "\n";
    $message .= "Vendi: " . $row["vendi"] . "\n";
    $message .= "Porosia: " . $row["porosia"] . "\n";
    $message .= "Data dhe koha per ta derguar: " . $row["start_date"] . "\n";
    $message .= "Data per ta marre: " . $row["end_date"] . "\n";
    $message .= "Cmimi: " . $row["price"] . "\n\n";
  }
} else {
  $message .= "No reservations for today.";
}

// Set up the Twilio API
$account_sid = 'ACda71a4205a50191f3f0ff3494a121ab0'; // Replace with your Twilio account SID
$auth_token = '79cb8927553f1be2ed6d520a64fdd210'; // Replace with your Twilio auth token
$twilio_number = '+13203177174'; // Replace with your Twilio phone number
$to_number = '+38349254475'; // Replace with the recipient's phone number
$client = new Twilio\Rest\Client($account_sid, $auth_token);

// Send the message
$message = $client->messages->create(
  $to_number,
  array(
    'from' => $twilio_number,
    'body' => $message
  )
);

echo "Message sent successfully.";
mysqli_close($conn);
?>
