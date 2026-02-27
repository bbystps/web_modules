<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Display Image</title>
</head>

<body>
  <h1>Display Uploaded Image</h1>

  <div id="full_name">ding</div>

  <div id="imageBox">Loading...</div>

  <script src="../../plugins/js/jquery.min.js"></script>
  <script>
    $(document).ready(function() {

      var full_name = $("#full_name").text().trim();

      $.ajax({
        type: "GET",
        url: "api/display.php",
        data: {
          full_name: full_name
        }, // 🔥 send full_name to PHP
        dataType: "json",
        success: function(res) {
          console.log(res);
          $("#imageBox").html(`
            <p><b>${res.data.full_name}</b></p>
            <img src="${res.data.image_name}" 
                 style="max-width:300px; border:1px solid #ccc; padding:5px;">
          `);
        },
        error: function(xhr) {
          $("#imageBox").html("Request failed: " + xhr.status);
        }
      });

    });
  </script>

</body>

</html>