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
