<!--

	Я здесь собрал php,js,css,html в одной куче чтобы вам было удобно понять логику и не прыгать по файлам

	Логика диаграммы такова 10 заказаных книг это 100% так как 10 купленных книг это по моему очень много

	соответственно 1 книга == 10%

	как то так)
 
-->
<!DOCTYPE html>
<html>
 <head>
  <meta charset="utf-8">
   <title>Статистика</title>
	
 </head>
 <body>
     <h3>Статистика книг проданных в этом месяце</h3>
	<ul>
<?
	 for($i = 0;$i<count($orders);$i++){
	 	for($j=0;$j<count($products);$j++){
	 		if($products[$j]['id'] == $orders[$i]['productid']){
	 			$procent = 10*$orders[$i]['COUNT(*)']."%";
	 			echo "<li><a><em>".$orders[$i]['COUNT(*)']."</em>".$products[$j]['book_name']."</a><span>$procent</span></li>";
	 		}	
	 	}
	 }
?>

    </ul>
 </body>
</html>

<style>
h3 {
 padding:30px;
 padding-bottom: 25px;
}
    
li {
 position: relative;
 margin: 0 0 2px 0;
 list-style-type:none;
}
a {
 position: relative;
 display: block;
 padding: 7px;
 z-index:2; 
}
em {
 float: right;
 font-style: normal;
 font-weight: normal;
 color: #9c836e;
}
span{
 position:absolute;
 top:0;
 left:0;
 display:block;
 height:100%;
 text-indent:-9999px;
 background: #f3f2e8;
}
li:hover span{
  background:#ecebe1;
}

</style>

<script type="text/javascript">
	$(function(){
		var span = $('span');
		var procent = $('span').text();
		procent = procent.split('%');
		procent.pop();

		//console.log(procent);

		for(var i=0;i<span.length;i++){
			var spanelem = span[i];
			move(spanelem,procent[i]);
		}
	});
	function move(spanelem,procent){ 
	   var pixwidth=0;  
	   function frame(){ 
	      pixwidth=pixwidth+1;
		  spanelem.style.width=pixwidth+'%';
	      if(pixwidth==procent){
	         clearInterval(timer); 
	      }
	   }
	   var timer=setInterval(frame,30); 
}
</script>
