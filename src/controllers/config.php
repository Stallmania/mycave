<?php
function ScriptingTesting($string){
    return trim(htmlentities($string, ENT_QUOTES));
}

function validatingNomberOfChar(string $feild, int $NbOfCharAutorized = 50){
	if (strlen($feild) > $NbOfCharAutorized) {
		return false;
	}
}

function validatingEmail($email){
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function validatingPhone($phone){
	$valid_number = filter_var($phone, FILTER_SANITIZE_NUMBER_INT);
	$valid_number = str_replace("-", "", $valid_number);
	if (strlen($valid_number) < 10 || strlen($valid_number) > 14) {
		return false;
	}else {
		return $valid_number;
	}
}


function validatingPassWord($password){
	$pattern = '/^(?=.*\d+)(?=.*\W+)(?=.*[A-Z]+)(?=.*[a-z]+)[a-zA-Z\d\W]{8,}$/';
	return (preg_match($pattern, $password));
}

function validatingBottelYear($year){
	$year = (int) $year;
	if ((!is_integer($year)) || ($year<1900) || (($year>(int)date('Y')-1))) {
		return false;
	}
}

function validatingImageSize($picture){
	define('MB', 1048576);// 1 megabyte
	if($picture['size'] > MB or $picture['error'] === UPLOAD_ERR_INI_SIZE or $picture['error'] === UPLOAD_ERR_FORM_SIZE) {
        return false;
    }
}
function validatingImageExtension($picture){
	$ext = ['png', 'jpg', 'jpeg', 'gif'];
	if(!in_array(pathinfo($picture['name'],PATHINFO_EXTENSION), $ext)) {
        return false;
	}
}
function validatingImageUpload($picture){
	if($picture['error'] === UPLOAD_ERR_PARTIAL || $picture['error'] > UPLOAD_ERR_NO_FILE) {
		return false;
	}
}
?>