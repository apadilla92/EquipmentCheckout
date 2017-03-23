<?php
    //require_once("support.php");
    //require_once("dbinfo.php");
    
    if (isset($_POST['addButton'])){
        header("Location: addUser.php");
    }
    if (isset($_POST['updateButton'])){
        header("Location: updateUser.php");
    }
    if (isset($_POST['removeButton'])){
        header("Location: removeUser.php");
    }
?>