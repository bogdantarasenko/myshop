<?php


$this->breadcrumbs=array(
	'Products'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Показать все товары', 'url'=>array('index')),
	array('label'=>'Добавить товар', 'url'=>array('create')),
	array('label'=>'Показать товар', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Редактировать товар', 'url'=>array('admin')),
);
?>

<h1>Update Product <?php echo $model->id; ?></h1>

<?php $this->renderPartial('form_update', array('model'=>$model)); ?>