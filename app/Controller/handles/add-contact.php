<?php
session_start();
include_once("../provider/ContactProvider.php");
include_once("../provider/UserProvider.php");
if (!isset($_SESSION['user']))
  header("Location:../login.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_REQUEST['name'] ? $_REQUEST['name'] : "";
  $email = $_REQUEST['email'] ? $_REQUEST['email'] : "";
  $phone = $_REQUEST['phone'] ? $_REQUEST['phone'] : "";
  //VALIDATE DATA
  $userProvider = new UserProvider();

  $user = $userProvider->getUserById($_SESSION['user']['id']);

  $error = [];
  if (empty($name)) $error[] = "Name must be not empty";
  if (!preg_match("/^[0-9+()]{9,12}$/", $phone)) $error[] = "Phone number is invalid";
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $error[] = "Email is invalid";

  if (count($error) == 0) {
    $contactProvider = new ContactProvider();
    $rs = $contactProvider->addNewContactOfUser($user->id, [
      'name' => $name,
      'email' => $email,
      'phone' => $phone
    ]);

    if ($rs) header("Location:../index.php?success=Add success");
    else header("Location:../index.php?error=Something went wrong");
  } else header("Location:../index.php?error=$error[0]");
} else header("Location:../index.php");
