<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCP Entries</title>
    <link rel="stylesheet" href="includes/style.css"> <!-- Correct path to your CSS -->
</head>
<?php
include('includes/config.php'); // Include DB connection

// Handle form submission for creating new SCP
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $scp_number = $_POST['scp_number'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $containment_procedures = $_POST['containment_procedures'];
    $object_class = $_POST['object_class'];
    $image_url = $_POST['image_url'];

    // Insert new SCP record into the database
    $sql = "INSERT INTO scp_entries (scp_number, title, description, containment_procedures, object_class, image_url) 
            VALUES ('$scp_number', '$title', '$description', '$containment_procedures', '$object_class', '$image_url')";

    if ($conn->query($sql) === TRUE) {
        echo "New SCP created successfully!";
        header("Location: index.php");  // Redirect after insert
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>

<!-- Form to create new SCP -->
<form method="POST">
    <label for="scp_number">SCP Number</label>
    <input type="text" name="scp_number" id="scp_number" required><br><br>

    <label for="title">Title</label>
    <input type="text" name="title" id="title" required><br><br>

    <label for="description">Description</label>
    <textarea name="description" id="description" required></textarea><br><br>

    <label for="containment_procedures">Containment Procedures</label>
    <textarea name="containment_procedures" id="containment_procedures" required></textarea><br><br>

    <label for="object_class">Object Class</label>
    <select name="object_class" id="object_class" required>
        <option value="Safe">Safe</option>
        <option value="Euclid">Euclid</option>
        <option value="Keter">Keter</option>
    </select><br><br>

    <label for="image_url">Image URL</label>
    <input type="text" name="image_url" id="image_url"><br><br>

    <button type="submit" class="btn btn-success">Create SCP</button>
</form>
