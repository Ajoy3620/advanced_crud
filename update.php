<?php
$message = ''; // Initialize an empty message

// Check if ID is set in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'travel');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch the existing data for the given ID
    $sql = "SELECT * FROM travel WHERE sl_no = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        $message = "Record not found!";
    }

    // Check if the form is submitted to update the record
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        $age = $_POST['age'];
        $gender = $_POST['gender'];
        $class = $_POST['class'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $any_text = $_POST['any_text'];

        // Update query
        $sql = "UPDATE travel SET 
                name = '$name', 
                age = '$age', 
                gender = '$gender', 
                class = '$class', 
                email = '$email', 
                phone = '$phone', 
                any_text = '$any_text'
                WHERE sl_no = $id";

        // Execute update query
        if ($conn->query($sql) === TRUE) {
            // Set success message
            $message = "Record updated successfully!";
        } else {
            $message = "Error updating record: " . $conn->error;
        }
    }

    // Close the database connection
    $conn->close();
} else {
    $message = "Invalid Request!";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Update The Record</title>


    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Protest Guerrilla", sans-serif;
            font-weight: 400;
            font-style: normal;
        }

        .container {
            max-width: 80%;
            background-color: rgb(218, 181, 253);
            padding: 34px;
            margin: auto;
            align-items: center;
            justify-content: center;
        }

        .container h3 {
            font-size: 40px;
            text-align: center;
            font-family: "Protest Guerrilla", sans-serif;
        }

        p {
            text-align: center;
            font-family: "Protest Guerrilla", sans-serif;
            font-size: 16px;
        }

        input,
        textarea {
            width: 80%;
            margin: 5px auto;
            font-size: 10px;
            padding: 5px;
            border-radius: 5px;
            border: 2px solid black;
            outline: none;
        }

        form {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        .btn {
            border: 2px solid black;
            border-radius: 5px;
            color: #fff;
            background: rgb(245, 101, 245);
            font-size: 15px;
            cursor: pointer;
        }

        body {
            background-image: url("images.jpg");
            height: 100vh;
            display: flex;
            opacity: 0.8;
        }

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
            height: 45px;
        }

        .Go-back-to-Home:hover {
            background-color: #45a049;
        }

        /* Style and animation for the message */
        .message {
            padding: 10px;
            border: 6px solid white;
            margin-bottom: 20px;
            display: inline-block;
            color: white;
            opacity: 0;
            transform: translateY(-20px);
            animation: fadeInOut 4s ease-out forwards;
            height: 45px;
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
    <!-- Go back to home link -->
    <a href="index.php" class="Go-back-to-Home">Go back to Home</a>

    <!-- Update form -->
    <div class="container">
        <h3>Update The Record</h3>
        <form action="" method="post">
            <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($row['name']); ?>" required />
            <input type="text" name="age" id="age" value="<?php echo htmlspecialchars($row['age']); ?>" required />
            <input type="text" name="gender" id="gender" value="<?php echo htmlspecialchars($row['gender']); ?>" required />
            <input type="text" name="class" id="class" value="<?php echo htmlspecialchars($row['class']); ?>" required />
            <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($row['email']); ?>" required />
            <input type="number" name="phone" id="phone" value="<?php echo htmlspecialchars($row['phone']); ?>" required />
            <textarea name="any_text" id="any_text" cols="30" rows="10" required><?php echo htmlspecialchars($row['any_text']); ?></textarea>
            <button class="btn" type="submit">Update</button>
        </form>
    </div>


</body>

</html>