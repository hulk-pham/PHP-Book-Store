<?php
// var_dump($_SERVER);
include_once($_SERVER['DOCUMENT_ROOT'] . "/Contact/provider/Provider.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/Contact/models/Contact.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/Contact/models/Users.php");
// namespace Contact\provider;

// use \Contact\provider\Provider;

class UserProvider extends Provider
{

  public function createUser($id, $username, $password, $email)
  {
    $sql = "Insert into users (id,username, password, email) value ('$id', '$username', '$password', '$email')";

    $result = $this->db->query($sql);
  }

  public function getUserById($id)
  {
    $sql = "Select * from users where id = '$id'";

    $result = $this->db->query($sql);
    $rs = [];
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        array_push($rs, new Users(
          $row["id"],
          $row["username"],
          $row["password"],
          $row["email"]
        ));
      }
    }
    if (count($rs) > 0) return $rs[0];
    return null;
  }

  public function getUserByUsername($name)
  {
    $sql = "Select * from users where username = '$name'";

    $result = $this->db->query($sql);
    $rs = [];
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {

        array_push($rs, new Users(
          $row["id"],
          $row["username"],
          $row["password"],
          $row["email"]
        ));
      }
    }
    if (count($rs) > 0) return $rs[0];
    return null;
  }

  public function getContactOfUser($userId)
  {
    $sql = "Select * from contact where user_id = '$userId'";

    $result = $this->db->query($sql);
    $rs = [];
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        array_push($rs, new Contact(
          $row["id"],
          $row["name"],
          $row["phone"],
          $row["email"]
        ));
      }
    }
    return $rs;
  }

  public function getContactWithCondition($userId, $condition)
  {
    // SELECT * FROM `contact` WHERE `user_id` = 1 AND (name like "%a%")
    $sql = "Select * from contact where user_id = '$userId'";
    if (!empty($condition))
      $sql .= " and ($condition)";
    $sql .= " order by name,phone ";

    $result = $this->db->query($sql);
    $rs = [];
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        array_push($rs, new Contact(
          $row["id"],
          $row["name"],
          $row["phone"],
          $row["email"]
        ));
      }
    }
    return $rs;
  }
}
