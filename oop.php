<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php

$servername = "127.0.0.1";
$username = "root";
$password = "Köcsögh33kk11ng!";
$dbname = "szavazas";

$om=$_POST["om"];
$osztaly=$_POST["osztaly"];
$nev=$_POST["nev"];


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
mysqli_set_charset($conn,"utf8");

$sql = "SELECT szavazott FROM azonosito WHERE om=$om  AND nev = '$nev'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    $row = $result->fetch_assoc();
    if ($row["szavazott"]==1){
        echo "Már szvaztál. Nézd meg inkább a többi programot!";
    }else{
        echo "Szavazatodat sikeresen mentettük. Nézd meg a többi programot is!";
        $sql = "UPDATE azonosito SET szavazott='1' WHERE om='$om' AND nev='$nev'";
        $conn->query($sql);
        /*if ($conn->query($sql) === TRUE) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $conn->error;
        }*/
        $sql = "INSERT INTO osztaly (osztaly) VALUES ('$osztaly')";
        $conn->query($sql);
        /*if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }*/
    }
} else {
    echo "Rosszul írtad be az adataidat. Kérlek menj vissza, majd próbáld újra!";
}
echo $nev . $om . $osztaly;
$conn->close();

?>