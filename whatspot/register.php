<?php include 'includes/header.inc'; ?>

<?php
		// This section adapted from www.w3schools.com/php/php_form_required.asp

		// Declare empty variables for form values

		$uname = $fname = $lname = $email = $confEmail = $password = $confPassword = $postcode = $dobD = $dobM = $dobY = $marketing = $hashed = $confHashed = '';
		$salt = uniqid();

		// Declare empty variables for error messages

		$unameError = $fnameError = $lnameError = $emailError = $confEmailError = $passwordError = $confPasswordError = $postcodeError = $dateError = $querySuccess = $loginLink = '';

		// Declare error counter
		$errorCounter = 0;

		// test each form element to see if it is set and if confirmation values match, then "prepare" -> see prepare()
		// check to see if there was a POST event so script doesn't trigger on page load
		
		if ($_SERVER["REQUEST_METHOD"] == "POST") {

			// validate username, check to see if it has a value, if not, inform the user that it is required and add to errorCounter
			// else, check to see if it is allowed with REGEXP - if not, ask user to reenter and display warning
			// else - use prepare() method to prepare data for database entry

			if (empty($_POST['uname'])){				
				$unameError = " Username required";
				$errorCounter = $errorCounter + 1;
			} else {				
				if (!preg_match("/^[a-zA-Z0-9_]{6,45}$/", $_POST['uname'])) {
			    	$unameError = "6-45 Letters, numbers or underscores";
			    	$errorCounter = $errorCounter + 1;
			    } else {
			    	$uname = prepare($_POST["uname"]);
			    }
			}

			// validate first name - required

			if (empty($_POST['fname'])){
				$fnameError = "First name required";
				$errorCounter = $errorCounter + 1;
			} else {
				if (!preg_match("/^[a-zA-Z ]{1,45}$/", $_POST['fname'])) {
			    	$fnameError = "1-45 Letters and spaces only";
			    	$errorCounter = $errorCounter + 1;
			    } else {
			    	$fname = prepare($_POST["fname"]);
			    }
			}

			// validate last name - not required

			if (!preg_match("/^[a-zA-Z ]{1,45}$/", $_POST['lname'])) {
		    	$lnameError = " 1-45 Letters and spaces only";
		    	$errorCounter = $errorCounter + 1;
		    } else {
		    	$lname = prepare($_POST["lname"]);
		    }

		    // validate email with filter_var(), required

			if (empty($_POST['email'])){
				$emailError = " Email required";
				$errorCounter = $errorCounter + 1;
			} else {				
				if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
					$emailError = " Invalid email";
				} else {
					$email = prepare($_POST["email"]);
				}
			}

			// validate confirmation email as with email

			if (empty($_POST['confEmail'])){
				$confEmailError = " Confirmation email required";
				$errorCounter = $errorCounter + 1;
			} else {
				if (!filter_var($_POST['confEmail'], FILTER_VALIDATE_EMAIL)){
					$confEmailError = " Invalid email";
				} else {
					$confEmail = prepare($_POST["confEmail"]);
				}
			}

			// check to see that emails match other show error

			if ($email != $confEmail){
				$confEmailError = " Email mismatch";
				$errorCounter = $errorCounter + 1;
			}

			// validate password - required

			if (empty($_POST['password'])){
				$passwordError = " Password required";
				$errorCounter = $errorCounter + 1;
			} else {
				if (!preg_match("/^[\s\S]{8,64}$/", $_POST['password'])) {
			    	$passwordError = "8-64 Characters only";
			    	$errorCounter = $errorCounter + 1;
			    } else {
			    	$hashed = prepare($_POST["password"]);
			    }
			}

			// validate confirmation password - required

			if (empty($_POST['confPassword'])){
				$confPasswordError = " Confirmation required";
				$errorCounter = $errorCounter + 1;
			} else {
				if (!preg_match("/^[\s\S]{8,64}$/", $_POST['confPassword'])) {
			    	$confPasswordError = "8-64 Characters only";
			    	$errorCounter = $errorCounter + 1;
			    } else {
			    	$confHashed = prepare($_POST["confPassword"]);
			    }
			}

			// make sure that both passwords match

			if ($hashed != $confHashed){
				$confPasswordError = " Password mismatch";
				$errorCounter = $errorCounter + 1;
			}

			// get the three DOB date components

			$dobD = $_POST['dobD'];
			$dobM = $_POST['dobM'];
			$dobY = $_POST['dobY'];

			// user checkdate() to make sure that they are a valid date

			if (checkdate($dobM, $dobD, $dobY)){
				$DOB = $dobY . '-' . $dobM . '-' . $dobD;
			} else {
				$dateError = "Date Invalid";
				$errorCounter = $errorCounter + 1;
			}

			// validate postcode - not required so set to 4000 if user does not enter anything

			if (!empty($_POST['postcode']) && !preg_match("/^[0-9]{4,5}$/", $_POST['postcode'])) {
				$postcodeError = "Enter a 4 or 5 digit number";				
			} else {
				if (empty($_POST['postcode'])){
					$postcode = 4000;
				} else {
					$postcode = $_POST["postcode"];
				}				
			}
			
			// trim/strip/remove special chars to prevent XSS

			$lname = prepare($_POST["lname"]);			
			$marketing = $_POST["marketing"];


		}

		// if there were no errors and there was a POST event

		if ($errorCounter == 0 && $_SERVER["REQUEST_METHOD"] == "POST"){  // only submit if no errors and check to see if a form was actually posted

			// commit data to DB

			try {

				$sql = "INSERT INTO Members(memberName, fname, lname, email, pwdHash, salt, addressPC, marketing, DOB)
						VALUES (:memberName, :fname, :lname, :email, SHA2(CONCAT(:pwdHash, :salt), 0), :salt, :addressPC, :marketing, :DOB)";
				$stmt = $pdo->prepare($sql);

				if($stmt->execute(array(

						"memberName" => $uname,
						"fname" => $fname,
						"lname" => $lname,
						"email" => $email,
						"pwdHash" => $hashed,
						"salt" => $salt,
						"addressPC" => $postcode,
						"marketing" => $marketing,
						"DOB" => $DOB

					))){

						// clear form by emptying strings if a successful POST occured and notify user

						$querySuccess = "Registration Successful!  ";
						$loginLink = "<a href=\"login.php\">Login Here!</a>";
						$uname = '';
						$fname = '';
						$lname = '';
						$email = '';
						$confEmail = '';
						$password = '';
						$confPassword = '';
						$postcode = '';
						$dobD = '';
						$dobM = '';
						$dobY = '';
						$marketing = '';
					};

				} catch (PDOException $e) {

					// catch error if unique integrtity on username is violated - inform user
					
					if ($e->errorInfo[1] == 1062){
						$unameError = " Already Exists";  // display this error if a user tries to register a username that already exists
					} else {
						echo $e->getMessage();
					}
			}
		}

?>

<!-- begin HTML form - each required input will also perform client side validation that complements server side code-->

<div id="register" class="inputForm">
	
	<br>

	<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST" class="inputForm">

		<h1>Registration Form</h1>

		<?php 

			if ($errorCounter > 0){
				echo "<p>You have $errorCounter errors to fix in this form</p>";
			} 

		?>

		<p>Required fields are denoted with a <span class="required">*</span></p>
		<p>Hover over<img src="imgs%2Fquestionmark.png" alt="Hover for input requiremnts" width="20" height="23"> for input requirements.</p>

			<div>
				<label>Username: <span class="required">*</span></label>
				<input type="text" name="uname" value="<?php echo $uname; ?>" required autofocus placeholder="User_Name" pattern="[a-zA-Z0-9_]{6,45}" maxlength="45"/><span class="error"> <?php echo $unameError; ?></span>
				<span class="fieldParams" title="6-45 Letters (a-z, A-Z), numbers (0-9) or underscores (_)"><img src="imgs%2Fquestionmark.png" alt="Hover for input requiremnts" width="22" height="26"></span>
			</div>		

			<div>
				<label>First Name: <span class="required">*</span></label>
				<input type="text" name="fname" value="<?php echo $fname; ?>" required placeholder="First Name" pattern="[a-zA-Z ]{1,45}" maxlength="45"/><span class="error"> <?php echo $fnameError; ?> </span>
				<span class="fieldParams" title="1-45 Letters and spaces only"><img src="imgs%2Fquestionmark.png" alt="Hover for input requiremnts" width="22" height="26"></span>
			</div>

			<div>
				<label>Last Name:  </label>
				<input type="text" name="lname" value="<?php echo $lname; ?>" placeholder="First Name" pattern="[a-zA-Z ]{1,45}" maxlength="45"/><span class="error"><?php echo$lnameError; ?> </span> 
				<span class="fieldParams" title="1-45 Letters and spaces only"><img src="imgs%2Fquestionmark.png" alt="Hover for input requiremnts" width="22" height="26"></span>
			</div>

			<div>
				<label>Email: <span class="required">*</span></label>
				<input type="email" name="email" value="<?php echo $email; ?>" placeholder="your@email.com"><span class="error"> <?php echo $emailError; ?> </span> 
				<span class="fieldParams" title="Valid email: an@example.com"><img src="imgs%2Fquestionmark.png" alt="Hover for input requiremnts" width="22" height="26"></span>
			</div>
			

			<div>
				<label>Confirm Email: <span class="required">*</span></label>
				<input type="email" name="confEmail" value="<?php echo $confEmail; ?>" placeholder="your@email.com"/><span class="error"> <?php echo $confEmailError; ?> </span>
				<span class="fieldParams" title="Valid email: an@example.com"><img src="imgs%2Fquestionmark.png" alt="Hover for input requiremnts" width="22" height="26"></span>
			</div>

			<div>
				<label>Password: <span class="required">*</span></label>
				<input type="password" name="password" placeholder="Your password"/><span class="error"> <?php echo $passwordError; ?> </span> 
				<span class="fieldParams" title="8-64 characters or symbols"><img src="imgs%2Fquestionmark.png" alt="Hover for input requiremnts" width="22" height="26"></span>
			</div>

			<div>
				<label>Confirm Password: <span class="required">*</span></label>
				<input type="password" name="confPassword" placeholder="Confirm password"/><span class="error"> <?php echo $confPasswordError; ?> </span> 
				<span class="fieldParams" title="8-64 characters or symbols"><img src="imgs%2Fquestionmark.png" alt="Hover for input requiremnts" width="22" height="26"></span>
			</div>

			<div>
				<label>Postcode:  </label>
				<input type="text" name="postcode" placeholder="4000" value="<?php echo $postcode; ?>"/><span class="error"> <?php echo $postcodeError; ?> </span> 
				<span class="fieldParams" title="Any 4 or 5 digit number"><img src="imgs%2Fquestionmark.png" alt="Hover for input requiremnts" width="22" height="26"></span>
			</div>

			<!-- php loops used to automatically generate select input elements -->

			<div>

				<label>DOB (DD/MM/YYYY): <span class="required">*</span></label>

				<select id="dobD" name="dobD">
				<?php
					echo '<option value="0">----</option>';
					for ($i = 1; $i <= 31; $i++){
						if($dobD == $i){
							echo "<option value=\"$i\" selected>$i</option>";
						} else {
							echo "<option value=\"$i\">$i</option>";
						}
					}
				?></select>
	

			<select id="dobM" name="dobM">
				<?php  
					echo '<option value="0">----</option>';
					for ($i = 1; $i <= 12; $i++){
						if($dobM == $i){
							echo "<option value=\"$i\" selected>$i</option>";
						} else {
							echo "<option value=\"$i\">$i</option>";
						}
					}
				?></select>

			<select id="dobY" name="dobY">
				<?php 
					$year = date("Y"); 
					echo '<option value="0">----</option>';
					for ($i = $year; $i >= $year - 130; $i--){  // allow up to 120yo olds to join - to cater for the oldest person alive 
						if($dobY == $i){
							echo "<option value=\"$i\" selected>$i</option>";
						} else {							
							echo "<option value=\"$i\">$i</option>";
						}
					}
				?></select><span class="error"><?php echo $dateError; ?></span>

			</div><br>

			<p>Do you wish to receive marketing communications? </p> 

				<input type="radio" name="marketing" value="Y" checked="checked"><label>Yes</label>
				<input type="radio" name="marketing" value="N"><label>No</label><br><br>

			<span id="querySuccess"><?php echo $querySuccess; ?></span>
			<span id="loginLink"><?php echo $loginLink; ?></span>

			<button class="button" id="regButton" type="submit" value="Join!">Join!</button>			

	</form>

	<!-- END FORM -->

</div>

<?php include 'includes/footer.inc'; ?>
