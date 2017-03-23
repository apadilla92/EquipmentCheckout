<?php
    require_once("dbinfo.php");


    if(isset($_POST['submit'])){
        //connect to the db
        $db = connectToDB($host, $user, $password, $database);
        $table = "users";

        $name = trim($_POST['id']);

        $sqlQuery = sprintf("delete from $table where username = '$name'");
        $result = mysqli_query($db, $sqlQuery);

        if ($result){
            $body = "Deleting $name was successful";
        }else{
			$body = "Deletion failed.".mysqli_error($db);
        }
    } else{


    $body = <<<EOBODY
        <form action="" method="post">
            Enter the user's directory ID: <input type="text" name="id" required>

            <input type="submit" name="submit" value="Delete User">
        </form>
EOBODY;
	}
    echo $body;
?>
