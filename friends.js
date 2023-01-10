
// login form validation 
$(document).ready(function(){
    $(document).on('submit' , '#friendlog' , function(e){
        e.preventDefault();
        $.ajax({
            url: $(this).prop('action'),
            method : $(this).prop('method'),
            contentType: false,
            cache: false,
            processData: false,
            dataType: 'JSON',
            data: new FormData(this),
            success:function(result2){
                // console.log(hello);
                if(result2.email == "error"){
                    toastr.error(result2.msg , "Error");
                }else if(result2.pwd == "error"){
                        toastr.error(result2.msg , "Error");
                }else if(result2.pass_match == "error"){
                        toastr.error(result2.msg , "Error");
                }else if(result2.message == "error"){
                        toastr.error(result2.msg , "Error");
                }else if(result2.check == "success"){
                    window.location= result2.location;
                }else if(result2.check1 == "success"){
                    window.location= result2.location;
                }
            }
        });
    });
    
    
    var id="";
    var req = 0;
    // hide persons in ma you know
    
    $(document).on('click' , '#remove_btn' , function(e){
        e.preventDefault();
            
    });
    
    // Add friend button
    
    
    $(document).on('click' , '.rec_id' , function(e){
        e.preventDefault();
        var id = $(this).data('id');
        var req=1;
        var url = "insert_request.php?receiver_id="+ id +"&request=" + req;   
            $.get(url , function(){
                var url = "get_request.php"; 
                $.get(url , function(res){
                    $('.request_load').html(res);
                })
                });    
    });
    // Accept friend request button
    setInterval(() => {
        $.get("get_friend.php" , function(res){
            $('.friends_load').html(res);
        })   
        $.get("get_request.php" , function(res){
            $('.request_load').html(res);
        }) 
    }, 5000);
    
    // accept request click event
    $(document).on('click' , '.accept_id' , function(e){
        e.preventDefault();
        var id = $(this).data('id');
        var url = "accept_request.php?receiver_id="+ id;   
            $.get(url , function(){
                var url = "get_friend.php"; 
                $.get(url , function(res){
                    $('.friends_load').html(res);
                })
                });    
    });
    
    //search button work
    $(document).on('click' , '#search' , function(e){
        e.preventDefault();
        $('#search').keyup(function(){
            $.post("search_users.php", {name: $(this).val()},function(data){
                $("#all-friends").html(data);
              });
            });
    });
})
