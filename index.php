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
          <p>This is an amazing feature that makes you awesome! This is an amazing feature that makes you awesome!</p>
      </article>
      <article class="large-4 columns">
            <img src="img/promo2.png"  width="250" /><br /><br />
             <p>This is an amazing feature that makes you awesome! This is an amazing feature that makes you awesome!</p>
      </article>
       <article class="large-4 columns">
            <img src="img/promo3.png"  width="250" /><br />
             <p>This is an amazing feature that makes you awesome! This is an amazing feature that makes you awesome!</p>
      </article>
    </section>
    <article class="large-12 columns information">
           <h3>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h3>
             <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lorem urna, sodales vitae ligula at, tincidunt ultricies turpis. Suspendisse ac vehicula tortor. Sed ex nisi, eleifend at pretium eu, congue sed nisi. Suspendisse quis maximus dui. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec lobortis sit amet nulla et molestie. Suspendisse vestibulum tincidunt massa, ut varius ipsum tincidunt pellentesque. Nulla quis nibh nec ante ullamcorper gravida sit amet quis lacus. Morbi porttitor ultrices lectus, a ornare felis malesuada et. Curabitur placerat felis et quam maximus tincidunt. Aliquam ornare porttitor nulla, sed congue nisi vestibulum in.</p>
      </article>
    
    <script src="js/vendor/jquery.js"></script>
    <script src="js/foundation.min.js"></script>
    <script src="js/main.js"></script>
    <script>
      $(document).foundation();
    </script>
  </body>
</html>
