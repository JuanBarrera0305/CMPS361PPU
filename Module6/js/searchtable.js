function searchTable() {
    var input, filter, table, tr, td, i, j, txtValue;
    input = document.getElementById("searchInput");
    filter = input.value.toLowerCase();
    table = document.getElementById("dataGrid");
    tr = table.getElementByTagName("tr");

    // Loop through all table rows and hide those that don't match
    for (i = 1; i < tr.length; i++) { 
        tr[i].style.display = "none"; 
        td = tr[i].getElementByTagName("td");
        for (j = 0; j < td.length; j++) { 
            if (td[j]) {
                txtValue = td[j].textContent || td[j].innerText; 
                if (textValue.toLowerCase().indexOf(filter) > -1) {
                    tr[i].style.display = ""; 
                    break; 
                }
            }
        }
    }
}

