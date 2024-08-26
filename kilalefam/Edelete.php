<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM events WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    $conn->close();
    header("Location: Eedit.php");
    exit();
}
?>
