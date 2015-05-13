<html>
<head>
  <title>Comment System</title>
<head>
<body>
    <style>
    #progressbox {
border: 1px solid #0099CC;
padding: 1px; 
position:relative;
width:400px;
border-radius: 3px;
margin: 10px;
display:none;
text-align:left;
}
#progressbar {
height:20px;
border-radius: 3px;
background-color: #003333;
width:1%;
}
#statustxt {
top:3px;
left:50%;
position:absolute;
display:inline-block;
color: #000000;
}
    </style>
  <div class="post">
    <!-- post will be placed here from db -->
  </div>
  <div class="comment-block">
    here!
  </div>
  <!-- comment form -->
  <form id="form" method="POST" enctype="multipart/form-data" >
    <!-- need to supply post id with hidden fild -->
     <div id="progressbox" style="display:none;"><div id="progressbar"></div><div id="statustxt">0%</div></div>
     <input id='document' type='file' name="file" multiple />
    <input type="submit" id="submit"  value="Submit Comment">
  </form>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script>
$(document).ready(function(){
  var formData = $('form');
  var submit = $('#submit');
  var progressbox     = $('#progressbox');
	var progressbar     = $('#progressbar');
	var statustxt       = $('#statustxt');
	var completed       = '0%';
    $('#document').change(function(){
        $('#form').submit();
    });
    
  formData.on('submit', function(e) {
    // prevent default action
    e.preventDefault();
    // send ajax request
    $.ajax({
      url: 'ajax_comment.php',
      type: 'POST',
      type: "POST",             // Type of request to be send, called as method // Data sent to server, a set of key/value pairs (i.e. form fields and values)
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
        $('.comment-block').append(data);

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