<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $phonenumber = $_POST['phonenumber'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    $stmt=$conn->prepare("SELECT * FROM users WHERE phonenumber = ?");
    $stmt->bind_param("s", $phonenumber);
    $stmt->execute();
    $result=$stmt->get_result();

    #$sql = "INSERT INTO users (name, phonenumber, email, password, role) VALUES ('$name', '$phonenumber', '$email', '$password', '$role')"; 

    if($result->num_rows>0){
        echo "Error:User with this phone number already exists.";
    }else{
        if ($role === 'admin') {
            $stmt = $conn->prepare("SELECT * FROM users WHERE role = 'admin'");
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                echo "Error: An admin already exists.";
                $stmt->close();
                $conn->close();
                exit();
            }
        }

        $stmt=$conn->prepare("INSERT INTO users(name, phonenumber, email, password, role) VALUES(?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $name, $phonenumber, $email, $password, $role);
    }
    if ($stmt->execute()) {
        $_SESSION['role'] = $role;
        if ($role === 'child') {
            header("Location: childdashboard.php");
        } elseif ($role === 'parent') {
            header("Location: parentdashboard.php");
        } elseif ($role === 'admin') {
            header("Location: admindashboard.php");
        } else {
            // Handle unknown role
            echo "Unknown role: $role";
        }
        exit();
        }
        else{
            echo "Error: ".$sql."<br>".$conn->error;
        }
        $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded shadow-md w-full max-w-md">
        <h2 class="text-2xl font-bold mb-6 text-center">Registration</h2>
        <div class="form-container">
            <form class="form" action="registration.php" method="post">
                <span class="heading block text-xl font-semibold mb-4">Enter your details below</span>
                
                <div class="form-group mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700 mt-2">Name</label>
                    <input type="text" id="name" name="name" required class="form-input w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required type="name" />

                </div>

                <div class="form-group mb-4">
                    <label for="role" class="block text-sm font-medium text-gray-700 mt-2">Role</label>
                    <input type="text" id="role" name="role" placeholder="small letters(child or parent)" class="form-input w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required type="role" />

                </div>

                <div class="form-group mb-4">
                    <label for="phonenumber" class="block text-sm font-medium text-gray-700 mt-2">Phone Number</label>
                    <input type="text" id="phonenumber" name="phonenumber" required class="form-input w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required type="phone" />

                </div>

                <div class="form-group mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 mt-2">Email</label>
                    <input type="text" id="email" name="email" required class="form-input w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required type="email" />

                </div>
                
                <div class="form-group mb-6">
                    <label for="password" class="block text-sm font-medium text-gray-700 mt-2">Password</label>
                    <input type="text" id="password" name="password" required class="form-input w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required type="password" />

                </div>
                
                <button type="submit" class="w-full bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">SUBMIT</button>
            </form>
        </div>
    </div>
</body>
</html>
