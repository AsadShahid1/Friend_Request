
 <?php
                      
include ('../inc/conn.php');
extract($_POST);
$query = mysqli_query($con, "SELECT * FROM chat_system WHERE CONCAT(`first` , ' ' , `last` ) like '%$name%'");
if($query){
    if(mysqli_num_rows($query) > 0){
        while($row = mysqli_fetch_assoc($query)){
            extract($row);
 ?>
               <div id="all-friends">
               <div class="chat_list chat_user">
                    <div class="chat_people">
                      <div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
                      <div class="chat_ib">
                        <h2><?= $first." ".$last ?><span><button class="btn btn-primary m-3 rec_id" data-id="<?= $user['id'] ?>">Add Friend</button></span> </h2>
                      </div>
                    </div>
                  </div>  
                </div>           
 <?php
              }
          }else{
              echo "<div class='alert alert-danger'>No Record Found</div>";
          }
      }else{
          echo mysqli_error($con);
      }
  ?>