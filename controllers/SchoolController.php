<?php
include_once ROOT . '/models/School_model.php';
include_once ROOT . '/models/Site_model.php';

class SchoolController{
	
	
	public function actionInit(){
		$finalResult = false;
		require_once(ROOT . '/views/school/add_school.php');
		return true;
	
	}
	public function getScloolsList(){
		
		$schools = new School_model();
		$schoolList = $schools->getSchoolsList(); 
		
		return $schoolList;
	}
	
	public function actionGetMembersById($param){
			
			$schoolModel = new School_model();
			$members =	$schoolModel->getSchoolMembers($param);
			$SchoolName = $schoolModel->GetSchoolName($param ); 
				
			require_once(ROOT . '/views/school/school-members.php');
		return true;
	}
	public function actionSave_school(){
			$succes = $finalResult = false;
			
			if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btnSubmit'])) {
			
				$result = new Site_model();
				
				$SchoolName = isset($_POST['school_name']) ? $result->test_input($_POST['school_name']) : '' ;
				$errors = $result->checkName( $SchoolName );
				$schoolModel = new School_model();
				$SchoolExit = $schoolModel->checkSchoolExist( $SchoolName );
				
				if($errors == false && $SchoolExit === false ){
					$succes = true;
					$finalResult = $schoolModel->SaveSchool( $SchoolName );	
				}elseif($SchoolExit =! false ){
					$errors[] = 'This school already exist';
				}
				
			}	
			
		require_once(ROOT . '/views/school/add_school.php');
		return true;
	}
}