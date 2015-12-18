<?php


class SiteController extends Controller
{
	


	public function actions()
	{
		return array(
			
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	
	public function actionIndex()
	{
	
		
		//Yii::app()->session['key1'] = "value1";
		//$product = Product::model()->findAll();

		$connection=new CDbConnection("mysql:host=127.0.0.1;dbname=shop","mysql","mysql");
			$sql = "SELECT * FROM `product`";
		$command = $connection->createCommand($sql);
		$product = $command->queryAll();

		$this->render('index',array('product'=>$product));
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

//-------------------------------
	public function actionCabinet()
	{	
		$pk = Yii::app()->user->id;
		$user = Users::model()->findByPk($pk);
		$orders = self::getProducts($pk);
		
		$this->render('cabinet',array('user'=>$user,'orders'=>$orders));
	}

	public function actionshowCart(){

		$orders = self::getProductsById();

		$this->render('cart',array('orders'=>$orders));
	}

	public function getProducts($pk,$order_id = null){

		$connection=new CDbConnection("mysql:host=127.0.0.1;dbname=shop","mysql","mysql");
		if($order_id != null){
			$sql = "SELECT * FROM `order` WHERE id='$order_id' ";
		}else{
			$sql = "SELECT * FROM `order` WHERE userid='$pk' ORDER BY id DESC";
		}
		
		$command = $connection->createCommand($sql);
		$orders = $command->queryAll();
		//return self::processData($orders);
		$products = array();
		if($orders != null){
			foreach($orders as $key => $value){
					$arr[] = $value['productid'];
			}
			
			foreach($arr as $k => $v){
				$newarr = explode(",",$v);
				foreach($newarr as $k2 => $v2){
					$sql = "SELECT * FROM `product` WHERE id='$v2'";
					$command = $connection->createCommand($sql);
					$products[] = $command->queryAll();
				}
			}
		}
		return $products;

	}
	public function getProductsById(){
		$connection=new CDbConnection("mysql:host=127.0.0.1;dbname=shop","mysql","mysql");
		$orders = Yii::app()->session['product'];
		if(count($orders)>1){
			foreach($orders as $key => $value){
				$arr[] = $value['id'];
			}

			$products = array();
			foreach($arr as $k => $v){
				//$newarr = explode(",",$v);
				//foreach($newarr as $k2 => $v2){
					$v2 = $v;
					$sql = "SELECT * FROM `product` WHERE id='$v2'";
					$command = $connection->createCommand($sql);
					$products[] = $command->queryAll();
				//}
			}
		}else if(count($orders) == 1){
			$v2 = $orders[0]['id'];
			$sql = "SELECT * FROM `product` WHERE id='$v2'";
			$command = $connection->createCommand($sql);
			$products[] = $command->queryAll();
		}
		
		return $products;
	}

	
	/*public function processData($orders){

	}*/
//------------------------------------------
//sorting
//------------------------------------------
public function actionsortDateByIncrease(){
	$connection=new CDbConnection("mysql:host=127.0.0.1;dbname=shop","mysql","mysql");
	$sql = "SELECT * FROM `product` ORDER BY `date_of_write` ASC";
	$command = $connection->createCommand($sql);
	$product = $command->queryAll();

	$this->render('index',array('product'=>$product));
}
public function actionsortDateByDecrease(){
	$connection=new CDbConnection("mysql:host=127.0.0.1;dbname=shop","mysql","mysql");
	$sql = "SELECT * FROM `product` ORDER BY `date_of_write` DESC";
	$command = $connection->createCommand($sql);
	$product = $command->queryAll();

	$this->render('index',array('product'=>$product));
}
public function actionsortPriceByIncrease(){
	$connection=new CDbConnection("mysql:host=127.0.0.1;dbname=shop","mysql","mysql");
	$sql = "SELECT * FROM `product` ORDER BY price ASC";
	$command = $connection->createCommand($sql);
	$product = $command->queryAll();

	$this->render('index',array('product'=>$product));
}
public function actionsortPriceByDecrease(){
	$connection=new CDbConnection("mysql:host=127.0.0.1;dbname=shop","mysql","mysql");
	$sql = "SELECT * FROM `product` ORDER BY price DESC";
	$command = $connection->createCommand($sql);
	$product = $command->queryAll();

	$this->render('index',array('product'=>$product));
}

public function actionsearch(){
	if(isset($_POST['search'])){
		$search = $_POST['search'];
		$connection=new CDbConnection("mysql:host=127.0.0.1;dbname=shop","mysql","mysql");
		$sql = "SELECT * FROM `product` WHERE book_name = '$search'";
		$command = $connection->createCommand($sql);
		$product = $command->queryAll();
	}

	$this->render('index',array('product'=>$product));
}

	
}