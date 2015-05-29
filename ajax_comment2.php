<?php 
$name = $_POST['name'];
$comment = $_POST['comment'];
$picture = $_POST['picture'];
$color = $_POST['color'];
$id = $_POST['id'];
$groupid = $_POST['groupid'];
$time = date('l jS \of F Y h:i:s A');

     $user="root";
	 $pass="root";
	 $mysql = 'mysql:host=localhost;dbname=mile-stone;port=8889';
     $dbh = new PDO($mysql, $user, $pass);
     
     $stmt = $dbh->prepare(
                           "INSERT INTO teamComment (userId,teamId,comment,time)
                            VALUES('".$id."','".$groupid."','".$comment."','".$time."');"
                          );
     $stmt->execute();

echo "
    <div style='float:left;'>
     <p style='float:left;'>".$name."</p>
            <div class='comment-pic' style=".'"'."background: url('".$picture."') no-repeat center;background-size: 100% 100%;border-color:".$color.";".'"'." ></div>
     </div>
     <div class='mycomment' style='float:left;'>
            <p class='comment-text'>".$comment."</p>
     </div>
     <div style='clear:both;'></div>
     <p style='text-align:center;'>".$time."</p>
     
"

?>

