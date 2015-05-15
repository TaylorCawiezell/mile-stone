<?php
if(isset($_GET['id'])){
     $alert = '';
     $user="root";
	 $pass="root";
	 $mysql = 'mysql:host=localhost;dbname=mile-stone;port=8889';
     $dbh = new PDO($mysql, $user, $pass);
     $id = $_GET['id'];
     
     $stmt = $dbh->prepare("SELECT * FROM user WHERE id='".$id."';");
     $stmt->execute();
     $rows = $stmt->fetch();
    
       if($rows['id'] = $id) {
           $alert = "
                <div class='large-12 columns fixed error2' style='background:#00FF18;'>
                    <h3 style='color:white;'>Welcome ".$rows['fname']."</h3>
                    </div>";
        if(isset($_GET['deletetaskid'])){
            $deleteId = $_GET['deletetaskid'];
            $stmt = $dbh->prepare("
                            SELECT user.id, userTask.taskId, task.name
                            FROM userTask
                            INNER JOIN user ON userTask.userId=user.id
                            INNER JOIN task ON userTask.taskId=task.id
                            where user.id='".$id."' and task.Id='".$deleteId."';
                            ");
            $stmt->execute();
            $taskInfo = $stmt->fetch();
            $stmt = $dbh->prepare("
                            SELECT * FROM user
                            where admin='yes' and groupId='".$rows['groupId']."';;
                            ");
            $stmt->execute();
            $adminInfo = $stmt->fetch();
            if($adminInfo['emailopt'] == 'yes'){
            require 'PHPMailer/PHPMailerAutoload.php';
            $mail = new PHPMailer;
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
            $mail->SMTPAuth = true;  // authentication enabled
            $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 465; 
            $mail->Username = 'dowebguys@gmail.com';  
            $mail->Password = 'megaman1';           
            $mail->SetFrom('mile-stone@info.com', 'Mile-Stone');
            $mail->Subject = 'Task Update';
            $mail->Body = $rows['fname']." ".$rows['lname']." has removed themselves from ".$taskInfo['name']." on ".date("m/d/Y");
            $mail->AddAddress($adminInfo['email']);
            $mail->Send();
            }
            $stmt = $dbh->prepare("
                                    DELETE FROM userTask
                                    WHERE taskId='".$deleteId."' AND userId='".$id."';
                                ");
            $stmt->execute();
             $alert = "
                <div class='large-12 columns fixed error2' style='background:#F72828;'>
                    <h3 style='color:white;'>You Where Removed From This Task</h3>
                    </div>";
            
            
        }
           
        if(isset($_GET['alerttaskid'])){
            $alertId = $_GET['alertId'];
            $responce = $_GET['responce'];
            $alerttaskid = $_GET['alerttaskid'];
            if($responce == 'yes'){
            $stmt = $dbh->prepare("
                            INSERT INTO userTask(userId,taskId) VALUES('".$id."','".$alerttaskid."');
                            ");
            $stmt->execute();
            $stmt = $dbh->prepare("
                            UPDATE invite
                            SET responce='yes'
                            WHERE id='".$alertId."';
                            ");
            $stmt->execute();
            $stmt = $dbh->prepare("
                            SELECT * FROM user
                            where admin='yes' and groupId='".$rows['groupId']."';
                            ");
            $stmt->execute();
            $adminInfo = $stmt->fetch();
            $stmt = $dbh->prepare("
                            SELECT * FROM task
                            where id='".$alerttaskid."';
                            ");
            $stmt->execute();
            $taskInfo = $stmt->fetch();
            if($adminInfo['emailopt'] == 'yes'){
            require 'PHPMailer/PHPMailerAutoload.php';
            $mail = new PHPMailer;
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
            $mail->SMTPAuth = true;  // authentication enabled
            $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 465; 
            $mail->Username = 'dowebguys@gmail.com';  
            $mail->Password = 'megaman1';           
            $mail->SetFrom('mile-stone@info.com', 'Mile-Stone');
            $mail->Subject = 'Your Request Had Been Accepted';
            $mail->Body = $rows['fname']." ".$rows['lname']." has accepted ".$taskInfo['name']." on ".date("m/d/Y");
            $mail->AddAddress($adminInfo['email']);
            $mail->Send();
            }
            $alert = "
                <div class='large-12 columns fixed error2' style='background:#00FF18;'>
                    <h3 style='color:white;'>The Invite Was Accepted!</h3>
                    </div>";
            }
            
            if($responce == 'no'){
             $stmt = $dbh->prepare("
                            DELETE FROM invite
                            WHERE id='".$alertId."';
                            ");
            $stmt->execute();
            $stmt = $dbh->prepare("
                            SELECT * FROM user
                            where admin='yes' and groupId='".$rows['groupId']."';
                            ");
            $stmt->execute();
            $adminInfo = $stmt->fetch();
            $stmt = $dbh->prepare("
                            SELECT * FROM task
                            where id='".$alerttaskid."';
                            ");
            $stmt->execute();
            $taskInfo = $stmt->fetch();
            if($adminInfo['emailopt'] == 'yes'){
            require 'PHPMailer/PHPMailerAutoload.php';
            $mail = new PHPMailer;
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
            $mail->SMTPAuth = true;  // authentication enabled
            $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 465; 
            $mail->Username = 'dowebguys@gmail.com';  
            $mail->Password = 'megaman1';           
            $mail->SetFrom('mile-stone@info.com', 'Mile-Stone');
            $mail->Subject = 'Your Request Had Been Rejected';
            $mail->Body = $rows['fname']." ".$rows['lname']." has rejected ".$taskInfo['name']." on ".date("m/d/Y");
            $mail->AddAddress($adminInfo['email']);
            $mail->Send();
            }
            
            $alert = "
                <div class='large-12 columns fixed error2' style='background:#F72828;'>
                    <h3 style='color:white;'>You Have Rejected The Invite</h3>
                    </div>";
        }
    }
      }else{
           header('location: index.php');
       }

/*
https security for later
$use_sts = true;

// iis sets HTTPS to 'off' for non-SSL requests
if ($use_sts && isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') {
    header('Strict-Transport-Security: max-age=31536000');
} elseif ($use_sts) {
    header('Location: https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'], true, 301);
    // we are in cleartext at the moment, prevent further execution and output
    die();
}*/
}else{
    header('location: index.php');
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
    <script src="js/vendor/jquery.js"></script>
    <script src="js/foundation.min.js"></script>
  </head>
  <body>
   <?php echo $alert; ?>   
    <section class="side-nav">
            <a href="team.php?id=<?php echo $id ?>"><h2>My Team</h2></a>
             <a href="index.php"><h2>Logout</h2></a>
            
      </section>
    <section class="nav">
      <article class="large-12 columns">
           <a><img class="menu" src="/img/menu.png"  /></a>
        <h3>mile stone</h3>
         
      </article>
    </section>
      
      <br />
      <br />
      <br />
      <section>
        <form id="form"></form>
      <article class="large-6 columns type-over">
           
            <div class="type" style="background:<?php echo $rows['color'];?>;">
                
                <!--<img src="img/sarah.png" />-->
                <div class='circular' style="background: url(.<?php echo $rows['image']; ?>) no-repeat center; background-size: 120% 100%;"></div>
             <div class="type-hover"><img src="img/settings.gif" /></div>
            </div>
         
      </article>
        <article class="large-6 columns alerts">
            <?php
			$stmt=$dbh->prepare(
                                "SELECT user.id, invite.taskId, task.name, task.color as taskcolor, invite.id as alertId,invite.responce
                                 FROM invite
                                 INNER JOIN user ON invite.userId=user.id
                                 INNER JOIN task ON invite.taskId=task.id
                                 where user.id='".$id."';"
                               ); 
			$stmt->execute(); 
			$alerts = $stmt->fetchall(PDO::FETCH_ASSOC); 
			//The parameter means it will return an indexed array with each index containing an associative array 
            $c = 0;
			foreach ($alerts as $row) {
                if($row['responce'] == 'yes' || $row['responce'] == 'no'){
                   
                 }else{
  				echo '<div class="alert alertclick'.$row['alertId'].'"  style="background:'.$row['taskcolor'].';">you have a new invite!</div>
                      <div class="alert-pop alert'.$row['alertId'].'"><h3>Your Invited to Take Place In "'.$row['name'].'"</h3>
                      <a href="dashboard.php?id='.$row['id'].'&alertId='.$row['alertId'].'&responce=yes&alerttaskid='.$row['taskId'].'" ><button>Yes</button></a>
                      <a href="dashboard.php?id='.$row['id'].'&alertId='.$row['alertId'].'&responce=no&alerttaskid='.$row['taskId'].'" ><button>No</button></a>
                      </div>
                      <script>
                        $("document").ready(function(){
                            $(".alert'.$row['alertId'].'").hide();
                            
                            $(".alertclick'.$row['alertId'].'").click(function(){
                                $(".alert'.$row['alertId'].'").slideToggle();
                            });
                        });
                      </script>';
                     $c++;
                  }
                
                
			     }
                if($c == 0){
                    echo "
                    <br />
                    <br />
                    <br />
                    <h1 style='color:#474747;'>You Have No Pending Invites</h1>";
                    }
	         ?>
            
      </article>
    </section>
      
    
        <?php 
            $stmt=$dbh->prepare(
                                "SELECT user.id, userTask.taskId, task.name, task.color as taskcolor, task.date
                                 FROM userTask
                                 INNER JOIN user ON userTask.userId=user.id
                                 INNER JOIN task ON userTask.taskId=task.id
                                 where user.id='".$id."' order by task.date;"
                               ); 
			$stmt->execute(); 
			$tasks = $stmt->fetchall(PDO::FETCH_ASSOC); 
			//The parameter means it will return an indexed array with each index containing an associative array 
            $i = 0;
            $count = count($tasks);
if($rows['admin'] == 'no'){
			foreach ($tasks as $row) {
                if($i <= 0){
                    echo '
                <article class="large-12 columns ">
                <section class="first job-over" style="background:'.$row['taskcolor'].';">
                    <div class="job-hover" style="height:100px;">
                        <a href="task.php?id='.$id.'&taskid='.$row['taskId'].'"><img class="view-pic" src="img/view.png" width="250"/></a>
                        <a href="dashboard.php?id='.$id.'&deletetaskid='.$row['taskId'].'"><img class="exit-pic" src="img/exit.png" width="100"/></a>
                    </div>
                        <h1>'.$row['date'].'</h1>
                        <br />
                        <h1>'.$row['name'].'</h1>
                </section>
                </article>';
                }
                
                if($i == 1 || $i == 2){
                    echo '
                <article class="large-6 columns ">
                <section class="second job-over" style="background:'.$row['taskcolor'].';">
                <h1>'.$row['date'].'</h1>
                <br />
                <h1>'.$row['name'].'</h1>
                <div class="job-hover">
                 <a href="task.php?id='.$id.'&taskid='.$row['taskId'].'"><img class="view-pic" src="img/view.png" width="250"/></a>
                 <a href="dashboard.php?id='.$id.'&deletetaskid='.$row['taskId'].'"><img class="exit-pic" src="img/exit.png" width="100"/></a>
                 </div>
                </section>
                </article>';
                }
                
                if($i >= 3){
                    echo '
                <article class="large-4 columns">
                <section class="rest job-over" style="background:'.$row['taskcolor'].';">
                <div class="job-hover" style="height:100px;">
                 <a href="task.php?id='.$id.'&taskid='.$row['taskId'].'"><img class="view-pic" src="img/view.png" width="250"/></a>
                <a href="dashboard.php?id='.$id.'&deletetaskid='.$row['taskId'].'"><img class="exit-pic" src="img/exit.png" width="100"/></a>
                </div>
            <h1>'.$row['date'].'</h1>
            <br />
            <h1>'.$row['name'].'</h1>
        </section>
    </article>';
                }
                 $i++;
                
             
        }
}else{

        foreach ($tasks as $row) {
                if($i <= 0){
                    echo '
                <article class="large-12 columns ">
                <section class="first job-over" style="background:'.$row['taskcolor'].';">
                    <div class="job-hover" style="height:100px;">
                        <a href="edit-task.php?id='.$id.'&taskid='.$row['taskId'].'"><img class="view-pic" src="img/edit.png" width="200"/></a>
                        <a href="dashboard.php?id='.$id.'&deletetaskid='.$row['taskId'].'"><img class="exit-pic" src="img/exit.png" width="100"/></a>
                    </div>
                        <h1>'.$row['date'].'</h1>
                        <br />
                        <h1>'.$row['name'].'</h1>
                </section>
                </article>';
                }
                
                if($i == 1 || $i == 2){
                    echo '
                <article class="large-6 columns ">
                <section class="second job-over" style="background:'.$row['taskcolor'].';">
                <h1>'.$row['date'].'</h1>
                <br />
                <h1>'.$row['name'].'</h1>
                <div class="job-hover">
                 <a href="edit-task.php?id='.$id.'&taskid='.$row['taskId'].'"><img class="view-pic" src="img/edit.png" width="150"/></a>
                 <a href="dashboard.php?id='.$id.'&deletetaskid='.$row['taskId'].'"><img class="exit-pic" src="img/exit.png" width="100"/></a>
                 </div>
                </section>
                </article>';
                }
                
                if($i >= 3){
                    echo '
                <article class="large-4 columns">
                <section class="rest job-over" style="background:'.$row['taskcolor'].';">
                <div class="job-hover" style="height:100px;">
                 <a href="edit-task.php?id='.$id.'&taskid='.$row['taskId'].'"><img class="view-pic" src="img/edit.png" width="100"/></a>
                <a href="dashboard.php?id='.$id.'&deletetaskid='.$row['taskId'].'"><img class="exit-pic" src="img/exit.png" width="100"/></a>
                </div>
            <h1>'.$row['date'].'</h1>
            <br />
            <h1>'.$row['name'].'</h1>
        </section>
    </article>';
                }
                 $i++;
                
             
        }
   }
  
            if($rows['admin'] == 'yes'){
                
            echo ' 
            <br />
            <div class="large-12 columns" >
            <article class="">
        <section class="rest job-over" style="color:white; width:30%;margin:auto;">
           <a href="create-task.php?id='.$rows['id'].'"><h1 style="font-size:10em;">+</h1></a>
        </section>
         <h1 style="color:#4747474; text-align:center;">Create Task</h1>
    </article></div>';      

            }
        ?>
  
    
    <script src="js/main.js"></script>
    <script>
      $(document).foundation();
    
        
    </script>
  </body>
</html>

