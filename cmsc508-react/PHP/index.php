<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

echo "Testing";


require_once('config.php');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $user = json_decode(file_get_contents('php://input') );
        $sql = "INSERT INTO users(user_name, user_password) VALUES (:username, :password)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
        $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);
        // if($stmt->exec()){
        //     $response = ['status' => 1, 'message' => 'Account created sucessfully']
        // }
        // else{
        //     $response = ['status' => 0, 'message' => 'Failed to add Employee']
        // }

 


}