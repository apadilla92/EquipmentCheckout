<?php
    require_once("dbinfo.php");
    $table = "";
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);
    
    session_start();
    if(isset($_POST["userButton"])){
        if(isset($_SESSION["userAuth"])){
            $_SESSION["userN"] = $username;
            header("Location: userMain.php");
        }else{
            $table = "users";
        }
    }elseif(isset($_POST["adminButton"])){
        if(isset($_SESSION["adminAuth"])){
            header("Location: adminMain.php");
        }else{
            $table = "admins";
        }
    }
    
    $sqlQuery=sprintf("select * from %s where username = \"%s\"",$table,$username);
    $result = mysqli_query($db_connection, $sqlQuery);
    if($result){
        $numRows = mysqli_num_rows($result);
        if($numRows == 0){
            echo "<script type='text/javascript'>alert('Invalid Username'); window.location='main.html';</script>";
        }else{
            $recordArray=mysqli_fetch_array($result,MYSQLI_ASSOC);
            if($password == $recordArray["password"]){
                if($table == "users"){
                    $_SESSION["userAuth"] = true;
                    $_SESSION["userN"] = $username;
                    header("Location: userMain.php");
                }
                else{
                    $_SESSION["adminAuth"] = true;
                    header("Location: adminMain.php");
                }
            }else{
                echo "<script type='text/javascript'>alert('Invalid Password'); window.location='main.html';</script>";
            }
        }
    }else{
        echo "<script type='text/javascript'>alert('Error obtaining records.'); window.location='main.html';</script>";
    }
?>