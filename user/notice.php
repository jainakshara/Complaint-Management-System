<?php
// Include the database configuration file
include("include/config.php");

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
      /* Resetting default browser styles */
body {
    font-family: Arial, sans-serif;
    background-color: #3FC8C8; 
    color: #fff; /* White text color */
    margin: 0;
    padding: 0;
}

.container {
    max-width: 1500px; /* Adjusted max-width */
    margin: 20px auto;
    padding: 20px;
    background-color: #fff; /* White container background */
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.5); /* Darker box shadow */
}

h1 {
    text-align: center;
    margin-bottom: 20px;
    color: #000; /* Black heading text color */
    font-size: 28px;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 40px;
    color: #000; /* Black table text color */
    
}

th, td {
    padding: 10px;
    text-align: left;
    border-bottom: 1px solid #ccc; /* Light gray border color */
    font-size: 18px
}

th {
    background-color: #f2f2f2; /* Light gray background for table header */
}

.notice-date {
    min-width: 250px;
}

.back-link {
            margin-top: 20px;
            text-align: center; /* Center align link */
        }

        .back-link a {
            color: black; /* White link color */
            text-decoration: none;
            background-color: #3FC8C8; 
            padding: 10px 20px; /* Adjust padding */
            border-radius: 5px; /* Rounded corners */
            transition: background-color 0.3s ease; /* Smooth transition */
        }

        .back-link a:hover {
            background-color: #6FC0BB; /* Darker cyan color on hover */
        }

       </style>
    
    <title>Notice</title>
   
</head>
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
                    echo "<tr><td colspan='3'>No notices found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
        
        <div class="back-link">
            <a href="index.php">Back to Home</a>
        </div>
        
    </div>
</body>
</html>
