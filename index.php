<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "wpdb1";
 
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
 
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
 
$sql = "SELECT * FROM tbl1";
$result = $conn->query($sql);

if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo"<ul>
        <li>ID : ".$row['ID']."</li>
        <li>Title : ".$row['title']."</li>
        <li>Info : ".$row['info']."</li>
        <li>Image :<img width='200' src='".$row['img']."'></li>
        </ul>";
    }
} else {
    echo "0 results";
}
?>
 
<form method="GET">
      <label for="fname">First Name</label><br>
    <input type="text" id="fname" name="fname"><br>
    <label for="lname">Last Name</label><br>
    <input type="text" id="lname" name="lname"><br>

    <button>Submit</button>
</form>

<?php
if($_GET['fname']){
  echo "First Name from server : ".$_GET['fname'];
}
?>