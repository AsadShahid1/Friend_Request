<?Php
include 'db.php';
include '../inc/conn.php';
$obj = new Database('batch', 'chat_system');
$users = $obj->chat_user();
if (!$obj->is_login())
  header("location:friendslogin.php");
$user = $obj->data();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Friend Request</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
  <link href="http://getbootstrap.com/examples/jumbotron-narrow/jumbotron-narrow.css" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="../Chat System//user.css">
</head>

<body>

  <div class="container bootstrap snippets bootdey mt-5 border border-5 p-3">
    <div class="row">
      <div class="header col-8">
        <h3 class="text-muted prj-name">
          <span class="fa fa-users fa-2x principal-title"></span>
       FRIEND REQUEST SYSTEM
        </h3>
      </div>
      <div class="col-4 ">
        <div class="d-flex">
          <input class="form-control me-2" type="search" id="search" placeholder="Search" aria-label="Search" style="user-select: auto;">
          <a class="btn btn-primary ml-2" href="logout.php" role="button">Logout</a>
        </div>
      </div>
    </div>

    <div class="container">
        <br>
           <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#cam"><i class="fa fa-camera"></i></a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#home">USERS</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#menu1">REQUESTS</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#status">FRIENDS</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#menu2">CALLS</a>
          </li>
        </ul>
         
           <!-- Tab panes -->
      <div class="tab-content">
             <div id="cam" class="container tab-pane fade"><br>
               <h3>camera</h3>
               <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
             </div>
             <div id="home" class="container tab-pane active"><br>
             <div class="inbox_chat">
               <div id="all-friends">
                     <?php
                         foreach($users as $user){
                          $login = $_SESSION['id'];
                          $query = mysqli_query($con,"SELECT * FROM friend_request WHERE 
                          (sender_id = '$login'
                          And receiver_id = '$user[id]') OR (receiver_id = '$login' 
                          And sender_id = '$user[id]')");
                            if($query){
                             if(mysqli_num_rows($query) > 0){
                               $us = mysqli_fetch_assoc($query);
                     ?>
                
                  <div class="chat_list chat_user">
                    <div class="chat_people">
                      <div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
                      <div class="chat_ib">
                        <h2><?= $user['first']." ".$user['last'] ?><span>
                        <?php
                          if($us['request'] == 1){
                        ?>
                         <a href="unfriend_request.php?id=<?= $us['id'] ?>"> <button class="btn btn-primary m-3 unfriend_id" data-id="<?= $user['id'] ?>">Unfriend</button></a>
                          <?php
                          }else if($us['sender_id'] == $login){
                            ?>
                         <a href="unfriend_request.php?id=<?= $us['id'] ?>"> <button class="btn btn-primary m-3 cancel_id" data-id="<?= $user['id'] ?>">Cancel Request</button></a>

                            <?php
                          }else if($us['receiver_id'] == $login){
                            ?>
                          <button class="btn btn-primary m-3 accept_id" data-id="<?= $user['id']?>">Accept Request</button>
                            <?php
                          }
                          ?>
                          
                        </span> </h2>
                      </div>
                    </div>
                  </div>  
            <?php
                            }else{
                              ?>
                              
                  <div class="chat_list chat_user">
                    <div class="chat_people">
                      <div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
                      <div class="chat_ib">
                        <h2><?= $user['first']." ".$user['last'] ?><span><button class="btn btn-primary m-3 rec_id" data-id="<?= $user['id'] ?>">Add Friend</button></span> </h2>
                      </div>
                    </div>
                  </div> 
                              <?php
                            }
                          }
              }
            ?>
            
          </div>
    </div>
    </div>
    <div id="menu1" class="container tab-pane fade"><br>
      <h3>Friend Requests</h3>
      <div class="inbox_chat request_load">
          <?php
            include("get_request.php");
          ?>
      </div>
    </div>
    <div id="status" class="container tab-pane fade"><br>
      <h3>FRIENDS</h3>
      <div class="inbox_chat friends_load">
          <?php
            include("get_friend.php");
          ?>
      </div>    </div>
    <div id="menu2" class="container tab-pane fade"><br>
      <h3>calls</h3>
      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
    </div>
  </div>
</div>




  </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="friends.js"></script>

</body>

</html>