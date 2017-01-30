<?php 
class Members_model{
	
	public static function CheckUserExist( $email , $name){
		$db     = Db::getConnection();		
        $sql    = 'SELECT * FROM Members WHERE Email = :email AND Name = :name ';
        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_INT);
        $result->bindParam(':name', $name, PDO::PARAM_INT);
        $result->execute();

        $member = $result->fetch();
        if ($member) {
            return $member['ID'];
        }
		
	}
	public function SaveMember( $name ,$email , $schoolID  ){
		$db  = Db::getConnection();		
		$sql = 'INSERT INTO `Members` (`Name`, `Email`) '
						. 'VALUES (:name, :email )';

        $result = $db->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);		
		$result->execute();
		$id   = $db->lastInsertId();
		
		$rs = self::saveRelationship($id ,  $schoolID );
		
		return $id; 
          	
	}
	public function checkRelationship($memberID , $schoolID ){
		$db  = Db::getConnection();		
		
		$sql = 'SELECT * 
				FROM Meta
				WHERE Meta.MemeberId = :memberID AND  Meta.SchoolID = :schoolID';
				
		$result = $db->prepare($sql);
        $result->bindParam(':memberID', $memberID, PDO::PARAM_STR);
        $result->bindParam(':schoolID', $schoolID, PDO::PARAM_STR);		
		$result->execute();
        $members = $result->fetch();
        if($members){
			return true;
		}
		return false;
	}
	public function saveRelationship($memberID , $schoolID ){
		$db  = Db::getConnection();		
		
		
		$sql2 = 'INSERT INTO `Meta` (`MemeberId`, `SchoolID`) '
						. 'VALUES (:memberId, :SchoolID )';

        $result2 = $db->prepare($sql2);
        $result2->bindParam(':memberId', $memberID, PDO::PARAM_STR);
        $result2->bindParam(':SchoolID', $schoolID, PDO::PARAM_STR);		
		
		return $result2->execute();
	} 
}