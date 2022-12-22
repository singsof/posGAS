<?php


use App\Database as Database;
$Db = new Database();





?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title></title>
</head>

<body>

  <?php print_r($Db->returnNNN()) ?>

  <?php echo  $_ENV['APP_NAME'] ?>
  <a href="/new-note">Create new note</a>
  <ul>

  </ul>
</body>

</html>