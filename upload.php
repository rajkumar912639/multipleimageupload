<?php
require 'connectiion1.php';

if (isset($_POST["submit"])) {
    $name = $_POST['name'];
    $files = $_FILES['fileImg'];
    $uploadDir = 'uploads';
    $allowedTypes = ['jpg', 'jpeg', 'png'];
    $maxSize = 2 * 1024 * 1024; // 2MB
    $filesArray = [];

    // Create the upload directory if it doesn't exist
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    $totalFiles = count($files['name']);

    for ($i = 0; $i < $totalFiles; $i++) {
        $imageName = $files["name"][$i];
        $tmpName = $files["tmp_name"][$i];
        $fileSize = $files["size"][$i];

        // Ensure the file has an extension
        $imageExtension = pathinfo($imageName, PATHINFO_EXTENSION);
        $imageExtension = strtolower($imageExtension);

        // Generate a unique name for the file
        $newImageName = uniqid() . '.' . $imageExtension;

        // Validate file type
        if (!in_array($imageExtension, $allowedTypes)) {
            echo "<script>alert('Invalid file type for $imageName. Only JPG, JPEG, and PNG are allowed.');</script>";
            continue;
        }

        // Validate file size
        if ($fileSize > $maxSize) {
            echo "<script>alert('File size exceeds the 2MB limit for $imageName.');</script>";
            continue;
        }

        // Move the file to the uploads directory
        if (move_uploaded_file($tmpName, $uploadDir . DIRECTORY_SEPARATOR . $newImageName)) {
            $filesArray[] = [
                'original_name' => $imageName,
                'stored_name' => $newImageName
            ];
        } else {
            echo "<script>alert('Error uploading $imageName.');</script>";
        }
    }

    if (!empty($filesArray)) {
        $filesArray = json_encode($filesArray);
        $query = "INSERT INTO gallery (name, image) VALUES ('$name', '$filesArray')";
        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Successfully Added'); document.location.href = 'index1.php';</script>";
        } else {
            echo "<script>alert('Database insertion failed');</script>";
        }
    } else {
        echo "<script>alert('No valid files uploaded');</script>";
    }
}
?>
<html>
<head>
    <title>Upload Image</title>
</head>
<body>
    <h5>My Image</h5>
    <form action="" method="post" enctype="multipart/form-data">
        Name: <input type="text" name="name" required><br>
        Image: <input type="file" name="fileImg[]" accept=".jpg,.jpeg,.png" required multiple><br>
        <button type="submit" name="submit">Submit</button>
    </form>
    <br>
    <a href="index1.php">Index</a>
</body>
</html>
