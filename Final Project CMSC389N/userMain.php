<!doctype html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
        <link href='https://fonts.googleapis.com/css?family=Righteous' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="userMain.css" type="text/css" />
	    <title>HTML TEMPLATE</title>
    </head>
	<body>
		<?php
			session_start();
			$con = mysql_connect("mysql3.gear.host", "equipments", "cmsc389nd@t@");
			mysql_select_db("equipments", $con);
			$sql = 'SELECT * FROM items';
			$value = mysql_query($sql, $con);
			$user = $_SESSION['userN'];
			if(!isset($_SESSION['sort'])){
				$_SESSION['sort'] = 'All';
				$sort3 = $_SESSION['sort'];
			} else {
				$sort3 = $_SESSION['sort'];
			}
			if(!isset($_SESSION['selectA'])){
				$_SESSION['selectA'] = 'All';
				$selectA = $_SESSION['selectA'];
			} else {
				$selectA = $_SESSION['selectA'];
			}

		?>
		<div class="jumbotron">
			<?php
				print "<p class='logoutButton'>$user <a href='main.html'>Logout</a><br /><a href='updateuser.php'> Change Password</a> </p>";
			?>

            <h1>Equipment Checkout</h1>
        </div>
		<div class="container">
			<form action="userConfirm.php" method="get">
				<?php


				$name ="";
				$img ="";
				//$qAmount = 0;
				$in = 0;


				print "<h1>Items Checked out by: $user</h1>";
				print "<table class='table table-bordered table-hover'><thead>";
					print "<tr>";
						print "<td>Name of Item</td>";
						print "<td>Photo</td>";
						print "<td>Amount</td>";
						print "<td>Check</td>";
					print "</tr></thead>";
				print "<div class='scrollit'>";
				while($row = mysql_fetch_assoc($value)) {
					$arrayU = unserialize($row['user']);
					$counter = 0;
					$count = 0;

					if(!empty($arrayU)){

						foreach($arrayU as $key){
							if($user == $key && $counter == 0){
								$in = 1;
								$count = 1;
								$counter++;
							} else if($user == $key && $counter > 0){
								$in = 1;
								$count = 2;
								$counter++;
							}

						}
						if($count == 1){
							$name = $row['name'];
							$img = $row['img'];
							$qAmount = 1;
							print "<tr>";
									print "<td>$name</td>";

									//print "<td><img src='base64_encode($img)' height='121' width='121'/></td>";
									print '<td><img src="data:image/jpeg;base64,'.base64_encode( $img ).' "/></td>';
									print "<td>$qAmount</td>";
									echo "<td><input type='checkbox' name='items[]' value='$name'/></td>";

							print "</tr>";
						}
						if($count == 2){
							$name = $row['name'];
							$img = $row['img'];

							print "<tr>";
									print "<td>$name</td>";

									//print "<td></td>";//<img src='base64_encode($img)' height='121' width='121'/>
									print '<td><img src="data:image/jpeg;base64,'.base64_encode( $img ).' "/></td>';
									print "<td>$counter</td>";
									echo "<td><input type='checkbox' name='items[]' value='$name'/></td>";
							print "</tr>";
						}

					}
				}
				if($count == 0 && $in == 0){
					print "<tr>";
					print "<td colspan='3'>Nothing Checked Out</td>";
					print "</tr>";

				}
				print "</div>";
				print "</table>";
				print "<input id='removeItemButton' class='btn btn-primary btn-lg' type='submit' name='remove' value='Return Item'/>";
				print "<h1>Items</h1>";
				print "<select name='fields' >
							<option value='All'"; if($selectA == "All"){print "selected='selected'";}else{print "";} print ">All Items</option>
							<option value='Only'"; if($selectA == "Only"){print "selected='selected'";}else{print "";} print ">Only available Items</option>
						</select>&nbsp";
				print "<input type='submit' value='Update'/><br /><br />";
				print "<table class='table table-bordered table-hover'><thead>";
					print "<tr>";
						print "<td>Name of Item</td>";
						print "<td>Photo</td>";
						print "<td>Amount Available</td>";
						print "<td>Total Amount</td>";
						print "<td>Check</td>";
					print "</tr></thead>";
				print "<div class='scrollit'>";
					$qAmountList = "quantityAmount >= 1";
					if(empty($sort3) || $sort3 == 'All'){
						$sql2 = 'SELECT * FROM items';
					} else{
						$sql2 = 'SELECT * FROM items WHERE '.$qAmountList.'';
					}
					$value1 = mysql_query($sql2, $con);
					while($row = mysql_fetch_assoc($value1)) {
						if($row['quantityAmount'] == 0 && ($sort3 == "All" || $sort3 == "")){
							print "<tr bgcolor='#d1c3c2'>";
							$n = $row['name'];
							print "<td>$n</td>";

							$g = $row['img'];
						   // print "<td><img src='base64_encode($g)' height='121' width='121'/></td>";
							print '<td><img src="data:image/jpeg;base64,'.base64_encode( $g ).'  "/></td>';
							$qA = $row['quantityAmount'];
							print "<td>$qA</td>";

							$qT = $row['quantityTotal'];
							print "<td>$qT</td>";

							print "<td> </td>";

						print "</tr>";
						} else if($sort3 == "Only"){

								print "<tr>";
								$n = $row['name'];
								print "<td>$n</td>";

								$g = $row['img'];
								//print "<td><img src='base64_encode($g)' height='121' width='121'/></td>";
								print '<td><img src="data:image/jpeg;base64,'.base64_encode( $g ).'  "/></td>';
								$qA = $row['quantityAmount'];
								print "<td>$qA</td>";

								$qT = $row['quantityTotal'];
								print "<td>$qT</td>";

								echo "<td><input type='checkbox' name='item[]' value='$n'/></td>";

								print "</tr>";
						} else {
						print "<tr>";
							$n = $row['name'];
							print "<td>$n</td>";

							$g = $row['img'];
							//print "<td><img src='base64_encode($g)' height='121' width='121'/></td>";
							print '<td><img src="data:image/jpeg;base64,'.base64_encode( $g ).'  "/></td>';
							$qA = $row['quantityAmount'];
							print "<td>$qA</td>";

							$qT = $row['quantityTotal'];
							print "<td>$qT</td>";

							echo "<td><input type='checkbox' name='item[]' value='$n'/></td>";

						print "</tr>";
						}
					}
					$_SESSION['sort'] = "";
				print "</div>";
				print "</table>";
				?>
				<input id="checkOutButton" class="btn btn-primary btn-lg" type="submit" name="check" value="Check Out"/>
				<br/>
				<br/>
			</form>
		</div>
    </body>
</html>
