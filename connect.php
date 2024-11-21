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

   $data=json_decode(file_get_contents("php://input"));
//    if (false){//empty($data->refid) || empty($data->uname) || empty($data->name) || empty($data->fname) || empty($data->mname) || empty($data->occu) || empty($data->salary) || empty($data->email) || empty($data->mob) || empty($data->door) || empty($data->sname) || empty($data->city) || empty($data->pin) || empty($data->blood) || empty($data->nominee)) {
//     http_response_code(400); // Bad Request
//     echo json_encode(["message" => "Required fields are missing or invalid"]);
//     exit;
// }
   try{
   $conn=new PDO("mysql:host=localhost;dbname=detail","root","");
   $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
   $sql="INSERT INTO information(uname,name,father_name,mother_name,occupation,salary,email,mobile,door,street,city,pincode,blood,nominee) values(:uname,:name,:fname,:mname,:occu,:salary,:email,:mob,:door,:sname,:city,:pin,:blood,:nominee)";
   $stmt=$conn->prepare($sql);
   $stmt->bindParam(':uname',$data->uname);
   $stmt->bindParam(':name',$data->name);
   $stmt->bindParam(':fname',$data->father_name);
   $stmt->bindParam(':mname',$data->mother_name);
   $stmt->bindParam(':occu',$data->occupation);
   $stmt->bindParam(':salary',$data->salary);
   $stmt->bindParam(':email',$data->email);
   $stmt->bindParam(':mob',$data->mobile);
   $stmt->bindParam(':door',$data->door);
   $stmt->bindParam(':sname',$data->street);
   $stmt->bindParam(':city',$data->city);
   $stmt->bindParam(':pin',$data->pincode);
   $stmt->bindParam(':blood',$data->blood);
   $stmt->bindParam(':nominee',$data->nominee);
   if($stmt->execute()){
      http_response_code(200);
      echo json_encode(["message"=>"submitted"]);
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