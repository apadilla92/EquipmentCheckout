<?php
    require("adminSupport.php");
    
    
    $itemToRemove  = trim($_POST['removeItemName']);
    
    $queryResponse = removeItemFromDatabase($itemToRemove);
    
     $body = <<<body
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="container">
                    <div class="inner">
                        $queryResponse
                        <p>
                            Item Name: $itemToRemove
                        </p>
                        <a href="adminMain.php" class="btn btn-default">Back to Administration</a>
                    </div>
                </div>
            </div>
        </div>

body;

    echo generatePage($body);
?>