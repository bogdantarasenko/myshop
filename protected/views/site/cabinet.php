<?php


$this->pageTitle=Yii::app()->name . 'Ваш кабинет';

?>

<h1><?echo $user['name']." &nbsp; ".$user['surname'];?></h1>

<p>
ваш профиль
</p>
<?php
//print_r($user);
//foreach ($user as $value) {
//	echo $value."<br>";
//}
	if(Yii::app()->user->id == "admin"){
		$this->redirect(array("Product/index"));
	}else{
	foreach ($user as $key => $value) {
		echo $key.": &nbsp;".$value."<br>";
	}
}
echo "<br><br><hr>";
//print_r($orders);
echo "Ваши покупки:<br><br>";


//var_dump($orders);
if(!empty($orders)){
	foreach ($orders as $key) {
		foreach($key as $k => $v){
			echo $v["book_name"]."<br>".$v["author"]."<br><img src='/img/".$v['img_path']."' width='20%' height='20%'><br>".$v["price"]."<br>".$v[""]."<br><hr><br>";
		
		}
	}
}else{
	echo "у вас еще нет заказов";
}
//print_r($orders);
//echo "count=".count($orders);


?>
