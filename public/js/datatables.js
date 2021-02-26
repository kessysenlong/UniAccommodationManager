$(document).ready(function () {
    $('#roomsTable').DataTable({

        dom: 'Bfrtip',
        buttons: [
            'excel',
            'pdf',
            'print',
        ],
    });
});

$(document).ready(function () {
 // Setup - add a text input to each footer cell
//  $('#bookingsTable thead tr').clone(true).appendTo( '#bookingsTable thead' );
//  $('#bookingsTable thead tr:eq(1) th').each( function (i) {
//      var title = $(this).text();
//      $(this).html( '<input type="text" placeholder="Search '+title+'" />' );

//      $( 'input', this ).on( 'keyup change', function () {
//          if ( table.column(i).search() !== this.value ) {
//              table
//                  .column(i)
//                  .search( this.value )
//                  .draw();
//          }
//      } );
//  } );

    // 
    $('#bookingsTable').DataTable({
        orderCellsTop: true,
        fixedHeader: true,
        dom: 'Bfrtip',
        buttons: [
            'excel',
            'pdf',
            'print',
        ],
    });
});


