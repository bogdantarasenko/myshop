<?php


class Users extends CActiveRecord
{
	
	public function tableName()
	{
		return 'users';
	}

	
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, surname, login, password, email, telephone', 'required'),
			array('password, telephone', 'numerical', 'integerOnly'=>true),
			array('name, surname, login, email', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, surname, login, password, email, telephone', 'safe', 'on'=>'search'),
		);
	}

	
	public function relations()
	{
		
		return array(
		);
	}

	
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'surname' => 'Surname',
			'login' => 'Login',
			'password' => 'Password',
			'email' => 'Email',
			'telephone' => 'Telephone',
		);
	}

	
	public function search()
	{


		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('surname',$this->surname,true);
		$criteria->compare('login',$this->login,true);
		$criteria->compare('password',$this->password);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('telephone',$this->telephone);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
