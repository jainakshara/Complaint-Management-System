<?php
// Include the database configuration file
include("include/config.php");

// Function to sanitize input data
function sanitize($data) {
    return htmlspecialchars(strip_tags($data));
}

// Check if edit or delete actions are triggered
if (isset($_GET['action'])) {
    if ($_GET['action'] == 'edit') {
        // Handle edit action
        $id = sanitize($_GET['id']);
        // Redirect to the edit page with notice ID
        header("Location: edit_notice.php?id=$id");
        exit;
    } elseif ($_GET['action'] == 'delete') {
        // Handle delete action
        $id = sanitize($_GET['id']);
        // Perform delete operation (You need to implement this)
        $delete_sql = "DELETE FROM notices WHERE id = $id";
        $delete_result = mysqli_query($con, $delete_sql);
        if ($delete_result) {
            echo "<script>alert('Notice deleted successfully');</script>";
            // Reload the page after deletion
            header("Refresh:0");
            exit;
        } else {
            echo "<script>alert('Failed to delete notice');</script>";
        }
    }
}

// Fetch all notices from the database
$sql = "SELECT * FROM notices";
$result = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User View Notices</title>
    <link rel="stylesheet" href="assets/css/style.css"> <!-- Include your CSS file -->
    <style>
        /* Custom CSS for the table */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 1500px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        .notice-date {
            min-width: 150px;
        }
        .back-link {
            text-align: center;
            margin-top: 20px;
        }
        .action-buttons {
            display: flex;
            justify-content: space-between;
        }
        .action-buttons a {
            padding: 5px 10px;
            border-radius: 5px;
            text-decoration: none;
            color: #fff;
        }
        .edit-button {
            background-color: #007bff;
        }
        .delete-button {
            background-color: #dc3545;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Notices</h1>
        
        <!-- Display notices in a table -->
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Content</th>
                    <th class="notice-date">Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Check if there are any notices
                if (mysqli_num_rows($result) > 0) {
                    // Loop through each notice and display it in a row
                    while($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr>
                            <td><?php echo $row["title"]; ?></td>
                            <td><?php echo $row["content"]; ?></td>
                            <td class="notice-date"><?php echo $row["created_at"]; ?></td>
                            
                        </tr>
                        <?php
                    }
                } else {
                    // No notices found
                    echo "<tr><td colspan='4'>No notices found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
        
        <!-- Back to Home link -->
        <div class="back-link">
            <a href="index.php">Back to Home</a>
        </div>
    </div>

   
</body>
</html>
