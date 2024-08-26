<?php

session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    $_SESSION = array();
    session_destroy();
    header("Location: login.php");
    exit();
}



// Prevent browser caching
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded shadow-md w-full max-w-4xl">
        <h2 class="text-2xl font-bold mb-6 text-center">Admin Dashboard</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Manage Users -->
            <div class="bg-gray-200 p-4 rounded shadow">
                <h3 class="text-xl font-semibold mb-4">Manage Users</h3>
                <button class="w-full bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700 mb-2">Add User</button>
                <button class="w-full bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">Edit User</button>
            </div>
            <!-- Announcements -->
            <div class="bg-gray-200 p-4 rounded shadow">
                <h3 class="text-xl font-semibold mb-4">Announcements</h3>
                <a href="announcement.php" class="w-full bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700 mb-2 text-center block">Check Event</a>
                <!--<a href="edit.php" class="w-full bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700 text-center block">Edit Event</a>-->
            </div>
            <!-- Events -->
            <div class="bg-gray-200 p-4 rounded shadow">
                <h3 class="text-xl font-semibold mb-4">Events</h3>
                <a href="event.php" class="w-full bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700 mb-2 text-center block">Check Event</a>
                <!--<a href="edit.php" class="w-full bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700 text-center block">Edit Event</a>-->
            </div>

            <!-- Timetable -->
            <div class="bg-gray-200 p-4 rounded shadow">
                <h3 class="text-xl font-semibold mb-4">Timetable</h3>
                <button class="w-full bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">Assign Task</button>
            </div>
        </div>
    </div>
</body>
</html>
