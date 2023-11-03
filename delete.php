<?php
  // Connect to the database
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "reservations";

  $conn = mysqli_connect($servername, $username, $password, $dbname);
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  // Check if the delete button is clicked
  if (isset($_POST['delete'])) {
    $ids = $_POST['delete'];
    $id_list = implode(",", $ids);

    // Delete the selected rows from the Porosia table
    $sql = "DELETE FROM Porosia WHERE id IN ($id_list)";
    if (mysqli_query($conn, $sql)) {
      echo "Porosite u fshin me sukses.";

      // Reset auto_increment value if all rows are deleted
      $check_empty = mysqli_query($conn, "SELECT * FROM Porosia");
      if (mysqli_num_rows($check_empty) == 0) {
        mysqli_query($conn, "ALTER TABLE Porosia AUTO_INCREMENT = 1");
      } else {
        // Get the next available id
        $next_id = mysqli_query($conn, "SELECT MAX(id) FROM Porosia");
        $next_id = mysqli_fetch_array($next_id)[0] + 1;
        mysqli_query($conn, "ALTER TABLE Porosia AUTO_INCREMENT = $next_id");
      }
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
  }

  // Close database connection
  mysqli_close($conn);
?>
  
<!DOCTYPE html>
<html>
<head>
<style type="text/css">
		/* Style for the button */
		.siesesi {
			display: inline-block;
			padding: 10px 20px;
			background-color: #4CAF50;
			color: #FFFFFF;
			font-size: 16px;
			border-radius: 50px;
			text-decoration: none;
			text-align: center;
			cursor: pointer;
		}
		/* Style for the button when hovered */
		.siesesi:hover {
			background-color: #3e8e41;
		}
	</style>
  <style>
    
.navbar.fixed-top {
    position: fixed;
    top: 0;
    width: 100%;
}
</style>

  <title>Ornela SHPK - Porosite</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

  <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <a class="navbar-brand" href="porosi.php">Ornela SHPK</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
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
  <div class="text-center mt-5">
      <a class="button siesesi" href="porosi.php">Go to Porosia</a>
      </div>
  </body>
</html>
