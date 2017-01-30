<?php

class Site_model{
	public function checkEmail(  $field ){
		$errors = false; 
		if (!filter_var($field, FILTER_VALIDATE_EMAIL)) {
				$errors['Email'] = 'Please insert a valid email';	
			}
		return $errors;	
	}
	public function checkName( $field ){
		$errors = false; 
			if (strlen($field) <=3 ) {
				$errors['SchoolName'] = 'The field "Name" must contain must then 4 characters';	
			}
		return $errors;	
	}
	public static function test_input($data) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
		return $data;
	}
    

}