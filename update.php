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

   $data=json_decode(file_get_contents("php://input"));

   try{
   $conn=new PDO("mysql:host=localhost;dbname=detail","root","");
   $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
   $sql="update information set uname=:uname,name=:name,father_name=:fname,mother_name=:mname,occupation=:occu,salary=:salary,email=:email,mobile=:mob,door=:door,street=:sname,city=:city,pincode=:pin,blood=:blood,nominee=:nominee where refid=:refid";
   $stmt=$conn->prepare($sql);
   $stmt->bindParam(':refid',$data->refid);
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
      echo json_encode(["message"=>"Data Updated"]);
   }
   else{
      http_response_code(500);
      echo json_encode(["message"=>"Data not Updated"]);
   }}
   catch(PDOException $e)
   {
      http_response_code(500);
      echo json_encode(["message"=>"catch".$e->getMessage()]);
   }
?>