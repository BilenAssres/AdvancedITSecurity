<?php 


$user= $_SESSION['user'];
if($user=="")
{header('location:../index.php');}
$sql=mysqli_query($conn,"select * from user where email='$user' ");
$q=mysqli_query($conn,"select * from feedback where email= '$user' ");
$users=mysqli_fetch_assoc($sql);

extract($_POST);

$statusMsg = '';
$targetDir = "../uploads/";
$honeypot= null;

if(isset($sub) && !empty($_FILES["feedbackfile"]) ){
  if ($_POST['honeypot'] !=0) {
    $statusMsg = "Are you a bot?";
    
  }else{
  $token = filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING);
  if (!empty($_POST['token'])) {
    if (hash_equals($_SESSION['token'], $_POST['token'])) {
   
      if($honeypot==0){
        $filepath = $_FILES['feedbackfile']['tmp_name'];
        $fileName = basename($_FILES["feedbackfile"]["name"]);
        $targetFilePath = $targetDir. $fileName;
        $fileType = pathinfo($fileName,PATHINFO_EXTENSION);
        $allowTypes = array('pdf');
        $fileSize = filesize($filepath);
        $fileinfo = finfo_open(FILEINFO_MIME_TYPE);
        $filetype = finfo_file($fileinfo, $filepath);
    
        if ($fileSize === 0) {
          $statusMsg = "Empty File .";
        }
    
        if ($fileSize > 20971520) { 
          $statusMsg = "File too big .";
        }
    
        if ($filetype != "application/pdf") {
           
          $statusMsg = "Wrong file .";
        }
    
        if(in_array($fileType, $allowTypes)){
          $now= time();
          $date=date("Y-m-d",$now);
            if(move_uploaded_file($_FILES["feedbackfile"]["tmp_name"], $targetFilePath)){
              $query="INSERT INTO  feedback(Name,email,comment,file,date) values (?,?,?,?,?)";
              $stmt = mysqli_stmt_init($conn);
              mysqli_stmt_prepare($stmt, $query);
              
              mysqli_stmt_bind_param($stmt, "sssss", $users['name'],$user,$quest13,$fileName, $date);
              if(mysqli_stmt_execute($stmt)){
                $statusMsg = "The feedback has been uploaded successfully.";
    
              }else{
                $statusMsg = "Feedback failed, please try again.";
    
              }
               
            }else{
                $statusMsg = "Sorry, there was an error uploading your file.";
            }
        }else{
            $statusMsg = 'Sorry, only PDF files are allowed to upload.';
        }
      }else{
          $statusMsg = 'Abnormal Activity, try again!' ;
        }
    }
    else{
      $statusMsg = "Weird actions reported!";
     

    }
  }}


 
}else{
    $statusMsg = 'Please select a file tooad.' ;
}

echo $statusMsg;
?>
<form method="post" enctype="multipart/form-data">






<h3>Feedback:<h3>



<p>Comments</p>
<textarea name="quest13" rows="5" cols="60" id="comments" style="font-family:sans-serif;font-size:1.2em;">

</textarea><br><br>
<div>Upload  the file </div>
<div><input type="file"  name="feedbackfile" id="feedbackfile" class="form-control"/></div>
<input type="text" name="honeypot" id="honeypot" hidden value="0">
<input type="hidden" name="token" value="<?php echo $_SESSION['token'] ?? '' ?>">
<button type="submit" style="font-size: 1.5rem;color:white;background-color:#5B4A99;border: none;padding:10px; width:100%; margin-top:1rem;" name="sub">Submit</button>



</form>
</fieldset>

</div><!--close content_item-->
      </div><!--close content-->   
	
	</div><!--close site_content-->  	
  
    
    </div><!--close main-->
  </form>
<center>