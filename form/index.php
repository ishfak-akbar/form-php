<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "form";
 
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
 
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if (!$conn) {
    echo "Database connection failed!<br>";
}
 
$sql = "SELECT * FROM tbl_form";
$result = $conn->query($sql);

if(isset($_POST["add"])){
    $fname=$_POST["fname"];
    $lname=$_POST["lname"];
    $email=$_POST["email"];
    $password=$_POST["password"];
    $dob=$_POST["dob"];

    $sql = "INSERT INTO tbl_form(firstName, lastName, email, password, dob) VALUES ('$fname','$lname','$email','$password','$dob')";

     if ($conn->query($sql)) {
        echo "<script>alert('Inserted Successfully!');</script>";

        header("Location:index.php"); //redirects to the same page
    } else {
        echo "Error: " . $conn->error;
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <title>User Form</title>
</head>
<body class="gradient-backgroundd">
    <section style="min-height: 100vh; display: flex; align-items: center; justify-content: center;">
        <form method="POST"> <!--method POST for *uploading* info --> 
    <!-- required makes sure all the boxes are filled with data -->
      <h2 style="text-align:center;font-size:28px; margin-bottom: 6px">Sign Up</h2>
      <p style="display: block; font-size: 12px; font-weight: 400; color: rgba(0,0,0,0.4); text-align: center; margin-bottom: 15px">Provide your info to register</p>

      <label for="fname">First Name</label>
      <input type="text" id="fname" name="fname" required placeholder="Type your first name"><br>

      <label for="lname">Last Name</label>
      <input type="text" id="lname" name="lname" required placeholder="Type your last name"><br>

      <label for="email">Email</label>
      <input type="text" id="email" name="email" required placeholder="Type your email"><br>

      <label for="password">Password</label>
      <input type="password" id="password" name="password" required placeholder="********"><br>

      <label for="dob">Date Of Birth</label>
      <input type="date" id="dob" name="dob" required placeholder="Date Of Birth">

      <button name="add" type="submit"><b>SUBMIT</b></button>
      <p style="display: block; font-size: 12px; font-weight: 400; color: rgba(0,0,0,0.4); text-align: center; margin-top: 15px">Already have an account? <span style="font-weight: 700;color: black">Sign In</span></p>
  </form>
    </section>

  <div class="row_container">
    <h3 style="text-align: center;">Saved Data</h3>
    <?php foreach($result as $r){?>
    <div class="row">
        <span><?php echo($r["firstName"])?> <?php echo($r["lastName"]) ?></span>
        <span><?php echo($r["email"]) ?></span>
        <span style="text-align: right;"><?php echo($r["dob"]) ?></span>
    </div>
        <?php }?>
  </div>
</body>
