<?php
use App\Database;

$db = Database::getInstance()->getConnection();

$statement = $db->prepare( "SELECT * FROM notes WHERE note_id = :id" );
$statement->execute([
  ':id' => $id,
]);

$notes = $statement->fetch();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <a href="/">Home</a>
  <h1><?=$notes['title'];?></h1>
  <pre><?=$notes['content'];?></pre>
</body>
</html>
