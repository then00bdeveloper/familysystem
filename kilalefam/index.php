<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded shadow-md w-full max-w-md">
        <h1 class="text-2xl font-bold mb-6 text-center">Welcome to Our System</h1>
        
        <?php
        // Check if the user is logged in by looking for a session variable
        if (isset($_SESSION['user_phone_number'])) {
            echo "<p class='text-center mb-4'>Welcome back, " . $_SESSION['user_name'] . "!</p>";
            echo '<p class="text-center"><a href="auth/logout.php" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-700">Logout</a></p>';
        } else {
            echo '<p class="text-center mb-4">Please log in to continue.</p>';
            echo '<div class="flex flex-col items-center space-y-2">';

            echo '<a href="login.php" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-700">Login</a>';
            echo '<a href="registration.php" class="text-blue-500 hover:underline">No account? Register here.</a>';
            
            echo '</div>';
        }
        ?>
    </div>
</body>
</html>
