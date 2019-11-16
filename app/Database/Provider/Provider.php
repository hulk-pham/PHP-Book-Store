<?php
// namespace Contact\provider;
include_once($_SERVER['DOCUMENT_ROOT']."/Contact/provider/Database.php");
abstract class Provider
{
  public $db = null;

  public function __construct()
  {
    $database  = new Database();
    $this->db = $database->getConnect();
  }

  public function __destruct()
  {
    // var_dump("Close");
    // var_dump($this->db);
    if ($this->db)
      $this->db->close();
  }
}
