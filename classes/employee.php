<?php
require_once './database/Database.php';
include_once './helper/Sanitize.php';

class Employee
{
  private $db;
  private $sanitize;

  public function __construct()
  {
    $this->db = new Database();
    $this->sanitize = new Sanitize();
  }

  // Insert data
  public function insert($data)
  {
    $name = $this->sanitize->sanitize($data['name']);
    $email = $this->sanitize->sanitize($data['email']);
    $phone = $this->sanitize->sanitize($data['phone']);

    if (empty($name) || empty($email) || empty($phone)) {
      return 'All fields are required';
    }

    $query = "INSERT INTO users (name, email, phone) VALUES ('$name', '$email', '$phone')";
    $result = $this->db->insert($query);
    if ($result) {
      $this->db->closeDB();
      return 'Data Inserted';
    } else {
      $this->db->closeDB();
      return 'Data Not Inserted';
    }
  }
  // Select or Read data
  public function select()
  {
    $query = "SELECT * FROM users";
    $result = $this->db->select($query);
    if ($result) {
      $this->db->closeDB();
      return $result;
    } else {
      $this->db->closeDB();
      return false;
    }
  }
  // Update data
  public function update($data)
  {
    $id = $data['id'];
    $name = $this->sanitize->sanitize($data['name']);
    $email = $this->sanitize->sanitize($data['email']);
    $phone = $this->sanitize->sanitize($data['phone']);

    if (empty($name) || empty($email) || empty($phone)) {
      return 'All fields are required';
    }

    $query = "UPDATE users SET name = '$name', email = '$email', phone = '$phone' WHERE id = $id";
    $result = $this->db->update($query);
    if ($result) {
      $this->db->closeDB();
      return 'Data Updated';
    } else {
      $this->db->closeDB();
      return 'Data Not Updated';
    }
  }

}