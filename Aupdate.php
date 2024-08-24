<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $urgent = isset($_POST['urgent']) ? 1 : 0;
    $posted = $_POST['posted'];

    $sql = "UPDATE announcements SET name = ?, urgent = ?, posted = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssii", $name, $urgent,  $posted, $id);
    $stmt->execute();
    $stmt->close();
    $conn->close();
    header("Location: Aview.php");
    exit();
}
?>
