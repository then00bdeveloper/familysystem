<?php  
session_start();
include 'db.php';

$sql = "SELECT (@row_number := @row_number + 1) AS row_number, id, name, urgent, posted FROM announcements, (SELECT @row_number := 0) AS r
        ORDER BY id ASC";
$result = $conn->query($sql);

$announcements = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $announcements[] = $row;
    }
} else {
    $noResults = true;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Announcements</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded shadow-md w-full max-w-4xl">
        <h2 class="text-2xl font-bold mb-6 text-center">Announcements</h2>

        <?php if (isset($noResults) && $noResults): ?>
            <p class="text-lg font-semibold text-gray-700 text-center">No announcements found</p>
        <?php else: ?>
            <div class="overflow-x-auto">
                <table class="min-w-full border border-gray-200">
                    <thead>
                        <tr class="bg-blue-500">
                            <th class="px-4 py-2 border">S/N</th>
                            <th class="px-4 py-2 border">Name</th>
                            <th class="px-4 py-2 border">Urgent</th>
                            <th class="px-4 py-2 border">Posted on</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($announcements as $announcement): ?>
                            <tr class="text-center">
                                <td class="px-4 py-2 border"><?php echo htmlspecialchars($announcement['row_number']); ?></td>
                                <td class="px-4 py-2 border"><?php echo htmlspecialchars($announcement['name']); ?></td>
                                <td class="px-4 py-2 border"><?php echo $announcement['urgent'] ? 'Yes' : 'No'; ?></td>
                                <td class="px-4 py-2 border"><?php echo htmlspecialchars($announcement['posted']); ?></td>
                            </tr>
                            <?php endforeach; ?>
                            
                    </tbody>
                </table>
                <br>
                <a href="Aedit.php">
                <button type="button" style="margin-left: 400px;" class="bg-blue-500 text-white px-2 py-1 rounded">Edit</button>
                </a>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
