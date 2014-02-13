 $(document).ready(function(){
            $("#username").change(function(){
                 $("#message").html("checking...");
             
 
            var username=$("#username").val();
 
              $.ajax({
                    type:"post",
                    url:"check-username.php",
                    data:"username="+username,
                        success:function(data){
                        if(data==0){
                            $("#message").html("<font color=green>Username available</font>");
                        }
                        else{
                            $("#message").html("<font color=red>Username already taken</font>");
                        }
                    }
                 });
 
            });
 
         });
 

