$(document).ready(function(){
    //Initially hide all forms
    $('#addItemForm').hide();
    $('#removeItemForm').hide();
    $('#updateItemForm').hide();
    $('#itemExistsConfirmation').hide();
    $('#updateForm').hide();
    $('#updateConfirmationPage').hide();
    $('#removeConfirmationPage').hide();
    $('#addItemConfirmationPage').hide();

    var newTotalQuantity = -1;
    var oldTotalQuantity = -1;
    var newAvailQuantity = -1;
    var oldAvailQuantity = -1;
    var itemName;

    //Add form show/hide functions
    $('#backToAdmin1').click(function(){
      $.ajax({
        url: "adminSupport.php",
        data: {"funcCall4": name},
        type: "POST",
        success: function(response){
          $('#table').text("");
          $('#table').html(response);
          $('#addItemForm').hide();
          $('#removeItemForm').hide();
          $('#updateItemForm').hide();
          $('#itemExistsConfirmation').hide();
          $('#updateForm').hide();
          $('#updateConfirmationPage').hide();
          $('#removeConfirmationPage').hide();
          $('#inventoryTable').show();
          $('#inventoryTableButtons').show();
        }
      });
    });
    $('#backToAdmin2').click(function(){
      $.ajax({
        url: "adminSupport.php",
        data: {"funcCall4": name},
        type: "POST",
        success: function(response){
          $('#table').text("");
          $('#table').html(response);
          $('#addItemForm').hide();
          $('#removeItemForm').hide();
          $('#updateItemForm').hide();
          $('#itemExistsConfirmation').hide();
          $('#updateForm').hide();
          $('#updateConfirmationPage').hide();
          $('#removeConfirmationPage').hide();
          $('#inventoryTable').show();
          $('#inventoryTableButtons').show();
        }
      });
    });
    $('#backToAdmin3').click(function(){
      $.ajax({
        url: "adminSupport.php",
        data: {"funcCall4": name},
        type: "POST",
        success: function(response){
          $('#table').text("");
          $('#table').html(response);
          $('#addItemForm').hide();
          $('#removeItemForm').hide();
          $('#updateItemForm').hide();
          $('#itemExistsConfirmation').hide();
          $('#updateForm').hide();
          $('#updateConfirmationPage').hide();
          $('#removeConfirmationPage').hide();
          $('#inventoryTable').show();
          $('#inventoryTableButtons').show();
        }
      });
    });
    $('#addButton').click(function(){
        $('#addItemForm').show();
        $('#inventoryTable').hide();
        $('#inventoryTableButtons').hide();
        $('#itemExistsConfirmation').hide();
        $('#updateForm').hide();
        $('#updateConfirmationPage').hide();
    });

    $('#cancelAddItem').click(function(){
        $('#addItemForm').hide();
        $('#inventoryTable').show();
        $('#inventoryTableButtons').show();
        $('#itemExistsConfirmation').hide();
        $('#updateForm').hide();
        $('#updateConfirmationPage').hide();
    });

    //Remove form show/hide functions
    $('#removeButton').click(function(){
        $('#removeItemForm').show();
        $('#inventoryTable').hide();
        $('#inventoryTableButtons').hide();
        $('#itemExistsConfirmation').hide();
        $('#updateForm').hide();
        $('#updateConfirmationPage').hide();
    });

    $('#cancelRemoveItem').click(function(){
        $('#removeItemForm').hide();
        $('#inventoryTable').show();
        $('#inventoryTableButtons').show();
        $('#itemExistsConfirmation').hide();
        $('#updateForm').hide();
        $('#updateConfirmationPage').hide();
        $('#removeConfirmationPage').hide();
    });

    //Update form show/hide functions
       //Remove form show/hide functions
    $('#updateButton').click(function(){
        $('#updateItemForm').show();
        $('#inventoryTable').hide();
        $('#inventoryTableButtons').hide();
        $('#itemExistsConfirmation').hide();
        $('#updateForm').hide();
        $('#updateConfirmationPage').hide();
    });

    $('#cancelUpdateItem').click(function(){
        $('#updateItemForm').hide();
        $('#inventoryTable').show();
        $('#inventoryTableButtons').show();
        $('#itemExistsConfirmation').hide();
        $('#updateForm').hide();
        $('#updateConfirmationPage').hide();
    });

    $('#removeItemForm').submit(function(event){
      var name = $('#removeItemName').val();
      $.ajax({
        url: "adminSupport.php",
        data: {"funcCall": name},
        type: "POST",
        success: function(response){
          if(response == 0){
            $('#removeItemForm').hide();
            $('#itemExistsConfirmation').show();
            $('#itemNameSpan1').text(name);
            $('#itemNameSpan2').text(name);
          }
          else{
            $.ajax({
              url: "adminSupport.php",
              data: {"funcCall3": name},
              type: "POST",
              success: function(response){
                $('#removeSpan1').text(name);
                $('#removeSpan2').text(name);
                $('#removeItemForm').hide();
                $('#itemExistsConfirmation').hide();
                $('#removeConfirmationPage').show();
              }
            });
          }
        }
      });
      event.preventDefault();
    });

    $('#updateItemForm').submit(function(event){
      var name = $('#itemName1').val();
      $.ajax({
        url: "adminSupport.php",
        data: {"funcCall": name},
        type: "POST",
        success: function(response){
          if(response == 0){
            $('#updateItemForm').hide();
            $('#updateForm').hide();
            $('#itemExistsConfirmation').show();
            $('#itemNameSpan1').text(name);
            $('#itemNameSpan2').text(name);
          }
          else{
            $('#updateItemForm').hide();
            $('#itemExistsConfirmation').hide();
            $('#updateForm').show();
            itemName = name;
          }
        }
      });
      $('#itemName2').val(name);
      $.ajax({
        url: "adminSupport.php",
        data: {"funcCall1": name},
        type: "POST",
        success: function(response){
          var response = eval(response);
          oldTotalQuantity = Number(response[1]);
          newTotalQuantity = Number(response[1]);
          oldAvailQuantity = Number(response[0]);
          newAvailQuantity = Number(response[0]);

          $('#totalQuantityNum').text(response[1]);
          $('#availQuantityNum').text(response[0]);
        }
      });
      event.preventDefault();
    });

    $('#updateFormBackButton').click(function(){
        $('#updateItemForm').show();
        $('#inventoryTable').hide();
        $('#inventoryTableButtons').hide();
        $('#itemExistsConfirmation').hide();
        $('#updateForm').hide();
        $('#updateConfirmationPage').hide();
    });

    $('#updateBackButton').click(function(){
      $('#updateItemForm').show();
      $('#inventoryTable').hide();
      $('#inventoryTableButtons').hide();
      $('#itemExistsConfirmation').hide();
      $('#updateConfirmationPage').hide();
    });

    $('#addQuantityButton').click(function(){
      newTotalQuantity+=1;
      $('#totalQuantityNum').text(newTotalQuantity);
    });

    $('#subtractQuantityButton').click(function(){
      newTotalQuantity-=1;
      $('#totalQuantityNum').text(newTotalQuantity);

    });

    $('#addQuantityAvailButton').click(function(){
      newAvailQuantity+=1;
      $('#availQuantityNum').text(newAvailQuantity);
    });

    $('#subtractQuantityAvailButton').click(function(){
      newAvailQuantity-=1;
      $('#availQuantityNum').text(newAvailQuantity);
    });

    $('#updateFormButton').click(function(){
      var advance = $('#advance').val();
      var name = $('#itemName2').val();
      var quantity = $('#totalQuantityNum').text();
      var availQuantity = $('#availQuantityNum').text();
      if(advance == "Advance"){
        var arr = new Array();
        arr[0] = name;
        arr[1] = quantity;
        arr[2] = availQuantity
        arr[3] = itemName;
        $.ajax({
          url: "adminSupport.php",
          data: {"funcCall2": arr},
          type: "POST",
          success: function(response){
              $('#oldItemName').text(itemName);
              $('#newItemName').text(name);
              $('#oldTotalQuantity').text(oldTotalQuantity);
              $('#newTotalQuantity').text(quantity);
              $('#oldAvailQuantity').text(oldAvailQuantity);
              $('#newAvailQuantity').text(availQuantity);
              $('#updateForm').hide();
              $('#updateConfirmationPage').show();
          }
        });
      }
    });

});

function addItemConfirm()
{
    var itemName = document.getElementById('itemName').value;
    var itemTotal = document.getElementById('itemTotal').value;

    var confirmMessage = "Are you sure you want to add this item?\nName: " + itemName + "\nQuantity: " + itemTotal;
    var accepted = confirm(confirmMessage);

    if(accepted)
    {
        return true;
    }
    else
    {
        return false;
    }
}

function removeItemConfirm()
{
    var itemName = document.getElementById('removeItemName').value;

    var confirmMessage = "Are you sure you want to remove this item?\n" + itemName;

    var accepted = confirm(confirmMessage);
    if(accepted)
    {
        return true;
    }
    else
    {
        return false;
    }
}

function updateItemConfirm(){
  var itemName = document.getElementById('itemName2').value;
  var quantity = document.getElementById('totalQuantityNum').innerHTML;
  var availQuantity = document.getElementById('availQuantityNum').innerHTML;
  var advance = document.getElementById('advance');

  if(quantity < 0){
    advance.value = "Do not advance";
    alert("Total quantity cannot be less than 0");
    return false;
  }
  else if(availQuantity < 0){
    advance.value = "Do not advance";
    alert("Available quantity cannot be less than 0");
    return false;
  }
  else if(availQuantity > quantity){
    advance.value = "Do not advance";
    alert("Total quantity cannot be less than available quantity");
    return false;
  }
  else{
    var confirmMessage = "Are you sure you want to update this item?\nItem Name: " + itemName + "\nTotal Quantity: " + quantity + "\nAvailable Quantity: " + availQuantity;

    var accepted = confirm(confirmMessage);
    if(accepted)
    {
        advance.value = "Advance";
        return true;
    }
    else
    {
        advance.value = "Do Not Advance";
        return false;
    }
  }
}
