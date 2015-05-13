<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">

		<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
		Remove this if you use the .htaccess -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

		<title>Hello Worlds</title>
		<meta name="description" content="">
		<meta name="author" content="Acount Creation">

		<meta name="viewport" content="width=device-width; initial-scale=1.0">

		<!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
		<link rel="shortcut icon" href="/favicon.ico">
		<link rel="apple-touch-icon" href="/apple-touch-icon.png">
	</head>
<style>
		body{
			text-align:center;
			background:#3abeef;
			color:white;
			font: 20px "Lucida Sans Unicode";
			}
		
		.image{
			position:relative;
			margin-left:auto;
			margin-right:auto;
			width: 300px;
			height: 300px;
			border-radius: 150px;
			-webkit-border-radius: 150px;
			-moz-border-radius: 150px;
			background: url(<?php echo imgDir(); ?>) no-repeat;
			background-size: 300px 500px;
			border: 5px solid white;
		}

		.image img{
			opacity: 0;
			filter: alpha(opacity=0);
		}
		
		
			
		}
		
		
	</style>

	<body>
		<?php
			// Funtion for creating array//
			function makeArray(){
				$pass = $_POST['password'];
				$fname =  $_POST['fname'];
				$lname =  $_POST['lname'];
				$user = $_POST['user'];
				$epass = md5("encrypted".$pass);
				return array('first_name' => $fname,'last_name' => $lname,"username" => $user, "password" => $epass);
			}
			
			//Function for handling image file//
			function imgDir(){
				$type = str_replace("image/",".",$_FILES['file']['type']);
				//If statement to ensire file type is jpeg or png before uploading
				if ($type == ".jpeg" || $type == ".png"){
					$imgdir = "./images/images";
					$imgname = $_FILES['file']['name'];
					$tmp = $_FILES['file']['tmp_name'];
					$img = $imgdir.$imgname;
					move_uploaded_file($tmp,$img);
					return $img;
				}else{ //return statement if file type is not jpeg or png
					return "images/error.png";
					
				}
			}
			
			//if statement to ensure POST request was made//
			if(isset($_POST['submit'])){
				echo "<h1>Account Creation Was Successful!</h1>";
				
				//Turning array into a variable
				$data = makeArray();
			
				//Foreach for displaying Array created in makeAraay Function//
				foreach($data as $attribute => $data){
				echo "{$attribute} : {$data}</br>";
				}
			
				//echo for returning image tag//
				echo "<div class='image'><img src='".imgDir()."' width='200'/></div>";
			}
			
			
		?><br />
	</body>
</html>
