<!DOCTYPE html>
<html>
<head>
  <title>Ornela SHPK - Porosite</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
.navbar.fixed-top {
    position: fixed;
    top: 0;
    width: 100%;
}
</style>
<style>
    table {
      border-collapse: collapse;
    }

    th, td {
      border: 1px solid black;
      padding: 8px;
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
  <h1 class="text-center">Porosite</h1>
  <form method="post" action="delete.php">
    <div class="table-responsive">
      <table class='table table-striped' style="border-collapse: collapse; width: 100%;">
        <thead>
          <tr>
            <th><input type="checkbox" id="checkAll"></th>
            <th>ID</th>
            <th>Emri</th>
            <th>Numri</th>
            <th>Vendi</th>
            <th>Porosia</th>
            <th>Data Fillimit</th>
            <th>Data Mbarimit</th>
            <th>Cmimi</th>
          </tr>
        </thead>
        <tbody>
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

            // Fetch data from the Porosia table
            $sql = "SELECT * FROM Porosia";
            $result = mysqli_query($conn, $sql);

            // Display data in a table
            if (mysqli_num_rows($result) > 0) {
              while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr><td><input type='checkbox' name='delete[]' value='" . $row["ID"] . "'></td><td>" . $row["ID"] . "</td><td>" . $row["emri"]. "</td><td>" . $row["numri"] . "</td><td>" . $row["vendi"] . "</td><td>" . $row["porosia"] . "</td><td>" . $row["start_date"] . "</td><td>" . $row["end_date"] . "</td><td>" . $row["price"] . "</td></tr>";
              }  
            } else {
              echo "<tr><td colspan='9' class='text-center'>Nuk ka porosi ne databaze.</td></tr>";
            }

            // Close database connection
            mysqli_close($conn);
          ?>
        </tbody>
      </table>
    </div>
    <div class="text-center">
      <button type="submit" class="btn btn-danger">Fshij Porosite</button>
      <button type="button" class="btn btn-primary" onclick="printTable()">Printo Tabelen</button>

    </div>
  </form>
</div>

<script>
  // Get the "check all" checkbox and all other checkboxes
  const checkAll = document.getElementById('checkAll');
  const checkboxes = document.querySelectorAll('input[type="checkbox"][name="delete[]"]');

  // Add a click event listener to the "check all" checkbox
  checkAll.addEventListener('click', function() {
    // Loop through all other checkboxes and check/uncheck them based on the "check all" checkbox status
    checkboxes.forEach(function(checkbox) {
      checkbox.checked = checkAll.checked;
    });
  });
  function printTable() {
  var table = document.getElementsByTagName('table')[0];
  var checkboxes = table.getElementsByTagName('input');
  for (var i = 0; i < checkboxes.length; i++) {
    checkboxes[i].style.display = 'none';
  }
  var tableHtml = table.outerHTML;
  var newWin = window.open('print.html', 'Print-Window');
  newWin.document.open();
  
  // Add header with company name
  newWin.document.write('<html><head><style>table, th, td { border: 1px solid black; border-collapse: collapse; }</style></head><body onload="window.print()"><h1>Ornela SHPK</h1>');
  
  // Add table
  newWin.document.write(tableHtml);
  
  // Add signature line
  newWin.document.write('<p style="position:absolute;bottom:0;right:0">_______________________<br>Nënshkrimi</p>');
  
  // Close document
  newWin.document.write('</body></html>');
  newWin.document.close();
  setTimeout(function(){newWin.close();},10);
  // Restore the checkboxes after printing
  for (var i = 0; i < checkboxes.length; i++) {
    checkboxes[i].style.display = 'block';
  }}

</script>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper-base.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
