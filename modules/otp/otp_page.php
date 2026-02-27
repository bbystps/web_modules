<?php
session_start();

?>
<!DOCTYPE html>
<html>

<head>
    <title>OTP Verification</title>
</head>

<body>

    <h3>Enter OTP</h3>

    <form id="otpForm">
        <input type="text" name="otp" id="otpInput" placeholder="Enter OTP" required>
        <button type="submit">Verify OTP</button>
    </form>

    <script src="/web_modules/plugins/js/jquery.min.js"></script>

    <script>
        $("#otpForm").on("submit", function(e) {
            e.preventDefault();

            $.ajax({
                type: "POST",
                url: "/web_modules/modules/otp/api/otp_verification.php",
                data: $(this).serialize(),
                dataType: "json",
                success: function(response) {

                    if (response.status === "success") {
                        alert("Registration completed! Go to login page.");
                        window.location.href = "registration_success.php";
                    } else {
                        alert(response.message);
                    }

                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                    alert("Something went wrong.");
                }
            });

        });
    </script>

</body>

</html>