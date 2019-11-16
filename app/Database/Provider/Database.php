<?php
// namespace Contact\provider;
class Database
{
  private $connect = null;

  public function getConnect()
  {
    if ($this->connect == null) {
      $this->connect = new mysqli('localhost', 'root', '', 'contact');
      $this->connect->set_charset("utf8");
      if ($this->connect->connect_error) throw new Exception("Connection fail");
    }
    return $this->connect;
  }
}
