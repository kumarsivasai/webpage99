<?php
// Database connection setup
$host = "localhost"; // Use "localhost" for host
$port = "3308"; // MySQL port
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$dbname = "vollyballform"; // Your database name

// Create connection
$conn = new mysqli($host, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $firstname = htmlspecialchars(trim($_POST['firstname']));
    $lastname = htmlspecialchars(trim($_POST['lastname']));
    $rollnumber = htmlspecialchars(trim($_POST['rollnumber']));
    $fathername = htmlspecialchars(trim($_POST['fathername']));
    $age = intval($_POST['age']);
    $dob = htmlspecialchars(trim($_POST['dob']));
    $jerseynumber = intval($_POST['jerseynumber']);
    $gender = htmlspecialchars(trim($_POST['gender']));
    $languages = isset($_POST['language']) ? implode(',', $_POST['language']) : ''; // Convert array to string
    $schoolname = htmlspecialchars(trim($_POST['schoolname']));
    $address = htmlspecialchars(trim($_POST['address']));
    $pincode = intval($_POST['pincode']);
    $email = htmlspecialchars(trim($_POST['email']));
    $mobile = htmlspecialchars(trim($_POST['mobile']));

    

    // Prepare SQL query using prepared statements
    $sql = "INSERT INTO registerform (firstname, lastname, rollnumber, fathername, age, dob, jerseynumber, gender, language, schoolname, address, pincode, email, mobile) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Prepare statement failed: " . $conn->error);
    }

    $stmt->bind_param(
        "ssssssssssssss",
        $firstname,
        $lastname,
        $rollnumber,
        $fathername,
        $age,
        $dob,
        $jerseynumber,
        $gender,
        $languages,
        $schoolname,
        $address,
        $pincode,
        $email,
        $mobile
    );

    // Execute the query
    if ($stmt->execute()) {
        // Redirect to form.html after successful execution
        header('Location: form.html');
        exit();
    } else {
        // Log the error and display a generic error message
        error_log("Database error: " . $stmt->error); // Logs the error on the server
        echo "An error occurred. Please try again later.";
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>

