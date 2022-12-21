<?php
namespace App;

use PDO;
use PDOException;

class Database {
  private static $instance = null;
  private $connection;

  private function __construct() {
    $db_path = __DIR__ . "/../db/main.db";

    try {
      $this->connection = new PDO( "sqlite:" . $db_path );
      $this->createTables();
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }

  public static function getInstance() {
    if( !self::$instance ) {
      self::$instance = new Database();
    }

    return self::$instance;
  }

  public function getConnection() {
    return $this->connection;
  }

  private function createTables() {
    $this->connection->exec("CREATE TABLE IF NOT EXISTS notes (
      note_id INTEGER PRIMARY KEY,
      title VARCHAR(255) NOT NULL,
      content TEXT,
      timestamp TEXT
    )");
  }
}
