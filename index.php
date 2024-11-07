<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCP Entries</title>
    <link rel="stylesheet" href="includes/style.css"> <!-- Linking the CSS file -->
</head>
<?php


include('includes/config.php'); // Include database connection

// SQL query to fetch all SCP records
$sql = "SELECT * FROM scp_entries";
$result = $conn->query($sql);

// Check if any records exist
if ($result->num_rows > 0) {
    echo "<div class='container'>
            <h1>SCP Entries</h1>
            <table class='table'>
                <thead>
                    <tr>
                        <th>SCP Number</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Object Class</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>";

    // Output data for each SCP entry
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row['scp_number'] . "</td>
                <td>" . $row['title'] . "</td>
                <td>" . $row['description'] . "</td>
                <td>" . $row['object_class'] . "</td>
                <td>
                    <a href='edit.php?id=" . $row['id'] . "' class='btn btn-warning'>Edit</a>
                    <a href='delete.php?id=" . $row['id'] . "' class='btn btn-danger' onclick='return confirm(\"Are you sure you want to delete?\")'>Delete</a>
                </td>
            </tr>";
    }

    echo "</tbody></table>";

    // Action buttons (below the table)
    echo "<div class='actions-buttons'>
            <a href='create.php' class='btn btn-primary'>Create New SCP</a>
        </div>";
} else {
    echo "<p>No SCP entries found.</p>";
}

$conn->close();  // Close the connection after use
?>
