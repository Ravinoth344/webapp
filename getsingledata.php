<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");  // Allow requests from any origin
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
$id = $_GET['id'];
try{
$conn=new PDO("mysql:host=localhost;dbname=detail","root","");
$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
$sql="select * from information where refid=:id";
$stmt=$conn->prepare($sql);
$stmt->bindParam(':id',$id,PDO::PARAM_INT);
$stmt->execute();
$data = $stmt->fetch(PDO::FETCH_ASSOC);
if ($data) {
    // Return the data as JSON
    echo json_encode($data);
} else {
    // Return a custom message if no data is found
    echo json_encode(["error" => "No data found for the provided id"]);
}
}
catch(PDOException $e)
{
    echo json_encode(["error"=>"connection failed"]);
}
?>