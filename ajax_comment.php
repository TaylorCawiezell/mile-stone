<?php
// code will run if request through ajax
//if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] )):
 
    // preventing sql injection
    

    // insert new comment into comment table
    $imgdir = "./files/";
					$imgname = $_FILES['file']['name'];
					$tmp = $_FILES['file']['tmp_name'];
					$img = $imgdir.$imgname;
      
             function imgDir(){
           
				$type = str_replace("image/",".",$_FILES['file']['type']);
				//If statement to ensire file type is jpeg or png before uploading
				if ($type == ".jpeg" || $type == ".png" || $type == ".jpg"){
					move_uploaded_file($tmp,$img);
					return $img;
				}else{ //return statement if file type is not jpeg or png
				return "images/default.png";
					
				}
            }
			


        
   /*  $user="root";
	 $pass="root";
	 $mysql = 'mysql:host=localhost;dbname=mile-stone;port=8889';
     $dbh = new PDO($mysql, $user, $pass);
     $stmt = $dbh->prepare(" INSERT INTO document
      (file,name,size,)
      VALUES('".$."', '".$mail."', '".$comment."', '".$postId."');");
     $stmt->execute();
  // connecting to db*/
 ?> 
 

<!-- sending response with new comment and html markup-->
<div class="comment-item">
  <div class="comment-avatar">
    <img src="/img/document.png" >
  </div>
  <div class="comment-post">
    <?php echo $imgname;?>
  </div>
</div>