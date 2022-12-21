<?php
use App\Database;

$db = Database::getInstance()->getConnection();

$query = $db->query( "SELECT * FROM notes ORDER BY note_id DESC" );
$notes = $query->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <a href="/new-note">Create new note</a>
  <ul>
    <?php foreach( $notes as $note ) : ?>
    <li><a href="/note/<?=$note['note_id'];?>"><?=$note['title'];?></a></li>
    <?php endforeach; ?>
  </ul>
</body>
</html>
