<?php
require 'connectiion1.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <h1>Gallery</h1>
    <table border="1" cellspacing="0" cellpadding="10">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Image</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            $result = mysqli_query($conn, "SELECT * FROM gallery");
            while ($row = mysqli_fetch_assoc($result)) : ?>
                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo htmlspecialchars($row["name"]); ?></td>
                    <td style="display: flex; align-items: center; gap: 10px;">
                        <?php foreach (json_decode($row["image"]) as $image) : ?>
                            <img src="uploads/<?php echo htmlspecialchars($image->stored_name); ?>" width="200" alt="Image">
                        <?php endforeach; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <br>
    <a href="upload.php">Upload Image</a>
</body>
</html>
