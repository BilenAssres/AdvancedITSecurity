<?php 
extract($_POST);
if(isset($save))
{

	if($e=="" || $p=="")
	{
	$err="<font color='red'>fill all the fileds first</font>";	
	}
	else
	{
$pass=md5($p);	

$sql=mysqli_query($conn,"select * from user where email='$e' and pass='$pass'");

$r=mysqli_num_rows($sql);

if($r==true)
{
$_SESSION['user']=$e;
header('location:user');
}

else
{

$err="<font color='red'>Invalid login details</font>";

}
}
}

?>
<div class="row">
		<div class="col-sm-6">
		<img class="smo" src="./assets/dist/img/log.png">
		</div>
		<div class="col-sm-6" style="padding: 90px; padding-right: 150px;">

<form method="post">
	<h2 style="color: #5b4a99;">Login Form</h2>
	
	<?php echo @$err;?>
	
		<div>Email</div>
		<input type="email" name="e" class=" input-field" style="margin-bottom: 20px;"/>
		<div>Password</div>
		<input type="password" name="p" class="input-field" style="margin-bottom: 20px;"/>
	
		<input type="submit" value="Login" name="save" class="submit-btn" style="font-size: 18px;"/>
		
		
</form>	
</div>
</div>