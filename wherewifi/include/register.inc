<form id="form" action="register/register.php" method="POST">
  <h1>Register</h1>
  <p>Username</p>
  <input id="user" name="user" type="text" size=30 value="<?php if (isset($_POST['user'])){echo $_POST['user'];} ?>" required/>
	<span id="userError" class="error">
  <?php
  	// Check if there was an error for this input
	if (isset($errors['user'])) {
		echo $errors['user'];
	}
	?>
	</span>
  <p>Password</p>
  <input id="pass" name="passwd" type="password" size=30 value="<?php if (isset($_POST['pass'])){echo $_POST['pass'];} ?>" required/>
  <span id="passError" class="error">
  <?php
	if (isset($errors['pass'])) {
		echo $errors['pass'];
	}
	?>
	</span>
  <p>Email</p>
  <input id="email" name="email" placeholder="address@domain.com" size=30 required="" type="email" value="<?php if (isset($_POST['email'])){echo $_POST['email'];} ?>">
  <span id="emailError" class="error">
  <?php
		if (isset($errors['email'])) {
			echo $errors['email'];
		}
	?>
	</span>
  <p>Birthdate</p>
  <input id="date" placeholder="yyyy-mm-dd" name="bdate" type="text" value="<?php if (isset($_POST['date'])){echo $_POST['date'];} ?>" required/>
  <span id="dateError" class="error">
  <?php
		if (isset($errors['date'])) {
			echo $errors['date'];
		}
	?>
	</span>
  <p>Gender</p>
  <p><input name="gender" type="radio" value="male" required>Male
  <input name="gender" type="radio" value="female">Female
  <input name="gender" type="radio" value="other">Other</p>
  <span id="genderError" class="error">
  <?php
		if (isset($errors['gender'])) {
			echo $errors['gender'];
		}
	?>
	</span>
  <p>How many wifi enabled devices do you own?</p>
  <input id="devices" name="wifi" type="number" size=30 value="<?php if (isset($_POST['devices'])){echo $_POST['devices'];} ?>" required/>
  <span id="devicesError" class="error">
  <?php
		if (isset($errors['devices'])) {
			echo $errors['devices'];
		}
	?>
	</span>
  <br /><br />
  <input class="button" name="submit" type="submit" />
</form>