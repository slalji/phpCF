 <?php 
    session_start();
 /*
  * If Login, Create new User session, validate input and check database for data
  * Else show errors and direct them to register instead.
  */
 include("config.php");
 include("class/user.php");
  //
    if( isset( $_POST['login'] )  ) {
     
	$usr = new Users;
	$usr->storeFormValues( $_POST );         
       $usr->userLogin();
	break;
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Magic Login</title>
        <link rel="stylesheet" type="text/css" href="css/style.css" />
    </head>
    
    <body>
        
        <header id="head" >
        	<p>Magic Survey for Clinicians </p>
        </header>
       <?php
           
         echo "<div class=error>";
            if (isset ($_GET['error']) && $_GET['error'] == '1'){
            foreach($_SESSION['error'] as $msg) {
                    echo '<br> *',$msg;  
                } 
                 echo "</div>";
            }
            else if (isset ($_GET['error']) && $_GET['error'] == '2'){
           echo '<br> *'."Error username and password does not exist. Try registering?  <a href=register.php>Register</a>"; 
                
            }
        ?>
        <div id="main-wrapper">
        	<div id="login-wrapper">
            	<form method="post" action="">
                   <a href="register.php">Register</a>
                   <hr>
                   
                	<ul>Sign in
                    	<li>
                        	<label for="usn">Username : </label>
                        	<input type="text" maxlength="30" required autofocus name="username" />
                    	</li>
                    
                    	<li>
                        	<label for="passwd">Password : </label>
                        	<input type="password" maxlength="30" required name="password" />
                                <input type='hidden' name='max' value='3'>
                    	</li>
                        
                        
                    	<li class="buttons">
                            <input type="submit" name="login" value="Login" /> 
                          </li>
                    
                	</ul>
            	</form>
                
            </div>
        </div>
    
    </body>
</html>
