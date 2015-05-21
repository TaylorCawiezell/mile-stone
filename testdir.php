<?php
  function imgDir(){
            if (isset($_FILES['file'])) {
				$type = str_replace("image/",".",$_FILES['file']['type']);
				//If statement to ensire file type is jpeg or png before uploading
				if ($type == ".jpeg" || $type == ".png" || $type == ".jpg" || $type == ".tiff"){
					$imgdir = "./files/";
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
imgDir();
 
?>

<form method="post">
<input type="file" name="file" />
</form>