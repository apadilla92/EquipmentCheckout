<?php
    require_once("dbinfo.php");


    if (isset($_POST['submit'])){
        //connect to the db
        $db = connectToDB($host, $user, $password, $database);
        $table = "users";
        $pass = "terps";

        $name = trim($_POST['id']);

        $sqlQuery = sprintf("insert into $table (username, password) values ('%s', '%s')", $name, $pass);
        $result = mysqli_query($db, $sqlQuery);

        if ($result){
            $body = "Adding $name was successful";
        }else{
			$body = "Add failed.".mysqli_error($db);
        }
    }else{

    $body = <<<EOBODY
        <form action="" method="post">
            Enter the user's directory ID: <input type="text" name="id" required>

            <input type="submit" name="submit" value="Submit User">
        </form>

EOBODY;
	}
    echo $body;
?>
