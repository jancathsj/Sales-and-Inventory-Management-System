/*search item
function search(){
  var option = $('#sort').find(":selected").val();
  var input = $('#searchItem').val();
  /*
  $.ajax({
      type: "POST",
      url: "search_sort.php",
      data: {
          search: input,
          sort: option
      },
      success: function(data) {
          $("#display").html(data);
      }
  });

  const $select = document.querySelector('#categ');
  $select.value = 'All';
  sort();
} */

/*function search() {
  var input = $('#searchItem').val();

  if (event.keyCode === 13) {
    event.preventDefault();
    let item = prompt("How many?", 1);

    if (item != null) {
      $.ajax({
        type: "POST",
        url: "searchSort.php",
        data: { search: input },
        success: function(data) {
            $("#display").html(data);
        }
      });
    }
  }
}*/

/*sort and category item
function sort(){
  var option = $('#sort').find(":selected").val();
  var categOption = $('#categ').find(":selected").val();
  var input = $('#searchItem').val();

  sessionStorage.setItem("selectedOption", option);
  var optionValue = $(this).selectedIndex;
  $.ajax({
      type: "POST",
      url: "searchSort.php",
      data: {
          selected: option,
          categSort: categOption,
          search: input
      },
      success: function(data) { 
          $("#display").html(data);
      }
  });

}*/

//change qty
function changeQty(getID, getQty) {
    var dataString = "action=update&itemID="+getID+"&qty="+getQty;
  
    $.ajax({
      type: "GET",
      url: "updateItem.php",
      data: dataString,
      success: function(data) {
        $("#itemTotal-"+getID).html(data);
        $("#update").innerHTML("Item quantity update.");
        totalPrice();
      }
    });
  
    return false;
}

//update total price
function totalPrice() {
    var dataString = "action=total";
  
    $.ajax({
      type: "GET",
      url: "updateItem.php",
      data: dataString,
      success: function(data){
        $("#total").html(data);
        $("#totalOrder").val(data);
      }
    });
}

//calculateChange
function calculateChange(money) {
    var change = money - document.getElementById("totalOrder").value;
    document.getElementById("change").value = change.toFixed(2);

    if (change < 0) {
        document.getElementById('pay').disabled = true;
    } else {
        document.getElementById('pay').disabled = false;
    }
}

function checkStock(input, stock, item) {
  var qtyInput = document.getElementById('qty-'+item);

  if (input > stock || input.length > stock.length) {
    //qtyInput.html = stock;
    qtyInput.value = stock;
  }

  if (input.keyCode === 13) {
    input.preventDefault();
    document.getElementById('addItem').click();
  }
}

