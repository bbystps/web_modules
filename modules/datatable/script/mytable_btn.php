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
        {
          data: null, // This column will be for action buttons, so we set data to null
          render: function(data, type, row) { // Render action buttons - Change button classes and data attributes as needed
            return `
              <button class="table-btn btn-view" data-id="${row.id}">
                View
              </button>
              <button class="table-btn btn-delete" data-id="${row.id}">
                Delete
              </button>
            `;
          }
        }
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

    // add event listeners for action buttons (using event delegation)
    $('#myTable tbody').on('click', '.btn-view', function() {
      const id = $(this).data('id');
      alert(`View button clicked for ID: ${id}`);
      // Implement your view logic here (e.g., open a modal with details)
    });

    // add event listeners for action buttons (using event delegation)
    $('#myTable tbody').on('click', '.btn-delete', function() {
      const id = $(this).data('id');
      $.ajax({
        type: "POST",
        url: "api/delete_data.php", // API endpoint to handle deletion - Change to your actual endpoint
        data: {
          id: id
        },
        dataType: "json",
        success: function(response) {
          if (response.status === 'success') {
            alert(`Record with ID: ${id} deleted successfully.`);
            table.ajax.reload(); // Reload table data after deletion
          } else {
            alert(`Failed to delete record with ID: ${id}.`);
          }
        },
        error: function(xhr) {
          console.log(xhr.status);
          console.log(xhr.responseText);
          alert("An error occurred during deletion.");
        }
      });
    });

  });
</script>