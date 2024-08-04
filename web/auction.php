<?php
$servername = "localhost"; 
$username = "root"; 
$password = "root"; 
$dbname = "auction"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $auctionItem = $_POST["auction-item"];
    $vehicleID = $_POST["vehicle-id"];
    $offeredPrice = $_POST["reserve-price"];
    $Name = $_POST["name"];
    $Email = $_POST["email"];
    $Phone = $_POST["phone"];

    $stmt = $conn->prepare("INSERT INTO auction_table (auction_item, vehicle_id, offered_price, name, email, phone)
                            VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssdsss",$auctionItem, $vehicleID, $offeredPrice, $Name, $Email, $Phone);

    if ($stmt->execute()) {
        echo "<h1 style='text-align: center;'>You are Registered successfully.</h1>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
