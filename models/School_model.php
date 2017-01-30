<?php

class School_model {
		
		public function checkSchoolExist($name){
			
			$db = Db::getConnection();

			$sql = 'SELECT * 
					FROM Schools
					WHERE Name = :name';
			
			$result = $db->prepare($sql);
			$result->bindParam(':name', $name, PDO::PARAM_INT);
			
			$result->execute();
			return $result->fetch();
		}
		
		public static function SaveSchool( $SchoolName ){
			$db = Db::getConnection();

			$sql = 'INSERT INTO Schools (Name) '
                . 'VALUES (:name)';

			$result = $db->prepare($sql);
			$result->bindParam(':name', $SchoolName, PDO::PARAM_INT);
			
			return  $result->execute();
		}
		public static function getSchoolsList(){
			$db = Db::getConnection();
				
			$SchoolList = array();
			
			$result = $db->query('SELECT Id, Name '
					. 'FROM Schools '
					. 'ORDER BY Id ASC ');        

			$i = 0;
			while($row = $result->fetch()) {
				$SchoolList[$i]['id'] = $row['Id'];
				$SchoolList[$i]['Name'] = $row['Name'];
				$i++;
			}
			
			return $SchoolList;
			
		}
		public function getSchoolMembers($id){
			$db = Db::getConnection();
			$sql = 'SELECT Meta.MemeberId , Meta.SchoolID, Members.ID, Members.Name , Members.Email
					FROM `Meta`
					INNER JOIN Members
					on Meta.SchoolID = :ID 
					AND Members.ID = Meta.MemeberId';	
				
			$result = $db->prepare($sql);
			$result->bindParam(':ID', $id, PDO::PARAM_INT);
			$members = array();
		  	$result->execute();
			$i = 0;
			
			while($row = $result->fetch()) {
				$members[$i]['MemeberId'] = $row['MemeberId'];
				$members[$i]['Name'] = $row['Name'];
				$members[$i]['Email'] = $row['Email'];
				$i++;
			}
			return $members ;			
		}
		public function GetSchoolName ($id){
			$db = Db::getConnection();
			$sql = 'SELECT Schools.Name 
					FROM `Schools`
					WHERE Schools.Id = :id';	
				
			$result = $db->prepare($sql);
			$result->bindParam(':id', $id, PDO::PARAM_INT);
			 
		  	$result->execute();
			while($row = $result->fetch()) {
				$School = $row['Name'];
				
			}
			return $School;
		}
}