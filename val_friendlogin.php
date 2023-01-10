<?php
include('db.php');
$obj = new Database('batch' , 'chat_system');
// if($obj->is_login())
//     header("location:users.php");
    extract($_POST);
       if (isset($email) && !empty(trim($email))){
        if (isset($pwd) && !empty (trim($pwd))){
            if(strpos($pwd," ")){
                $response2 = [
                    'pass_match' => "error" ,
                    'msg' => "Don't space in between pwd"
               ];
             }else{
                unset($_POST['login']);
                unset($_POST['check']);
                if(isset($check)){
                    if($obj->login($email , $pwd , true))
                    $response2 = [
                        'check' => "success" ,
                        'location' => "friends.php"
                   ];
                }else if($obj->login($email , $pwd)){
                        $response2 = [
                            'check1' => "success" ,
                            'location' => "friends.php"
                    ];
                }else{
                    $response2 = [
                        'message' => "error" ,
                        'msg' => "Credentials doen't match our record"
                   ]; 
                }
             } 
        }
        else{
            $response2 = [
                'pwd' => "error" ,
                'msg' => "pwd is required"
           ];   
        }
       }else{
        $response2 = [
            'email' => "error" ,
            'msg' => "email is required"
       ]; 
    }


echo json_encode($response2);

?>

