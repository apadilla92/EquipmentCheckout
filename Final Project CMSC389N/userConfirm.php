<?php
session_start();
$con = mysql_connect("mysql3.gear.host", "equipments", "cmsc389nd@t@");
mysql_select_db("equipments", $con);
$sort= $_GET['fields'];
if(isset($_GET['logout'])){
	session_unset();
	header("Location: main.html");
}elseif(isset($_GET['check'])){
    $sql = 'SELECT * FROM items';
    $value = mysql_query($sql, $con);

    $name = $_GET['item'];
    $array = array();
    foreach ($name as $item){
        array_push($array,$item);
    }

    while($row = mysql_fetch_assoc($value)) {
        foreach ($array as $key){
            if($key == $row['name']){
                //$img = $row['img'];
                $qAmount = $row['quantityAmount'];
                $qAmount--;
                $qTotal = $row['quantityTotal'];
                $user = unserialize($row['user']);
                if(empty($user)){
                    $user = array();
                }
                array_push($user, $_SESSION['userN']);
                $userNew = serialize($user);
                
                $sql1 = "UPDATE items SET quantityAmount='$qAmount', quantityTotal='$qTotal', user='$userNew'
                WHERE name='$key'";
                
                mysql_query($sql1, $con);
                
            }
        }   
    }

	header('Location: userMain.php');	
}elseif(isset($_GET['remove'])){
	$sql = 'SELECT * FROM items';
    $value = mysql_query($sql, $con);

    $name = $_GET['items'];
    $array = array();
    foreach ($name as $item){
        array_push($array,$item);
    }

    while($row = mysql_fetch_assoc($value)) {
        foreach ($array as $key){
            if($key == $row['name']){
                //$img = $row['img'];
                $qAmount = $row['quantityAmount'];
                $qAmount++;
                $qTotal = $row['quantityTotal'];
                $user = unserialize($row['user']);
				$i = 0;
				foreach($user as $key){
					print"Before $key\n";
				}
				foreach($user as $key){
					if($_SESSION['userN'] == $key){
						unset($user[$i]);
						break;
					}
					$i++;
				}
				foreach($user as $key){
					print"After $key\n";
				}
                //array_push($user, $_SESSION['userN']);
                $userNew = serialize($user);
                $key1 = $row['name'];
                $sql1 = "UPDATE items SET quantityAmount='$qAmount', user='$userNew'
                WHERE name='$key1'";
                
                mysql_query($sql1, $con);
                
            }
        }   
    }

	header('Location: userMain.php');


}else{

    $sort = $_GET['fields'];

    if($sort == 'All'){

        $_SESSION['sort'] = "All";
        $_SESSION['selectA'] = "All";
    } else {//if($sort == 'Only'){

        $_SESSION['sort'] = "Only";
		$_SESSION['selectA'] = "Only";
    }

    header('Location: userMain.php');	
}
?>