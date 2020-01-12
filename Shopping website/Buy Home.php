<?php //2020.1.11 ?>

<?php
	$dbc_sql = mysqli_connect('127.0.0.1', 'root', '', 'web_user_info_data', 3306) or header('Location:error.html');  //如果出错则重定向至错误页面
	
	if(!isset($GET['cdy']))
		{
			echo "<h1>URL错误</h1>";
			echo "请检查URL";
			exit(0);	
		}

	$cdy = $GET['cdy'];	//获取是什么商品

	$query = "SELECT * FROM  web_product_info_table WHERE name = '$cdy'";	//查询商品信息

	$data_cdy = mysqli_query($dbc_sql, $query);	

	if(mysqli_num_rows($data_cdy) == 0)
		{
			echo "<h1>URL错误</h1>";
			echo "请检查URL";
			exit(0);
		}
	//继续执行
?>

<?php 
	//购物页面
	require_once('Function library.php');	//判断cookie是否过期

	$log = 0;	//登录信息 为0则未登录 1为登录
	$user_name = ''; 	//用户名

	if(isset($_COOKIE['user_id'])) // 判断用户是否登录
		{
			if(!cookie_if())	//判断cookie是否过期
				{
					$log = 1;	//如果已经登录改变状态
					$c = $_COOKIE['user_id'];
					$query = "SELECT user_name FROM web_cookie_table WHERE cookie = '$c'";	//查询用户名

					$data = mysqli_query($dbc_sql, $query);		//数据库查询
					$row = mysqli_fetch_array($data);			//获取用户名
					$user_name = $row['user_name'];				//输出用户名
				}
			else
			setcookie('user_id', '', time()-1);	//清除cookie
		}
	//继续执行

	$data_cdy_s = mysqli_fetch_array($data_cdy);
?>

<!DOCTYPE html>
<html>
<head>
	<title><?php echo $data_cdy_s['name']; ?></title>
</head>
<body>

</body>
</html>