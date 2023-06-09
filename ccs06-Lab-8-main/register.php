<?php
	class Password{
		public function HashPass($password){
		password_hash($password, PASSWORD_BCRYPT);
	}
}
	?>
	
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Registration</title>
</head>
<body>
<h1>Register a User</h1>

<form action="save-registration.php" method="POST">
	<div>
		<label>First Name</label>
		<input type="text" name="first_name" placeholder="First Name" required/>	<p/>
	</div>
	<div>
		<label>Middle Name</label>
		<input type="text" name="middle_name" placeholder="Middle Name" />	<p/>
	</div>
	<div>
		<label>Last Name</label>
		<input type="text" name="last_name" placeholder="Last Name" required/>	<p/>
	</div>
	<div>
		<label>Email Address</label>
		<input type="email" name="email" placeholder="email@address.com" required/>	<p/>
	</div>
	<div>
		<label>Password</label>
		<input type="password" name="password" id="password" minlength="8" required/>	<p/>
	</div>
	<div>
		<label>Confirm Password</label>
		<input type="password" name="confirm_password" id="confirm_password" minlength="8" required/>	<p/>
	</div>

	<script type="text/JavaScript"> 
	var password = document.getElementById("password")
	, confirm_password = document.getElementById("confirm_password");

	function validatePassword(){
	if(password.value != confirm_password.value) {
		confirm_password.setCustomValidity("Passwords does not match!");
	} else {
		confirm_password.setCustomValidity('');
	}
	}
	password.onchange = validatePassword;
	confirm_password.onkeyup = validatePassword;
	</script>

	<div>
	<div>
		<label>Birthdate</label>
		<input type="date" name="birthdate" placeholder="Birthdate" />	<p/>
	</div>
	<div>
		<label>Gender</label>
		<input type="radio" name="gender" value="Male" /> Male
		<input type="radio" name="gender" value="Female" /> Female <p/>
	</div>
	<div>
		<label>Address</label>
		<input type="text" name="address" placeholder="Address" />	<p/>
	</div>
	<div>
		<label>Contact Number</label>
		<input type="tel" name="contact_number" placeholder="Contact Number" />	<p/>
	</div>
	<br>
	<br>
		<button>
			Register User
		</button>	
	</div>
</form>
</body>
</html>