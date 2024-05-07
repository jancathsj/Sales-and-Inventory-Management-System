function notif(trans, ID, transTotal){
    var num = trans +""+ID;
    var quant = $("#quant"+num).val();
    //var ID = $("#itemID").val();
    //var trans = $("#transID").val();
    var cost = $("#itemCost"+num).val();
    //alert(quant + " id: " + ID + " trans: " + trans);
        $.ajax({
            type: "POST",
            url: "pending2.php",
            data: {
                changeQuantity: quant,
                cost: cost,
                itemID: ID,
                transID: trans
            },
            success: function(data) { 
                $("#transTotal"+trans).html(data);
            }
        });
        document.getElementById("total"+num).innerHTML = cost*quant;

        //document.getElementById("transTotal"+trans).innerHTML = transTotal;
}

function notif1(trans, ID){
    var num = trans +""+ID;
    var quant = $("#deliQuant"+num).val();
    var cost = $("#deliCost"+num).val();
    //var ID = $("#deliItemID").val();
    //var trans = $("#deliTransID").val();
    //alert(quant + " id: " + ID + " trans: " + trans);
        $.ajax({
            type: "POST",
            url: "pending2.php",
            data: {
                deliQuant: quant,
                deliCost: cost,
                deliItemID: ID,
                deliTransID: trans
            },
            success: function(data) { 
                $("#transTotal"+trans).html(data);
            }
        });
    document.getElementById("total"+num).innerHTML = cost*quant;
}


function fill(Value) {
    $('#search').val(Value);
    $('#display').hide();
 }

function add(){
    alert("found i");
    $.ajax({
        type: "POST",
        url: "addpending.php",
        data: {
            pending_ItemID: '<?php echo $_SESSION["pending_ItemID"]?>'
        },
        success: function(data) {  
            $("#dummy").html(data);
        }
    });
}

function edit(){
    alert("hi");
}

function search(){
    var option = $('#sort').find(":selected").val();
    var input = $('#search').val();
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
    });*/

    const $select = document.querySelector('#categ');
    $select.value = 'All';
    sort();
}

function sort(){
    var option = $('#sort').find(":selected").val();
    var categOption = $('#categ').find(":selected").val();
    var input = $('#search').val();

    sessionStorage.setItem("selectedOption", option);
    var optionValue = $(this).selectedIndex;
    $.ajax({
        type: "POST",
        url: "search_sort.php",
        data: {
            selected: option,
            categSort: categOption,
            search: input
        },
        success: function(data) { 
            $("#display").html(data);
        }
    });

}

/* UNUSED ===================
function categ(){
    var categOption = $('#categ').find(":selected").val();
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
}======================*/

    //categ on salability
    //$("#categ1").change(function(){
        function categ1(){
        var categOption = $("#categ1").find(":selected").val();
        $.ajax({
            type: "POST",
            url: "search_sort.php",
            data: {
                category1: categOption
            },
            success: function(data) { 
                $("#display").html(data);
            }
        });
        
    //});
    }
    //sort on salability
    
    
    //$("#sort1").change(function(){
    function sort1(){
        var option = $("#sort1").find(":selected").val();
        sessionStorage.setItem("selectedOption", option);
        var optionValue = $("#sort1").selectedIndex;
        $.ajax({
            type: "POST",
            url: "search_sort.php",
            data: {
                selected1: option
            },
            success: function(data) { 
                $("#display").html(data);
            }
        });
        
    //});
    }
    //search on salability
    //$("#search1").keyup(function() {
    function search1(){
        var input = $("#search1").val();
            $.ajax({
                type: "POST",
                url: "search_sort.php",
                data: {
                    search1: input
                },
                success: function(data) {
                    $("#display").html(data);
                }
            });
    //});
    }

    function transactionDate(){
        var min = $("#from_date").val();       
        document.getElementById('to_date').setAttribute("min", min);
        //var max = $("#to_date").val(); 
        //document.getElementById('from_date').setAttribute("max", max);
        var link = "export.php?exportTransactions=range&from=" + $("#from_date").val() + "&to=" + $("#to_date").val();
        document.getElementById('exportRange').setAttribute("href", link);
    }

    function changeRange(){
        var link = "export.php?exportTransactions=range&from=" + $("#from_date").val() + "&to=" + $("#to_date").val();
        document.getElementById('exportRange').setAttribute("href", link);
    }