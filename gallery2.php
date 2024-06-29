<?php

// Establish connection to the database
$conn = new mysqli("localhost", "root", "", "gallery");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST['submit'])){
    $photo = $_FILES['photo'];
    $file_names = $_FILES["photo"]["name"];
    $location = "uploads/";

    // Check if files are not empty
    if(!empty($file_names[0])){
        $photo_names = [];

        foreach($file_names as $key => $val) {
            $targetPath = $location . $val;
            if(move_uploaded_file($_FILES['photo']['tmp_name'][$key], $targetPath)){
                $photo_names[] = $val;
            }
        }

        $photo_names = implode(",", $photo_names);

        // Prepare the SQL query
        $query = "INSERT INTO gallery (image) VALUES ('$photo_names')";

        // Execute the query
        $result = mysqli_query($conn, $query);

        // Check the result
        if($result) {
            echo "Success";
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "No files selected.";
    }
}

// Close the connection
$conn->close();
?>

<html>
<head>
    <title>My Image</title>
</head>
<body>
    <h5>My Image</h5>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="photo[]" accept=".jpg,.png,.jpeg" multiple>
        <br>
        <button type="submit" name="submit">Submit</button>
    </form>
</body>
</html>
