<div class="form">

<?php echo CHtml::beginForm();?>

<?php echo CHtml::errorSummary($model);?>

<div class="row">
<?php echo Chtml::activeLabel($model,'login');?>
<?php echo Chtml::activeTextField($model,'login');?>
</div>

<div class="row">
<?php echo Chtml::activeLabel($model,'password');?>
<?php echo Chtml::activePasswordField($model,'password');?>
</div>

<div class="row submit">
<?php echo CHtml::submitButton('Войти'); ?>
</div>

<?php echo CHtml::endForm(); ?>
</div><!-- form -->
<?php// print_r(Yii::app()->user);?><br>
</div>
<?php if(Yii::app()->user->isGuest){
	echo "Guest";
}else{
	echo "Authorize";
}
//echo "<br>id=".Yii::app()->user->id;
?>