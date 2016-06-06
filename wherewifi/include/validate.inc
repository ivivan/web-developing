<?php
//Validate Username, minimum entry is 3 characters
function validateUsername(&$errors, $field_list, $field_name) {
	if (!isset($field_list[$field_name])|| empty($field_list[$field_name]))  {
		$errors[$field_name] = 'This field is Required';
	} else if (strlen($field_list[$field_name]) < 3) {
		$errors[$field_name] = 'Please enter a valid Username. Username must be at least 3 characters long';
	}
}

//Validate password, minimum entry is 6 characters
function validatePassword(&$errors, $field_list, $field_name) {
	if(!isset($field_list[$field_name])|| empty($field_list[$field_name])) { // user didn't enter a password
		$errors[$field_name] = 'Please enter a password. Password must be at least 6 characters long';
	} else if (strlen($field_list[$field_name]) < 6) { // Password entered is invalid {
		$errors[$field_name] = 'Please enter a valid password. Password must be at least 6 characters long';
	}
}

//Validate Birthdate, where field input is yyyy-mm-dd
function validateBdate(&$errors, $field_list, $field_name) {
	$pattern = '/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/';
	if(!preg_match($pattern,$field_list[$field_name])) {
		$errors[$field_name] = "Please enter a valid date";
	}
}

//Validate Email, where email has to have Address@hotmail.com type of syntax
function validateEmail(&$errors, $field_list, $field_name) {
	if(!preg_match('/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{1,})+$/',$field_list[$field_name])) { // user didn't enter valid email address
		$errors[$field_name] = "Please enter a valid email address";
	}
}

//Validate Gender, One radio button has to be chosen
function validateGender(&$errors, $field_list, $field_name) {
	if (!isset($field_list[$field_name])) {
		$errors[$field_name] = "Please choose a Gender";
	}
}

//Validate Wifi Devices where minimum input number is 1 or more
function validateDevices(&$errors, $field_list, $field_name){
	if(!isset($field_list[$field_name])|| empty($field_list[$field_name])) {
		$errors[$field_name] = 'Please enter a number bigger than zero';
	} else if (!$field_list[$field_name] > 0) {
		$errors[$field_name] = 'Have to have at least one device';
	}
}

//Input fields for form in php
function input_field($errors, $name, $type, $placeholder, $label) {
	echo '<div class="required_field">';
	echo '<p>'.$label.'</p>';
	$value = posted_value($name);
	echo "<input type=\"$type\" id=\"$name\" name=\"$name\" value=\"$value\" placeholder=\"$placeholder\" size=30 />";
	echo '<br/>';
	errorLabel($errors, $name);
	echo '</div>';
}

//To repost data if values are wrong on form
function posted_value($name) {
	if(isset($_POST[$name]))
		return htmlspecialchars($_POST[$name]);
}

//The error label if errors are found with in a field
function errorLabel($errors, $name) {
	echo '<span id="' . $name .'Error" class="error">';
	if (isset($errors[$name]))
		echo $errors[$name];
		echo '</span>';
}

//Field Input for radio buttons
function input_radio_button($errors, $name, $type, $value1, $value2, $value3, $label) {
	echo '<div class="required_field">';
	echo '<p>'.$label.'</p>';
	echo "<input type=\"$type\" name=\"$name\" value=\"$value1\" >";
	echo "$value1";
	echo "<input type=\"$type\" name=\"$name\" value=\"$value2\" >";
	echo "$value2";
	echo "<input type=\"$type\" name=\"$name\" value=\"$value3\" >";
	echo "$value3";
	echo '<br>';
	errorLabel($errors, $name);
	echo '</div>';
}
?>