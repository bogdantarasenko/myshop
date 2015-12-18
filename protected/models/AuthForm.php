<?php



class AuthForm extends CFormModel{
	public $login;
	public $password;
	public $name;
	public $surname;
	public $email;
	public $telephone;

	private $_identity;

	public $_DBHOST = "localhost";
	public  $_DBPASS = "apogel41";
	public  $_DBUSER = "u749272293_bd";
	public  $_DBNAME = "shop";


	public function rules(){
		return array(
			array('login,password','required','on'=>'login,register'),
			array('name,surname,email,telephone','required','on'=>'register'),
			//array('password','authenticate','on'=>'login')
		);
	}

	/*public function authenticate($attribute,$params){
		if(!$this->hasErrors()){
			$this->_identity = new UserIdentity($this->login,$this->password);
			if(!$this->_identity->authenticate()){
				$this->addError('password','Incorect password');
			}
		}
	}*/

	public function auth()
	{	
		if($this->_identity === null){
			$this->_identity = new UserIdentity($this->login,$this->password);
			$this->_identity->authenticate();
		}
		if($this->_identity->errorCode===UserIdentity::ERROR_NONE){
			//$duration =  3600*24*30;
			if(Yii::app()->user->login($this->_identity,3600*24*7)){
				return true;
			}
			
		}else{
			return false;
		}
	}

	public function createUser(){
		$connection = new CDbConnection("mysql:host=$this->_DBHOST;dbname=$this->_DBNAME","$this->_DBUSER","$this->_DBPASS");
		$sql = "INSERT INTO users (name,surname,login,password,email,telephone) VALUES('$this->name','$this->surname','$this->login','$this->password','$this->email','$this->telephone')";
		$command = $connection->createCommand($sql);
		$command->execute();
	}


}

/*
		if($this->_identity===null)
		{
			$this->_identity=new UserIdentity($this->username,$this->password);
			$this->_identity->authenticate();
		}
		if($this->_identity->errorCode===UserIdentity::ERROR_NONE)
		{
			$duration=$this->rememberMe ? 3600*24*30 : 0; // 30 days
			Yii::app()->user->login($this->_identity,$duration);
			return true;
		}
		else
			return false;
		*/