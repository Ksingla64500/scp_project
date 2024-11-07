<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCP Entries</title>
    <link rel="stylesheet" href="includes/style.css"> <!-- Correct path to your CSS -->
</head>
<?php
include('includes/config.php');  // Include DB connection

// Check if 'id' is passed in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // SQL query to delete the record
    $sql = "DELETE FROM scp_entries WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully!";
        header("Location: index.php"); // Redirect to index.php after deletion
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

$conn->close();
?>
