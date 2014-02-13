<?php

if (isset($_GET['id']) && (filter_var($_GET['id'], FILTER_VALIDATE_INT)) ){
        $_id= $_GET['id'];
if(isset($_GET['studyname'])  && preg_match("/[A-Za-z0-9]+/", $_GET['studyname']) == TRUE)
         $study = $_GET['studyname']; 
if (isset($_GET['counter']) && (filter_var($_GET['counter'], FILTER_VALIDATE_INT)) ) 
         $counter= $_GET['counter'];
 

}

 else {
        $_SESSION['error']='Contact your Administrator';
        header('location:index.php?error=1');
 }
?>
<html>
    <head>
        <title>Mag3</title>
        <link rel="stylesheet" type="text/css" href="css/style.css" />
        
       
    </head>
    
    <body>
        
        <header id="head" >
        	<p>Magic Survey for Clinicians </p>
        </header>
         <div id="main-wrapper">
        	<div id="login-wrapper">
                    <input type=hidden name=id value='<?php echo $_id?>'>
                    <input type=hidden name=counter value='<?php echo $counter?>'>
                    <?php echo 'studyname: '.$study.'<br>id: '.$_id.''; ?>
                    <hr>
<form action='random.php' method='post'>
         <input type=hidden name=id value='<?php echo $_id?>'>
    <input type=hidden name=counter value='<?php echo $counter?>'>
        <label>Did you understand the mean of this survey :</label>
         <ul>
             <li><input type="radio"  name="meaning" value="yes">Yes </li>
             <li><input type="radio"  name="meaning" value="no">No</li>
         </ul>
         
         <p><br>
        <input type=submit value='submit'>
</form>
                </div></div>
    </body>
