<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cards</title>
</head>

<body>

  <div class="card">
    <!-- Create card that can contain temperature label, icon and value -->
    <div class="temperature-label">Temperature</div>
    <div class="temperature-icon">🌡️</div>
    <div class="temperature-value" id="temperatureValue">--</div>
  </div>

  <br> <br> <br>

  <div class="card">
    <!-- Create card that can contain humidity label, icon and value -->
    <div class="humidity-label">Humidity</div>
    <div class="humidity-icon">💧</div>
    <div class="humidity-value" id="humidityValue">--</div>
  </div>

  <br> <br> <br>

  <button id="refreshButton">Refresh Data</button>

  <script src="../../plugins/js/jquery.min.js"></script>

  <script>
    $(document).ready(function() {

      button = document.getElementById("refreshButton");
      button.addEventListener("click", function() {
        fetchData();
      });

      fetchData();

      function fetchData() {
        $.ajax({
          type: "POST",
          url: "/web_modules/modules/cards/api/get_data_from_db.php",
          dataType: "json",
          success: function(response) {
            console.log(response);
            $("#temperatureValue").text(response.temperature + " °C");
            $("#humidityValue").text(response.humidity + " %");
          },
          error: function(xhr) {
            console.log(xhr.status);
            console.log(xhr.responseText);
            alert("An error occurred during login.");
          }
        });
      };

    });
  </script>

</body>

</html>