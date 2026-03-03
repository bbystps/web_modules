<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Datatable</title>
  <link rel="stylesheet" href="../../plugins/datatables/datatables.min.css">
</head>

<body>

  <table id="myTable" class="display nowrap" style="width:100%">
    <thead>
      <tr>
        <th>User ID</th>
        <th>Full Name</th>
        <th>Age</th>
        <th>Gender</th>
        <th>Option</th>
      </tr>
    </thead>
    <tbody>
      <!-- Insert Data Dynamically -->
    </tbody>
  </table>

  <script src="../../plugins/js/jquery.min.js"></script>
  <script src="../../plugins/datatables/datatables.min.js"></script>

  <?php include 'script/mytable_btn.php'; ?>
</body>

</html>