$(document).ready(function() 
    {       
        $("#myTable").tablesorter({ widgets: ['zebra'] }); 
        $("table").tablesorter({ 
        // pass the headers argument and assing a object 
        headers: { 
            // assign the secound column (we start counting zero) 
            1: { 
                // disable it by setting the property sorter to false 
                sorter: false 
            }, 
            // assign the third column (we start counting zero) 
            2: { 
                // disable it by setting the property sorter to false 
                sorter: false 
            } 
        } 
    }); 
        
    } 
); 
