<?php
$error='';
if(isset($_POST['login'])){
    

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

        $stmt = $dbh->prepare("SELECT * FROM user WHERE email='".$email."';");
        $stmt->execute();
        $rows = $stmt->fetch(PDO::FETCH_NUM);
    
       if($rows < 1) {
        
        
        
       
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
        
        $stmt = $dbh->prepare("SELECT * FROM team WHERE name='".$groupname."';");
        $stmt->execute();
        $rows2 = $stmt->fetch(PDO::FETCH_NUM);
    
        if($rows2 < 1) {
        
        $admin = 'yes';
        $stmt=$dbh->prepare("INSERT INTO team(name) VALUES ('".$groupname."');");
        $stmt->execute();
		
        $stmt=$dbh->prepare("SELECT id FROM team where name='".$groupname."' ORDER BY id"); 
			$stmt->execute(); 
			$result = $stmt->fetch();
            $groupid = $result['id'];
          
        $stmt=$dbh->prepare("INSERT INTO user (fname,lname,color,groupId,availability,admin,pass,image,email,emailopt,smsopt,phone) VALUES('".$fname."','".$lname."','".$color."','".$groupid."','".$availability."','".$admin."','".$pass."','none','".$email."','".$emailopt."','".$smsopt."','".$phone."');"); 
        $stmt->execute();
            
        $stmt=$dbh->prepare("select id from user where email='".$email."' LIMIT 1;"); 
            $stmt->execute();
            $rows = $stmt->fetch();
            header("Location: dashboard.php?id=".$rows['id']);
        }else{
            
           $error = "
           <div class='large-12 columns fixed error2'>
                    <h3 style='color:white;'>That Group Name Already Exists</h3>
                    </div>";
            };
        
	
    }else if(isset($_POST['groupid'])){
          $groupid = $_POST['groupid'];
        
          $stmt = $dbh->prepare("SELECT * FROM team WHERE id='".$groupid."';");
          $stmt->execute();
          $rows3 = $stmt->fetch(PDO::FETCH_NUM);
    
          if($rows3 > 0) {
         
          $admin = 'no';
		  $stmt=$dbh->prepare("INSERT INTO user (fname,lname,color,groupId,availability,admin,pass,image,email,emailopt,smsopt,phone) VALUES('".$fname."','".$lname."','".$color."','".$groupid."','".$availability."','".$admin."','".$pass."','".imgDir()."','".$email."','".$emailopt."','".$smsopt."','".$phone."');"); 
$stmt->execute();
              
            $stmt=$dbh->prepare("select id from user where email='".$email."' LIMIT 1;"); 
            $stmt->execute();
            $rows = $stmt->fetch();
            header("Location: dashboard.php?id=".$rows['id']);
          }else{
            
           $error = "
           <div class='large-12 columns fixed error2'>
                    <h3 style='color:white;'>The Group ID You Entered Is Incorrect</h3>
                    </div>";
            }   
        }
        
        

  

 }else{
            
           $error = "
           <div class='large-12 columns fixed error2'>
                    <h3 style='color:white;'>That Email Is Already Being Used</h3>
                    </div>";
            }     
        
}
?>

<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Mile Stone</title>
    <link href='http://fonts.googleapis.com/css?family=Quicksand:300,400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/foundation.css" />
     <link rel="stylesheet" href="css/main.css" />
    <script src="js/vendor/modernizr.js"></script>
  </head>
  <body>
      <?php echo $error; ?>
      <div class="large-12 columns fixed error">
          <h3 style="color:white;">Please Complete The Form</h3>
      </div>
      
    
    <section class="nav">
      <article class="large-12 columns">
        <h3>mile stone</h3>
      </article>
    </section>
      <br />
      <br />
      <br />
 
      
      <form id="form" class="sign-up" action="sign-up.php" method="POST" enctype="multipart/form-data">
        <input class="sms-opt" type="hidden" name="sms-opt" value="no" />
        <input class="email-opt" type="hidden" name="email-opt" value="no" />
  <div class="row">
    
    <div class="large-6 columns">
      <label>first Name
        <input type="text" placeholder="" name="fname" required />
      </label>
    </div>
      <div class="large-6 columns">
      <label>last Name
        <input type="text" placeholder="" name="lname" required />
      </label>
    </div>
      <div class="large-12 columns">
        <div class="center-it">
    <div class="radios">
    <input type="radio" name="color" value="red" id="r0"  required />
    <label class="radio color-choice red" for="r0"></label>    
        
    <input type="radio" name="color" value="blue" id="r1"  />
    <label class="radio color-choice blue" for="r1"></label>
   
    <input type="radio" name="color" value="green" id="r2" />
    <label class="radio color-choice green" for="r2"></label>
    
    <input type="radio" name="color" value="yellow" id="r3" />
    <label class="radio color-choice yellow" for="r3"></label>
    </div>
          
         
        </div>
      </div>
  </div>
  <div class="row">
      <p>availability</p>
    <div class="large-4 columns">
      <label>from
        <input type="text" placeholder="9:00am" name="time1" required/>
      </label>
    </div>
    <div class="large-4 columns">
      <label>to
        <input type="text" placeholder="12:00pm" name="time2" required/>
      </label>
    </div>
    <div class="large-4 columns">
      <div class="row collapse">
        <label>on</label>
        <div class="small-9 columns">
          <select name="time3" required>
                <option value="weekends">weekends</option>
                <option value="weekends">weekdays</option>  
          </select>
        </div>
        
      </div>
    </div>
  </div>
  
  <div class="row">
    <p>account</p>
    <div class="large-6 columns">
      <input type="email" placeholder="email" name="email" required  />
          <br />
        <label for="check">
         <input id="check" type="checkbox"  />send email notifications
        </label>
    </div>
    <div class="large-6 columns">
       
        <input type="text" placeholder="phone" name="phone" required/>
          <br />
        <label for="check2">
         <input id="check2" type="checkbox"  />send sms notifications
        </label>
    </div>
  </div>
          <div class="row">
           
    <div class="large-12 columns">
        <div class="center-it">
             <label for="pass">password
      <input id="pass" type="password"  name="pass" required  />
            </label>
          </div>
    </div>
             
    
  </div>
          <div class="row">
           
    <div class="large-12 columns">
        <div class="center-it">
             <label for="picture">profile picture
      <input id="picture" type="file" name="file"   />
            </label>
          </div>
    </div>
             
    
  </div>
  <div class="row">
    <div class="large-12 columns">
      <div class="center-it">
       
        <input type="text" class="groupid" placeholder="group id" name="groupid" required />
           <input type="text" class="groupname" placeholder="group name" name=""  />
          <br />
        <label for="check3">
         <input id="check3" type="checkbox"  />create a new group
        </label>
        </div>
    </div>
  </div>
  <div class="row">
    <div class="large-12 columns">
      <div class="center-it">
          <button name="login">Sign Up</button>
       
        </div>
    </div>
  </div>
          
  
</form>
      
      
    <script src="js/vendor/jquery.js"></script>
    <script src="js/foundation.min.js"></script>
    <script src="js/main.js"></script>
    <script>
        $(document).ready(function(){
            $('.groupname').hide();
           $('#check3').change(function(){
                if(this.checked){
                    $('.groupname').show();
                    $('.groupid').hide();
                    $('.groupid').attr('name','');
                    $('.groupname').attr('name','groupname');
                    $('.groupname').prop('required',true);
                    $('.groupid').prop('required',false);
                }else{
                    $('.groupname').hide();
                    $('.groupid').show();
                    $('.groupname').attr('name','');
                    $('.groupid').attr('name','groupid');
                    $('.groupname').prop('required',false);
                    $('.groupid').prop('required',true);
                }
           });
            
            $('#check').change(function(){
                if(this.checked){
                    $('.email-opt').val('yes');
                    
                }else{
                    $('.email-opt').val('no');
                   
                }
           });
            
              $('#check2').change(function(){
                if(this.checked){
                    $('.sms-opt').val('yes');
                    
                }else{
                    $('.sms-opt').val('no');
                   
                }
           });
        });
      $(document).foundation();
    </script>
  </body>
</html>
