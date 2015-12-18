<ul class="nav nav-tabs">
	
	<li class="dropdown">
    <a class="dropdown-toggle"
       data-toggle="dropdown"
       href="#">
        статус заказа
        <b class="caret"></b>
      </a>
    <ul class="dropdown-menu">
      <li><a href="<?echo Yii::app()->createUrl('product/ShowConfirmed');?>">подтвержденные</a></li>
		  <li><a href="<?echo Yii::app()->createUrl('product/ShowUnConfirmed');?>">неподтвержденные</a></li>
    </ul>
</ul>

</ul>
</div>
<?
//print_r($orders);
if(count($orders) != 0){
	foreach ($orders as $key => $v) {
		//foreach($key as $k => $v){
			$id = $v["user_id"];
			echo "id заказа".$v["id"]."<br>id пользователя".$v["userid"]."<br> адрес доставки ".$v["adress"]."<br> цена ".$v["price"]."<br> время заказа".$v["time"]."<br>статус&nbsp;:&nbsp;".$v["confirmed"]."&nbsp;<a href='".Yii::app()->createUrl('product/СonfirmOrder',array('id'=>$v["id"]))."'>подтвердить заказ</a>&nbsp;<br> <a href='".Yii::app()->createUrl('product/ViewOrder',array('id'=>$v["id"],'userid'=>$v["userid"],'adress'=>$v["adress"]))."'>подробнее</a><hr><br>";
			//echo $v;
		//}
		}
}else if(count($orders) == 0){
	echo "не подтвержденных заказов нет";
}else{
	echo "id заказа".$orders["id"]."<br>id пользователя".$orders["userid"]."<br> адрес доставки ".$orders["adress"]."<br> цена ".$orders["price"]."<br> время заказа".$orders["time"]."<br>статус&nbsp;:&nbsp;".$orders["confirmed"]."&nbsp;<a href='".Yii::app()->createUrl('product/СonfirmOrder',array('id'=>$orders["id"]))."'>подтвердить заказ</a>&nbsp;<br> <a href='".Yii::app()->createUrl('product/ViewOrder',array('id'=>$orders["id"],'userid'=>$orders["userid"],'adress'=>$orders["adress"]))."'>подробнее</a><hr><br>";

}


?>