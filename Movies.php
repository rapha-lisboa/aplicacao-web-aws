<?php include "../inc/dbinfo.inc"; ?>
<html>
<body>
<h1> Add a Movie</h1>
<?php

  /* Connect to MySQL and select the database. */
  $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);

  if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();

  $database = mysqli_select_db($connection, DB_DATABASE);

  /* Ensure that the MOVIES table exists. */
  VerifyMoviesTable($connection, DB_DATABASE);

  /* If input fields are populated, add a row to the MOVIES table. */
  $movie_name = htmlentities($_POST['NAME']);
  $movie_actor = htmlentities($_POST['ACTOR']);
  $movie_budget = htmlentities($_POST['BUDGET']);
  $movie_rate = htmlentities($_POST['RATE']);

  if (strlen($movie_name) && strlen($movie_actor) && strlen((string)$movie_budget)) {
    AddMovies($connection, $movie_name, $movie_actor, $movie_budget, $movie_rate);
  }
?>

<!-- Input form -->
<form action="<?PHP echo $_SERVER['SCRIPT_NAME'] ?>" method="POST">
  <table border="0">
    <tr>
      <td>NAME</td>
      <td>ACTOR</td>
      <td>BUDGET</td>
      <td>RATE</td>
    </tr>
    <tr>
      <td>
        <input type="text" name="NAME" maxlength="45" size="30" />
      </td>
      <td>
        <input type="text" name="ACTOR" maxlength="90" size="60" />
      </td>
      <td>
        <input type="number" name="BUDGET">
      </td>
      <td>
        <input type="radio" name="RATE" value="Good" id="GOOD">
          <label for="GOOD"> Good </label><br>
        <input type="radio" name="RATE" value="Bad" id="BAD">
          <label for="BAD"> Bad </label>
      </td>
      <td>
        <input type="submit" value="Add Data" />
      </td>
    </tr>
  </table>
</form>

<!-- Display table data. -->
<table border="1" cellpadding="2" cellspacing="2">
  <tr>
    <td>ID</td>
    <td>NAME</td>
    <td>ACTOR</td>
    <td>BUDGET</td>
    <td>RATE</td>
  </tr>

<?php

$result = mysqli_query($connection, "SELECT * FROM MOVIES");

while($query_data = mysqli_fetch_row($result)) {
  echo "<tr>";
  echo "<td>",$query_data[0], "</td>",
       "<td>",$query_data[1], "</td>",
       "<td>",$query_data[2], "</td>",
       "<td>",$query_data[3], "</td>",
       "<td>",$query_data[4], "</td>";
  echo "</tr>";
}
?>

</table>

<!-- Clean up. -->
<?php

  mysqli_free_result($result);
  mysqli_close($connection);

?>

</body>
</html>


<?php

/* Add an movie to the table. */
function AddMovies($connection, $name, $actor, $budget, $rate) {
   $n = mysqli_real_escape_string($connection, $name);
   $a = mysqli_real_escape_string($connection, $actor);
   $b = mysqli_real_escape_string($connection, $budget);
   $r = ($rate === 'Good') ? 'Good' : 'Bad';

   $query = "INSERT INTO MOVIES (NAME, ACTOR, BUDGET, RATE) VALUES ('$n', '$a', '$b', '$r');";

   if(!mysqli_query($connection, $query)) echo("<p>Error adding movie data.</p>");
}

/* Check whether the table exists and, if not, create it. */
function VerifyMoviesTable($connection, $dbName) {
  if(!TableExists("MOVIES", $connection, $dbName))
  {
     $query = "CREATE TABLE MOVIES (
         ID int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
         NAME VARCHAR(45),
         ACTOR VARCHAR(90),
         BUDGET int,
         RATE ENUM('Good', 'Bad'),
       )";

     if(!mysqli_query($connection, $query)) echo("<p>Error creating table.</p>");
  }
}

/* Check for the existence of a table. */
function TableExists($tableName, $connection, $dbName) {
  $t = mysqli_real_escape_string($connection, $tableName);
  $d = mysqli_real_escape_string($connection, $dbName);

  $checktable = mysqli_query($connection,
      "SELECT TABLE_NAME FROM information_schema.TABLES WHERE TABLE_NAME = '$t' AND TABLE_SCHEMA = '$d'");

  if(mysqli_num_rows($checktable) > 0) return true;

  return false;
}
?>