<?php
    $user="root";
	$pass="root";
	$mysql = 'mysql:host=localhost;dbname=mile-stone;port=8889';
		$dbh = new PDO($mysql, $user, $pass);
		$fname=$_POST['fname']; //get POST values 
		$lname=$_POST['lname'];
        $email=$_POST['email'];
        $pass=$_POST['pass'];
        $phone=$_POST['phone'];
        $color=$_POST['color'];
        $availability='from '.$_POST['time1'].' to '.$_POST['time2'].' on '.$_POST['time3'];
        $emailopt=$_POST['email-opt'];
        $smsopt=$_POST['sms-opt'];

        
       
        function imgDir(){
            if (isset($_FILES['file'])) {
				$type = str_replace("image/",".",$_FILES['file']['type']);
				//If statement to ensire file type is jpeg or png before uploading
				if ($type == ".jpeg" || $type == ".png" || $type == ".jpg"){
					$imgdir = "./files/";
					$imgname = $_FILES['file']['name'];
					$tmp = $_FILES['file']['tmp_name'];
					$img = $imgdir.$imgname;
					move_uploaded_file($tmp,$img);
					return $img;
				}else{ //return statement if file type is not jpeg or png
				return "images/default.png";
					
				}
            }
			}
    if(isset($_POST['groupname'])){
        $groupname=$_POST['groupname'];
        $admin = 'yes';
        $stmt=$dbh->prepare("INSERT INTO team(name) VALUES ('".$groupname."');");
        $stmt->execute();
		
        $stmt=$dbh->prepare("SELECT id FROM team where name='".$groupname."' ORDER BY id"); 
			$stmt->execute(); 
			$result = $stmt->fetch();
            $groupid = $result['id'];
          
        $stmt=$dbh->prepare("INSERT INTO user (fname,lname,color,groupId,availability,admin,pass,image,email,emailopt,smsopt,phone) VALUES('".$fname."','".$lname."','".$color."','".$groupid."','".$availability."','".$admin."','".$pass."','none','".$email."','".$emailopt."','".$smsopt."','".$phone."');"); 
        $stmt->execute();
        
        
	
    }else if(isset($_POST['groupid'])){
          $groupid = $_POST['groupid'];
          $admin = 'no';
		  $stmt=$dbh->prepare("INSERT INTO user (fname,lname,color,groupId,availability,admin,pass,image,email,emailopt,smsopt,phone) VALUES('".$fname."','".$lname."','".$color."','".$groupid."','".$availability."','".$admin."','".$pass."','".imgDir()."','".$email."','".$emailopt."','".$smsopt."','".$phone."');"); 
$stmt->execute();
   }

  $stmt=$dbh->prepare("select id from user where email='".$email."' LIMIT 1;"); 
            $stmt->execute();
            $rows = $stmt->fetch();
            $id = $rows['id']
            $hash = md5($email . $id);
            header("Location: dashboard.html?id=".$hash);
die();