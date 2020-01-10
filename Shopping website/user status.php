<?php //2020.1.3  ?>
<?php
	//判断用户是否登录
	$_index = 'index.php';	//重定向至主页的地址 

	if(isset($_COOKIE['user_id'])) // 判断用户是否登录
		{
			if(!cookie_if()){	//判断cookie是否过期
				header('Location:'.$_index);	//如果已经登录则重定向
				exit();
			}
			setcookie('user_id', '', time()-1);	//清除cookie
		}
	//如果没有登录则继续执行
?>

<?php
function cookie_if(){
	$dbc_sql = mysqli_connect('127.0.0.1', 'root', '', 'web_user_info_data', 3306) or header('Location:error.html');  //如果出错则重定向至错误页面

	$c = $_COOKIE['user_id'];

	//判断cookie是否无效
	$query = "SELECT cookie FROM web_cookie_table WHERE cookie = '$c'";
	$data = mysqli_query($dbc_sql, $query);

	if(mysqli_num_rows($data) == 0)	
		return 1;		//如果cookie无效

	$query = "SELECT time FROM web_cookie_table WHERE cookie = '$c'";

	$c = mysqli_query($dbc_sql, $query);
	$s = mysqli_fetch_array($c);	
	
	$z = pow(10,9);
	$w = 0;
	for ($i = 0; $i < 10; $i ++){
		$w = $w + $s[0][$i] * $z;
		$z = $z / 10;  
	}
	mysqli_close($dbc_sql);
	if((time() - 1800) > $w)
		return 1;
	return 0;
}
?>