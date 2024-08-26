<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $date = $_POST['date'];
    $urgent = isset($_POST['urgent']) ? 1 : 0;

    $sql = "UPDATE events SET name = ?, date = ?, urgent = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssii", $name, $date, $urgent, $id);
    $stmt->execute();
    $stmt->close();
    $conn->close();
    header("Location: Eview.php");
    exit();
}
?>
