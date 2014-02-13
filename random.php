<?php
/*
 * Find next survey for participate based on his randomized survey to do
 * by checking the database
 * 
 */
  

include("config.php");
 include("class/user.php");



if (isset($_POST['id']) && (filter_var($_POST['id'], FILTER_VALIDATE_INT)) ){
        $_id= $_POST['id'];
if (isset($_POST['counter']) && (filter_var($_POST['counter'], FILTER_VALIDATE_INT)) )
        $_counter= $_POST['counter'];
}
else {
    $_SESSION['error']='invalid, contact Administrator';
        header('location:index.php?error=1');
}

    try{
            $con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD ); 
            $con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
            $sql = "SELECT * FROM clinicians WHERE id=:id";
            
            $stmt = $con->prepare( $sql );
            $stmt->bindValue( "id", $_id, PDO::PARAM_INT );
            $stmt->execute();

            $data = $stmt->fetchAll(); 
            $complete='';
            $_counter = $data[0]['counter'];
            $_counter++; // update database counter by 1 as another survey is done.
            /*
             * If counter for error and hack reason becomes more than 3, you want to end the
             * survey. The switch statement on next survey function can handle counter up to
             * 3. Therefore make sure counter stays at 3 which will end the survey.
             */
            if ($_counter >=3){
                $_counter=3;
                $complete='yes';
            }
            
            $num = 6+$_counter; //columns to move to based on counter to get next round survey
            
            $_survey= $data[0][$_counter+6];
            
           
           
            // update database column tablename to allow next survey    
            $qry = "UPDATE clinicians set complete=:complete, tableName=:tablename, counter=:counter where id=:id LIMIT 1";
            $stmt2 = $con->prepare( $qry);
            $stmt2->bindValue( "tablename", $_survey, PDO::PARAM_STR );
            $stmt2->bindValue( "counter", $_counter, PDO::PARAM_INT );
            $stmt2->bindValue( "complete", $complete, PDO::PARAM_INT );
            $stmt2->bindValue( "id", $_id, PDO::PARAM_INT );
            $stmt2->execute();
            $con = null;
            //next survey
            $usr = new Users;            
            $next = $usr->nextOne($_id);
           
            header('location:'.$next);
          
    }catch (PDOException $e) {
           echo $e->getMessage()." random";
           
    } 
    
  
 
   
    

?>
