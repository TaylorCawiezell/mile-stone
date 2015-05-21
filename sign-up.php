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
				if ($type == ".jpeg" || $type == ".png" || $type == ".jpg" || $type == ".tiff"){
					$imgdir = "/files/";
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
    <link href='https://fonts.googleapis.com/css?family=Quicksand:300,400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/foundation.css" />
     <link rel="stylesheet" href="css/main.css" />
    <script src="js/vendor/modernizr.js"></script>
  </head>
  <body>
      <?php echo $error; ?>
      <div class='large-12 columns fixed error2' style='background:#00FF18;'>
                    <h3 style='color:white;'>Lets Get Started!</h3>
                    </div>
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
     
          </div>

<form id="form" class="sign-up" action="sign-up.php" method="POST" enctype="multipart/form-data">
    <div class="signup-1">
        <h1>First Tell Me Your Name!</h1>
        <br />
        <div class="large-6 columns">
        <label><h2>First Name</h2>
            <input id="fname"  type="text" placeholder="" name="fname" required />
        </label>
        </div>
        <div class="large-6 columns">
        <label><h2>Last Name</h2>
            <input id="lname" type="text" placeholder="" name="lname" required />
        </label>
            <button class="next" type="button"><img src="/img/arrow.png" /></button>
        </div>
        <div style="clear:both;"></div>
    </div>
    
    <div class="signup-2">
        <h1>Nice to meet you <span class="insert"></span>!</h1>
        <h2>Now We need to select our color profile.</h2>
        <p>Your color profile tells everyone what jobs best suite you! Hover over the colors to see what best fits you!</p>
        <br />
        <div class="center-it">
            <div class="radios">
                <div class="large-3 small-6 columns">
                    <input type="radio" name="color" value="#F72828" id="r0"  required />
                    <label class="radio color-choice red" for="r0"></label>    
                </div>
                <div class="large-3 small-6 columns">
                    <input type="radio" name="color" value="#42ACE0" id="r1"  />
                    <label class="radio color-choice blue" for="r1"></label>
                </div>
                <div class="large-3 small-6 columns">
                    <input type="radio" name="color" value="#00FF18" id="r2" />
                    <label class="radio color-choice green" for="r2"></label>
                </div>
                <div class="large-3 small-6 columns">
                    <input type="radio" name="color" value="#FAE300" id="r3" />
                    <label class="radio color-choice yellow" for="r3"></label>
                </div>
            </div>
        </div>
        <br />
        <div style="clear:both;"></div>
        <button class="back" type="button"><img src="/img/arrow.png" /></button>
        <button class="next2" type="button"><img src="/img/arrow.png" /></button>
        <div class="chosen-color gold-choice">
            <h1 class="head">Gold</h1>
            <br />
            <p>You are very proficent in organizational skills and are somewhat of a perfectionists.</p>
            <p>Some of your traits can be:</p>
            <ul style="list-style:none;">
                <li>Organization Skills</li>
                <li>Keen Eye for Details</li>
                <li>Right the First Time</li>
                <li>You Take Your Time</li>
            </ul>
        </div>
        <div class="chosen-color blue-choice">
            <h1 class="head">Blue</h1>
            <br />
            <p>You are very outgoing and want to be customer facing!</p>
            <p>Some of your traits can be:</p>
            <ul style="list-style:none;">
                <li>Outgoing</li>
                <li>Personable</li>
                <li>Empathetic</li>
                <li>Relatable</li>
                <li>Speaking</li>
            </ul>
        </div>
        <div class="chosen-color green-choice">
            <h1 class="head">Green</h1>
            <br />
            <p>You are very technical!</p>
            <p>Some of your traits can be:</p>
            <ul style="list-style:none;">
                <li>Critical Thinking</li>
                <li>Technical Skills</li>
                <li>Savy</li>
            </ul>
        </div>
        <div class="chosen-color red-choice">
            <h1 class="head">Red</h1>
            <br />
            <p>You are a born leader!</p>
            <p>Some of your traits can be:</p>
            <ul style="list-style:none;">
                <li></li>
                <li>Direct</li>
                <li>Numbers Focused</li>
                <li>Leading</li>
               
            </ul>
        </div>
        <br />
    </div>
     
    <div class="signup-3">
        <h1>Now We Need to Select What times You Are Available</h1>
        <h2>availability</h2>
        <div class="large-4 columns">
            <label><h3>from</h3>
            <input class="from" type="text" placeholder="9:00am" name="time1" required/>
            </label>
        </div>
        <div class="large-4 columns">
            <label><h3>to</h3>
            <input class="to" type="text" placeholder="12:00pm" name="time2" max="6" required/>
            </label>
        </div>
        <div class="large-4 columns">
            <label><h3>on</h3></label>
            <div class="small-9 columns">
                <select id="week" name="time3" required>
                    <option value="weekends">weekends</option>
                    <option value="weekends">weekdays</option>  
                </select>
            </div>
        </div>
        <button class="back2" type="button"><img src="/img/arrow.png" /></button>
        <button class="next3" type="button"><img src="/img/arrow.png" /></button>
    </div>
    
    <div class="signup-4">
        <h1>Now we need some account information</h1>
        <br />
        <div class="large-6 columns">
            <input id="email" type="email" placeholder="email" name="email" required  />
            <br />
            <label for="check">
                <p>send email notifications</p>
                <input id="check" type="checkbox"    />
                <input class="email-opt" type="hidden"  name="email-opt" value="no" />
            </label>
        </div>
        <div class="large-6 columns">
            <input id="phone" type="text" placeholder="phone" name="phone" required/>
            <br />
            <label for="check2">
                <p>send sms notifications</p>
                 <input id="check2" type="checkbox"   />
                <input class="sms-opt" type="hidden"  name="sms-opt" value="no" />
                 
            </label>
        </div>
        <div class="row">
            <div class="large-12 columns">
            <div class="center-it">
                <label for="pass" placeholder="password"><h3>password</h3>
                <input id="pass" type="password"  name="pass" required  />
                </label>
            </div>
            </div>
            <div class="row">
            <div class="large-12 columns">
                <div class="center-it">
                    <input id="gid" type="text" class="groupid" placeholder="group id" name="groupid" required />
                    <input id="gname" type="text" class="groupname" placeholder="group name" name=""  />
                    <br />
                    <label for="check3">
                        <p>create a new group</p>
                        <input id="check3" type="checkbox"  />
                    </label>
                </div>
            </div>
        </div>
        <button class="back3" type="button"><img src="/img/arrow.png" /></button>
        <button class="next4" type="button"><img src="/img/arrow.png" /></button>
        </div>
     </div> 
    
    
    
    <div class="signup-5">
        <h1>Almost Done! Just click the circle to upload your picture or use the default!</h1>
        <div class="row">
            <div class="large-12 columns">
                <div class="center-it">
                    <label for="picture">
                        <div class="circular-person type-over member pro-pic" style="background: url('/img/default.png') no-repeat center;background-size: 100% 100%;"><div style="clear:both;"></div> 
                        <input id="picture" type="file" name="file" style="display:none;"/>
                    </label>
                </div>
                <h3>profile picture</h3>
            </div>
        </div>
        <br />
        <br />
        <div class="row">
            <div class="large-12 columns">
                <div class="center-it">
                    <br />
                    <br />
                    <button class="login" name="login">Create Acount</button>
                </div>
            </div>
        </div>
        <button class="back4" type="button"><img src="/img/arrow.png" /></button>
    </div>
    
  <div style="clear:both;"></div>
      </div>
     <div class="center-it">
      <div class="position pos"></div>
      <div class="position pos2"></div>
      <div class="position pos3"></div>
      <div class="position pos4"></div>
      <div class="position pos5"></div>
      <div style="clear:both;"></div>
         
   <!-- <div class="hidden-fields">
       
        <input class="fname" name="fname" type="hidden" value="" />
        <input class="lname" name="lname" type="hidden" value="" />
        <input class="email" name="email" type="hidden" value="" />
        <input class="pass" name="pass" type="hidden" value="" />
        <input class="time1" name="time1" type="hidden" value="" />
        <input class="time2" name="time2" type="hidden" value="" />
        <input class="email-opt" name="email-opt" type="hidden" value="" />
        <input class="sms-opt" name="sms-opt" type="hidden" value="" />
        <input class="phone" name="phone" type="hidden" value="" />
        <input class="week" name="week" type="hidden" value="" />
        <div class='group-fields'>
            <input class="gid" name="groupid" type="hidden" value="" />
        </div>
        </div>
    </div>-->
    </form>  
    
     
     
     
    
    <script src="js/vendor/jquery.js"></script>
    <script src="js/foundation.min.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.js"></script>
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
