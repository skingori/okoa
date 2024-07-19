// Call the dataTables jQuery plugin
$(document).ready(function() {
  $('#dataTable').DataTable({
    "pageLength": 5,
    "lengthMenu": [10, 20, 50, 100],
    "order": [[0, "asc"]],
    "language": {
      "sEmptyTable":     "No data available in table",
      "sInfo":           "Showing _START_ to _END_ of _TOTAL_ entries",
      "sInfoEmpty":      "Showing 0 to 0 of 0 entries",
      "sInfoFiltered":   "(filtered from _MAX_ total entries)",
      "sInfoPostFix":    "",
      "sInfoThousands":  ",",
      "sLengthMenu":     "Show _MENU_ entries",
      "sLoadingRecords": "Loading...",
      "sProcessing":     "Processing...",
      "sSearch":         "Search:",
      "sZeroRecords":    "No matching records found",
      "oPaginate": {
        "sFirst":    "First",
        "sLast":     "Last",
        "sNext":     "Next",
        "sPrevious": "Previous"
      },
      "oAria": {
        "sSortAscending":  ": activate to sort column ascending",
        "sSortDescending": ": activate to sort column descending"
      }
    }
  });
});
