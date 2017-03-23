<?php
require("dbinfo.php");

if (isset($_POST['funcCall'])) {
  echo checkIfItemInDatabase(trim($_POST['funcCall']));
}else if(isset($_POST['funcCall1'])){
  echo json_encode(findQuantity($_POST['funcCall1']));
}else if(isset($_POST['funcCall2'])){
  echo updateItem($_POST['funcCall2']);
}else if(isset($_POST['funcCall3'])){
  echo removeItemFromDatabase($_POST['funcCall3']);
}else if(isset($_POST['funcCall4'])){
  echo generateInventoryTable();
}


function generatePage($body, $title="Example") {
    $page = <<<EOPAGE
<!doctype html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

        <script src="adminMain.js"></script>
        <link rel="stylesheet" type="text/css" href="adminMain.css" />
        <link href='https://fonts.googleapis.com/css?family=Righteous' rel='stylesheet' type='text/css'>
        <title>$title</title>
    </head>

    <body>
        <div class="jumbotron">
            <h1>Administration</h1>
        </div>
        $body
    </body>
</html>
EOPAGE;

    return $page;
}

function generateInventoryTable()
{
    $table = "items";
    $tableBody = "";

    $sqlQuery = sprintf("select * from %s", $table);
    $result = mysqli_query($GLOBALS['db_connection'], $sqlQuery);
	if ($result) {
		$numberOfRows = mysqli_num_rows($result);
 	 	if ($numberOfRows == 0) {
			$tableBody = "<h2>No entries exists in the table</h2>";
		} else {
			$tableBody = "<table id='inventoryTable' class='table table-bordered table-hover'><thead><tr><th>Image</th><th>Name</th><th>Quantity (available / total)</th><th>Users</th></tr></thead>";
			while ($recordArray = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		     	$name = $recordArray['name'];
				$img = base64_encode($recordArray['img']);
				$quantityAmount = $recordArray['quantityAmount'];
                $quantityTotal = $recordArray['quantityTotal'];
                $user = unserialize($recordArray['user']);

                $displayUsers = displayUserList($user);
				$tableBody .= "<tr><td><img src='data:image/jpeg;base64,$img' alt='No Image'/></td><td>$name</td><td>$quantityAmount / $quantityTotal </td><td>$displayUsers</td></tr>";
     		}
            $tableBody .= "</table>";

		}
		mysqli_free_result($result);
	}  else {
		$tableBody = "Retrieving records failed.".mysqli_error($GLOBALS['db_connection']);
	}

    return $tableBody;
}

function addItemToDataBase($itemName, $itemImage, $itemTotal)
{
    $sqlQuery = sprintf("insert into items (name, img, quantityAmount, quantityTotal) values ('%s', '%s', %s, %s)",
				$itemName, $itemImage, $itemTotal, $itemTotal);
	$result = mysqli_query($GLOBALS['db_connection'], $sqlQuery);
	if ($result) {
		return "<h1>The entry has been added to the database</h1>";
	} else {
		return "<h1>Inserting records failed.".mysqli_error($GLOBALS['db_connection'])."</h1>";
	}
}

function removeItemFromDatabase($itemToRemove)
{
  $sqlQuery = sprintf("delete from items where name = '%s'",$itemToRemove);
  $result = mysqli_query($GLOBALS['db_connection'], $sqlQuery);
  $numberOfRows = mysqli_affected_rows($result);
  if ($numberOfRows == 0) {
    return 0;
  }
  return 1;
}

function checkIfItemInDatabase($itemName){
  $sqlQuery = sprintf("select * from items where name='%s'",$itemName);

  $result = mysqli_query($GLOBALS['db_connection'], $sqlQuery);

  $numberOfRows = mysqli_num_rows($result);
  if($numberOfRows == 0){
    return 0;
  }

  return 1;
}

function findQuantity($itemName){
  $sqlQuery = sprintf("select * from items where name='%s'",$itemName);

  $result = mysqli_query($GLOBALS['db_connection'], $sqlQuery);
  $row = mysqli_fetch_array($result);

  $arr = array($row["quantityAmount"], $row["quantityTotal"]);
  return $arr;
}

function updateItem($argsArray){
  if($argsArray[3] == $argsArray[0]){
    $sqlQuery = sprintf("update items set name='%s', quantityTotal=%d, quantityAmount=%d where name='%s'",$argsArray[0], $argsArray[1], $argsArray[2], $argsArray[3]);

    $result = mysqli_query($GLOBALS['db_connection'], $sqlQuery);
  }
  else{
    $sqlQuery = sprintf("select * from items where name='%s'",$argsArray[3]);

    $result = mysqli_query($GLOBALS['db_connection'], $sqlQuery);
    $row = mysqli_fetch_array($result);

    $imageBlob = $row["img"];

    $sqlQuery = sprintf("delete from items where name='%s'", $argsArray[3]);
    mysqli_query($GLOBALS['db_connection'], $sqlQuery);
    $sqlQuery = sprintf("insert into items (name, img, quantityAmount, quantityTotal) values ('%s', '%s', %s, %s)",$argsArray[0], $imageBlob, $argsArray[2], $argsArray[1]);
    $result = mysqli_query($GLOBALS['db_connection'], $sqlQuery);
  }
  return $result;

}

function displayUserList($userList)
{
    if($userList == "" || sizeof($userList) == 0)
    {
        return "";
    }
    else
    {
        $nameList = "<p>";
        for($i = 0; $i < sizeof($userList); $i++)
        {
            $nameList .= $userList[$i]."<br/>";
        }
        $nameList .= "</p>";
        return $nameList;
    }
}

?>
