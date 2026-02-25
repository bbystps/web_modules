<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
</head>

<body>

  <h1>Login</h1>
  <form id="loginForm">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required><br><br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><br><br>
    <input type="submit" value="Login">
  </form>

  <script src="../../plugins/js/jquery.min.js"></script>

  <script>
    $(document).ready(function() {
      $("#loginForm").on("submit", function(e) {
        e.preventDefault();

        $.ajax({
          type: "POST",
          url: "/web_modules/modules/login/api/authenticate.php",
          data: $(this).serialize(), // cleaner & safer
          dataType: "json",
          success: function(response) {
            console.log(response);
            if (response.status === "success") {
              alert("Login successful!");
              // window.location.href = "/web_modules/modules/dashboard/index.php";
            } else {
              alert("Login failed: " + response.message);
            }
          },
          error: function(xhr) {
            console.log(xhr.status);
            console.log(xhr.responseText);
            alert("An error occurred during login.");
          }
        });
      });
    });
  </script>

</body>

</html>