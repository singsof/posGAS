<?php
use App\Database;

$db = Database::getInstance()->getConnection();

$title = filter_input( INPUT_POST, 'title' );
$note = filter_input( INPUT_POST, 'note' );

$statement = $db->prepare( "INSERT INTO notes (title, content) VALUES (:title, :content)" );
$status = $statement->execute([
  ':title' => $title,
  ':content' => $note,
]);

if ( $status ) {
  $insert_id = $db->lastInsertId();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <?php if ( $status ) : ?>
  Note saved. <a href="/note/<?=$insert_id?>">View</a>
  <?php else : ?>
  Note not saved. <a href="/">Home</a>
  <?php endif; ?>
</body>
</html>
