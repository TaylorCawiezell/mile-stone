<?php

if(isset($_GET['id']) && isset($_GET['taskid'])){
     $alert = '';
     $user="root";
	 $pass="root";
	 $mysql = 'mysql:host=localhost;dbname=mile-stone;port=8889';
     $dbh = new PDO($mysql, $user, $pass);
     $id = $_GET['id'];
     $taskid = $_GET['taskid'];
     $stmt = $dbh->prepare("SELECT * FROM task WHERE id='".$taskid."';");
     $stmt->execute();
     $rows = $stmt->fetch();
}else{
     header('location: index.php');
}

?>
<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $rows['name'] ?></title>
    <link href='https://fonts.googleapis.com/css?family=Quicksand:300,400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/foundation.css" />
     <link rel="stylesheet" href="css/main.css" />
    <script src="js/vendor/modernizr.js"></script>
  </head>
  <body>
      
    
     <section class="side-nav">
            <a href="dashboard.php?id=<?php echo $id ?>"><h2>My Dashboard</h2></a>
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
      <section class="large-12 columns">
        <form id="form"></form>
      
        <article class="header-task">
            
            <h1><?php echo $rows['name'] ?></h1>
            <h1><?php echo $rows['date'] ?></h1>
            <h3><?php echo $rows['time'] ?></h3>
            <button>I have completed this task</button>
           
      </article>
    </section>
      
    <article class="large-12 columns documentation">
        <h1 class="center white">Objectives and matierials</h1>
        <?php 
        $stmt = $dbh->prepare("
                                SELECT * FROM documents
                                where taskId='".$taskid."';"
                                );
           $stmt->execute();
           $doc = $stmt->fetchall(PDO::FETCH_ASSOC);
           
foreach($doc as $row) {
    echo '<section class="large-3 columns document">
            <a href="'.$row['document'].'"  download ><img src="img/document.png" /></a>
           <h3>'.$row['document'].'</h3>
       </section>';
    
}
        
        ?>
      
       
    </article>
      
   
       
       
      
    
      
      <article class="large-12 columns best-color">
        <section>
             <h2>best suited color</h2>
            <br />
            <div class="circle" style="background:<?php echo $rows['color'] ?>;"></div>

           
        </section>
    </article>
      <section class="row">
          <h2 class="center">working on this task</h2>
   
           <?php 
           $col = 12;
           $stmt = $dbh->prepare("
                                SELECT user.id, userTask.taskId, user.color, user.fname,user.image
                                FROM userTask
                                INNER JOIN user ON userTask.userId=user.id
                                INNER JOIN task ON userTask.taskId=task.id
                                where task.id='".$taskid."';"
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
                echo "
                <article class='large-".$col." columns'>
                <div class='circular-person type-over' style='background: url(.".$row['image'].") no-repeat center;border:10px solid ".$row['color']."; background-size: 100% 100%;'>
                <div class='person-hover'><img src='img/settings.gif' /></div>
                </div>
                </article>
                ";
               
            }
 ?>
          
    
         
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
  </body>
</html>
