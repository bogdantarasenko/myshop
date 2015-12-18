<?php


$this->breadcrumbs=array(
	'Products'=>array('index'),
	$model->id,
);
if(Yii::app()->user->id == 'admin'){
	$this->menu=array(
	array('label'=>'Показать все товары', 'url'=>array('index')),
	array('label'=>'Добавить товар', 'url'=>array('create')),
	array('label'=>'Обновить информацию о товаре', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Удалить товар', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Редактировать товар', 'url'=>array('admin')),
	);
}

?>

<h1>View Product #<?php echo $model->id; ?></h1>

<?php //echo CHtml::encode($data->img_path); 
		echo "<img src='/img/".$model->img_path."'>";
		
?>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'book_name',
		'date_of_write',
		'author',
		'description',
		'img_path',
		'publisher',
		'date_of_publish',
		'price',
		'quantity',
	),
)); 
if(!Yii::app()->user->isGuest){
echo "<a href='".Yii::app()->createUrl('Product/AddToCart',array('id'=>$model->id,'price'=>$model->price))."'><button type='button' class='btn btn-default'>купить</button></a><br>";
}
?>

