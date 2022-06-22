<?php 
extract($_POST);
if(isset($sub))
{
$user=$_SESSION['user'];
$s=mysqli_query($conn,"select id from feedback where student_id='$user'");
$idn =mysqli_fetch_assoc($s);
$id=$idn['id'];
echo $id;
// $_SESSION['idn']= $idn;
// $idnt=$_SESSION['idn'];
// $strp= implode(" =>",$idnt);
$query="update feedback set complaints='$quest12' where id='$id' ";


mysqli_query($conn,$query);

echo "<h2 style='color:green'>Updated </h2>";


}


?>
<form method="post">





<h3>Update Complaint:<h3>
<center>
<textarea name="quest12" rows="5" cols="60" id="comments" style="font-family:sans-serif;font-size:1.2em;">

</textarea></center><br><br>

<p align="center"><button type="submit" style="font-size:7pt;color:white;background-color:brown;border:2px solid #336600;padding:7px" name="sub">Submitt</button></p>


</form>
</fieldset>

</div><!--close content_item-->
      </div><!--close content-->   
	
	</div><!--close site_content-->  	
  
    
    </div><!--close main-->
  </form>
<center>