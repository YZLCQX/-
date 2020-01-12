<?php //2020.1.11 ?>

<?php
	$dbc_sql = mysqli_connect('127.0.0.1', 'root', '', 'web_user_info_data', 3306) or header('Location:error.html');  //如果出错则重定向至错误页面
	
	if(!isset($_GET['cdy']))
		{
			echo "<h1>URL错误</h1>";
			echo "请检查URL";
			exit(0);	
		}

	$cdy = $_GET['cdy'];	//获取是什么商品

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
	<link rel="stylesheet" type="text/css" href="css/index.css" />
	<link rel="stylesheet" type="text/css" href="css/Buy_Home.css" />
	<meta charset="utf-8" />

	<title><?php echo $data_cdy_s['name']; ?></title>
</head>
<body>
	<div class="header">		<!-- 导航栏 -->
		<ul class="header_ul">	
			<?php 
				if($log)
					{
						echo '<li><a href="#" class="header_ul_a"><img src="img/user.png"  height="14" width="14" style="margin-top:2px;" /><font size="3">'.$user_name.'</font></a></li>';
						echo '<li>|</li>';
						echo '<li><a href="#" class="header_ul_a"><font size="2">购物车</font></a></li>';
						echo '<li>|</li>';
						echo '<li><a href="log out.php" class="header_ul_a"><font size="2">退出</font></a></li>';
					}
					else
					{
						echo '<li><a href="regis.php" class="header_ul_a"><font size="2">注册</font></a></li>';
						echo '<li>|</li>';
						echo '<li><a href="login.php" class="header_ul_a"><font size="2">登录</font></a></li>';
					}
			?>
		</ul>
	</div>

	<div class="frame"></div>	<!--顶框 -->

	<div class="Buy_Home">
		<div class="Above_b">
			<div class="product_picture">
				
			</div>
		</div>
	</div>

</body>
</html>