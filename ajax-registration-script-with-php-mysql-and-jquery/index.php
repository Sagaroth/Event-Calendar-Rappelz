<?php 
include('header.php');
include_once("db_connect.php");
?>
<title>phpzag.com : Demo Ajax Registration Script with PHP, MySQL and jQuery</title>
<script type="text/javascript" src="script/validation.min.js"></script>
<script type="text/javascript" src="script/register.js"></script>
<link href="css/style.css" rel="stylesheet" type="text/css" media="screen">
<?php include('container.php');?>

<div class="container">
	<h2>Example: Ajax Registration Script with PHP, MySQL and jQuery</h2>		
	
	<div class="register_container">
	<form class="form-signin" method="post" id="register-form">
	<h2 class="form-signin-heading">User Registration Form</h2><hr />
	<div id="error">
	</div>
	<div class="form-group">
	<input type="text" class="form-control" placeholder="Username" name="user_name" id="user_name" />
	</div>
	<div class="form-group">
	<input type="email" class="form-control" placeholder="Email address" name="user_email" id="user_email" />
	<span id="check-e"></span>
	</div>
	<div class="form-group">
	<input type="password" class="form-control" placeholder="Password" name="password" id="password" />
	</div>
	<div class="form-group">
	<input type="password" class="form-control" placeholder="Retype Password" name="cpassword" id="cpassword" />
	</div>
	<hr />
	<div class="form-group">
	<button type="submit" class="btn btn-default" name="btn-save" id="btn-submit">
	<span class="glyphicon glyphicon-log-in"></span> &nbsp; Create Account
	</button> 
	</div>  
	</form>
	</div>
		
	<div style="margin:50px 0px 0px 0px;">
		<a class="btn btn-default read-more" style="background:#3399ff;color:white" href="http://www.phpzag.com/ajax-registration-script-with-php-mysql-and-jquery" title="">Back to Tutorial</a>			
	</div>		
</div>
<?php include('footer.php');?>