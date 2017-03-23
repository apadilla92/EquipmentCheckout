<?php
    //require_once("support.php");
    
    $body = "";
    $topPart = <<<EOBODY
    
    <h1>User Management</h1>
    <form action="userManagementRedirect.php" method="post">
        <input type="submit" name="addButton" value="Add User"><br><br>
        <input type="submit" name="updateButton" value="Update User"><br><br>
        <input type="submit" name="removeButton" value="Remove User"><br><br>
        
    </form>
EOBODY;

    $body = $body.$topPart;
     
    //$page = generatePage($body);
    
    echo $body;
?>