<?php
$message = ''; // Initialize an empty message

// Check if ID is set in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'travel');

    // Check for connection errors
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Delete query
    $sql = "DELETE FROM travel WHERE sl_no = $id";

    // Execute delete query
    if ($conn->query($sql) === TRUE) {
        // Set success message
        $message = "Record Deleted Successfully !!";
    } else {
        $message = "Error deleting record: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
} else {
    $message = "Invalid Request!";
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Delete Record</title>
    <style>
        /* Style the button to look nice */
        .Go-back-to-Home {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            color: white;
            background-color: #4CAF50;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            margin-bottom: 20px;
        }

        .Go-back-to-Home:hover {
            background-color: #45a049;
        }

        /* Style and animation for the message */
        .message {
            padding: 10px;
            border: 2px solid green;
            margin-bottom: 20px;
            display: inline-block;
            color: green;
            opacity: 0;
            transform: translateY(-20px);
            animation: fadeInOut 4s ease-out forwards;
        }

        @keyframes fadeInOut {
            0% {
                opacity: 0;
                transform: translateY(-20px);
            }

            20% {
                opacity: 1;
                transform: translateY(0);
            }

            80% {
                opacity: 1;
                transform: translateY(0);
            }

            100% {
                opacity: 0;
                transform: translateY(20px);
            }
        }
    </style>
</head>

<body>
    <!-- Display message -->
    <?php if ($message): ?>
        <div class="message">
            <?php echo htmlspecialchars($message); ?>
        </div>
    <?php endif; ?>

    <!-- Other content or redirection links can go here -->
    <a href="index.php" class="Go-back-to-Home">Back To The List</a>
</body>

</html>