<?php
  require_once("dbinfo.php");

  if (isset($_POST['funcCall'])) {
    $itemName = trim($_POST['funcCall']);
    echo itemInDatabase(trim($_POST['funcCall']));
  }

  function itemInDatabase($itemName){
    $sqlQuery = sprintf("select * from items where name='%s'",$itemName);

    $result = mysqli_query($GLOBALS['db_connection'], $sqlQuery);

    $numberOfRows = mysqli_num_rows($result);
    if($numberOfRows === 0){
      return 0;
    }

    return 1;
  }

 ?>
