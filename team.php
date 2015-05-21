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
    
     $stmt = $dbh->prepare("SELECT * FROM user WHERE groupId='".$rows['groupId']."';");
     $stmt->execute();
     $team = $stmt->fetchall(PDO::FETCH_ASSOC); 

}?>
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
     <section class="lightbox2">
            <br />
          <a><span class="exit">x</span></a>
         <div class="circular-person type-over image" style="position:relative;">
             
             <br/>
             <br />
             <br/>
             <br />
             <br/>
             <br />
             <br/>
             <br />
             
             <br />
             <h3 class='name'>yo@yahoo.com</h3>
             <h3 class='phone'>850-502-1087</h3>
             <hr />
             <h3>Available</h3>
             <h3 class='time'>9am - 5pm</h3>
          
      </section> 
    
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
      <form id="form"></form>

      <section class="row">
          <h2 class="center">My Team</h2>
          
          <?php
    foreach ($team as $row) {
         echo '
          <article class="large-3 columns">
         <div class="circular-person type-over member" style="background: url('.$row['image'].') no-repeat center;background-size: 100% 100%;border-color:'.$row['color'].';">
                <input type="hidden" class="time" value="'.$row['availability'].'" />
                <input type="hidden" class="email" value="'.$row['email'].'" />
                <input type="hidden" class="phone" value="'.$row['phone'].'" />
                <input type="hidden" class="name" value="'.$row['fname'].'" />
                <input type="hidden" class="image" value="'.$row['image'].'" />
                <input type="hidden" class="color" value="'.$row['color'].'" />
                <div class="person-hover"><br /><img src="img/view.gif" width="150"/></div>
            </div>
          <h3 class="center name">'.$row['fname'].'</h3>
          </article>';
         
    }
?>
   
    
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
