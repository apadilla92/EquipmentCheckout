<?php
   $host = "mysql3.gear.host";
   $user = "equipments";
   $password = "cmsc389nd@t@";
   $database = "equipments";
   $db_connection = new mysqli($host, $user, $password, $database);

   if ($db_connection->connect_error) {
       die($db_connection->connect_error);
   }

   function connectToDB($host, $user, $password, $database) {
       $db = mysqli_connect($host, $user, $password, $database);
       if (mysqli_connect_errno()) {
           echo "Connect failed.\n".mysqli_connect_error();
           exit();
       }
       return $db;
   }
?>