<?php 
extract($_POST);
if(isset($save))
{
//check user alereay exists or not
if($e=="" || $p==""|| $n=="" || $mob==""){
	$err="<font color='red'>fill all the fileds first</font>";	
}else{

$sql=mysqli_query($conn,"select * from user where email='$e'");

$r=mysqli_num_rows($sql);

if($r==1)
{
$err= "<font color='red'><h3 align='center'>This user already exists</h3></font>";
}
else
{

//encrypt your password
	$pass=password_hash($p,PASSWORD_DEFAULT);


	$query="INSERT into user (name,email,pass,mobile) values(?,?,?,?)";
	$stmt = mysqli_stmt_init($conn);
	mysqli_stmt_prepare($stmt, $query);
		  
	mysqli_stmt_bind_param($stmt, "ssss", $n,$e,$pass,$mob);
	if(mysqli_stmt_execute($stmt)){
	
		  
			$_SESSION['user'] = $e;
			header('location:user');
			die();
	

	}else{
		$err="<font color='red'>Login Failed </font>";

	}
}




}
}






?>


		<div class="row">
		<div class="col-sm-6">
		<img class="smo" src="./assets/dist/img/log.png">
		</div>
		<div class="col-sm-6" style="padding: 90px; padding-right: 150px;">
		<form method="post" enctype="multipart/form-data">
	<h2 style="color: #5b4a99;">Registration Form</h2>
		<div><?php echo @$err;?></div>
					<div>Full name</div>
					<input  type="text" name="n" class="input-field" required style="margin-bottom: 20px;"/>

					<div>Email </div>
					<input type="email" name="e" class="input-field" required style="margin-bottom: 20px;"/>
				
				
				
					<div>Password </div>
					<input type="password" name="p" class="input-field" required style="margin-bottom: 20px;"/>
				
				
				
					<div>Mobile Number </div>
					<input type="text" name="mob" class="input-field" required style="margin-bottom: 20px;"/>
				
					<input type="submit" value="Sign Up" class="submit-btn" name="save" style="font-size: 18px;" />

				
					</div>
				
		</form>
		</div>
		
	</body>
</html>