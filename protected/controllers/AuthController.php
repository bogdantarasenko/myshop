<?php

class AuthController extends Controller{

	public function actionRegistration(){

		$model = new AuthForm('register');

		if(isset($_POST['AuthForm'])){
			$model->attributes = $_POST['AuthForm'];
			if($model->validate()){
				$model->createUser();
				$this->redirect(array('Auth/Authorize'));
			}
		}
		$this->render('reg',array('model'=>$model));
	}

	public function actionAuthorize(){

		$model = new AuthForm('login');

		if(isset($_POST['AuthForm'])){
			$model->attributes = $_POST['AuthForm'];
			
			if($model->auth() == true){
				if(Yii::app()->user->id == "admin"){
					$this->redirect(array("Product/index"));
				}else{
					$this->redirect(array("Site/index"));
					Yii::app()->session['id'] = "sessia";
				}
				//$this->redirect(Yii::app()->getHomeUrl());
				
			}

		}
		$this->render('auth',array('model'=>$model));
	}

	public function actionLogout(){
		Yii::app()->user->logout();
		$model = new AuthForm('login');
		$this->redirect(Yii::app()->getHomeUrl());
	}
}

	
