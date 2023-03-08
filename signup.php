<?php
require "DataBase.php";
$db = new DataBase();
if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['fullname']) && isset($_POST['tel']) && isset($_POST['email'])) {
    if ($db->dbConnect()) {
        if ($db->signUp("user",$_POST['username'], $_POST['password'],$_POST['fullname'],$_POST['tel'], $_POST['email'])) {
            echo "User registration completed";
        } else echo "Registration Failed";
    } else echo "Error: Database connection";
} else echo "All fields are required";
?>
