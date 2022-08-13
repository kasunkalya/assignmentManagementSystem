
<?php 




$servername = "localhost";
$username = "kasunkalya";
$password = "Admin@123";
$dbname = "core_web";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id,studentAttachment FROM assignment_request WHERE id<=8247";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "id: " . $row["studentAttachment"]. "<br>";
    
    $source_file = 'attachments/'.$row["id"].'/'.$row["studentAttachment"];
    $destination_path = 'deleted/';
    rename($source_file, $destination_path . pathinfo($source_file, PATHINFO_BASENAME));
    
    
  }
} else {
  echo "0 results";
}
$conn->close();




//unlink($myFile) or die("Couldn't delete file");



?> 
