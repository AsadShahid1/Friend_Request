<?php 
include ('../inc/conn.php');
session_start();
    if(isset($_SESSION['id'])){
        $login = $_SESSION['id'];        
        $query = mysqli_query($con,"SELECT C.id as id, C.first as first , C.last as last , F.request as request FROM chat_system C  inner JOIN friend_request F
        ON F.sender_id = C.id  WHERE  (receiver_id = '$login' AND request = 0)");
        if($query){
            if(mysqli_num_rows($query) > 0){
 ?>
     <?php
           while($row = mysqli_fetch_assoc($query)){
            extract($row);
    ?>  
          <div class="chat_list chat_user">
                    <div class="chat_people">
                      <div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
                      <div class="chat_ib">
                        <h2><?= $first." ".$last ?><span><button class="btn btn-primary m-3 accept_id " data-id="<?= $id?>">ACCEPT</button></span> </h2>
                    </div>
                    </div>
            </div>  
            <?php
                }
                }
                else{
                    echo "<div class='alert alert-danger'>No Record Found</div>";
                }
            }else{
                echo mysqli_error($con);
            }
    }
                
            ?>