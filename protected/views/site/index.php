<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<?php 
function cut_content($string){

      $t = explode(" ",$string);
      for($j = 0;$j<35;$j++){
          $arr[$j] = $t[$j];
      }
      $text = implode(" ", $arr);
      return $text;
      //unset($arr);
}

?>


<ul class="nav nav-tabs">
  <li class="dropdown">
    <a class="dropdown-toggle"
       data-toggle="dropdown"
       href="#">
        По дате
        <b class="caret"></b>
      </a>
    <ul class="dropdown-menu">
      <li><a href="<?echo Yii::app()->createUrl('site/sortDateByIncrease');?>">по возрастанию</a></li>
      <li><a href="<?echo Yii::app()->createUrl('site/sortDateByDecrease');?>">по убыванию</a></li>
    </ul>
     <li class="dropdown">
    <a class="dropdown-toggle"
       data-toggle="dropdown"
       href="#">
        По цене
        <b class="caret"></b>
      </a>
    <ul class="dropdown-menu">
      <li><a href="<?echo Yii::app()->createUrl('site/sortPriceByIncrease');?>">по возрастанию</a></li>
      <li><a href="<?echo Yii::app()->createUrl('site/sortPriceByDecrease');?>">по убыванию</a></li>
    </ul>
    
    


</ul>
</div>

<form class="form-search" method='POST' action="<?echo Yii::app()->createUrl('site/search');?>">
  	<input type="text" class="input-medium search-query" name="search">
  	<button type="submit" class="btn">Найти</button>
</form>

<?
echo "<ul class='thumbnails'>";
foreach($product as $v){
echo "<li class='span4'>";
echo  "<div class='thumbnail'>";
echo  "<img src='/img/".$v['img_path']."'width='60%' height='80%'>";
echo  "<h3><i><strong>название:</strong></i> &nbsp;".$v['book_name']."</h3>";
echo  "<p><i>цена:</i> &nbsp;".$v['price']."</p>";
echo  "<p><i>дата написания:</i> &nbsp;".$v['date_of_write']."</p>";
echo  "<p>".cut_content($v['description'])."</p>
       <br><a href='".Yii::app()->createUrl('Product/View',array('id'=>$v['id']))."'><button type='button' class='btn btn-default' position='right'>подробнее</button></a><br>
      </div></li>";


}
echo "</ul>";
?>


  
