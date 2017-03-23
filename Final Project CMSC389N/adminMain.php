<?php
    require("adminSupport.php");
    $mainbody = "";

    $tableBody = generateInventoryTable();

    $mainbody = <<<body
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="container">
                <ul class="nav nav-tabs">
                    <li role="presentation" class="active"><a data-toggle="tab" href="#inventory">Inventory Management</a></li>
                    <li role="presentation"><a data-toggle="tab" href="#user">User Management</a></li>
                    <li role="presentation"><a data-toggle="tab" href="#statistics">Statistics</a></li>
                </ul>

                <div class="tab-content">
                    <div id="inventory" class="tab-pane fade in active">
                        <p>
                            <span id="table">$tableBody</span>
                        </p>
                        <p id='inventoryTableButtons'>
                            <input class="btn btn-default" type="button" id="addButton" value="Add New Item"/>
                            <input class="btn btn-default" type="button" id="updateButton" value="Update Item"/>
                            <input class="btn btn-default" type="button" id="removeButton" value="Remove Item"/>
                        </p>
                        <p>
                            <form class="form-group" id='addItemForm' action="addItemConfirmation.php" method="post" enctype="multipart/form-data" onsubmit="return addItemConfirm()">
                                <p>
                                    <strong>Name: </strong> <input id="itemName" class="form-control" type="text" name="itemName" required/>
                                </p>
                                <p>
                                    <strong>Quantity Total: </strong> <input id="itemTotal" class="form-control" type="number" min="0" name="itemTotal" required />
                                </p>
                                <p>
                                    <strong>Image File: </strong> <input id="itemImage" type="file" name="itemImage" required/>
                                </p><br/><br/>
                                <p>
                                    <input class="btn btn-default" type="button" id="cancelAddItem" value="Cancel Item Add" />
                                    <input class="btn btn-default" type="reset" value="Reset" />
                                    <input class="btn btn-default" type="submit" value="Submit" />
                                </p>
                            </form>
                            <form class="form-group" id='addItemConfirmationPage'>
                              <p>
                                <h1>The entry <span id='removeSpan1'></span> has been removed from the database</h1>
                              </p>
                              <p>
                                Item Name: <span id='removeSpan2'></span>
                              </p>
                              <p><input class="btn btn-default" type="button" id="backToAdmin1" value="Back To Administration" /></p>
                            </form>
                            <form class="form-group" id='removeItemForm' onsubmit="return removeItemConfirm()">
                                <p>
                                    Enter the name of the item you want to remove
                                </p>
                                <p>
                                    <strong>Name: </strong> <input id="removeItemName" class="form-control" type="text" name="removeItemName" required/>
                                </p>
                                <p>
                                    <input class="btn btn-default" type="button" id="cancelRemoveItem" value="Cancel Item Remove" />
                                    <input class="btn btn-default" type="submit" value="Submit" />
                                </p>
                            </form>
                            <form class="form-group" id='removeConfirmationPage'>
                              <p>
                                <h1>The entry <span id='removeSpan1'></span> has been removed from the database</h1>
                              </p>
                              <p>
                                Item Name: <span id='removeSpan2'></span>
                              </p>
                              <p><input class="btn btn-default" type="button" id="backToAdmin1" value="Back To Administration" /></p>
                            </form>
                            <form class="form-group" id='updateItemForm'>
                                <p>
                                    Enter the name of the item you want to remove
                                </p>
                                <p>
                                    <strong>Name: </strong> <input class="form-control" type="text" name="itemName" id="itemName1" required/>
                                </p>
                                <p>
                                    <input class="btn btn-default" type="button" id="cancelUpdateItem" value="Cancel Item Update" />
                                    <input class="btn btn-default" type="submit" value="Submit" />
                                </p>
                            </form>
                            <form class="form-group" id='itemExistsConfirmation'>
                              <h1>Entry: <span id="itemNameSpan1"></span> does not exist</h1>
                              <p>
                                Item Name: <span id="itemNameSpan2"></span>
                              </p>
                              <p><input class="btn btn-default" type="button" id="backToAdmin2" value="Back To Administration" /></p>

                            </form>
                            <form class="form-group" id="updateForm" >
                              <p><strong>Item Name:</strong></p>
                              <p><input class="form-control" type="text" name="itemName" id="itemName2"/></p>
                              <input type="hidden" name="advance" id="advance" value="Advance" />
                              <p>
                                <p><strong>Available Quantity: </strong></p>
                                <input class="btn btn-default" type="button" name="subtractQuantityButton" id="subtractQuantityAvailButton" value="-" />
                                &nbsp;&nbsp;<span id="availQuantityNum"></span>&nbsp;&nbsp;
                                <input class="btn btn-default" type="button" name="addQuantityButton" id="addQuantityAvailButton" value="+" />
                              </p>
                              <p>
                                <p><strong>Total Quantity: </strong></p>
                                <input class="btn btn-default" type="button" name="subtractQuantityButton" id="subtractQuantityButton" value="-" />
                                &nbsp;&nbsp;<span id="totalQuantityNum"></span>&nbsp;&nbsp;
                                <input class="btn btn-default" type="button" name="addQuantityButton" id="addQuantityButton" value="+" />
                              </p>

                              <input class="btn btn-default" type="button" id="updateFormButton" value="Update" onclick="return updateItemConfirm()"/>
                              <input class="btn btn-default" type="button" id="updateFormBackButton" value="Back" />
                            </form>
                            <form class="form-group" id="updateConfirmationPage">
                              <p><h1>Updates Summary</h1></p>
                              <p><table>
                                <tr class="blank_row">
                                  <td colspan="3"></td>
                                </tr>
                                <tr>
                                  <td><strong>Old item name: </strong><span id="oldItemName"></span></td>
                                  <td>&nbsp;&nbsp;&nbsp;&nbsp;<strong>New item name: </strong><span id="newItemName"></span></td>
                                </tr>
                                <tr class="blank_row">
                                  <td colspan="3"></td>
                                </tr>
                                <tr>
                                  <td><strong>Old available quantity: </strong><span id="oldAvailQuantity"></span>&nbsp;&nbsp;</td>
                                  <td>&nbsp;&nbsp;&nbsp;&nbsp;<strong>New available quantity: </strong><span id="newAvailQuantity"></span></td>
                                </tr>
                                <tr class="blank_row">
                                  <td colspan="3"></td>
                                </tr>
                                <tr>
                                  <td><strong>Old total quantity: </strong><span id="oldTotalQuantity"></span>&nbsp;&nbsp;</td>
                                  <td>&nbsp;&nbsp;&nbsp;&nbsp;<strong>New total quantity: </strong><span id="newTotalQuantity"></span></td>
                                </tr>
                                <tr class="blank_row">
                                  <td colspan="3"></td>
                                </tr>
                              </table></p>
                              <p><input class="btn btn-default" type="button" id="backToAdmin3" value="Back To Administration" /></p>
                            </form>
                        </p>
                    </div>
                    <div id="user" class="tab-pane fade">
                        <p>
                            <form action="userManagementRedirect.php" method="post">
                                <input type="submit" name="addButton" value="Add New User"><br><br>
                                <input type="submit" name="updateButton" value="Update User"><br><br>
                                <input type="submit" name="removeButton" value="Remove User"><br><br>
                            </form>
                        </p>
                    </div>
                    <div id="statistics" class="tab-pane fade">
                        <p>
                            Page under construction
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
body;


    echo generatePage($mainbody, "Administration Home Page");

  ?>
