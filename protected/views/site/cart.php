<?

$this->pageTitle=Yii::app()->name . 'User Shoping Cart';

?>

<h1>Shoping Cart</h1>


<?php
//$orders = Yii::app()->session['product'];


//echo Yii::app()->session['product'];
//print_r(Yii::app()->session['product']);
/*foreach (Yii::app()->session['product'] as $key) {
	print_r($key);
}*/
echo "<p>Товаров в корзине:&nbsp;".count($orders)."</p><hr><br>";
/*if(count($orders) == 1){
	foreach ($orders as $key) {
		foreach($key as $k => $v){
			echo $v["book_name"]."<br>".$v["author"]."<br><img src='/img/".$v['img_path']."' width='20%' height='20%'><br>".$v["price"]."<br>".$v[""]."<br><hr><br>";
		}
	}
}else if(count($orders) > 1){
	foreach ($orders as $key) {
		foreach($key as $k => $v){
			echo $v["book_name"]."<br>".$v["author"]."<br><img src='/img/".$v['img_path']."' width='20%' height='20%'><br>".$v["price"]."<br>".$v[""]."<br><hr><br>";
		}
	}
}else{
	echo "Корзина пуста";
}*/

if(count($orders) > 0){
	foreach ($orders as $key) {
		foreach($key as $k => $v){
			echo $v["book_name"]."<br>".$v["author"]."<br><img src='/img/".$v['img_path']."' width='20%' height='20%'><br>".$v["price"]."<br>".$v[""]."<br><hr><br>";
		}
	}
	echo "номер отделения новой почты<form class='form-search' method='POST' action=".Yii::app()->createUrl('Product/ConfirmPurchase').">
  	<input type='text' name='adress' class='input-medium search-query' name='search'>
  	 <br><br><button type='submit' class='btn btn-success'>подтвердить заказ</button>
	</form>";

}else{
	echo "Корзина пуста";
}


//print_r($arr);

//print_r($orders);
echo "<br><br><a href='".Yii::app()->createUrl('Product/ClearCart')."'><button type='button' class='btn btn-default'>очистить корзину</button></a>";
//echo "<br><br><a href='".Yii::app()->createUrl('Product/ConfirmPurchase')."'><button type='button' class='btn btn-success'>подтвердить заказ</button></a>";
?>
