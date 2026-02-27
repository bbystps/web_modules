<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Image Upload</title>
</head>

<body>
  <h1>Image Upload</h1>

  <form id="uploadForm" enctype="multipart/form-data">
    <label>Select image to upload:</label>
    <input type="file" name="fileToUpload" id="fileToUpload" required>
    <input type="submit" value="Upload Image">
  </form>

  <script src="../../plugins/js/jquery.min.js"></script>

  <script>
    $(document).ready(function() {

      $("#uploadForm").on("submit", function(e) {
        e.preventDefault(); // stop normal form submission

        let formData = new FormData(this);

        $.ajax({
          type: "POST",
          url: "api/upload.php",
          data: formData,
          processData: false, // VERY IMPORTANT
          contentType: false, // VERY IMPORTANT
          success: function(response) {
            console.log(response);
          },
          error: function(xhr) {
            console.log("Error: " + xhr.status);
          }
        });

      });

    });
  </script>

</body>

</html>