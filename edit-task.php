<?php
/* 
blue = #42ACE0
green = #00FF18
orange = #FFB600
red = #F72828
yellow = #FAE300
font = font-family: 'Quicksand', sans-serif;

*/


if(isset($_GET['id'])){
     $alert = '';
     $user="root";
	 $pass="root";
	 $mysql = 'mysql:host=localhost;dbname=mile-stone;port=8889';
     $dbh = new PDO($mysql, $user, $pass);
     $id = $_GET['id'];
     $taskid = $_GET['taskid'];
     $stmt = $dbh->prepare("SELECT * FROM user WHERE id='".$id."';");
     $stmt->execute();
     $rows = $stmt->fetch();
     $stmt = $dbh->prepare("SELECT * FROM task WHERE id='".$taskid."';");
     $stmt->execute();
     $taskRow = $stmt->fetch();
}else{
     header('location: index.php');
}


if(isset($_POST['create'])){
    $taskName = $_POST['task-name'];
    $taskTime = $_POST['task-time'];
    $taskDate = $_POST['task-date'];
    $taskColor = $_POST['color'];
    $user="root";
	 $pass="root";
	 $mysql = 'mysql:host=localhost;dbname=mile-stone;port=8889';
     $dbh = new PDO($mysql, $user, $pass);
     $stmt = $dbh->prepare("
                            UPDATE task
                            set name='".$taskName."',color='".$taskColor."',time='".$taskTime."',date='".$taskDate."'
                            where id='".$taskid."';
                            ");
     
     $stmt->execute();
    if( isset($_POST['invite'])){
           foreach ($_POST['invite'] as $row) {
    $stmt = $dbh->prepare("
                            INSERT INTO invite(taskId,userId,responce)
                            VALUES ('".$newTask."','".$row."','none');
                            ");
     
     $stmt->execute();
        
   }
    $stmt = $dbh->prepare("
                            INSERT INTO userTask(taskId,userId)
                            VALUES ('".$taskid."','".$rows['id']."');
                            ");
     
     $stmt->execute();
    }
      header('location: dashboard.php?id='.$rows['id']);  
}else if(isset($_POST['create']) && empty($_POST['invite'])){
     $alert = "
                <div class='large-12 columns fixed error2' style='background:#F72828;'>
                    <h3 style='color:white;'>You Must Invite Someone to Perform The Task</h3>
                    </div>";
}

?>
<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $rows['name'] ?></title>
    <link href='http://fonts.googleapis.com/css?family=Quicksand:300,400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/foundation.css" />
     <link rel="stylesheet" href="css/main.css" />
    <script src="js/vendor/modernizr.js"></script>
  </head>
  <body>
      <?php echo $alert; ?>
       <form id="form" action="edit-task.php?id=<?PHP echo $id ?>&taskid=<?PHP echo $taskid ?>" method="POST" enctype="multipart/form-data">
    
    <section class="nav">
      <article class="large-12 columns">
        <h3>mile stone</h3>
      </article>
    </section>
      <br />
      <br />
      <br />
      <section class="large-12 columns">
       
      
        <article class="header-task">
            
            <input id="edit-header" style="margin: auto;" name='task-name' type='text' value="<?PHP echo $taskRow['name']; ?>" />
            <input id="edit-date" style="margin: auto;" name='task-date' type='text' value="<?PHP echo $taskRow['date']; ?>" />
            <input id="edit-time" style="margin: auto;" name='task-time' type='text' value="<?PHP echo $taskRow['time']; ?>" />
            <button name="create" >finished creating</button>
          
      </article>
    </section>
      
    <article class="large-12 columns documentation">
        <h1 class="center white">Objectives and matierials</h1>
       <section class="large-3 columns document">
            <img src="img/document.png" />
           <h3>document.png</h3>
       </section>
         <section class="large-3 columns document">
            <img src="img/document.png" />
           <h3>document.png</h3>
       </section>
         <section class="large-3 columns document">
            <img src="img/document.png" />
           <h3>document.png</h3>
       </section>
         <section class="large-3 columns document">
            <img src="img/document.png" />
           <h3>document.png</h3>
       </section>
       
    </article>
      
   
       
       
      
    
      
      <article class="large-12 columns best-color">
        <section style="text-align:center;">
             <h2>best suited color</h2>
            <br />
            
        <div class="center-it">
    <div class="radios">
    <input type="radio" name="color" value="#F72828" id="r0"  required />
    <label class="radio color-choice red" for="r0"></label>    
        
    <input type="radio" name="color" value="#42ACE0" id="r1"  />
    <label class="radio color-choice blue" for="r1"></label>
   
    <input type="radio" name="color" value="#00FF18" id="r2" />
    <label class="radio color-choice green" for="r2"></label>
    
    <input type="radio" name="color" value="#FAE300" id="r3" />
    <label class="radio color-choice yellow" for="r3"></label>
    </div>
            </div>
                
           
        </section>
    </article>
      <section class="row">
          <h2 class="center">who will be invited to work on this task?</h2>
           <div class="person-place">
          
          </div>
           
          <article class='large-12 columns'>
              
                <div class='circular-person type-over' style='background:#3abeef; no-repeat center; background-size: 100% 100%;border:none;'><h1 style="font-size:10em;color:#ffffff;position:relative;left:63px;top:-10px;font-family:'Quicksand', sans-serif;">+</h1>
                <div class='person-hover add-person'><h1 style="font-size:10em;color:#ffffff;position:relative;left:63px;top:-10px;font-family:'Quicksand', sans-serif;"><a>+</a></h1></div>
               
                </div>
                </article>
          
   <div class="pop-up">
           <?php 
           $col = 12;
           $stmt = $dbh->prepare("
                                SELECT *
                                FROM user
                                where groupId='".$rows['groupId']."';"
                                );
           $stmt->execute();
           $people = $stmt->fetchall(PDO::FETCH_ASSOC);
           $count = count($people);

           foreach ($people as $row) {
               if($count == 2){
                   $col = 6;
               }else if($count == 3){
                   $col = 4;
               }else if($count >= 4){
                   $col = 3;
               }
               
               if($row['id'] == $id){
                   
               }else{
                echo "
                <article class='large-4 columns person-added'>
                <div class='circular-person type-over' style='background: url(.".$row['image'].") no-repeat center;border:10px solid ".$row['color']."; background-size: 100% 100%;'>
                <div class='person-hover'><img src='img/settings.gif' /></div>
                <input type='hidden' name='no-invite' value='".$row['id']."' />
                </div>
                 <p style='text-align:center;font-size:2em;color:white;'>".$row['fname']."</p>
                </article>
                ";
               }
            }
           
 ?>
 </div>     
      
    
         
      </article>
          </section>
      
      <br />
      <br />
    <script src="js/vendor/jquery.js"></script>
    <script src="js/foundation.min.js"></script>
    <script src="js/main.js"></script>
    <script>
      $(document).foundation();
    </script>
      </form>  
  </body>
</html>
