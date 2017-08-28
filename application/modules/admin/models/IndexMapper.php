<?php
class Admin_Model_IndexMapper{	
	public function login($username,$password){            
		try{
			$db=$this->getDB();
			$select=$db->select();
			$select->from("user",array("*"))
			->where("username=?",$username,"STRING")                                
                        ->where("password=?",$password,"STRING");
                        
			$result=$db->fetchRow($select);
                        

		}
		catch (Exception $e){
		}

		if($result['id_user']==NULL){
			return false;
		}
		$auth = Zend_Auth::getInstance();
		if($auth->hasIdentity()){
                    $auth->clearIdentity();		
                }
			
		
		$result['user']='admin';
		
		$auth->getStorage()->write($result);
		return true;
	}
	public function changePassword($username,$newPassword,$table_name){
		$db=$this->getDB();
		$data=array();
		$data['password']=$newPassword;
		try{
			$where=$db->quoteInto('username=?', $username,'STRING');		
			$db->update($table_name,$data,$where);
			$auth = Zend_Auth::getInstance();
			$identity=$auth->getIdentity();
			$identity["password"]=$newPassword;
			$auth->clearIdentity();
			$auth->getStorage()->write($identity);
		}
		catch (Exception $e){
			return  false;
		}
		return true;
	}
	
	
	public function signup($username,$password,$firstName,$lastName,$middleName){
		$user=array();
		$user['username']=$username;
		$user['password']=$password;
		$user['first_name']=$firstName;
		$user['last_name']=$lastName;
		$user['middle_name']=$middleName;
		foreach ($user as $key => $value){
			if($value === '' || $value === null){
				unset($user[$key]);
			}
		}
		$db=$this->getDB();
		try{
			$db->insert('user',$user);
		}
		catch (Exception $e){
		}
	}
	public function sendEmailByIdhoso($email,$password,$firstName,$lastName,$middleName,$username)
	{
		require_once 'Zend/Mail.php';
		require_once 'Zend/Mail/Transport/Smtp.php';



		//var_dump($send_to_email); exit ;
		//SMTP server configuration
		$smtpHost = 'smtp.gmail.com';
		$smtpConf = array(
				'auth' => 'login',
				'ssl' => 'ssl',
				'port' => '465',
				'username' =>'chanhduypq@gmail.com',
				'password' => '826498meyeu'
		);
		$transport = new Zend_Mail_Transport_Smtp($smtpHost, $smtpConf);

		//Create email
		$mail = new Zend_Mail('UTF-8');
		$mail->setFrom('chanhduypq@gmail.com', 'Tony Caporicci');
		$mail->addTo($email, $firstName.' '.$middleName.' '.$lastName);
		$mail->setSubject('Hello '.$firstName.' '.$middleName.' '.$lastName.'!');
		$mail->setBodyText('Your password is '.$password);

			

		$sent = true;
		try {
			$mail->send($transport);

		}
		catch (Exception $e) {


			$sent = false;
		}

		return $sent;
	}

	private function getDB(){
		$db=Core_Db_Table::getDefaultAdapter();
		$db->setFetchMode(Zend_Db::FETCH_ASSOC);
		return $db;
	}




}