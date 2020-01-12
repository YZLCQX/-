<?php //2020.1.6 ?>
<?php
//存放函数
//生成cookie		2020.1.3
function genaret($user)
	{
		return sha1($user.microtime());	//用户名跟毫秒时间戳哈希
	}
?>

<?php
//判断cookie是否过期
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