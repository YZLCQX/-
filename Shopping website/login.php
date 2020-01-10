<?php //2020.1.6 ?>
<?php
	//登录界面	
	require_once('Function library.php');	//包含登录状态判断php文件
	$error_info = '';	//用户错误信息

	if(isset($_POST['submit']))	//判断用户是否提交过页面
		{
			//如果提交过页面 则执行下面语句
			$dbc_sql = mysqli_connect('127.0.0.1', 'root', '', 'web_user_info_data', 3306) or header('Location:error.html');  //如果出错则重定向至错误页面

			//对字符转义防止注入
			$user_name = mysqli_real_escape_string($dbc_sql,trim($_POST['username']));	
			$user_password = mysqli_real_escape_string($dbc_sql,trim($_POST['password']));

			if(!empty($user_name) && !empty($user_password))	//判断密码或用户名是否为空
				{
					$user_password = sha1($user_password);	//对密码哈希

					$query = "SELECT name, password FROM web_user_info_table WHERE name = '$user_name' AND password = '$user_password'";	//查询用户名跟密码是否正确
					$data = mysqli_query($dbc_sql, $query);

					if(mysqli_num_rows($data) == 1)
						{
							$cookie_id = genaret($user_name);	//生成cookie
							$time = time();						//获取时间
							$query = "INSERT INTO web_cookie_table(cookie,user_name,time) VALUES ('$cookie_id', '$user_name', '$time')";		//插入cookie跟创建时间
							mysqli_query($dbc_sql, $query);		//将语句插入数据库
							setcookie('user_id',$cookie_id);	//设置cookie
							echo "<meta http-equiv=\"refresh\" content=\"0; url=index.php\">";		//设置立即跳转
							exit();		//到这里停止运行
						}
						else
						{
							$error_info = '用户名或密码错误!';
						}
				}
				else
				{
					if(!empty($user_name))
						$error_info = '请输入密码！';
					else
						$error_info = '请输入用户名！';
				}	//密码或用户名是否为空
		}//第一次使用
?>

<!DOCTYPE html>
<html>
<head>
	<title>登录</title>
	<link href="css/login.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="filling"></div>

	<div id="input">
		<h2 id="biaoti">登录</h2>
		<form action="login.php"  method="post">
			<div id="form">用户名:  <input type="text" name="username"  placeholder="用户名" id="distance1"></div>
			<div id="form">密  码: <input type="password" name="password"  placeholder="密码" id="distance"></div>
			<div id="prompt"><p id="ip"><?php echo $error_info; ?></p></div>
			<div id="sub">
				<input type="submit" name="submit" class="button" value="登录">
				<input type="reset" value="清空" class="button" id="reset">
			</div>
			<a href="regis.php" id="a">注册</a>
		</form>
	</div>
</body>
</html>
