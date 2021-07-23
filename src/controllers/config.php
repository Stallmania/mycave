<?php
// escape xss scripts
function ScriptingTesting($string)
{
	return trim(htmlspecialchars($string, ENT_QUOTES));
}

//validate number of chars // return true de préference
function validatingNomberOfChar(string $feild, int $NbOfCharAutorized = 50)
{
	if (strlen($feild) > $NbOfCharAutorized) {
		return false;
	}
}


// validate Email
function validatingEmail($email)
{
	return filter_var($email, FILTER_VALIDATE_EMAIL);
}


//validate phone
function validatingPhone($phone)
{
	$valid_number = filter_var($phone, FILTER_SANITIZE_NUMBER_INT);
	$valid_number = str_replace("-", "", $valid_number);
	if (strlen($valid_number) < 10 || strlen($valid_number) > 14) {
		return false;
	} else {
		return $valid_number;
	}
}

//validate password must be with Capital letter , one integer and a special caracters
function validatingPassWord($password)
{
	$pattern = '/^(?=.*\d+)(?=.*\W+)(?=.*[A-Z]+)(?=.*[a-z]+)[a-zA-Z\d\W]{8,}$/';
	return (preg_match($pattern, $password));
}

//validate year
function validatingBottelYear($year)
{
	$year = (int) $year;
	if ((!is_integer($year)) || ($year < 1900) || (($year > (int)date('Y') - 1))) {
		return false;
	}
}

//validate image size
function validatingImageSize($picture)
{
	define('MB', 1048576); // 1 megabyte
	if ($picture['size'] > MB or $picture['error'] === UPLOAD_ERR_INI_SIZE or $picture['error'] === UPLOAD_ERR_FORM_SIZE) {
		return false;
	}
}

//validate extension of image
function validatingImageExtension($picture)
{
	$ext = ['png', 'jpg', 'jpeg', 'gif'];
	if (!in_array(strtolower(pathinfo($picture['name'], PATHINFO_EXTENSION)), $ext)) {
		return false;
	}
}

//validate upload image
function validatingImageUpload($picture)
{
	if ($picture['error'] === UPLOAD_ERR_PARTIAL || $picture['error'] > UPLOAD_ERR_NO_FILE) {
		return false;
	}
}
