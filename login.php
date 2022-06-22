<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<?php 
extract($_POST);
if(isset($save))
{
	if($e=="" || $p==""){
		$err="<font color='red'>fill all the fileds first</font>";	
	}else{
		$query="SELECT * FROM user WHERE email=? LIMIT 1";
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt, $query);
              
        mysqli_stmt_bind_param($stmt, "s", $e);
        if(mysqli_stmt_execute($stmt)){
			$result = mysqli_stmt_get_result($stmt);
			$row = mysqli_fetch_array($result);
			
            if (password_verify($p, $row["pass"])) {
              
                $_SESSION['user'] = $e;
                header('location:user');
                die();
            } else {
				$err="<font color='red'>Invalid login details</font>";
            }
    
        }else{
			$err="<font color='red'>Login Failed </font>";
    
        }
	}
}



?>
<div class="row">
		<div class="col-sm-6">
		<img class="smo" src="./assets/dist/img/log.png">
		</div>
		<div class="col-sm-6" style="padding: 90px; padding-right: 150px;">

<form method="post" auto_complete="off">
	<h2 style="color: #5b4a99;">Login Form</h2>
	
	<?php echo @$err;?>
	
		<div>Email</div>
		<input type="email" name="e" class=" input-field" style="margin-bottom: 20px;"/>
		<div>Password</div>
		<input type="password" name="p" class="input-field" style="margin-bottom: 20px;"/>
		<div class="g-recaptcha" data-sitekey="6LctkJEgAAAAAB9BSrVnM_fd3gJTX4VhrDEta7uR"></div>
	
		<input type="submit" value="Login" name="save" class="submit-btn" style="font-size: 18px;"/>
		
		
</form>	
</div>
</div>