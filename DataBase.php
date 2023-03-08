<?php
require "DataBaseConfig.php";

class DataBase
{
    public $connect;
    public $data;
    private $sql;
    protected $servername;
    protected $username;
    protected $password;
    protected $databasename;

    public function __construct()
    {
        $this->connect = null;
        $this->data = null;
        $this->sql = null;
        $dbc = new DataBaseConfig();
        $this->servername = $dbc->servername;
        $this->username = $dbc->username;
        $this->password = $dbc->password;
        $this->databasename = $dbc->databasename;
    }

    function dbConnect()
    {
        $this->connect = mysqli_connect($this->servername, $this->username, $this->password, $this->databasename);
        return $this->connect;
    }

    function prepareData($data)
    {
        return mysqli_real_escape_string($this->connect, stripslashes(htmlspecialchars($data)));
    }

    function logIn($table, $username, $password) : int
    {
        $username = $this->prepareData($username);
        $password = $this->prepareData($password);
        //$password = $this->prepareData($password, PASSWORD_DEFAULT);
        //$this->sql = "select * from " . $table . " where username = '" . $username . "'";
        $sql = "SELECT * 
                FROM user,user_role
                WHERE username = '$username'AND password = '$password' AND user.role_id=user_role.role_id";
        //$result = mysqli_query($this->connect, $this->sql);
        $connect=mysqli_connect("localhost","root","","gift4you");
        $result = mysqli_query($connect,$sql);
        //$row = mysqli_fetch_assoc($result);
        if ($result &&  mysqli_num_rows($result) > 0) {
            //$dbusername = $row['username'];
            //$dbpassword = $row['password'];
            $row = mysqli_fetch_assoc($result);
            //if ($dbusername == $username && password_verify($password, $dbpassword)) {
             //   $login = true;
            //} else $login = false;
            if ($row != 0){
                if ($row['role_id'] == 1){
                    $login = 1;
                }elseif ($row['role_id'] == 2){
                    $login = 2;
                }elseif ($row['role_id'] == 3){
                    $login = 3;
                }
            }else{
                $login = 0;
            }
        } else $login = 0;

        return $login;
    }

    function signUp($table, $username, $password,$fullname, $tel, $email)
    {
        $username = $this->prepareData($username);
        $password = $this->prepareData($password);
        $fullname = $this->prepareData($fullname);
        $tel = $this->prepareData($tel);
        $email = $this->prepareData($email);
        //$password = password_hash($password, PASSWORD_DEFAULT);
        $this->sql =
            "INSERT INTO " . $table . " (username, password, fullname, tel, email) VALUES ('" . $username  . "','" . $password . "','" . $fullname . "','" . $tel . "','" . $email ."')";
        if (mysqli_query($this->connect, $this->sql)) {
            return true;
        } else return false;
    }

}

?>
