<?php

class connectDB
{
    public function connect()
    {
        $dbhost = "localhost";
        $dbuser = "root";
        $dbpassword = "";
        $db = "db_homework_app";
        $conn = mysqli_connect($dbhost, $dbuser, $dbpassword, $db) or
            die("Connect failed %s\n" . $conn->erro);
        mysqli_query($conn, "set character set utf8");
        return $conn;
    }
}
?>