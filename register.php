<?php 
session_start();
/*
 * If register, validate input, create and save new user to database and allow login
 * Else show error messages and allow them to make corrections and try again
 * Use JQuery Ajax call to allow distinict username by check database
 * Inviation code ensure only those that got email with that secrete password can register
 */
	include("config.php");
        include("class/user.php");
       
         //Start session
      
    // if register button was pressed, validate fields show any error messages
    if( (isset( $_POST['register'] ) ) ) {  
 
	$usr = new Users;
	$usr->storeFormValues( $_POST );
        
	if( sizeof($errmsg_arr = $usr->validate()) > 0 ) {
		$_SESSION['error'] = $errmsg_arr;
                header('location:register.php?error=1');
	} else 
            $usr->register();

       break;
    }
     
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Magic Clinicians</title>
        <link rel="stylesheet" type="text/css" href="css/style.css" />
         <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
        <script type="text/javascript" src="js/check-username.js"></script>  
        
       </head>
    
    <body>
        <!-- validate Answer selection Other specify-->

        <header id="head" >
       
        	<p></p>
                
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
            //echo '<br> *'."Error username and password. Try again. Have you already registered?"; 
                header('location:index.php?error=2');
            }
            
            ?>
        <div id="main-wrapper">
        	<div id="register-wrapper">
                    <h1>Magic Clinician Registration</h1>
                    <p> Already a user?  <a href="index.php">Login</a>
                        	
                          </li>
            	<form method="post" id="register-form">
                	<ul>
                    	<li>
                        
                            <input type="text" id="username" maxlength="30" required autofocus name="username" placeholder="Username" "/>
                            <label id="message"></label>
                    	</li>
                    
                    	<li>
                            <input type="password" id="passwd" size="50" maxlength="50" required name="password" placeholder="Password: 1 letter 1 number 's456dIr7' "/>
                    	</li>
                        
                        <li>
                        	<label for="conpasswd" : </label>
                                <input type="password" id="conpasswd" size="50" maxlength="50" required name="conpassword" placeholder="Confirm Password" class="confirm"  />
                    	</li>
                        <li>
                        	<label for="usn">Invitation Code : </label>
                                <input type="text" id="usn" maxlength="30" required autofocus name="secret" placeholder="M6irpx5w" />
                    	</li>
                    	<li class="buttons">
                        	<input type="submit" name="register" value="Register" />
                            
                    	</li>
                       
                    
                	</ul>
            	</form>
            </div>
            
        </div>
    
    </body>
</html>
