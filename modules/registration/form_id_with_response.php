<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registration</title>
</head>

<body>
  <form id="registerForm"> <!-- Added an ID to the form for easier JavaScript targeting -->
    <label for=" username">Username:</label>
    <input type="text" id="username" name="username" required><br><br>
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required><br><br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><br>
    <input type="submit">
  </form>
</body>

<script src="../../plugins/js/jquery.min.js"></script> <!-- Ensure jQuery is loaded before using it-->

<script>
  $(document).ready(function() { // Ensure the DOM is fully loaded before attaching event handlers
    $("#registerForm").on("submit", function(e) { // Use the ID to target the form
      e.preventDefault(); // Prevent the default form submission behavior
      // console.log("Form submitted"); // Debugging: Check if the form submission is being captured
      $.ajax({
        type: "POST",
        url: "/web_modules/modules/registration/api/register_with_dup_val.php", // Ensure this path is correct based on your project structure
        data: $(this).serialize(), // cleaner & safer
        dataType: "json",
        success: function(response) {
          console.log("Server response:", response); // Debugging: Check the server response
          // {"status":"failed","message":"Username already exists"}
          // handle json response
          if (response.status === "success") {
            alert("Registration successful!"); // Show success message
          } else {
            alert(response.message); // Show the error message from the server
          }
        },
        error: function(xhr) {
          console.log("status:", xhr.status);
          console.log("response:", xhr.responseText);
          // alert("Failed: " + xhr.status);
        }
      });
    });
  });
</script>

</html>