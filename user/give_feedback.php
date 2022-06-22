<?php 
extract($_POST);
if(isset($sub))
{
$user=$_SESSION['user'];

$sql=mysqli_query($conn,"select * from feedback where student_id='$user'");

$query="insert into feedback values('','$user','$quest13',now())";

mysqli_query($conn,$query);

echo "<h2 style='color:green'>Thank you </h2>";



$imageName=$_FILES['img']['name'];
$query="insert into user values('','$imageName',now())";
mysqli_query($conn,$query);

//upload image
move_uploaded_file($_FILES['img']['tmp_name'],"images/".$_FILES['img']['name']);
var_dump($_FILES["img"]);
}
?>
<form method="post">






<h3>Complaint:<h3>
<center>
<textarea name="quest13" rows="5" cols="60" id="comments" style="font-family:sans-serif;font-size:1.2em;">

</textarea></center><br><br>
<div>Upload  the file </div>
					<div><input type="file" name="img" class="form-control"/></div>
          

<p align="center"><button type="submit" style="font-size:7pt;color:white;background-color:brown;border:2px solid #336600;padding:7px" name="sub">Submitt</button></p>



</form>
</fieldset>

</div><!--close content_item-->
      </div><!--close content-->   
	
	</div><!--close site_content-->  	
  
    
    </div><!--close main-->
  </form>
<center>