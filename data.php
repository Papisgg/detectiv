<?php
// Подключение к базе данных
$servername = "localhost";
$username = "u2995773_u293290";
$password = "Egor200544";
$dbname = "u2995773_default";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Запрос к базе данных
$sql = "SELECT * FROM transactions";
$result = $conn->query($sql);

// Преобразование в JSON
$data = array();
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $data[] = $row;
  }
} else {
  $data = array("error" => "No data found");
}

echo json_encode($data);


?>
