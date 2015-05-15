<?php 
$error = '';
if(isset($_POST['login'])){

    $user="root";
	$pass="root";
	$mysql = 'mysql:host=localhost;dbname=mile-stone;port=8889';
		$dbh = new PDO($mysql, $user, $pass);
		$email=$_POST['email']; //get POST values 
        $pass=$_POST['pass'];
        $stmt = $dbh->prepare("SELECT * FROM user WHERE email='".$email."' AND pass='".$pass."';");
        $stmt->execute();
        $rows = $stmt->fetch(PDO::FETCH_NUM);
        if($rows > 0) {
            $stmt=$dbh->prepare("select id from user where email='".$email."' LIMIT 1;"); 
            $stmt->execute();
            $rows = $stmt->fetch();
            $id = $rows['id'];
            $hash = 
            header("Location: dashboard.php?id=".$id);
        }else{
            
           $error = "
           <div class='large-12 columns fixed error2'>
                    <h3 style='color:white;'>Wrong Email or Password</h3>
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
      <div class="large-12 columns fixed error">
          <h3 style="color:white;">Please Complete The Form</h3>
      </div>
      <section class="lightbox">
            <br />
          <a><span class="exit">x</span></a>
         <h3>Please enter your login information</h3>
          <form id="form" action="index.php" method="POST">
            <input type="text" placeholder="email" name="email" required />
            <input type="password" placeholder="password" name="pass" required />
            <button class="login-btn" name="login">login</button>
           </form> 
      </section>
    
    <section class="nav">
      <article class="large-12 columns">
        <h3>mile stone</h3>
      </article>
    </section>
      <br />
      <br />
      <br />
      <section class="cta">
      <article class="large-12 columns">
          <br />
          <br />
          <br />
          <br />
          <br />
          <br />
          <br />
          <br />
          <br />
          <br />
          <br />
          <br />
          <br />
          
           <a href="sign-up.php"><button class="sign-btn btn">sign up</button></a>
           <button class="login-btn btn">login</button>
      </article>
    </section>
      <div class="clear"></div>
      <br />
      <br />
      <br />
      <br />
    <section class="color">
      <article class="large-12 columns">
            <img src="img/color-text.png" />
      </article>
    </section>
      <br />
      <br />
     <section class="promo">
      <article class="large-4 columns">
            <img src="img/promo1.png" width="250" /><br />
          <h4>Group your organization based on colors, creating a personalized experience for your volenteers.</h4>
      </article>
      <article class="large-4 columns">
            <img src="img/promo2.png"  width="250" /><br /><br />
             <h4>Customize each task to align with the work it requires.</h4>
      </article>
       <article class="large-4 columns">
            <img src="img/promo3.png"  width="250" /><br />
             <h4>Upload documentation to ensure every person has everything they need to be successful!</h4>
      </article>
    </section>
    <article class="large-12 columns information">
           <h3>Mile Stone is placing the right people in the right places.</h3>
             <h4>Here at Mile Stone we believe that your volenteers are the mile stone's to success. Mile Stone allows you to organize, customize and monitor your dayly tasks. Create a new group today and start aligning the expectations for every task!</h4>
      </article>
    
    <script src="js/vendor/jquery.js"></script>
    <script src="js/foundation.min.js"></script>
    <script src="js/main.js"></script>
    <script>
      $(document).foundation();
    </script>
  </body>
</html>
