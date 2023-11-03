<?php
require 'vendor/autoload.php'; // Include the SendGrid PHP library

// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "reservations";
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}


// Process form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Escape user inputs for security
  $emri = mysqli_real_escape_string($conn, $_POST['emri']);
  $numri = mysqli_real_escape_string($conn, $_POST['numri']);
  $vendi = mysqli_real_escape_string($conn, $_POST['vendi']);
  $porosia = mysqli_real_escape_string($conn, $_POST['porosia']);
  $start_date = mysqli_real_escape_string($conn, $_POST['start_date']);
  $end_date = mysqli_real_escape_string($conn, $_POST['end_date']);
  $price = mysqli_real_escape_string($conn, $_POST['price']);
// Define the email addresses
$to = 'shpk.ornela@gmail.com'; // Change this to the email address you want to send the message to
$from = 'ermallimaj69@gmail.com'; // Change this to the email address you want to send the message from

// Define the email subject and message
$subject = "Porosi e re nga: $emri";
$message = "Emri: $emri\nNumri: $numri\nVendi: $vendi\nTe dhenat per porosine:: $porosia\nData dhe koha per ta derguar:: $start_date\nData per ta marre:: $end_date\nCmimi:: $price";

// Set up the email
$email = new \SendGrid\Mail\Mail();
$email->setFrom($from);
$email->setSubject($subject);
$email->addTo($to);
$email->addContent("text/plain", $message);

// Set up the SendGrid API key and send the email
$apiKey = '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'; // Change this to your SendGrid API key
$sendgrid = new \SendGrid($apiKey);
try {
    $response = $sendgrid->send($email);
    echo "Email sent successfully.";
} catch (Exception $e) {
    echo "Email not sent. Error message: " . $e->getMessage();
}

  // Insert data into the Porosia table
  $sql = "INSERT INTO Porosia (emri, numri, vendi, porosia, start_date, end_date, price) 
          VALUES ('$emri', '$numri', '$vendi', '$porosia', '$start_date', '$end_date', '$price')";
  if (mysqli_query($conn, $sql)) {
    echo "Porosia u ruajt me sukses!";
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
  
  // Close database connection
  mysqli_close($conn);
}
?>


<!DOCTYPE html>
<html>
<head>
  <title>Ornela SHPK</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <style>
.navbar.fixed-top {
    position: fixed;
    top: 0;
    width: 100%;
}
body {
  position: relative;
}
body::before {
  content: "";
  display: block;
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  opacity: 0.3;
  z-index: -1;
  background-image: url('logo.jpg');
  background-repeat: no-repeat;
  background-size: cover;
  background-attachment: fixed;
}
</style>

</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <a class="navbar-brand" href="porosi.php">Ornela SHPK</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav"></ul>
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="porosi.php">Shto Porosi</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="porosia2.php">Porosite</a>
        </li>
      </ul>
    </div>
  </nav>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <h2 class="text-center mb-4">Shto Porosi</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
<div class="form-group">
<label for="emri">Emri:</label>
<input type="text" class="form-control" id="emri" name="emri" required>
</div>
<div class="form-group">
  <label for="numri">Numri:</label>
  <input type="tel" class="form-control" id="numri" name="numri" required>
  <small class="form-text text-muted">Ju lutem shkruani numrin e telefonit.
.</small>
</div>

<div class="form-group">
<label for="vendi">Vendi:</label>
<input type="text" class="form-control" id="vendi" name="vendi" required>
</div>
<div class="form-group">
<label for="porosia">Porosia:</label>
<textarea class="form-control" id="porosia" name="porosia" required></textarea>
</div>
<div class="form-group">
<label for="start_date">Data dhe koha per ta derguar:</label>
<input type="datetime-local" class="form-control" id="start_date" name="start_date" required>
</div>
<div class="form-group">
<label for="end_date">Data per ta marre:</label>
<input type="date" class="form-control" id="end_date" name="end_date" required>
</div>
<div class="form-group">
  <label for="price">Cmimi:</label>
  <input type="number" class="form-control" id="price" name="price" required>
</div>
<button type="submit" class="btn btn-primary btn-block">Ruaj Porosine</button>
</form>
</div>
</div>

  </div>
</body>
</html>