<?php
// code will run if request through ajax
//if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] )):
 
    // preventing sql injection
    

    // insert new comment into comment table
    $imgdir = "./files/";
					$imgname = $_FILES['file']['name'];
					$tmp = $_FILES['file']['tmp_name'];
					$img = $imgdir.$imgname;
      
           
           
				$type = str_replace("files/",".",$_FILES['file']['type']);
				//If statement to ensire file type is jpeg or png before uploading
				
					move_uploaded_file($tmp,$img);
?> 
 

<!-- sending response with new comment and html markup-->


<section class="large-3 columns" style="text-align:center;">
            <img src="img/document.png" />
         <p style="color:white;font-size:1.5em;margin-top:-50px;"><?php echo $imgname;?></p>
        <img src="img/exit.png" class="delete-doc" width="40" style="margin-top:-50px;cursor:pointer;" />
    <input type="hidden" name='file[]' value='<?php echo $img;?>' />
       </section>
<script>
$('document').ready(function(){
    $('.delete-doc').click(function(){
       $(this).next().attr('name','null');
       $(this).parent().hide(); 
    });   
});
</script>