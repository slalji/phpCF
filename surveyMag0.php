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
        <title>Mag0</title>
        <link rel="stylesheet" type="text/css" href="css/style.css" />
   
         
    </head>
    
    <body>
        
        <header id="head" >
        	<p>Magic Survey for Clinicians </p>
        </header>
         <div id="main-wrapper">
        	<div id="login-wrapper">
                    <?php echo 'studyname: '.$study.'<br>id: '.$_id.''; ?>
                    <hr>
<h1>Demographics Survey for everyone to complete</h1>

<form action='random.php' method='post'>
         <input type=hidden name=id value='<?php echo $_id?>'>
    <input type=hidden name=counter value='<?php echo $counter?>'>
        <label>
            Select your residence: </label>
         
         <select name="born">
             <option value="0">Province</option>
             <option value="1">Alberta</option>
             <option value="2">British Columbia</option>
             <option value="3">Ontario</option>
         </select>
        <p><br><input type="text" name="city" id="city" placeholder="city">
        <p><br><input type=submit value='submit'>
</form>
                </div></div>
    </body>
    