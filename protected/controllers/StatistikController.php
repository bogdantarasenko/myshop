<?php


class StatistikController extends Controller
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
		$fisrt_day_of_month = date("Y-m-01");
		$last_day_of_month = date("Y-m-30");
		$connection = new CDbConnection("mysql:host=localhost;dbname=shop","mysql","mysql");
		$sql = "SELECT COUNT(*),`productid` FROM `order`   WHERE `time` BETWEEN STR_TO_DATE('$fisrt_day_of_month', '%Y-%m-%d')  AND STR_TO_DATE('$last_day_of_month', '%Y-%m-%d') GROUP BY `productid`";
		$command = $connection->createCommand($sql);
		$order = $command->queryAll();
		$sql2 = "SELECT * FROM `product`";
		$command2 = $connection->createCommand($sql2);
		$products = $command2->queryAll();
// BETWEEN "2008.11.01"  AND  "2009.10.12"
		$this->render('index',['orders'=>$order,'products'=>$products]);
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