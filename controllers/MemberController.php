<?php 
include_once ROOT . '/models/School_model.php';
include_once ROOT . '/models/Site_model.php';
include_once ROOT . '/models/Members_model.php';

class MemberController {
	
	
	public function actionInit(){
	
		$schools = new School_model();
		$schoolList = $schools->getSchoolsList(); 
		
		require_once(ROOT . '/views/member/member.php');
		return true;
	}

	
	public function actionSave(){
		$nameError = false;	
		$emailError = false;
		
		$schools = new School_model();
		$schoolList = $schools->getSchoolsList(); 
		$message = array();
		
		if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['saveMember'])) {
			$site     = new Site_model();
			
			$name     = isset($_POST['member_name']) ? $site->test_input($_POST['member_name']) : '';
			$email    = isset($_POST['member_email']) ? $site->test_input($_POST['member_email']) : '';
			$schoolID = isset($_POST['school_name']) ? $_POST['school_name'] : '';
			
			$nameError  = $site->checkName(  $name );
			$emailError = $site->checkEmail(  $email );
			if ($nameError == false && $emailError == false){
				$Member_model = new Members_model();
				$MemberExist = $Member_model->CheckUserExist($email , $name); // get user's id if exists 
				if ($MemberExist === NULL){
					$ID = $Member_model->SaveMember($name ,$email , $schoolID );
					$message[] = 'the new member was successfully added!';
				}else{
					$relationship = $Member_model->checkRelationship($MemberExist , $schoolID);	//  check if exist relationship
					if($relationship === false){
						$Member_model->saveRelationship($MemberExist ,  $schoolID );		
						$message[] = 'A new school for this member was saved!';
					}else{
						$message[] = 'This member with this school already exist!';
					}						
				}
			}
		}
		require_once(ROOT . '/views/member/member.php');
		return true;
	}
	
	
}