<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>General page</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
.div1 {
            position: fixed;
            top: 40px; /* Modify this value */
            left: 20px; /* Modify this value */
            height: 150px; /* Set the height for the first div */
            width: 162px;
        }
        .div2 {
            height: auto;
            padding-left: 80px;
            display: flex; /* Use Flexbox for centering */
            justify-content: center; /* Center horizontally */
            align-items: center; /* Center vertically */
            text-align: center; /* Set the height for the second div */
        }
        .div3 {
            position: fixed;
            top: 210px; /* Modify this value */
            left: 20px; /* Modify this value */
            height: 150px; /* Set the height for the first div */
            width: 162px;
        }
        .div4 {
            position: fixed;
            top: 380px; /* Modify this value */
            left: 20px; /* Modify this value */
            height: 150px; /* Set the height for the first div */
            width: 162px;
        }
        .success-message {
            color: #008000; /* Green color for success message */
            background-color: #f8d7da; /* Light red background */
            border: 1px solid #f5c6cb; /* Light red border */
            padding: 12px;
            border-radius: 4px;
            margin-bottom: 16px;
            text-align: center;
            font-size: 16px;
            font-weight: bold;
        }
        .fail-message {
            color: #b71c1c; /* Dark red color for error messages */
            padding: 12px;
            border-radius: 4px;
            margin-bottom: 16px;
            text-align: center;
            font-size: 16px;
            font-weight: bold;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        function loadPage() {
            $.ajax({
                url: 'createevent.php',
                type: 'GET',
                success: function(response) {
                    $('#displayDiv').html(response);
                }
            });
        }

        document.addEventListener("DOMContentLoaded", function() {
            if (document.querySelector('.success-message, .fail-message')) {
                setTimeout(function() {
                    const messages = document.querySelectorAll('.success-message, .fail-message');
                    messages.forEach(message => {
                        message.style.display = 'none';
                    });
                }, 3000);
            }
        });
    </script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    
    <div style="align-items: center; padding: 40px; padding-left: 55px;" class="bg-white p-8 rounded shadow-md mr-6 w-100 max-w-4xl div1">
        <h2 class="text-2xl font-bold mb-6 text-center"></h2>
        <button onclick="showContent('Hello World')">View</button>
    </div>
    <div style="align-items: center; padding: 40px; padding-left: 55px;" class="bg-white p-8 rounded shadow-md mr-6 w-100 max-w-4xl div3">
        <h2 class="text-2xl font-bold mb-6 text-center"></h2>
        <button onclick="loadPage()">Create</button>
    </div>
    <div style="align-items: center; padding: 40px; padding-left: 55px;" class="bg-white p-8 rounded shadow-md mr-6 w-100 max-w-4xl div4">
        <h2 class="text-2xl font-bold mb-6 text-center"></h2>
        <button onclick="showContent('Hello World')">Update</button>
    </div>
    <div id="displayDiv" class="bg-white p-8 rounded shadow-md ml-6 w-full max-w-4xl div2">
        <h2 class="text-2xl font-bold mb-6 text-center"></h2>
    </div>

    <div class="message-container">
    <?php
    if (isset($_SESSION['success'])) {
        echo '<p class="success-message">' . $_SESSION['success'] . '</p>';
        unset($_SESSION['success']);
    }
    if (isset($_SESSION['fail'])) {
        echo '<p class="fail-message">' . $_SESSION['fail'] . '</p>';
        unset($_SESSION['fail']);
    }
    ?>
    </div>
    
</body>
</html>
