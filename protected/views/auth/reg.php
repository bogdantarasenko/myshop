
<div class="form">

<?php echo CHtml::beginForm();?>

<?php echo CHtml::errorSummary($model);?>

<div class="row">
<?php echo Chtml::activeLabel($model,'name');?>
<?php echo Chtml::activeTextField($model,'name');?>
</div>

<div class="row">
<?php echo Chtml::activeLabel($model,'surname');?>
<?php echo Chtml::activeTextField($model,'surname');?>
</div>

<div class="row">
<?php echo Chtml::activeLabel($model,'login');?>
<?php echo Chtml::activeTextField($model,'login');?>
</div>

<div class="row">
<?php echo Chtml::activeLabel($model,'password');?>
<?php echo Chtml::activePasswordField($model,'password');?>
</div>

<div class="row">
<?php echo Chtml::activeLabel($model,'email');?>
<?php echo Chtml::activeTextField($model,'email');?>
</div>

<div class="row">
<?php echo Chtml::activeLabel($model,'telephone');?>
<?php echo Chtml::activeTextField($model,'telephone');?>
</div>

<div class="row submit">
<?php echo CHtml::submitButton('register'); ?>
</div>

<?php echo CHtml::endForm(); ?>
</div><!-- form -->

</div>