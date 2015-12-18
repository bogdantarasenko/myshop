<?

//print_r($user);
//var_dump($order);
echo "<p><strong>Пользователь</strong></p>";
echo $user[0]['name']."&nbsp;".$user[0]['surname']."<br>email:&nbsp;".$user[0]['email']."<br>номер телефона:&nbsp;".$user[0]['telephone']."<br><br>";
echo "<p><strong>заказал</strong></p>";
foreach ($order as $key) {
	foreach($key as $k => $v){
		echo "название:".$v["book_name"]."<br>автор:".$v["author"]."<br><img src='/img/".$v['img_path']."' width='20%' height='20%'><br>цена:".$v["price"]."<br>".$v["time"]."<br><hr><br>";
	
	}
}
echo "адрес/отделение почты:".$adress;

?>