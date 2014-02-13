<?php


 /*
  * Every registration form needs basic inputs, username password and all inputs need to be validated
  * and inserted finally into a database, therefore class allows oops functionality
  */
 class Users {
         public $id = null;
	 public $username = null;
	 public $password = null;
         public $salt = "Zo4rU5Z1YyKJAASY0PT6EUg7BBYdlEhPaNLuxAwU8lqu1ElzHv0Ri7EM6irpx5w";
         public $secret= 'M6irpx5w';
         public $errmsg_arr = array();
         
	 
	 public function __construct( $data = array() ) {
             /*
              * For username remove all special char. for password, its good to have special char, therefore strip html tags
              */
                 if( isset( $data['username'] ) ) $this->username =  preg_replace('/[^A-Za-z0-9-]/', '', $data['username'] );
		 if( isset( $data['password'] ) ) $this->password = stripslashes( strip_tags( $data['password'] ) );
                
	 }
	 
	 public function storeFormValues( $params ) {
		//store the parameters
		$this->__construct( $params ); 
	 }
	 
	 public function userLogin() {
             
		 try{
                       
			$con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD ); 
			$con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
			$sql = "SELECT id FROM clinicians WHERE username = :username  AND password = :password  LIMIT 1";
                      
			 
			$stmt = $con->prepare( $sql );
			$stmt->bindValue( "username", $this->username, PDO::PARAM_STR );
			$stmt->bindValue( "password", hash("sha1", $this->password . $this->salt), PDO::PARAM_STR );
			$stmt->execute();
                         
                        $data = $stmt->fetch(PDO::FETCH_ASSOC);                     
                        $_id = $data['id'];
			$con = null; 
                        if ($_id){
                            $next = $this->nextOne($_id);                             
                            header('location:'.$next);
                        }  
                    
                        else
                           header('location:index.php?error=2');       
            
			
		 }catch (PDOException $e) {
			  echo $e->getMessage()." userLogin";
			                 
                       
		 }
	 }
         
          public function validate(){
           
             try{
			$con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD ); 
			$con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
			$sql = "SELECT username FROM clinicians WHERE username = :username LIMIT 1";
                       
			 
			$stmt = $con->prepare( $sql );
			$stmt->bindValue( "username", $this->username, PDO::PARAM_STR );
			$stmt->execute();
                        
                        $num_rows = $stmt->rowCount();
                        if ($num_rows >0 )
                             $this->errmsg_arr[] = "Username, <i>".$_POST['username']."</i>, already exists";
                        
                         //check password validity
                        $pwd = $this->password; 
                      /*   if(!preg_match((?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$), $_POST['password']):
                       * Could have used above regex to check password valid, but I wanted to send precise message to let 
                       * them know where they are wrong with their password
                       */
                      if (strlen($pwd) < 8) {
                           $this->errmsg_arr[] = "Password too short! Minimum of 8 characters";
                      }


                      if (!preg_match("#[0-9]+#", $pwd)) {
                           $this->errmsg_arr[] = "Password must include at least one number!";
                      }

                      if (!preg_match("#[a-zA-Z]+#", $pwd)) {
                           $this->errmsg_arr[] = "Password must include at least one letter!";
                      }     
                       //check password match
                       if( $pwd != $_POST['conpassword'] ) {
                      //echo "Password and Confirm password not match";
                               $this->errmsg_arr[] = "Password and Confirm password not match";
                       }  
                       if( $_POST['secret'] != $this->secret ) {
                      //echo "Password and Confirm password not match";
                               $this->errmsg_arr[] = "Invitation Code not match ";
                       } 
              
              return   $this->errmsg_arr;
             
                    
             }catch (PDOException $e) {
			  echo $e->getMessage()." validate username";                 
                    return -1;
		 }
                    
            
              
             
         }
	 /*
          * randomize array of Mag  numbers and save them to user's database to ensure no survey is done twice
          */
	 public function register() {
           
		$data=array("Mag1", "Mag2", "Mag3");
                shuffle($data);
                $rand = $data[0];
                $date = new DateTime();
                $now ="now()";
                
                $study = "clinicians";
                $r0 = $data[0];
                $r1 = $data[1];
                $r2 = $data[2];

              try{
			$con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD ); 
			$con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
			$sql = "INSERT INTO clinicians(username, password, tableName, study, round0, round1, round2) "
                               . "VALUES(:username, :password, :rand, :study, :round0, :round1, :round2)";
                      

			$stmt = $con->prepare( $sql );
			$stmt->bindValue( "username", $this->username, PDO::PARAM_STR );
			$stmt->bindValue( "password", hash("sha1", $this->password . $this->salt), PDO::PARAM_STR );
			
                        
			$stmt->bindValue( "rand", $rand, PDO::PARAM_STR);
                        $stmt->bindValue( "study", $study, PDO::PARAM_STR );
                        $stmt->bindValue( "round0", $r0, PDO::PARAM_STR );
                        $stmt->bindValue( "round1", $r1, PDO::PARAM_STR );
                        $stmt->bindValue( "round2", $r2, PDO::PARAM_STR );
                       
			$stmt->execute();                         
                        $this->userLogin(); 
                      
                        
		 }catch (PDOException $e) {
			 return false;	                 
                       
		 }
	 }
         

       public function nextOne($id){
       $survey = "survey";
        try{
                $con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD ); 
                $con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
                $sql = "SELECT * FROM clinicians WHERE id=:id";


                $stmt = $con->prepare( $sql );
                $stmt->bindValue( "id", $id, PDO::PARAM_INT );
                $stmt->execute();

                $data = $stmt->fetch(PDO::FETCH_ASSOC);  
                $_counter = $data['counter'];
                $_table = $data['tableName']; 

                $con = null;
                
                switch ($_counter){
                    case 0: //complete study
                        //$_SESSION['counter'] = $_counter;
                        $survey = $survey."Mag0.php?counter=".$_counter."&studyname=Mag0&id=".$id;
                        break;
      
                    case 3: //complete study
                        $survey = "end.php";
                        break;
                    default:
                        //$_counter += 1;
                        $survey = $survey.$_table.".php?counter=".$_counter."&studyname=".$_table."&id=".$id;
                        break;
                } //end switch
                return $survey;

         }catch (PDOException $e) {
                  echo $e->getMessage()." userLogin";

                return -1;
         }
    }
	 
 }
 
?>