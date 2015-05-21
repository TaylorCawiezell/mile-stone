 <?php
            $user="root";
	        $pass="root";
            $id = $_POST['id'];
            $mysql = 'mysql:host=localhost;dbname=mile-stone;port=8889';
            $dbh = new PDO($mysql, $user, $pass);
			$stmt=$dbh->prepare(
                                "SELECT user.id, invite.taskId, task.name, task.color as taskcolor, invite.id as alertId
                                 FROM invite
                                 INNER JOIN user ON invite.userId=user.id
                                 INNER JOIN task ON invite.taskId=task.id
                                 where user.id='".$id."' order by alertid desc limit 1;"
                               ); 
			$stmt->execute(); 
			$alerts = $stmt->fetchall(PDO::FETCH_ASSOC); 
			//The parameter means it will return an indexed array with each index containing an associative array 
            $c = 0;
			foreach ($alerts as $row) {
                if($row['responce'] == 'yes' || $row['responce'] == 'no'){
                   
                 }else{
  				echo '<div class="alert alertclick'.$row['alertId'].'"  style="background:'.$row['taskcolor'].';">you have a new invite!</div>
                      <div class="alert-pop alert'.$row['alertId'].'"><h3>Your Invited to Take Place In "'.$row['name'].'"</h3>
                      <a href="dashboard.php?id='.$row['id'].'&alertId='.$row['alertId'].'&responce=yes&alerttaskid='.$row['taskId'].'" ><button>Yes</button></a>
                      <a href="dashboard.php?id='.$row['id'].'&alertId='.$row['alertId'].'&responce=no&alerttaskid='.$row['taskId'].'" ><button>No</button></a>
                      </div>
                      <script>
                        $("document").ready(function(){
                            $(".alert'.$row['alertId'].'").hide();
                            
                            $(".alertclick'.$row['alertId'].'").click(function(){
                                $(".alert'.$row['alertId'].'").slideToggle();
                            });
                        });
                      </script>';
                     $c++;
                    
                    
                    
                  }
                
                
            }
                
	         ?>