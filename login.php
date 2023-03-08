<?php
require "DataBase.php";
$db = new DataBase();
if (isset($_POST['username']) && isset($_POST['password'])) {
    if ($db->dbConnect()) {
//        if ($db->logIn("user", $_POST['username'], $_POST['password'])) {
//            echo "User login completed";
//        } else echo "Username or Password incorrect";
        $getdb = 0;
        $getdb = $db->logIn("user", $_POST['username'], $_POST['password']);
        if ($getdb != 0) {
            if ($getdb == 1){
                echo "Admin login completed";
            }elseif ($getdb == 2){
                echo "User login completed";
            }elseif ($getdb == 3){
                echo "Market login completed";
            }
        } else echo "Username or Password incorrect";
    } else echo "Error: Database connection";
} else echo "All fields are required";
?>
