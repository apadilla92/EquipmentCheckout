<?php
    require("adminSupport.php");
    
    $itemName = trim($_POST['itemName']);
    //$itemImageName = trim($_POST['itemImageName']);
    $itemTotal = trim($_POST['itemTotal']);
    
    $imgFile = $_FILES['itemImage']['tmp_name'];
    $imgName = $_FILES['itemImage']['name'];
    $queryResponse = "";
    
    if(isset($imgFile))
    {
        $img = addslashes(file_get_contents($_FILES['itemImage']['tmp_name']));
        $imgName = $_FILES['itemImage']['name'];
        $imgSize = getimagesize($_FILES['itemImage']['tmp_name']);
        
        if(!$imgSize)
        {
            $queryResponse += "<h1>The file chosen was not an image</h1>";
        }
        else
        {
            $queryResponse = addItemToDataBase($itemName, $img, $itemTotal);
        }
    }
    
    
    $body = <<<body
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="container">
                    <div class="inner">
                        $queryResponse
                        <p>
                            Item Name: $itemName
                        </p>
                        <p>
                            Image File Name: $imgName
                        </p>
                        <p>
                            Item Quantity: $itemTotal
                        </p>
                        <a href="adminMain.php" class="btn btn-default">Back to Administration</a>
                    </div>
                </div>
            </div>
        </div>

body;

    echo generatePage($body);
?>