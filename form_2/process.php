<?php
// Database connection and PHP logic
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "form3";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->query("CREATE TABLE IF NOT EXISTS tbl_form (
    id INT AUTO_INCREMENT PRIMARY KEY,
    firstName VARCHAR(100),
    lastName VARCHAR(100),
    email VARCHAR(255),
    password VARCHAR(255),
    dob DATE,
    phone VARCHAR(20),
    address TEXT,
    gender ENUM('male', 'female', 'other'),
    subscription ENUM('basic', 'premium', 'enterprise'),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");

//set content type for AJAX responses
header('Content-Type: application/json');

//handle different actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add'])) {
        //add new records
        $fname = $conn->real_escape_string($_POST["fname"]);
        $lname = $conn->real_escape_string($_POST["lname"]);
        $email = $conn->real_escape_string($_POST["email"]);
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
        $dob = $conn->real_escape_string($_POST["dob"]);
        $phone = $conn->real_escape_string($_POST["phone"]);
        $address = $conn->real_escape_string($_POST["address"]);
        $gender = $conn->real_escape_string($_POST["gender"]);
        $subscription = $conn->real_escape_string($_POST["subscription"]);

        $sql = "INSERT INTO tbl_form (firstName, lastName, email, password, dob, phone, address, gender, subscription) 
                VALUES ('$fname','$lname','$email','$password','$dob','$phone','$address','$gender','$subscription')";

        if ($conn->query($sql)) {
            echo json_encode(['success' => true, 'message' => 'User added successfully!']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error: ' . $conn->error]);
        }
    } elseif (isset($_POST['edit'])) {
        //update record
        $id = $conn->real_escape_string($_POST["id"]);
        $fname = $conn->real_escape_string($_POST["fname"]);
        $lname = $conn->real_escape_string($_POST["lname"]);
        $email = $conn->real_escape_string($_POST["email"]);
        $dob = $conn->real_escape_string($_POST["dob"]);
        $phone = $conn->real_escape_string($_POST["phone"]);
        $address = $conn->real_escape_string($_POST["address"]);
        $gender = $conn->real_escape_string($_POST["gender"]);
        $subscription = $conn->real_escape_string($_POST["subscription"]);

        $sql = "UPDATE tbl_form SET 
                firstName='$fname', lastName='$lname', email='$email', 
                dob='$dob', phone='$phone', address='$address', 
                gender='$gender', subscription='$subscription' 
                WHERE id=$id";

        if ($conn->query($sql)) {
            echo json_encode(['success' => true, 'message' => 'User updated successfully!']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error: ' . $conn->error]);
        }
    } elseif (isset($_POST['delete'])) {
        //delete record
        $id = $conn->real_escape_string($_POST["id"]);
        $sql = "DELETE FROM tbl_form WHERE id=$id";

        if ($conn->query($sql)) {
            echo json_encode(['success' => true, 'message' => 'User deleted successfully!']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error: ' . $conn->error]);
        }
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['action'])) {
        if ($_GET['action'] === 'get_users') {
            //get all users info
            $sql = "SELECT * FROM tbl_form ORDER BY id DESC";
            $result = $conn->query($sql);
            $users = [];
            
            while($row = $result->fetch_assoc()) {
                $users[] = $row;
            }
            
            echo json_encode(['success' => true, 'data' => $users]);
        } elseif ($_GET['action'] === 'get_user') {
            //get single user info
            $id = $conn->real_escape_string($_GET["id"]);
            $result = $conn->query("SELECT * FROM tbl_form WHERE id=$id");
            $user = $result->fetch_assoc();
            
            if ($user) {
                echo json_encode(['success' => true, 'data' => $user]);
            } else {
                echo json_encode(['success' => false, 'message' => 'User not found']);
            }
        }
    }
}
?>