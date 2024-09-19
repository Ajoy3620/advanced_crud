<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data and prevent SQL injection
    $name = $_POST['name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $class = $_POST['class'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $any_text = $_POST['any_text'];

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'travel');

    // Check for connection errors
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL to insert the form data
    $sql = "INSERT INTO travel (name, age, gender, class, email, phone, any_text) 
            VALUES ('$name', '$age', '$gender', '$class', '$email', '$phone', '$any_text')";

    // Execute the SQL query
    if ($conn->query($sql) === TRUE) {
        $message = "<span style='color: red; font-weight: bold; font-size: 30px;'>Form successfully submitted. Thanks for believing with us!</span>";
    } else {
        $message = "<span style='color: red; font-weight: bold; font-size: 30px;'>Error: " . $conn->error . "</span>";
    }

    // Close the connection
    $conn->close();
}

// Fetch records
$conn = new mysqli('localhost', 'root', '', 'travel');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Search and fetch results
$search_query = "";
$search_result = null;
if (isset($_GET['search'])) {
    $search_query = $_GET['search'];
    // Modify the search query to check multiple fields (name, gender, age, email)
    $sql_search = "SELECT * FROM travel WHERE 
        name LIKE '%$search_query%' OR 
        gender LIKE '%$search_query%' OR 
        age LIKE '%$search_query%' OR 
        email LIKE '%$search_query%'OR 
       phone LIKE '%$search_query%' OR 
       class LIKE '%$search_query%'  ";
    $search_result = $conn->query($sql_search);
}

// Fetch all records regardless of search
$sql_all = "SELECT * FROM travel";
$result_all = $conn->query($sql_all);

// Start the HTML page
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Submitted Result</title>
    <link href="index.css" rel="stylesheet" />
</head>

<body>

    <style>
        /* Style the button to look nice */
        .back-button {
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

        .back-button:hover {
            background-color: #45a049;
        }

        /* Style for search box */
        .search-box {
            margin-bottom: 20px;
        }

        .search-box input[type="text"] {
            padding: 10px;
            font-size: 16px;
            width: 300px;
        }

        .search-box input[type="submit"] {
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            color: white;
            background-color: #4CAF50;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .search-box input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>

    <div class="container">
        <!-- Back button -->
        <a href="file.php" class="back-button">Go to the FORM</a>

        <!-- Search form -->
        <div class="search-box">
            <form action="index.php" method="get">
                <input type="text" name="search" placeholder="Search by name, gender, age, or email" value="<?php echo htmlspecialchars($search_query); ?>">
                <input type="submit" value="Search">
            </form>
        </div>

        <h3>Submitted Data</h3>

        <?php
        // Display submission message if set
        if (isset($message)) {
            echo $message;
        }
        ?>

        <!-- Display search results if a search was performed -->
        <?php if (isset($search_result)) : ?>
            <h4>Search Results:</h4>
            <?php
            if ($search_result->num_rows > 0) {
                echo "<table border='1px solid black'>
                    <tr>
                        <th>sl_no</th>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Gender</th>
                        <th>Class</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Actions</th>
                    </tr>";
                while ($row = $search_result->fetch_assoc()) {
                    echo "<tr>
                        <td>" . $row['sl_no'] . "</td>
                        <td>" . $row['name'] . "</td>
                        <td>" . $row['age'] . "</td>
                        <td>" . $row['gender'] . "</td>
                        <td>" . $row['class'] . "</td>
                        <td>" . $row['email'] . "</td>
                        <td>" . $row['phone'] . "</td>
                        <td>
                            <a href='update.php?id=" . $row['sl_no'] . "'>Update</a> |
                            <a href='delete.php?id=" . $row['sl_no'] . "' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                        </td>
                    </tr>";
                }
                echo "</table>";
            } else {
                echo "<p style='color: red; font-size: 20px; font-weight: bold;'>Data Not Found</p>";
            }
            ?>
        <?php endif; ?>

        <!-- Always show all records below -->
        <h4>All Records:</h4>
        <?php
        if ($result_all->num_rows > 0) {
            echo "<table border='1px solid black'>
                <tr>
                    <th>sl_no</th>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Gender</th>
                    <th>Class</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Actions</th>
                </tr>";
            while ($row = $result_all->fetch_assoc()) {
                echo "<tr>
                    <td>" . $row['sl_no'] . "</td>
                    <td>" . $row['name'] . "</td>
                    <td>" . $row['age'] . "</td>
                    <td>" . $row['gender'] . "</td>
                    <td>" . $row['class'] . "</td>
                    <td>" . $row['email'] . "</td>
                    <td>" . $row['phone'] . "</td>
                    <td>
                        <a href='update.php?id=" . $row['sl_no'] . "'>Update</a> |
                        <a href='delete.php?id=" . $row['sl_no'] . "' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                    </td>
                </tr>";
            }
            echo "</table>";
        } else {
            echo "No records found";
        }

        // Close the connection
        $conn->close();
        ?>
    </div>
</body>

</html>