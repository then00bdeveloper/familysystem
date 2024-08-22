<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $phonenumber = $_POST['phonenumber'];
    $password = $_POST['password'];

    // Prepare and execute the query
    $stmt = $conn->prepare("SELECT * FROM users WHERE phonenumber = ?");
    $stmt->bind_param("s", $phonenumber);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $user['password'])) {
            // Set session variables
            $_SESSION['loggedin'] = true;
            $_SESSION['role'] = $user['role'];

            // Redirect based on the user role
            if ($user['role'] === 'child') {
                header("Location: childdashboard.php");
            } elseif ($user['role'] === 'parent') {
                header("Location: parentdashboard.php");
            } elseif ($user['role'] === 'admin') {
                header("Location: admindashboard.php");
            } else {
                echo "Unknown role: " . $user['role'];
            }
            exit();
        } else {
            $_SESSION['error'] = 'Invalid password';
            header("Location: login.php");
            exit();
        }
    } else {
        $_SESSION['error'] = 'User not found';
        header("Location: login.php");
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded shadow-md w-full max-w-md">
        <h2 class="text-2xl font-bold mb-6 text-center">Login</h2>
        <?php
        if (isset($_SESSION['error'])) {
            echo '<p class="error-message">' . $_SESSION['error'] . '</p>';
            unset($_SESSION['error']);
        }
        ?>
        <form action="login.php" method="post">
            <div class="mb-4">
                <label for="phonenumber" class="block text-sm font-medium text-gray-700">Phone Number:</label>
                <input type="text" id="phonenumber" name="phonenumber" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            </div>
            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-gray-700">Password:</label>
                <input type="password" id="password" name="password" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            </div>
            <button type="submit" class="w-full bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">Login</button>
        </form>
    </div>
    <script>
        function injectStyles() {
            const styles = `
                .error-message {
                    color: #b71c1c; /* Dark red color for error messages */
                    background-color: #f8d7da; /* Light red background */
                    border: 1px solid #f5c6cb; /* Light red border */
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
        document.addEventListener("DOMContentLoaded", injectStyles);
    </script>
</body>
</html>
