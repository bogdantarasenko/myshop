<?php


$this->breadcrumbs=array(
	'Products'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'просмотр товаров', 'url'=>array('index')),
	array('label'=>'редактирование товаров', 'url'=>array('admin')),
);
?>

<h1>Create Product</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>