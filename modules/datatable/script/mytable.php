<script>
  $(function() {
    const table = $('#myTable').DataTable({ // initialize DataTable - Change 'myTable' to your table's ID
      ajax: {
        url: 'api/mytable_data.php', // API endpoint to fetch data - Change to your actual endpoint
        dataSrc: 'data'
      },

      columns: [{ // Define columns based on your table data structure
          data: 'id' // Assuming your data has a 'UserID' field - Change to your actual field name from your API - beware of field name case sensitivity
        },
        {
          data: 'full_name'
        },
        {
          data: 'age'
        },
        {
          data: 'gender'
        },
      ],

      columnDefs: [{
          targets: 0,
          visible: false
        }, // hide ID
        {
          targets: '_all',
          className: 'dt-left'
        }
      ],

      scrollX: true,
      scrollCollapse: true,
      responsive: false,
      autoWidth: true, // IMPORTANT: allow recalculation

      ordering: true,
      order: [ // Set default sorting - Change column index and order as needed
        [0, 'desc']
      ],
      paging: true,
      searching: true,
    });

    /* 🔑 THIS FIXES THE “STUCK WIDTH” ISSUE */
    function adjustTable() {
      table.columns.adjust().draw(false);
    }

    // On resize
    window.addEventListener('resize', adjustTable);

    // On sidebar/layout changes (just in case)
    setTimeout(adjustTable, 200);
  });
</script>