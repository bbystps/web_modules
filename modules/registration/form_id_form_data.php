<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registration</title>
</head>

<body>
  <div id="username">UserName</div> <!-- This div is used to try the append function to form (remove if needed) -->
  <form id="registerForm" enctype="multipart/form-data"> <!-- Added an ID to the form for easier JavaScript targeting -->
    <!-- <label for=" username">Username:</label>
    <input type="text" id="username" name="username" required><br><br> -->
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required><br><br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><br>
    <input type="submit">
  </form>
</body>

<!--  -->
<script src="../../plugins/js/jquery.min.js"></script> <!-- Ensure jQuery is loaded before using it-->

<script>
  $(document).ready(function() { // Ensure the DOM is fully loaded before attaching event handlers
    $("#registerForm").on("submit", function(e) {
      e.preventDefault();

      let formData = new FormData(this); // Automatically collects all inputs
      formData.append("username", $("#username").text()); // Append the div needed to be added to the form data

      $.ajax({
        type: "POST",
        url: "/web_modules/modules/registration/api/register_with_dup_val.php",
        data: formData,
        processData: false, // IMPORTANT
        contentType: false, // IMPORTANT
        dataType: "json",
        success: function(response) {
          console.log(response);
        },
        error: function(xhr) {
          console.log(xhr.status);
          console.log(xhr.responseText);
        }
      });
    });
  });
</script>

</html>