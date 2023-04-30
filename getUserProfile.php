<?php
$servername = "localhost";
$username = "abdyla29_11" ;
$password = "Ab05122004";
$dbname = "abdyla29_11";
$charset = "utf8"; 

//$user_login = "txf13@mail.ru";
//$user_pass = "qwertyuiop";
//$user_pass_md5 = md5($user_pass);

if($_SERVER['REQUEST_METHOD']=='POST'){
	$user_login = $_POST["login"];
	$user_pass = $_POST["password"];
	$user_pass_md5 = md5($user_pass);
	
	
	try {
		$conn = new PDO("mysql:host=$servername;dbname=$dbname;charset = $charset", $username, $password);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stm = $conn->prepare('SELECT full_name from users where login=:user_login and password=:user_pass_md5');
		
		$stm -> bindValue(':user_login', $user_login, PDO::PARAM_STR);
		$stm -> bindValue(':user_pass_md5', $user_pass_md5, PDO::PARAM_STR);
		
		$stm -> execute();
		
		if($stm->rowCount() > 0 ) {
			$row = $stm->fetch(PDO::FETCH_ASSOC);
			echo $row['full_name'];
			
		}
		else {
			echo "user not found";
		}
		
		$conn = null;
		
	} catch (PDOException $e) {
		echo "Connection failed: " . $e->getMessage();
	}
} else {
	
	 echo "<h1> You are Hacker! </h1>";
	 
	
}


?>		
	