<?php
 //require "localhost/form/dbconnect.php";
   header("Access-control-Allow-Origin: *");
   //header("Content-Type: application/json; charset=UTF-8");
   header("Access-control-Allow-Methods: POST, OPTIONS");
   header("Access-control-Allow-Headers: Content-Type, Access-Control-Allow-Headers,Authorization,X-Requested-With");
   if($_SERVER['REQUEST_METHOD'] === 'OPTIONS')
   {
      http_response_code(200);
      exit;
   }
   // if($_SERVER['REQUEST_METHOD'] !== '')
   // {
   //    http_response_code(405);
   //    echo json_encode(["message"=>"method not implemented"]);
   //    exit;
   // }

   $data=file_get_contents("php://input");
   try{
   $conn=new PDO("mysql:host=localhost;dbname=detail","root","");
   $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
   $sql="delete from information where refid=:refid";
   $stmt=$conn->prepare($sql);
   $stmt->bindParam(':refid',$data);
   if($stmt->execute())
   {
      http_response_code(200);
      echo json_encode(["message"=>"form deleted"]);
   }
   else{
      http_response_code(500);
      echo json_encode(["message"=>"not submitted"]);
   }}
   catch(PDOException $e)
   {
      http_response_code(500);
      echo json_encode(["message"=>"catch".$e->getMessage()]);
   }
?>