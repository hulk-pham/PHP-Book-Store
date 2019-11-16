<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/Contact/provider/Provider.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/Contact/models/Users.php");
class ContactProvider extends Provider
{
  public function addNewContactOfUser($user_id, $data)
  {
    $name = $data['name'];
    $email = $data['email'];
    $phone = $data['phone'];
    $sql = "Insert into contact (name,email,phone,user_id) values (\"$name\",\"$email\",\"$phone\",$user_id) ";
    $result = $this->db->query($sql);
    return $result;
  }


  public function updateContact($id, $data)
  {

    $name = $data['name'];
    $email = $data['email'];
    $phone = $data['phone'];
    $sql = "update contact set name = \"$name\",email =\"$email\" ,phone = \"$phone\" where id=$id";
    $result = $this->db->query($sql);
    return $result;
  }


  public function removeContact($id)
  {
    $sql = "delete from contact where id=$id";
    $result = $this->db->query($sql);
    return $result;
  }

  public function getContactById($id)
  {
    $sql = "Select * from contact where id = '$id'";

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
    if (count($rs) > 0) return $rs[0];
    return null;
  }
}
