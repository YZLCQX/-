<?php
function cookie_if(){
	$dbc_sql = mysqli_connect('127.0.0.1', 'root', '', 'web_user_info_data', 3306) or header('Location:error.html');  //如果出错则重定向至错误页面

	$c = $_COOKIE['user_id'];

	$query = "SELECT time FROM web_cookie_table WHERE cookie = '$c'";

	$c = mysqli_query($dbc_sql, $query);
	$s = mysqli_fetch_array($c);	
	
	$z = pow(10,9);
	$w = 0;
	for ($i = 0; $i < 10; $i ++){
		$w = $w + $s[0][$i] * $z;
		$z = $z / 10;  
	}
	$w = $w - 1800;
	mysqli_close($dbc_sql);
	return time() > $w);
}
?>