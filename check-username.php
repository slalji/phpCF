 <?php

$searchVal = $_REQUEST['username'];
//$searchVal = 'sisraels';
$username='likejagg_magic';
$password='nwbcvGKbLcrLxqDL';
$host='localhost';
$database='likejagg_dtcu';
try {
     
$dbh = new PDO('mysql:host=localhost; dbname=likejagg_dtcu;', $username, $password);
    $sql = "SELECT * FROM clinicians WHERE username = " . "'" . $searchVal .  "'";
    $stmt = $dbh->query($sql);
    $stmt->execute();

/* Fetch number rows */
 
$cnt = $stmt->rowCount();


return $cnt;
    
 

    $dbh = null;
    }
        catch(PDOException $e)
    {
        echo $e->getMessage();
    }       
?>
