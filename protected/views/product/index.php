<?php


$this->breadcrumbs=array(
	'Products',
);

$this->menu=array(
	array('label'=>'Добавить товар', 'url'=>array('create')),
	array('label'=>'Просмотр всех товаров', 'url'=>array('admin')),
	array('label'=>'Просмотреть все заказы', 'url'=>array('ViewAllOrders')),
);
?>

<h1>Products</h1>

<?php $this->widget('bootstrap.widgets.TbListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
