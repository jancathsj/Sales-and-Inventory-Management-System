function fill(Value) {
    $('#search').val(Value);
    $('#display').hide();
 }


$(document).ready(function(){
        $("#search").keyup(function() {
        var input = $(this).val();
  
            $.ajax({
                type: "POST",
                url: "search_sort.php",
                data: {
                    search: input
                },
                success: function(data) {
                    $("#display").html(data);
                }
            });
  
    });

    $("#sort").change(function(){
        var option = $(this).find(":selected").val();
        sessionStorage.setItem("selectedOption", option);
        var optionValue = $(this).selectedIndex;
        $.ajax({
            type: "POST",
            url: "search_sort.php",
            data: {
                selected: option
            },
            success: function(data) { 
                $("#display").html(data);
            }
        });
        
    });

    //$('#sort').find('option[value='+sessionStorage.getItem('selectedOption')+']').attr('selected','selected');
    $("#categ").change(function(){
        var categOption = $(this).find(":selected").val();
        $.ajax({
            type: "POST",
            url: "search_sort.php",
            data: {
                category: categOption
            },
            success: function(data) { 
                $("#display").html(data);
            }
        });
        
    });
});


function checkdelete(){
return confirm('Are you sure you want to delete this record?');
}

function togglePopup(){
	document.getElementById("popup-1").classList.toggle("active");
}
