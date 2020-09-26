<?php





?>
<html>
<head>



 <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd" crossorigin="anonymous">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css" integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd" crossorigin="anonymous">
 <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/base/minified/jquery-ui.min.css" type="text/css" /> 
 
   
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
 <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>


<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css" />
  

  
  <script src="libraries/jquerydatatable.js"></script>
  <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
  
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
   

 <style type="text/css">
         
td.details-control {
    background: url('open.png') no-repeat center center;
    cursor: pointer;
}
tr.shown td.details-control {
    background: url('close.png') no-repeat center center;
}
          
          
      
          
      </style>
	  
	  
	  
	  
</head>

<body>

				
				<br>
				<br>
				<br>

<table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>#</th>
				<th>code</th>
                <th>price</th>
				<th>status</th>
                <th>Guest name</th>
                <th>Guest mobile</th>
				

				

            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>#</th>
				<th>code</th>
                <th>price</th>
				<th>status</th>
                <th>Guest name</th>
                <th>Guest mobile</th>
				

					
            </tr>
        </tfoot>
    </table>
	
		         
	
	</body>
	
	 <script type="text/javascript" language="javascript" >
 
 
          /* Formatting function for row details - modify as you need */

/*

    dom: 'Bfrtip',
     buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
     ],
*/
 
$(document).ready(function() {
 
 
 

    var table = $('#example').DataTable( {
      
	   
    "processing" : true,
    "serverSide" : true,
    "order" : [],
    "ajax" : {
     url:"fetchchairs.php",
     type:"POST",
	
    },
	"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        "columns": [
            {
                "className":      'details-control',
                "orderable":      true,
                
                "defaultContent": ''
            },
            {},
            {},
			{},
            {},
			{}
	
        ],
        "order": [[1, 'asc']]
    } );
	
	/*$('#example').DataTable( {
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
    } );
     */
    // Add event listener for opening and closing details
    $('#example tbody').on('click', 'td.details-control', function () {
	       
		   
		   var id= $(this).html();
	     function format ( rowData ) {
      
   var div= $('<div/>')
        .addClass( 'loading' )
        .text( '$loading' );
 
 
    $.ajax({
    url:"fetchchairs.php",
    method:"POST",
    data:{id:id},
    dataType:"JSON",
    success:function(data)
    {
        div
                .html( data.name )
                .removeClass( 'loading' );
    }
   })
  
     
     return div;
}
	    
        var tr = $(this).closest('tr');
        var row = table.row( tr );
 
        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child( format(row.data()) ).show();
            tr.addClass('shown');
        }
    } );
} );




  </script>
  
  </html>