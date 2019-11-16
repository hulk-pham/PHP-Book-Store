<?php
session_start();
include_once("../provider/ContactProvider.php");
include_once("../provider/UserProvider.php");
if (!isset($_SESSION['user']))
  header("Location:../login.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $id = $_REQUEST['id'] ? $_REQUEST['id'] : "";

  if (isset($id)) {
    $contactProvider = new ContactProvider();
    $rs = $contactProvider->removeContact($id);

    if ($rs) header("Location:../index.php?success=Delete success");
    else header("Location:../index.php?error=Something went wrong");
  } else header("Location:../index.php?error=$error[0]");
} else header("Location:../index.php");
