<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "northwind";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM customers";
$result = $conn->query($sql);
$json = [];
$i = 1;
if ($result->num_rows > 0) {

// output data of each row
while($rows = $result->fetch_assoc()) {
  $json[$i] = [
    'CustomerID' => $rows["CustomerID"],
    'CompanyName' => $rows["CompanyName"],
    'ContactName' => $rows["ContactName"], 
    'ContactTitle' => $rows["ContactTitle"],
    'Address' => $rows["Address"],
    'City' => $rows["City"],
    'Region' => $rows["Region"],
    'PostalCode' => $rows["PostalCode"],
    'Country' => $rows["Country"],
    'Phone' => $rows["Phone"],
    'Fax' => $rows["Fax"],
  ];
$i = $i + 1;
}
} else {
echo "0 results";
}
$conn->close();
$data = ['data' => $json];
header('Content-Type: application/json');
	header('Access-Control-Allow-Methods: GET');
	
echo json_encode(
	array(
		'took'=>microtime(true),
		'code'=>200,
		'message'=>'Response Successfully',
		'data' => $json
		)
	);
?>
