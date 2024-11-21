<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");  // Allow requests from any origin
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
try{
$conn=new PDO("mysql:host=localhost;dbname=detail","root","");
$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
$sql="select * from information";
$stmt=$conn->prepare($sql);
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($data);
}
catch(PDOException $e)
{
    echo json_encode(["error"=>"connection failed"]);
}
?>