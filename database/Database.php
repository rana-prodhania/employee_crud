<?php
require_once './config/config.php';

class Database
{
  private $host = DB_HOST;
  private $user = DB_USER;
  private $pass = DB_PASS;
  private $dbname = DB_NAME;

  private $conn;
  private $error;

  public function __construct()
  {
    $this->connectDB();
  }

  // Connect to database
  private function connectDB()
  {
    $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->dbname);
    if (!$this->conn) {
      $this->error = "Connection failed: " . $this->conn->connect_error;
      return false;
    }
  }

  // Insert data
  public function insert($query)
  {
    $insert_row = $this->conn->query($query) or
      die($this->conn->error . __LINE__);
    if ($insert_row) {
      return $insert_row;
    } else {
      return false;
    }
  }

  // Select or Read data
  public function select($query)
  {
    $select_row = $this->conn->query($query) or
      die($this->conn->error . __LINE__);
    if ($select_row) {
      return $select_row;
    } else {
      return false;
    }
  }

  // Update data
  public function update($query)
  {
    $update_row = $this->conn->query($query) or
      die($this->conn->error . __LINE__);
    if ($update_row) {
      return $update_row;
    } else {
      return false;
    }
  }

  // Close connection
  public function closeDB()
  {
    $this->conn->close();
  }

}