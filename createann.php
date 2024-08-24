<?php
session_start();

include 'db.php';

if($_SERVER['REQUEST_METHOD']=='POST'){
    $name=$_POST['name'];
    $urgent=isset($_POST['urgent']) ? 1:0;
    $posted=date("Y-m-d H:i:s");

    $sql="INSERT INTO announcements (name, urgent, posted) VALUES ('$name', '$urgent', '$posted')" ;

    if($conn->query($sql)===TRUE){
        $_SESSION['success'] = 'New announcement posted successfully';
    }else{
        $_SESSION['fail'] = 'Failed to post the announcement. Try again or contact admin';
    }
    $conn->close();
    header("Location: announcement.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create a new announcement</title>
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
    <div class="bg-white p-8 rounded shadow-md w-full max-w-md mx-auto">
        <h2 class="text-2xl font-bold mb-6 text-center">Create a new announcement</h2>
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
        <div style="margin-left:20px;" class="form-container">
            <form class="form" action="createann.php" method="post">
                <div class="form-group mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Title:</label>
                    <input type="text" id="name" name="name" required value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>" class="w-full px-2 py-1 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500" />
                </div>
                <div class="form-group mb-4">
                    <label for="urgent" class="block text-sm font-medium text-gray-700">Mark as urgent</label>
                    <input type="checkbox" id="urgent" name="urgent" class="mr-2" <?php echo isset($_POST['urgent']) && $_POST['urgent'] ? 'checked' : ''; ?> /> Yes
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
