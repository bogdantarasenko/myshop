<?php


class ProductController extends Controller
{
	
	public $layout='//layouts/column2';


	
	public function filters()
	{
		return array(
			'accessControl', 
			'postOnly + delete', 
		);
	}
 
	
	 
	public function accessRules()
	{
		return array(
			array('allow',  
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', 
				'actions'=>array('create','update','AddToCart','ClearCart','ConfirmPurchase','ViewAllOrders','viewOrder'),
				'users'=>array('@'),
			),
			array('allow',
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			/*
			array('deny',  // deny all users
				'users'=>array('*'),
			),*/
		);
	}

	
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	
	public function actionCreate()
	{
		$model=new Product;

	

		if(isset($_POST['Product']))
		{
			$model->attributes=$_POST['Product'];
			$model->img_path=CUploadedFile::getInstance($model,'img_path');
			if($model->save())
				$path=Yii::getPathOfAlias('webroot').'/img/'.$model->img_path->getName();
                $model->img_path->saveAs($path);

				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
//-------------------------------------------------
//My shoping cart
//-------------------------------------------------
	

	public function actionAddToCart($id,$price){
		
		$session = Yii::app()->session['product'] ;
		$time = time();
		$product = array('id'=>$id,'time'=>$time,'price'=>$price);
		//array_push($session, $product);
		$session[] = $product;
		Yii::app()->session['product'] = $session;
		$this->redirect(array('site/showCart'));
	}
	public function actionClearCart(){
		unset(Yii::app()->session['product']);
		$this->redirect(array('site/showCart'));
	}

	public function actionConfirmPurchase(){
		$products = self::getProductIds();
		$userid = Yii::app()->user->id;
		$time = date("Y-m-d H:i:s");
		$price = self::countCheck();
		//$connection=Yii::app()->db;ViewAllOrders
		$confirmed = false;
		
		$connection=new CDbConnection("mysql:host=127.0.0.1;dbname=shop","mysql","mysql");
		if(isset($_POST['adress']) && !empty($_POST['adress'])){
			$adress = $_POST['adress'];
			$sql = "INSERT INTO `order` (userid,productid,time,price,adress,confirmed) VALUES('$userid','$products','$time','$price','$adress','$confirmed')";
		}else{
			$sql = "INSERT INTO `order` (userid,productid,time,price,confirmed) VALUES('$userid','$products','$time','$price','$confirmed')";
		}

		$command = $connection->createCommand($sql);
		/*$command->bindParam(":userid",$user_id,PDO::PARAM_STR);
		$command->bindParam(":products",$products,PDO::PARAM_STR);
		$command->bindParam(":time",$time,PDO::PARAM_STR);*/
		$res = $command->execute();
		self::actionClearCart();
		$this->redirect(array('site/Cabinet'));
	}
	

	private function getProductIds(){
		$orders = Yii::app()->session['product'];
		$arr = array();
		if(count($orders)>1){
			foreach($orders as $key){
				$arr[] = $key['id'];
			}
			$products = implode(",",$arr);
		}else if(count($orders) == 1){
			$products = $orders[0]['id'];
		}
		return $products;
	}
	private function countCheck(){
		$orders = Yii::app()->session['product'];
		if(count($orders)>1){
			foreach($orders as $key){
				$check += $key['price'];
			}
		}else{
			$check += $orders[0]['price'];
		}
		return $check;
	}
//------------------------------------
	public function actionViewAllOrders(){
		$connection=new CDbConnection("mysql:host=127.0.0.1;dbname=shop","mysql","mysql");
		$sql = "SELECT * FROM `order`";
		$command = $connection->createCommand($sql);
		$orders = $command->queryAll();
		//return self::processData($orders);

		$this->render('viewallorders',array('orders'=>$orders)); 
	}

	public function actionViewOrder($id,$userid,$adress){
		
		$order = self::getProducts($id);
		$user = self::getUser($userid);
		$this->render('vieworder',array('order'=>$order,'user'=>$user,'adress'=>$adress));
	}
	
	public function getProducts($id){

		$connection=new CDbConnection("mysql:host=127.0.0.1;dbname=shop","mysql","mysql");
	
		$sql = "SELECT * FROM `order` WHERE id='$id'";
		
		$command = $connection->createCommand($sql);
		$orders = $command->queryAll();

		foreach($orders as $key => $value){ 
			$arr[] = $value['productid'];
		}
		
		$newarr = explode(",",$arr[0]);
	
		$products = array();
		
		foreach($newarr as $k2 => $v2){
			$sql = "SELECT * FROM `product` WHERE id='$v2'";
			$command = $connection->createCommand($sql);
			$products[] = $command->queryAll();
		}
		return $products;

	}
	
	public function getUser($userid){
		$connection=new CDbConnection("mysql:host=127.0.0.1;dbname=shop","mysql","mysql");
	
		$sql = "SELECT * FROM `users` WHERE id='$userid'";
		
		$command = $connection->createCommand($sql);
		$user = $command->queryAll();
		
		return $user;
	}
	
	public function actionСonfirmOrder($id){
		$connection=new CDbConnection("mysql:host=127.0.0.1;dbname=shop","mysql","mysql");
	
		$sql = "UPDATE `order` SET confirmed=TRUE WHERE id='$id'";
		
		$command = $connection->createCommand($sql);
		$orders = $command->execute();
		
		$this->redirect(array('product/ViewAllOrders'));
	}
	
	public function actionShowConfirmed(){
		$connection=new CDbConnection("mysql:host=127.0.0.1;dbname=shop","mysql","mysql");
	
		$sql = "SELECT * FROM `order` WHERE confirmed=1 ";
		
		$command = $connection->createCommand($sql);
		$orders = $command->queryAll();
		
		$this->render('viewallorders',array('orders'=>$orders));
	}
	
	public function actionShowUnConfirmed(){
		$connection=new CDbConnection("mysql:host=127.0.0.1;dbname=shop","mysql","mysql");
	
		$sql = "SELECT * FROM `order` WHERE confirmed=0 ";
		
		$command = $connection->createCommand($sql);
		$orders = $command->queryAll();
		
		$this->render('viewallorders',array('orders'=>$orders));
	}
	
	
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		if(isset($_POST['Product']))
		{
			$model->attributes=$_POST['Product'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}


	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Product');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	
	public function actionAdmin()
	{
		$model=new Product('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Product']))
			$model->attributes=$_GET['Product'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	
	public function loadModel($id)
	{
		$model=Product::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='product-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}
}
