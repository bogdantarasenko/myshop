<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/styles.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>

	<?php Yii::app()->bootstrap->register(); ?>
</head>

<body>

<?php $this->widget('bootstrap.widgets.TbNavbar',array(
    'items'=>array(
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'items'=>array(
				array('label'=>'Главная', 'url'=>array('/site/index')),
				array('label'=>'Профиль', 'url'=>array('/site/Cabinet'), 'view'=>'Cabinet','visible'=>!Yii::app()->user->isGuest&&Yii::app()->user->id != 'admin'),
				array('label'=>'Корзина', 'url'=>array('/site/showCart'), 'view'=>'cart','visible'=>!Yii::app()->user->isGuest&&Yii::app()->user->id != 'admin'),
				array('label'=>'Выйти', 'url'=>array('/auth/Logout'),'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'Админ', 'url'=>array('/product/index'), 'visible'=>Yii::app()->user->id == 'admin'),
				array('label'=>'Авторизация', 'url'=>array('/auth/Authorize'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Регистрация', 'url'=>array('/auth/Registration'), 'visible'=>Yii::app()->user->isGuest),
				//array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
			),
        ),
    ),
)); ?>


<div class="container" id="page">

	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer" class="shop-author">
		
		<?php// echo "Bogdan Tarasenko"; ?>
	</div><!-- footer -->
	<style>
	.shop-author{
		color:blue;
		margin-left:200px;
    margin-right:auto; /* браузер вычислит оставщуюся ширину этого поля исходя из других значений  */
    width:960px
	}
	</style>
</div><!-- page -->

</body>
</html>
