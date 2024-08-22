<?php
session_start();

include 'db.php';

if($_SERVER['REQUEST_METHOD']=='POST'){
    $name=$_POST['name'];
    $date=$_POST['date'];
    $urgent=isset($_POST['urgent']) ? 1:0;

    $sql="INSERT INTO events (name, date, urgent) VALUES ('$name', '$date', '$urgent')" ;

    if($conn->query($sql)===TRUE){
        $_SESSION['success'] = 'New event created successfully';
    }else{
        $_SESSION['fail'] = 'Failed to create event. Try again or contact admin';
    }
    $conn->close();
    header("Location: event.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create new event</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
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
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded shadow-md w-full max-w-md">
        <h2 class="text-2xl font-bold mb-6 text-center">Create a new event</h2>
        <?php
          if(isset($_SESSION['success'])){
            echo '<p class="success-message">' . $_SESSION['success'] . '</p>';
            unset($_SESSION['success']);
          }
          if(isset($_SESSION['fail'])){
            echo '<p class="fail-message">' . $_SESSION['fail'] . '</p>';
            unset($_SESSION['fail']);
          }
        ?>
        <div class="form-container">
            <form class="form" action="createevent.php" method="post">
                <span class="heading block text-xl font-semibold mb-4">Enter event details below</span>
                
                <div class="form-group mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700 mt-2">Event name:</label>
                    <input type="text" id="name" name="name" required class="form-input w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500" />

                </div>

                <div class="form-group mb-4">
                    <label for="role" class="block text-sm font-medium text-gray-700 mt-2">Date and time:</label>
                    <input type="datetime-local" id="date" name="date" class="form-input w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500" />

                </div>

                <div class="form-group mb-4">
                    <label for="urgent" class="block text-sm font-medium text-gray-700 mt-2">Mark as urgent</label>
                    <input type="checkbox" id="urgent" name="urgent" class="form-input w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500"/>

                </div>
                <button type="submit" class="w-full bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">SUBMIT</button>
            </form>
        </div>
    </div>
    <script>
        function injectStyles() {
            const styles = `
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
            `;

            // Create a <style> element
            const styleSheet = document.createElement("style");
            styleSheet.type = "text/css";
            styleSheet.innerText = styles;
            document.head.appendChild(styleSheet);
        }

        function hideMessage() {
            setTimeout(function() {
                const messages = document.querySelectorAll('.success-message, .fail-message');
                messages.forEach(message => {
                    message.style.display = 'none';
                });
            }, 3000); // Hide after 3 seconds
        }

        document.addEventListener("DOMContentLoaded", function() {
            injectStyles();
            hideMessage();
        });
    </script>
</body>
</html>
