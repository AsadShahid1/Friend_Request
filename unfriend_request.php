<?php
 include ('../inc/conn.php');
 if(isset($_GET['id'])){
     $id = $_GET['id'];
     $query = mysqli_query($con , "DELETE FROM friend_request WHERE id= '$id' ");
     if($query){
         header("location:friends.php");
     }else{
         echo mysqli_error($con);
     }
 }
?>