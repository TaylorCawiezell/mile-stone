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
         <div class="circular-person type-over image" style="position:relative;"></div>
             <div style="clear:both;"></div>
             
          
             <br />
             <h3 class='name'>yo@yahoo.com</h3>
             <h3 class='email'>yo@yahoo.com</h3>
             <h3 class='phone'>850-502-1087</h3>
             <br />
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
      <h2 class="center">My Team</h2>
      <section class="row team-view">
          
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
      </section>
      <br />
      <br />
       <br />
      <br />
      <section class="row">
        <h2 class="center">Team Chat</h2>
        <div class="comments">
            <?php 
             $stmt = $dbh->prepare("
                                    select fname,image,color,comment,time,teamComment.userId as id,teamComment.id as commentId
                                    from teamComment
                                    INNER JOIN user ON user.id=teamComment.userId
                                    where groupId='".$rows['groupId']."' order by commentId;
                                    ");
            $stmt->execute();
            $comment = $stmt->fetchall(PDO::FETCH_ASSOC); 
            foreach ($comment as $row) {
                if($row['id'] == $id){
                    echo "
                    <div style='float:left;'>
                     <p style='float:left;'>".$row['fname']."</p>
                            <div class='comment-pic' style=".'"'."background: url('".$row['image']."') no-repeat center;background-size: 100% 100%;border-color:".$row['color'].";".'"'." ></div>
                     </div>
                     <div class='mycomment' style='float:left;'>
                            <p class='comment-text'>".$row['comment']."</p>
                     </div>
                     <div style='clear:both;'></div>
                     <p style='text-align:center;'>".$row['time']."</p>";
                }else{
                    echo "
                    <div style='float:left;'>
                     </div>
                     <div class='othercomment' style='float:left;'>
                            <p class='comment-text'>".$row['comment']."</p>
                     </div>
                     
                            <div class='comment-pic' style=".'"'."background: url('".$row['image']."') no-repeat center;background-size: 100% 100%;border-color:".$row['color'].";".'"'." ></div><p style='float:left;'>".$row['fname']."</p>
                     <div style='clear:both;'></div>
                     <p style='text-align:center;'>".$row['time']."</p>";
                }
            }
            ?>
        </div>
        <form id="form2" method="POST" enctype="multipart/form-data" >
            <textarea name="comment"></textarea>
            <button class="login">Send Message</button>
            <input type="hidden" name="name" value="<?php echo $rows['fname'] ?>" />
            <input type="hidden" name="picture" value="<?php echo $rows['image'] ?>" />
            <input type="hidden" name="color" value="<?php echo $rows['color'] ?>" />
            <input type="hidden" name="id" value="<?php echo $rows['id'] ?>" />
            <input type="hidden" name="groupid" value="<?php echo $rows['groupId'] ?>" />
        </form>
      </section>
    
      <br />
      <br />
    <script src="js/vendor/jquery.js"></script>
    <script src="js/foundation.min.js"></script>
    <script src="js/main.js"></script>
    <script>
      $(document).foundation();
    </script>
      <script>
$(document).ready(function(){
  var formData = $('#form2');
  var submit = $('#submit2');
  var progressbox     = $('#progressbox');
	var progressbar     = $('#progressbar');
	var statustxt       = $('#statustxt');
	var completed       = '0%';
    
    
  formData.on('submit', function(e) {
    // prevent default action
    e.preventDefault();
    // send ajax request
    $.ajax({
      url: 'ajax_comment2.php',
      type: 'POST',
            // Type of request to be send, called as method // Data sent to server, a set of key/value pairs (i.e. form fields and values)
      contentType: false,
      cache: false,             // To unable request pages to be cached
      processData:false,
      data: new FormData(this),//form serizlize data
      beforeSend: function(){
        // change submit button value text and disabled it
        submit.val('Submitting...').attr('disabled', 'disabled');
      },
      success: function(data){
        // Append with fadeIn see http://stackoverflow.com/a/978731
          
        var item = $(data).hide().fadeIn(800);
        $('.comments').append(item).slideDown(500);
        $('.comments').animate({ 
                   scrollTop: $(".comments").prop("scrollHeight")}, 0
                );

        // reset form and button
        formData.trigger('reset');
        submit.val('Submit Comment').removeAttr('disabled');
      },
      error: function(e){
        alert(e);
      }
    });
  });
    
   
});  
 
</script> 
  </body>
</html>
