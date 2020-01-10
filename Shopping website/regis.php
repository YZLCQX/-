<?php //2020.1.3  ?>
<?php
	//注册页面
	require_once('user status.php');	//包含登录状态判断php文件
	$error_info = '';	//用户错误信息

	if(isset($_POST['submit']) && isset($_POST['password1']))	//判断用户是否提交过页面
		{
			//如果提交过页面 则执行下面语句
			$dbc_sql = mysqli_connect('127.0.0.1', 'root', '', 'web_user_info_data', 3306) or header('Location:error.html');  //如果出错则重定向至错误页面

			//对字符转义防止注入
			$user_name = mysqli_real_escape_string($dbc_sql,trim($_POST['username']));	
			$user_password1 = mysqli_real_escape_string($dbc_sql,trim($_POST['password1']));	
			$user_password2 = mysqli_real_escape_string($dbc_sql,trim($_POST['password2']));	

			if(!empty($user_name) && !empty($user_password1) && !empty($user_password2))	//判断密码或用户名是否为空
				{
					if(!strcmp($user_password1,$user_password2))	//判断密码是否一致
						{
							$query = "SELECT name FROM web_user_info_table WHERE name = '$user_name'";	//查询用户名是否重复
							$data = mysqli_query($dbc_sql,$query);	//查询

							if(mysqli_num_rows($data) == 0)	//判断用户名是否被占用
								{	
									$time = date('Y-m-d H:i:s',time());	//用户创建时间
									$s = sha1($user_password1);	//密码哈希
									//没有占用 完成注册
									$query = "INSERT INTO web_user_info_table(name,password,creation_time) ".
									"VALUES ('$user_name', '$s', '$time')";

									mysqli_query($dbc_sql, $query);	//将用户信息插入数据库

									do{
										$cookie_id = genaret($user_name);	//生成cookie
										$query = "SELECT cookie FROM web_cookie_table WHERE cookie = '$cookie_id'";	//查询cookie是否重复
										$data = mysqli_query($dbc_sql,$query);		//输入数据库查询
									  }while (mysqli_num_rows($data) != 0);

									  $time = time();

									$query = "INSERT INTO web_cookie_table(cookie,user_name,time) ".
									"VALUES ('$cookie_id', '$user_name', '$time')";		//插入cookie跟创建时间

									mysqli_query($dbc_sql, $query);		//将语句插入数据库
									setcookie('user_id',$cookie_id);	//设置cookie

									echo "<meta http-equiv=\"refresh\" content=\"3; url=index.php\">";		//设置3秒后跳转
									echo "<h1 style=\"margin-left: 40%; margin-top: 10%\" >完成注册，正在跳转</h1>";
									exit();		//到这里停止运行
								}
								else
								{
									$error_info = '用户名被占用!';
								}
						}
						else
						{	
							$error_info = '两次密码不一致!';
						}
				}
				else
				{
					if(!empty($user_name))
						$error_info = '请输入密码！';
					else
						$error_info = '请输入用户名！';
				}	//密码或用户名是否为空

		}	//第一次使用
?>


<!DOCTYPE html>
<html>
<head>
	<title>注册</title>
	<link href="css/regis.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="filling"></div>

	<div id="input">
		<h2 id="biaoti">注册</h2>
		<form action="regis.php"  method="post">
			<div id="form">用户名:  <input type="text" name="username"  placeholder="用户名" id="distance1"></div>
			<div id="form">密  码: <input type="password" name="password1"  placeholder="密码" id="distance"></div>
			<div id="form">确认密码: <input type="password" name="password2"  placeholder="确认密码" id="distance2"></div>
			<div id="prompt"><p id="ip"><?php echo $error_info; ?></p></div>
			<div id="sub">
				<input type="submit" name="submit" value="注册">
				<input type="reset" value="清空" id="reset">
			</div>
		</form>
	</div>
</body>
</html>


<?php
	//生成cookie
	function genaret($user)
		{
			return sha1($user.microtime());	//用户名跟毫秒时间戳哈希
		}
?>