

<?php 
include 'includes/sql.php';
$conn = db_connect();
$emailAddress = "";
$errorBool = "";
$error = "";

   
if($_SERVER["REQUEST_METHOD"] == "POST") 
    { 
        $emailAddress = trim($_POST["email_address"]);        
      
        if(!isset($emailAddress) || $emailAddress == "") 
        { 
                $errorBool = "true"; $error .= "<br/>You must enter your email address."; 
        }        
		 if(!filter_var($emailAddress, FILTER_VALIDATE_EMAIL)) 
        { 
            $errorBool = "true"; $error .= "<br/>Email entered is not valid, you entered: " . $emailAddress ; 
            $emailAddress = ""; 
        } 
		
        $emailSearch = "SELECT * FROM event_subscribers WHERE email= '".$emailAddress."'"; 
        $result = pg_query($conn, $emailSearch); 
        if(pg_num_rows($result)) 
        { 
            $errorBool = "true"; 
			$error .="<br/>Email already exists, you entered: ".$emailAddress; 
            $loginId = ""; 
        }          
              
        if($error == "") 
		{
			$sql1 = "SELECT MAX(id) FROM  
					event_subscribers;"; 
			$result1 = pg_query($conn, $sql1); 			  
			$newIndex = pg_fetch_result($result1, 0) + 1;
            $userIdInput = "INSERT INTO event_subscribers(id,email)".  
                            "VALUES('".$newIndex."','".$emailAddress."');"; 
            $result = pg_query($conn, $userIdInput);                 
        } 
        else
        { 
                $errorBool = "true"; $error .= "<br/><br/>Please Try Again"; 
        } 
    }
?> 
  
 <?php 
    if($errorBool == "true") 
    { 
        echo "<h3>" . $error . "</h3>";  
    } 
?>  
  
Subscribe to our mailing-list to receive upcoming event information by inserting your email below. 
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">	
<input type="text" name="email_address" value="<?php echo $emailAddress; ?>" size="50" /><input type="submit" value="Subscribe" class="fsSubmitButton" />
</form> 
          
      

  
