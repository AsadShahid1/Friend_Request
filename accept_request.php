<?php
session_start();
include ('../inc/conn.php');
    if(isset($_SESSION['id'])){
        $sender_id = $_SESSION['id'];
        $receiver_id = $_GET['receiver_id'];
        $req = 1;
        $sql = mysqli_query($con,"UPDATE friend_request set request = '$req' WHERE sender_id = '$sender_id' and receiver_id= '$receiver_id'");
        if($sql){
            echo "successfully updated";
        }else{
            echo mysqli_error($con);
        }
    
    }
?>