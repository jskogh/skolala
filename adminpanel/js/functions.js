function contactCustomer(orderid) {
    if (document.getElementById(orderid).style.display=="none") {
    document.getElementById(orderid).style.display="table-row";
    }
    else {
        document.getElementById(orderid).style.display="none";
    }
}

function sendMessage() {
    document.getElementById('contact_name').value = "";
    document.getElementById('contact_message').value = "";
    $("#message_sent").fadeIn( "3000", function(){});
}

function addField(tableID) {
    var table = document.getElementById(tableID);
    var rowCount = table.rows.length;
    if(rowCount < 50) {
        var row = table.insertRow(rowCount);
        var colCount = table.rows[0].cells.length;
        for(var i=0; i<colCount; i++) {
            var newcell = row.insertCell(i);
            newcell.innerHTML = table.rows[0].cells[i].innerHTML;
        }
    }
    else {
        alert("Maximalt antal rader &auml;r 50...");
    }
}

function deleteField(tableID) {
    var table = document.getElementById(tableID);
    var rowCount = table.rows.length;
    for(var i=0; i<rowCount; i++) {
        var row = table.rows[i];
        var chkbox = row.cells[0].childNodes[0];
        if(null != chkbox && true == chkbox.checked) {
            if(rowCount <= 1) {               // limit the user from removing all the fields
                alert("Du kan inte ta bort alla rader...");
                break;
            }
            table.deleteRow(i);
            rowCount--;
            i--;
        }
    }
}