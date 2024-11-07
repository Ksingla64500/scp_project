<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCP Entries</title>
    <link rel="stylesheet" href="includes/style.css"> <!-- Correct path to your CSS -->
</head>
<?php
include('includes/config.php'); // Include DB connection

// Check if 'id' is passed in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the record to be edited
    $sql = "SELECT * FROM scp_entries WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Record not found!";
        exit;
    }
}

// Handle form submission for updating record
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $scp_number = $_POST['scp_number'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $containment_procedures = $_POST['containment_procedures'];
    $object_class = $_POST['object_class'];
    $image_url = $_POST['image_url'];

    // Update the record in the database
    $sql = "UPDATE scp_entries SET 
            scp_number = '$scp_number', 
            title = '$title', 
            description = '$description', 
            containment_procedures = '$containment_procedures', 
            object_class = '$object_class', 
            image_url = '$image_url' 
            WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully!";
        header("Location: index.php");  // Redirect after update
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>

<!-- Form to edit SCP -->
<form method="POST">
    <label for="scp_number">SCP Number</label>
    <input type="text" name="scp_number" id="scp_number" value="<?php echo htmlspecialchars($row['scp_number']); ?>" required><br><br>

    <label for="title">Title</label>
    <input type="text" name="title" id="title" value="<?php echo htmlspecialchars($row['title']); ?>" required><br><br>

    <label for="description">Description</label>
    <textarea name="description" id="description" required><?php echo htmlspecialchars($row['description']); ?></textarea><br><br>

    <label for="containment_procedures">Containment Procedures</label>
    <textarea name="containment_procedures" id="containment_procedures" required><?php echo htmlspecialchars($row['containment_procedures']); ?></textarea><br><br>

    <label for="object_class">Object Class</label>
    <select name="object_class" id="object_class" required>
        <option value="Safe" <?php if ($row['object_class'] == 'Safe') echo 'selected'; ?>>Safe</option>
        <option value="Euclid" <?php if ($row['object_class'] == 'Euclid') echo 'selected'; ?>>Euclid</option>
        <option value="Keter" <?php if ($row['object_class'] == 'Keter') echo 'selected'; ?>>Keter</option>
    </select><br><br>

    <label for="image_url">Image URL</label>
    <input type="text" name="image_url" id="image_url" value="<?php echo htmlspecialchars($row['image_url']); ?>"><br><br>

    <button type="submit" class="btn btn-warning">Update SCP</button>
</form>
