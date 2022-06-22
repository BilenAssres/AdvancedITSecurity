<?php 
extract($_POST);
if(isset($sub) || isset($query))
{
$user=$_SESSION['user'];
$s=mysqli_query($conn,"select id from feedback where student_id='$user'");
$idn =mysqli_fetch_assoc($s);
$id=$idn['id'];
echo $id;
$query="update feedback set complaints='$quest13' where id='$id' ";


mysqli_query($conn,$query);

echo "<h2 style='color:green'>Updated </h2>";


}


?>


<?php 
extract($_POST);

$statusMsg = '';
$targetDir = "uploads/";


if(isset($sub) && !empty($_FILES["feedbackfile"])){
  $fileName = basename($_FILES["feedbackfile"]["name"]);
  $targetFilePath = $targetDir;
  $fileType = pathinfo($fileName,PATHINFO_EXTENSION);
    $allowTypes = array('jpg','png','jpeg','gif','pdf');

    if(in_array($fileType, $allowTypes)){
        if(move_uploaded_file($_FILES["feedbackfile"]["tmp_name"], $targetFilePath)){
          $query="insert into feedback(Name,email,comment,file,date) values('$user','$quest13','".$fileName."', ".'now()'.")";

          if(mysqli_query($conn,$query)){
            $statusMsg = "The feedback has been uploaded successfully.";

          }else{
            $statusMsg = "Feedback failed, please try again.";

          }
           
        }else{
            $statusMsg = "Sorry, there was an error uploading your file.";
        }
    }else{
        $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
    }
}else{
    $statusMsg = 'Please select a file tooad.' ;
}

echo $statusMsg;
?>
<form method="post" enctype="multipart/form-data">






<h3>Update Complaint:<h3>
<center>
  <!-- <input name="complaint_giver_name" type="text"> -->
<textarea name="quest13" rows="5" cols="60" id="comments" style="font-family:sans-serif;font-size:1.2em;">

</textarea></center><br><br>
<div>Upload  the file </div>
					<div><input type="file" name="feedbackfile" id="feedbackfile" class="form-control"/></div>
          

<p align="center"><button type="submit" style="font-size:7pt;color:white;background-color:brown;border:2px solid #336600;padding:7px" name="sub">Submitt</button></p>



</form>
</fieldset>

</div><!--close content_item-->
      </div><!--close content-->   
	
	</div><!--close site_content-->  	
  
    
    </div><!--close main-->
  </form>
<center>